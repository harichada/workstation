/**
 * @file dll/fs.c
 *
 * @copyright 2015-2018 Bill Zissimopoulos
 */
/*
 * This file is part of WinFsp.
 *
 * You can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 3 as published by the Free Software
 * Foundation.
 *
 * Licensees holding a valid commercial license may use this software
 * in accordance with the commercial license agreement provided in
 * conjunction with the software.  The terms and conditions of any such
 * commercial license agreement shall govern, supersede, and render
 * ineffective any application of the GPLv3 license to this software,
 * notwithstanding of any reference thereto in the software or
 * associated repository.
 */

#include <dll/library.h>

enum
{
    FspFileSystemDispatcherThreadCountMin = 2,
};

static FSP_FILE_SYSTEM_INTERFACE FspFileSystemNullInterface;

static INIT_ONCE FspFileSystemInitOnce = INIT_ONCE_STATIC_INIT;
static DWORD FspFileSystemTlsKey = TLS_OUT_OF_INDEXES;
static NTSTATUS (NTAPI *FspNtOpenSymbolicLinkObject)(
    PHANDLE LinkHandle, ACCESS_MASK DesiredAccess, POBJECT_ATTRIBUTES ObjectAttributes);
static NTSTATUS (NTAPI *FspNtMakeTemporaryObject)(
    HANDLE Handle);
static NTSTATUS (NTAPI *FspNtClose)(
    HANDLE Handle);

static BOOL WINAPI FspFileSystemInitialize(
    PINIT_ONCE InitOnce, PVOID Parameter, PVOID *Context)
{
    HANDLE Handle;

    FspFileSystemTlsKey = TlsAlloc();

    Handle = GetModuleHandleW(L"ntdll.dll");
    if (0 != Handle)
    {
        FspNtOpenSymbolicLinkObject = (PVOID)GetProcAddress(Handle, "NtOpenSymbolicLinkObject");
        FspNtMakeTemporaryObject = (PVOID)GetProcAddress(Handle, "NtMakeTemporaryObject");
        FspNtClose = (PVOID)GetProcAddress(Handle, "NtClose");

        if (0 == FspNtOpenSymbolicLinkObject || 0 == FspNtMakeTemporaryObject || 0 == FspNtClose)
        {
            FspNtOpenSymbolicLinkObject = 0;
            FspNtMakeTemporaryObject = 0;
            FspNtClose = 0;
        }
    }

    return TRUE;
}

VOID FspFileSystemFinalize(BOOLEAN Dynamic)
{
    /*
     * This function is called during DLL_PROCESS_DETACH. We must therefore keep
     * finalization tasks to a minimum.
     *
     * We must free our TLS key (if any). We only do so if the library
     * is being explicitly unloaded (rather than the process exiting).
     */

    if (Dynamic && TLS_OUT_OF_INDEXES != FspFileSystemTlsKey)
        TlsFree(FspFileSystemTlsKey);
}

FSP_API NTSTATUS FspFileSystemPreflight(PWSTR DevicePath,
    PWSTR MountPoint)
{
    NTSTATUS Result;
    WCHAR TargetPath[MAX_PATH];
    HANDLE DirHandle;

    Result = FspFsctlPreflight(DevicePath);
    if (!NT_SUCCESS(Result))
        return Result;

    if (0 == MountPoint)
        Result = STATUS_SUCCESS;
    else
    {
        if (FspPathIsDrive(MountPoint))
            Result = QueryDosDeviceW(MountPoint, TargetPath, MAX_PATH) ?
                STATUS_OBJECT_NAME_COLLISION : STATUS_SUCCESS;
        else
        {
            DirHandle = CreateFileW(MountPoint,
                FILE_READ_ATTRIBUTES,
                FILE_SHARE_READ | FILE_SHARE_WRITE | FILE_SHARE_DELETE,
                0,
                OPEN_EXISTING,
                FILE_FLAG_BACKUP_SEMANTICS | FILE_FLAG_OPEN_REPARSE_POINT,
                0);
            if (INVALID_HANDLE_VALUE != DirHandle)
            {
                CloseHandle(DirHandle);
                Result = STATUS_OBJECT_NAME_COLLISION;
            }
            else if (ERROR_FILE_NOT_FOUND != GetLastError())
                Result = STATUS_OBJECT_NAME_INVALID;
            else
                Result = STATUS_SUCCESS;
        }
    }

    return Result;
}

FSP_API NTSTATUS FspFileSystemCreate(PWSTR DevicePath,
    const FSP_FSCTL_VOLUME_PARAMS *VolumeParams,
    const FSP_FILE_SYSTEM_INTERFACE *Interface,
    FSP_FILE_SYSTEM **PFileSystem)
{
    NTSTATUS Result;
    FSP_FILE_SYSTEM *FileSystem;

    *PFileSystem = 0;

    if (VolumeParams->UmFileContextIsUserContext2 &&
        VolumeParams->UmFileContextIsFullContext)
        return STATUS_INVALID_PARAMETER;

    if (0 == Interface)
        Interface = &FspFileSystemNullInterface;

    InitOnceExecuteOnce(&FspFileSystemInitOnce, FspFileSystemInitialize, 0, 0);
    if (TLS_OUT_OF_INDEXES == FspFileSystemTlsKey)
        return STATUS_INSUFFICIENT_RESOURCES;

    FileSystem = MemAlloc(sizeof *FileSystem);
    if (0 == FileSystem)
        return STATUS_INSUFFICIENT_RESOURCES;
    memset(FileSystem, 0, sizeof *FileSystem);

    Result = FspFsctlCreateVolume(DevicePath, VolumeParams,
        FileSystem->VolumeName, sizeof FileSystem->VolumeName,
        &FileSystem->VolumeHandle);
    if (!NT_SUCCESS(Result))
    {
        MemFree(FileSystem);
        return Result;
    }

    FileSystem->Operations[FspFsctlTransactCreateKind] = FspFileSystemOpCreate;
    FileSystem->Operations[FspFsctlTransactOverwriteKind] = FspFileSystemOpOverwrite;
    FileSystem->Operations[FspFsctlTransactCleanupKind] = FspFileSystemOpCleanup;
    FileSystem->Operations[FspFsctlTransactCloseKind] = FspFileSystemOpClose;
    FileSystem->Operations[FspFsctlTransactReadKind] = FspFileSystemOpRead;
    FileSystem->Operations[FspFsctlTransactWriteKind] = FspFileSystemOpWrite;
    FileSystem->Operations[FspFsctlTransactQueryInformationKind] = FspFileSystemOpQueryInformation;
    FileSystem->Operations[FspFsctlTransactSetInformationKind] = FspFileSystemOpSetInformation;
    FileSystem->Operations[FspFsctlTransactFlushBuffersKind] = FspFileSystemOpFlushBuffers;
    FileSystem->Operations[FspFsctlTransactQueryVolumeInformationKind] = FspFileSystemOpQueryVolumeInformation;
    FileSystem->Operations[FspFsctlTransactSetVolumeInformationKind] = FspFileSystemOpSetVolumeInformation;
    FileSystem->Operations[FspFsctlTransactQueryDirectoryKind] = FspFileSystemOpQueryDirectory;
    FileSystem->Operations[FspFsctlTransactFileSystemControlKind] = FspFileSystemOpFileSystemControl;
    FileSystem->Operations[FspFsctlTransactDeviceControlKind] = FspFileSystemOpDeviceControl;
    FileSystem->Operations[FspFsctlTransactQuerySecurityKind] = FspFileSystemOpQuerySecurity;
    FileSystem->Operations[FspFsctlTransactSetSecurityKind] = FspFileSystemOpSetSecurity;
    FileSystem->Operations[FspFsctlTransactQueryStreamInformationKind] = FspFileSystemOpQueryStreamInformation;
    FileSystem->Interface = Interface;

    FileSystem->OpGuardStrategy = FSP_FILE_SYSTEM_OPERATION_GUARD_STRATEGY_FINE;
    InitializeSRWLock(&FileSystem->OpGuardLock);
    FileSystem->EnterOperation = FspFileSystemOpEnter;
    FileSystem->LeaveOperation = FspFileSystemOpLeave;

    FileSystem->UmFileContextIsUserContext2 = !!VolumeParams->UmFileContextIsUserContext2;
    FileSystem->UmFileContextIsFullContext = !!VolumeParams->UmFileContextIsFullContext;

    *PFileSystem = FileSystem;

    return STATUS_SUCCESS;
}

FSP_API VOID FspFileSystemDelete(FSP_FILE_SYSTEM *FileSystem)
{
    FspFileSystemRemoveMountPoint(FileSystem);
    CloseHandle(FileSystem->VolumeHandle);
    MemFree(FileSystem);
}

static NTSTATUS FspFileSystemLauncherDefineDosDevice(
    WCHAR Sign, PWSTR MountPoint, PWSTR VolumeName)
{
    if (2 != lstrlenW(MountPoint) ||
        FSP_FSCTL_VOLUME_NAME_SIZEMAX / sizeof(WCHAR) <= lstrlenW(VolumeName))
        return STATUS_INVALID_PARAMETER;

    WCHAR Argv0[4];
    PWSTR Argv[2];
    NTSTATUS Result;
    ULONG ErrorCode;

    Argv0[0] = Sign;
    Argv0[1] = MountPoint[0];
    Argv0[2] = MountPoint[1];
    Argv0[3] = L'\0';

    Argv[0] = Argv0;
    Argv[1] = VolumeName;

    Result = FspLaunchCallLauncherPipe(FspLaunchCmdDefineDosDevice, 2, Argv, 0, 0, 0, &ErrorCode);
    return !NT_SUCCESS(Result) ? Result : FspNtStatusFromWin32(ErrorCode);
}

static NTSTATUS FspFileSystemSetMountPoint_Drive(PWSTR MountPoint, PWSTR VolumeName,
    PHANDLE PMountHandle)
{
    NTSTATUS Result;
    BOOLEAN IsLocalSystem, IsServiceContext;

    *PMountHandle = 0;

    Result = FspServiceContextCheck(0, &IsLocalSystem);
    IsServiceContext = NT_SUCCESS(Result) && !IsLocalSystem;
    if (IsServiceContext)
    {
        /*
         * If the current process is in the service context but not LocalSystem,
         * ask the launcher to DefineDosDevice for us. This is because the launcher
         * runs in the LocalSystem context and can create global drives.
         *
         * In this case the launcher will also add DELETE access to the drive symlink
         * for us, so that we can make it temporary below.
         */
        Result = FspFileSystemLauncherDefineDosDevice(L'+', MountPoint, VolumeName);
        if (!NT_SUCCESS(Result))
            return Result;
    }
    else
    {
        if (!DefineDosDeviceW(DDD_RAW_TARGET_PATH, MountPoint, VolumeName))
            return FspNtStatusFromWin32(GetLastError());
    }

    if (0 != FspNtOpenSymbolicLinkObject)
    {
        WCHAR SymlinkBuf[6];
        UNICODE_STRING Symlink;
        OBJECT_ATTRIBUTES Obja;

        memcpy(SymlinkBuf, L"\\??\\X:", sizeof SymlinkBuf);
        SymlinkBuf[4] = MountPoint[0];
        Symlink.Length = Symlink.MaximumLength = sizeof SymlinkBuf;
        Symlink.Buffer = SymlinkBuf;

        memset(&Obja, 0, sizeof Obja);
        Obja.Length = sizeof Obja;
        Obja.ObjectName = &Symlink;
        Obja.Attributes = OBJ_CASE_INSENSITIVE;

        Result = FspNtOpenSymbolicLinkObject(PMountHandle, DELETE, &Obja);
        if (NT_SUCCESS(Result))
        {
            Result = FspNtMakeTemporaryObject(*PMountHandle);
            if (!NT_SUCCESS(Result))
            {
                FspNtClose(*PMountHandle);
                *PMountHandle = 0;
            }
        }
    }

    /* HACK:
     *
     * Handles do not use the low 2 bits (unless they are console handles).
     * Abuse this fact to remember that we are running in the service context.
     */
    *PMountHandle = (HANDLE)(UINT_PTR)((DWORD)(UINT_PTR)*PMountHandle | IsServiceContext);

    return STATUS_SUCCESS;
}

static NTSTATUS FspFileSystemSetMountPoint_Directory(PWSTR MountPoint, PWSTR VolumeName,
    PSECURITY_DESCRIPTOR SecurityDescriptor, PHANDLE PMountHandle)
{
    NTSTATUS Result;
    SECURITY_ATTRIBUTES SecurityAttributes;
    HANDLE MountHandle = INVALID_HANDLE_VALUE;
    DWORD Backslashes, Bytes;
    USHORT VolumeNameLength, BackslashLength, ReparseDataLength;
    PREPARSE_DATA_BUFFER ReparseData = 0;
    PWSTR P, PathBuffer;

    *PMountHandle = 0;

    /*
     * Windows does not allow mount points (junctions) to point to network file systems.
     *
     * Count how many backslashes our VolumeName has. If it is 3 or more this is a network
     * file system. Preemptively return STATUS_NETWORK_ACCESS_DENIED.
     */
    for (P = VolumeName, Backslashes = 0; *P; P++)
        if (L'\\' == *P)
            if (3 == ++Backslashes)
            {
                Result = STATUS_NETWORK_ACCESS_DENIED;
                goto exit;
            }

    memset(&SecurityAttributes, 0, sizeof SecurityAttributes);
    SecurityAttributes.nLength = sizeof SecurityAttributes;
    SecurityAttributes.lpSecurityDescriptor = SecurityDescriptor;

    MountHandle = CreateFileW(MountPoint,
        FILE_WRITE_ATTRIBUTES,
        FILE_SHARE_READ | FILE_SHARE_WRITE | FILE_SHARE_DELETE,
        &SecurityAttributes,
        CREATE_NEW,
        FILE_ATTRIBUTE_DIRECTORY |
            FILE_FLAG_BACKUP_SEMANTICS | FILE_FLAG_POSIX_SEMANTICS | FILE_FLAG_DELETE_ON_CLOSE,
        0);
    if (INVALID_HANDLE_VALUE == MountHandle)
    {
        Result = FspNtStatusFromWin32(GetLastError());
        goto exit;
    }

    VolumeNameLength = (USHORT)lstrlenW(VolumeName);
    BackslashLength = 0 == VolumeNameLength || L'\\' != VolumeName[VolumeNameLength - 1];
    VolumeNameLength *= sizeof(WCHAR);
    BackslashLength *= sizeof(WCHAR);

    ReparseDataLength = (USHORT)(
        FIELD_OFFSET(REPARSE_DATA_BUFFER, MountPointReparseBuffer.PathBuffer) -
        FIELD_OFFSET(REPARSE_DATA_BUFFER, MountPointReparseBuffer)) +
        2 * (VolumeNameLength + BackslashLength + sizeof(WCHAR));
    ReparseData = MemAlloc(REPARSE_DATA_BUFFER_HEADER_SIZE + ReparseDataLength);
    if (0 == ReparseData)
    {
        Result = STATUS_INSUFFICIENT_RESOURCES;
        goto exit;
    }

    ReparseData->ReparseTag = IO_REPARSE_TAG_MOUNT_POINT;
    ReparseData->ReparseDataLength = ReparseDataLength;
    ReparseData->Reserved = 0;
    ReparseData->MountPointReparseBuffer.SubstituteNameOffset = 0;
    ReparseData->MountPointReparseBuffer.SubstituteNameLength =
        VolumeNameLength + BackslashLength;
    ReparseData->MountPointReparseBuffer.PrintNameOffset =
        ReparseData->MountPointReparseBuffer.SubstituteNameLength + sizeof(WCHAR);
    ReparseData->MountPointReparseBuffer.PrintNameLength =
        VolumeNameLength + BackslashLength;

    PathBuffer = ReparseData->MountPointReparseBuffer.PathBuffer;
    memcpy(PathBuffer, VolumeName, VolumeNameLength);
    if (BackslashLength)
        PathBuffer[VolumeNameLength / sizeof(WCHAR)] = L'\\';
    PathBuffer[(VolumeNameLength + BackslashLength) / sizeof(WCHAR)] = L'\0';

    PathBuffer = ReparseData->MountPointReparseBuffer.PathBuffer +
        (ReparseData->MountPointReparseBuffer.PrintNameOffset) / sizeof(WCHAR);
    memcpy(PathBuffer, VolumeName, VolumeNameLength);
    if (BackslashLength)
        PathBuffer[VolumeNameLength / sizeof(WCHAR)] = L'\\';
    PathBuffer[(VolumeNameLength + BackslashLength) / sizeof(WCHAR)] = L'\0';

    if (!DeviceIoControl(MountHandle, FSCTL_SET_REPARSE_POINT,
        ReparseData, REPARSE_DATA_BUFFER_HEADER_SIZE + ReparseData->ReparseDataLength,
        0, 0,
        &Bytes, 0))
    {
        Result = FspNtStatusFromWin32(GetLastError());
        goto exit;
    }

    *PMountHandle = MountHandle;

    Result = STATUS_SUCCESS;

exit:
    if (!NT_SUCCESS(Result) && INVALID_HANDLE_VALUE != MountHandle)
        CloseHandle(MountHandle);

    MemFree(ReparseData);

    return Result;
}

FSP_API NTSTATUS FspFileSystemSetMountPoint(FSP_FILE_SYSTEM *FileSystem, PWSTR MountPoint)
{
    return FspFileSystemSetMountPointEx(FileSystem, MountPoint, 0);
}

FSP_API NTSTATUS FspFileSystemSetMountPointEx(FSP_FILE_SYSTEM *FileSystem, PWSTR MountPoint,
    PSECURITY_DESCRIPTOR SecurityDescriptor)
{
    if (0 != FileSystem->MountPoint)
        return STATUS_INVALID_PARAMETER;

    NTSTATUS Result;
    HANDLE MountHandle = 0;

    if (0 == MountPoint)
    {
        DWORD Drives;
        WCHAR Drive;

        MountPoint = MemAlloc(3 * sizeof(WCHAR));
        if (0 == MountPoint)
            return STATUS_INSUFFICIENT_RESOURCES;
        MountPoint[1] = L':';
        MountPoint[2] = L'\0';

        Drives = GetLogicalDrives();
        if (0 != Drives)
        {
            for (Drive = 'Z'; 'D' <= Drive; Drive--)
                if (0 == (Drives & (1 << (Drive - 'A'))))
                {
                    MountPoint[0] = Drive;
                    Result = FspFileSystemSetMountPoint_Drive(MountPoint, FileSystem->VolumeName,
                        &MountHandle);
                    if (NT_SUCCESS(Result))
                        goto exit;
                }
            Result = STATUS_NO_SUCH_DEVICE;
        }
        else
            Result = FspNtStatusFromWin32(GetLastError());
    }
    else
    {
        PWSTR P;
        ULONG L;

        L = (ULONG)((lstrlenW(MountPoint) + 1) * sizeof(WCHAR));

        P = MemAlloc(L);
        if (0 == P)
            return STATUS_INSUFFICIENT_RESOURCES;
        memcpy(P, MountPoint, L);
        MountPoint = P;

        if (FspPathIsDrive(MountPoint))
            Result = FspFileSystemSetMountPoint_Drive(MountPoint, FileSystem->VolumeName,
                &MountHandle);
        else
            Result = FspFileSystemSetMountPoint_Directory(MountPoint, FileSystem->VolumeName,
                SecurityDescriptor, &MountHandle);
    }

exit:
    if (NT_SUCCESS(Result))
    {
        FileSystem->MountPoint = MountPoint;
        FileSystem->MountHandle = MountHandle;
    }
    else
        MemFree(MountPoint);

    return Result;
}

static VOID FspFileSystemRemoveMountPoint_Drive(PWSTR MountPoint, PWSTR VolumeName, HANDLE MountHandle)
{
    BOOLEAN IsServiceContext = 0 != ((DWORD)(UINT_PTR)MountHandle & 1);
    MountHandle = (HANDLE)(UINT_PTR)((DWORD)(UINT_PTR)MountHandle & ~1);
    if (IsServiceContext)
        /*
         * If the current process is in the service context but not LocalSystem,
         * ask the launcher to DefineDosDevice for us. This is because the launcher
         * runs in the LocalSystem context and can remove global drives.
         */
        FspFileSystemLauncherDefineDosDevice(L'-', MountPoint, VolumeName);
    else
        DefineDosDeviceW(DDD_RAW_TARGET_PATH | DDD_REMOVE_DEFINITION | DDD_EXACT_MATCH_ON_REMOVE,
            MountPoint, VolumeName);

    if (0 != MountHandle)
        FspNtClose(MountHandle);
}

static VOID FspFileSystemRemoveMountPoint_Directory(HANDLE MountHandle)
{
    /* directory is marked DELETE_ON_CLOSE */
    CloseHandle(MountHandle);
}

FSP_API VOID FspFileSystemRemoveMountPoint(FSP_FILE_SYSTEM *FileSystem)
{
    if (0 == FileSystem->MountPoint)
        return;

    if (FspPathIsDrive(FileSystem->MountPoint))
        FspFileSystemRemoveMountPoint_Drive(FileSystem->MountPoint, FileSystem->VolumeName,
            FileSystem->MountHandle);
    else
        FspFileSystemRemoveMountPoint_Directory(FileSystem->MountHandle);

    MemFree(FileSystem->MountPoint);
    FileSystem->MountPoint = 0;
    FileSystem->MountHandle = 0;
}

static DWORD WINAPI FspFileSystemDispatcherThread(PVOID FileSystem0)
{
    FSP_FILE_SYSTEM *FileSystem = FileSystem0;
    NTSTATUS Result;
    SIZE_T RequestSize, ResponseSize;
    FSP_FSCTL_TRANSACT_REQ *Request = 0;
    FSP_FSCTL_TRANSACT_RSP *Response = 0;
    FSP_FILE_SYSTEM_OPERATION_CONTEXT OperationContext;
    HANDLE DispatcherThread = 0;

    Request = MemAlloc(FSP_FSCTL_TRANSACT_BUFFER_SIZEMIN);
    Response = MemAlloc(FSP_FSCTL_TRANSACT_RSP_SIZEMAX);
    if (0 == Request || 0 == Response)
    {
        Result = STATUS_INSUFFICIENT_RESOURCES;
        goto exit;
    }

    if (1 < FileSystem->DispatcherThreadCount)
    {
        FileSystem->DispatcherThreadCount--;
        DispatcherThread = CreateThread(0, 0, FspFileSystemDispatcherThread, FileSystem, 0, 0);
        if (0 == DispatcherThread)
        {
            Result = FspNtStatusFromWin32(GetLastError());
            goto exit;
        }
    }

    OperationContext.Request = Request;
    OperationContext.Response = Response;
    TlsSetValue(FspFileSystemTlsKey, &OperationContext);

    memset(Response, 0, sizeof *Response);
    for (;;)
    {
        RequestSize = FSP_FSCTL_TRANSACT_BUFFER_SIZEMIN;
        Result = FspFsctlTransact(FileSystem->VolumeHandle,
            Response, Response->Size, Request, &RequestSize, FALSE);
        if (!NT_SUCCESS(Result))
            goto exit;

        memset(Response, 0, sizeof *Response);
        if (0 == RequestSize)
            continue;

        if (FileSystem->DebugLog)
        {
            if (FspFsctlTransactKindCount <= Request->Kind ||
                (FileSystem->DebugLog & (1 << Request->Kind)))
                FspDebugLogRequest(Request);
        }

        Response->Size = sizeof *Response;
        Response->Kind = Request->Kind;
        Response->Hint = Request->Hint;
        if (FspFsctlTransactKindCount > Request->Kind && 0 != FileSystem->Operations[Request->Kind])
        {
            Response->IoStatus.Status =
                FspFileSystemEnterOperation(FileSystem, Request, Response);
            if (NT_SUCCESS(Response->IoStatus.Status))
            {
                Response->IoStatus.Status =
                    FileSystem->Operations[Request->Kind](FileSystem, Request, Response);
                FspFileSystemLeaveOperation(FileSystem, Request, Response);
            }
        }
        else
            Response->IoStatus.Status = STATUS_INVALID_DEVICE_REQUEST;

        if (FileSystem->DebugLog)
        {
            if (FspFsctlTransactKindCount <= Response->Kind ||
                (FileSystem->DebugLog & (1 << Response->Kind)))
                FspDebugLogResponse(Response);
        }

        ResponseSize = FSP_FSCTL_DEFAULT_ALIGN_UP(Response->Size);
        if (FSP_FSCTL_TRANSACT_RSP_SIZEMAX < ResponseSize/* should NOT happen */)
        {
            memset(Response, 0, sizeof *Response);
            Response->Size = sizeof *Response;
            Response->Kind = Request->Kind;
            Response->Hint = Request->Hint;
            Response->IoStatus.Status = STATUS_INVALID_DEVICE_REQUEST;
        }
        else if (STATUS_PENDING == Response->IoStatus.Status)
            memset(Response, 0, sizeof *Response);
        else
        {
            memset((PUINT8)Response + Response->Size, 0, ResponseSize - Response->Size);
            Response->Size = (UINT16)ResponseSize;
        }
    }

exit:
    TlsSetValue(FspFileSystemTlsKey, 0);
    MemFree(Response);
    MemFree(Request);

    FspFileSystemSetDispatcherResult(FileSystem, Result);

    FspFsctlStop(FileSystem->VolumeHandle);

    if (0 != DispatcherThread)
    {
        WaitForSingleObject(DispatcherThread, INFINITE);
        CloseHandle(DispatcherThread);
    }

    return Result;
}

FSP_API NTSTATUS FspFileSystemStartDispatcher(FSP_FILE_SYSTEM *FileSystem, ULONG ThreadCount)
{
    if (0 != FileSystem->DispatcherThread)
        return STATUS_INVALID_PARAMETER;

    if (0 == ThreadCount)
    {
        DWORD_PTR ProcessMask, SystemMask;

        if (!GetProcessAffinityMask(GetCurrentProcess(), &ProcessMask, &SystemMask))
            return FspNtStatusFromWin32(GetLastError());

        for (ThreadCount = 0; 0 != ProcessMask; ProcessMask >>= 1)
            ThreadCount += ProcessMask & 1;
    }

    if (ThreadCount < FspFileSystemDispatcherThreadCountMin)
        ThreadCount = FspFileSystemDispatcherThreadCountMin;

    FileSystem->DispatcherThreadCount = ThreadCount;
    FileSystem->DispatcherThread = CreateThread(0, 0,
        FspFileSystemDispatcherThread, FileSystem, 0, 0);
    if (0 == FileSystem->DispatcherThread)
        return FspNtStatusFromWin32(GetLastError());

    return STATUS_SUCCESS;
}

FSP_API VOID FspFileSystemStopDispatcher(FSP_FILE_SYSTEM *FileSystem)
{
    if (0 == FileSystem->DispatcherThread)
        return;

    FspFsctlStop(FileSystem->VolumeHandle);

    WaitForSingleObject(FileSystem->DispatcherThread, INFINITE);
    CloseHandle(FileSystem->DispatcherThread);
    FileSystem->DispatcherThread = 0;
}

FSP_API VOID FspFileSystemSendResponse(FSP_FILE_SYSTEM *FileSystem,
    FSP_FSCTL_TRANSACT_RSP *Response)
{
    NTSTATUS Result;

    if (FileSystem->DebugLog)
    {
        if (FspFsctlTransactKindCount <= Response->Kind ||
            (FileSystem->DebugLog & (1 << Response->Kind)))
            FspDebugLogResponse(Response);
    }

    Result = FspFsctlTransact(FileSystem->VolumeHandle,
        Response, Response->Size, 0, 0, FALSE);
    if (!NT_SUCCESS(Result))
    {
        FspFileSystemSetDispatcherResult(FileSystem, Result);

        FspFsctlStop(FileSystem->VolumeHandle);
    }
}

FSP_API FSP_FILE_SYSTEM_OPERATION_CONTEXT *FspFileSystemGetOperationContext(VOID)
{
    return (FSP_FILE_SYSTEM_OPERATION_CONTEXT *)TlsGetValue(FspFileSystemTlsKey);
}

/*
 * Out-of-Line
 */

FSP_API PWSTR FspFileSystemMountPointF(FSP_FILE_SYSTEM *FileSystem)
{
    return FspFileSystemMountPoint(FileSystem);
}

FSP_API NTSTATUS FspFileSystemEnterOperationF(FSP_FILE_SYSTEM *FileSystem,
    FSP_FSCTL_TRANSACT_REQ *Request, FSP_FSCTL_TRANSACT_RSP *Response)
{
    return FspFileSystemEnterOperation(FileSystem, Request, Response);
}

FSP_API NTSTATUS FspFileSystemLeaveOperationF(FSP_FILE_SYSTEM *FileSystem,
    FSP_FSCTL_TRANSACT_REQ *Request, FSP_FSCTL_TRANSACT_RSP *Response)
{
    return FspFileSystemLeaveOperation(FileSystem, Request, Response);
}

FSP_API VOID FspFileSystemSetOperationGuardF(FSP_FILE_SYSTEM *FileSystem,
    FSP_FILE_SYSTEM_OPERATION_GUARD *EnterOperation,
    FSP_FILE_SYSTEM_OPERATION_GUARD *LeaveOperation)
{
    FspFileSystemSetOperationGuard(FileSystem, EnterOperation, LeaveOperation);
}

FSP_API VOID FspFileSystemSetOperationGuardStrategyF(FSP_FILE_SYSTEM *FileSystem,
    FSP_FILE_SYSTEM_OPERATION_GUARD_STRATEGY GuardStrategy)
{
    FspFileSystemSetOperationGuardStrategy(FileSystem, GuardStrategy);
}

FSP_API VOID FspFileSystemSetOperationF(FSP_FILE_SYSTEM *FileSystem,
    ULONG Index,
    FSP_FILE_SYSTEM_OPERATION *Operation)
{
    FspFileSystemSetOperation(FileSystem, Index, Operation);
}

FSP_API VOID FspFileSystemGetDispatcherResultF(FSP_FILE_SYSTEM *FileSystem,
    NTSTATUS *PDispatcherResult)
{
    FspFileSystemGetDispatcherResult(FileSystem, PDispatcherResult);
}

FSP_API VOID FspFileSystemSetDispatcherResultF(FSP_FILE_SYSTEM *FileSystem,
    NTSTATUS DispatcherResult)
{
    FspFileSystemSetDispatcherResult(FileSystem, DispatcherResult);
}

FSP_API VOID FspFileSystemSetDebugLogF(FSP_FILE_SYSTEM *FileSystem,
    UINT32 DebugLog)
{
    FspFileSystemSetDebugLog(FileSystem, DebugLog);
}

FSP_API BOOLEAN FspFileSystemIsOperationCaseSensitiveF(VOID)
{
    return FspFileSystemIsOperationCaseSensitive();
}

FSP_API UINT32 FspFileSystemOperationProcessIdF(VOID)
{
    return FspFileSystemOperationProcessId();
}
