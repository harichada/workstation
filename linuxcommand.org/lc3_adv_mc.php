



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: Midnight Commander</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="">
		<link rel="next" href="">
		<link rel="contents" href="">
	</head>

	<body>
	<a name="top"></a>
		<table class="page" summary="This table is used for graphic layout.">
			<tr>
				<td>
					<div class="colorblock"></div>
				</td>
				<td></td>
			</tr>
			<tr>
				<td valign="top">
		<div class="navbar">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="lc3_learning_the_shell.php">Learning&nbsp;the&nbsp;Shell</a></li>
				<li><a href="lc3_writing_shell_scripts.php">Writing&nbsp;Shell&nbsp;Scripts</a></li>
				<li><a href="lc3_resources.php">Resources</a></li>
				<li><a href="tlcl.php">The Book</a></li>
				<li><a href="lc3_adventures.php">Adventures</a></li>
			</ul>
			<hr noshade>
			<ul>
				<li><a href="http://lcorg.blogspot.com">Blog</a></li>
			</ul>
		</div>
	
				</td>
				<td>
					<div class="body">
<h1 id="midnight-commander">Midnight Commander</h1>
<p>At the beginning of chapter 4 in TLCL there is a discussion of GUI-based file managers versus the traditional command line tools for file manipulation such as <code>cp</code>, <code>mv</code>, and <code>rm</code>. While many common file manipulations are easily done with a graphical file manager, the command line tools provide additional power and flexibility.</p>
<p>In this adventure we will look at Midnight Commander, a character-based directory browser and file manager that bridges the two worlds of the familiar graphical file manager and the common command line tools.</p>
<p>The design of Midnight Commander is based on a common concept in file managers: dual directory panes where the listings of two directories are shown at the same time. The idea is that files are moved or copied from the directory shown in one pane to the directory shown in the other. Midnight Commander can do this, and much, much more.</p>
<h2 id="features">Features</h2>
<p>Midnight Commander is quite powerful and boasts an extensive set of features:</p>
<ul>
<li><p>Performs all the common file and directory manipulations such as copying, moving, renaming, linking, and deleting.</p></li>
<li><p>Allows manipulation of file and directory permissions.</p></li>
<li><p>Can treat remote systems (via FTP or SSH) as though they were local directories.</p></li>
<li><p>Can treat archive files (like .tar and .zip) as though they were local directories.</p></li>
<li><p>Allows creation of a user-defined &quot;hotlist&quot; of frequently used directories.</p></li>
<li><p>Can search for files based on file name or file contents, and treat the search results like a directory.</p></li>
</ul>
<h2 id="availability">Availability</h2>
<p><a href="http://www.midnight-commander.org/" title="Midnight Commander Official Site">Midnight Commander</a> is part of the GNU project. It is installed by default in some Linux distributions, and is almost always available in every distribution's software repositories as the package &quot;mc&quot;.</p>
<h2 id="invocation">Invocation</h2>
<p>To start Midnight Commander, enter the command <code>mc</code> followed optionally by either 1 or 2 directories to browse at start up.</p>
<h2 id="screen-layout">Screen Layout</h2>
<div class="figure">
<img src="images/adventure_mc-overview.png" alt="Midnight Commander screen layout" ><p class="caption">Midnight Commander screen layout</p>
</div>
<ol style="list-style-type: decimal">
<li><p><strong>Left and Right Directory Panels</strong></p>
<p>The center portion of the screen is dominated by two large <em>directory panels</em>. One of the two panels (called the <em>current panel</em>) is active at any one time. To change which panel is the current panel, press the Tab key.</p></li>
<li><p><strong>Function Key Labels</strong></p>
<p>The bottom line on the display contains function key (F1-F10) shortcuts to the most commonly used functions.</p></li>
<li><p><strong>Menu Bar</strong></p>
<p>The top line of the display contains a set of pull-down menus. These can be activated by pressing the F9 key.</p></li>
<li><p><strong>Command Line</strong></p>
<p>Just above the function key labels there is a shell prompt. Commands can be entered in the usual manner. One especially useful command is <code>cd</code> followed by a directory pathname. This will change the directory shown in the current directory panel.</p></li>
<li><p><strong>Mini-Status Line</strong></p>
<p>At the very bottom of the directory panel and above the command line is the <em>mini-status line</em>. This area is used to display supplemental information about the currently selected item such as the targets of symbolic links.</p></li>
</ol>
<h2 id="using-the-keyboard-and-mouse">Using the Keyboard and Mouse</h2>
<p>Being a character-based application with a lot of features means Midnight Commander has a lot of keyboard commands, some of which it shares with other applications; others are unique. This makes Midnight Commander a bit challenging to learn. Fortunately, Midnight Commander also supports mouse input on most terminal emulators (and on the console if the <code>gpm</code> package is installed), so it's easy to pick up the basics. Learning the keyboard commands is needed to take full advantage of the program's features, however.</p>
<p>Another issue when using the keyboard with Midnight Commander is interference from the window manager and the terminal emulator itself. Many of the function keys and Alt-key combinations that Midnight Commander uses are intercepted for other purposes by the terminal and window manager.</p>
<p>To work around this problem, Midnight Commander allows the <code>Esc</code> key to function as a Meta-key. In cases where a function key or Alt-key combination is not available due to interference from outside programs, use the <code>Esc</code> key instead. For example, to input the F1 key, press and release the <code>Esc</code> key followed by the &quot;1&quot; key (use &quot;0&quot; for F10). The same method works with troublesome Alt-key combinations. For example, to enter Alt-t, press and release the <code>Esc</code> key followed by the &quot;t&quot; key. To close dialog boxes in Midnight Commander, press the <code>Esc</code> key twice.</p>
<h2 id="navigation-and-browsing">Navigation and Browsing</h2>
<p>Before we start performing file operations, it's important to learn how to use the directory panels and navigate the file system.</p>
<p>As we can see, there are two directory panels, the left panel and the right panel. At any one time, one of the panels is active and is called the <em>current panel</em>. The other panel is conveniently called the <em>other panel</em> in the Midnight Commander documentation.</p>
<p>The current panel can be identified by the highlighted bar in the directory listing, which can be moved up and down with the arrow keys, <code>PgUp</code>, <code>PgDn</code>, etc. Any file or directory which is highlighted is said to be <em>selected</em>.</p>
<p>Select a directory and press <code>Enter</code>. The current directory panel will change to the selected directory. Highlighting the topmost item in the listing selects the parent directory. It is also possible to change directories directly on the command line below the directory panels. To do so, simply enter <code>cd</code> followed by a path name as usual.</p>
<p>Pressing the <code>Tab</code> key switches the current panel.</p>
<h3 id="changing-the-listing-format">Changing the Listing Format</h3>
<p>The directory listing can be displayed in several different formats. Pressing <code>Alt-t</code> cycles through them. There is a dual column format, a format resembling the output of <code>ls -l</code>, and others.</p>
<p>There is also an &quot;information mode.&quot; This will display detailed file system information in the other panel about the selected item in the current panel. To invoke this mode, type <code>Ctrl-x i</code>. To return the other panel to its normal state, type <code>Ctrl-x i</code> again.</p>
<div class="figure">
<img src="images/adventure_mc-infomode.png" alt="Directory panel in information mode" ><p class="caption">Directory panel in information mode</p>
</div>
<h3 id="setting-the-directory-on-the-other-panel">Setting the Directory on the Other Panel</h3>
<p>It is often useful to select a directory in the current panel and have its contents listed on the other panel; for example, when moving files from a parent directory into a subdirectory. To do this, select a directory and type <code>Alt-o</code>. To force the other panel to list the same directory as the current panel, type <code>Alt-i</code>.</p>
<h3 id="the-directory-hotlist">The Directory Hotlist</h3>
<p>Midnight Commander can store a list of frequently visited directories. This &quot;hotlist&quot; can displayed by pressing <code>Ctrl-\</code>.</p>
<div class="figure">
<img src="images/adventure_mc-hotlist.png" alt="Directory hotlist" ><p class="caption">Directory hotlist</p>
</div>
<p>To add a directory to the hotlist while browsing, select a directory and type <code>Ctrl-x h</code>.</p>
<h3 id="directory-history">Directory History</h3>
<p>Each directory panel maintains a list of directories that it has displayed. To access this list, type <code>Alt-H</code>. From the list, a directory can be selected for browsing. Even without the history list display, we can traverse the history list forward and backward by using the <code>Alt-u</code> and <code>Alt-y</code> keys respectively.</p>
<h3 id="using-the-mouse">Using The Mouse</h3>
<p>We can perform many Midnight Commander operations using the mouse. A directory panel item can be selected by clicking on it and a directory can be opened by double clicking. Likewise, the function key labels and menu bar items can be activated by clicking on them. What is not so apparent is that the directory history can be accessed and traversed. At the top of each directory panel there are small arrows (circled in the image below). Clicking on them will show the directory history (the up arrow) and move forward and backward through the history list (the right and left arrows).</p>
<p>There is also an arrow to the extreme lower right edge of the command line which reveals the command line history.</p>
<div class="figure">
<img src="images/adventure_mc-mousecontrols.png" alt="Directory and command line history mouse controls" ><p class="caption">Directory and command line history mouse controls</p>
</div>
<h2 id="viewing-and-editing-files">Viewing and Editing Files</h2>
<p>An activity often performed while directory browsing is examining the content of files. Midnight Commander provides a capable file viewer which can be accessed by selecting a file and pressing the <code>F3</code> key.</p>
<div class="figure">
<img src="images/adventure_mc-fileviewer.png" alt="File viewer" ><p class="caption">File viewer</p>
</div>
<p>As we can see, when the file viewer is active, the function key labels at the bottom of the screen change to reveal viewer features. Files can be searched and the viewer can quickly go to any position in the file. Most importantly, files can be viewed in either ASCII (regular text) or hexadecimal, for those cases when we need a really detailed view.</p>
<div class="figure">
<img src="images/adventure_mc-fileviewerhex.png" alt="File viewer in hexadecimal mode" ><p class="caption">File viewer in hexadecimal mode</p>
</div>
<p>It is also possible to put the other panel into &quot;quick view&quot; mode to view the the currently selected file. This is especially nice if we are browsing a directory full of text files and want to rapidly view the files, as each time a new file is selected in the current panel, it's instantly displayed in the other. To start quick view mode, type <code>Ctrl-x q</code>.</p>
<div class="figure">
<img src="images/adventure_mc-quickview.png" alt="Quick view mode" ><p class="caption">Quick view mode</p>
</div>
<p>Once in quick view mode, we can press <code>Tab</code> and the focus changes to the other panel in quick view mode. This will change the function key labels to a subset of the full file viewer. To exit the quick view mode, press <code>Tab</code> to return to the directory panel and press <code>Alt-i</code>.</p>
<h3 id="editing">Editing</h3>
<p>Since we are already viewing files, we will probably want to start editing them too. Midnight Commander accommodates us with the <code>F4</code> key, which invokes a text editor loaded with the selected file. Midnight Commander can work with the editor of your choice. On Debian-based systems we are prompted to make a selection the first time we press <code>F4</code>. Debian suggests <code>nano</code> as the default selection, but various flavors of <code>vim</code> are also available along with Midnight Commander's own built-in editor, <code>mcedit</code>. We can try out <code>mcedit</code> on its own at the command line for a taste of this editor.</p>
<div class="figure">
<img src="images/adventure_mc-mcedit.png" alt="mcedit" ><p class="caption">mcedit</p>
</div>
<h2 id="tagging-files">Tagging Files</h2>
<p>We have already seen how to select a file in the current directory panel by simply moving the highlight, but operating on a single file is not of much use. After all, we can perform those kinds of operations more easily by entering commands directly on the command line. However, we often want to operate on multiple files. This can be accomplished through <em>tagging</em>. When a file is tagged, it is marked for some later operation such as copying. This is why we choose to use a file manager like Midnight Commander. When one or more files are tagged, file operations (such as copying) are performed on the tagged files and selection has no effect.</p>
<h3 id="tagging-individual-files">Tagging Individual Files</h3>
<p>To tag an individual file or directory, select it and press the <code>Insert</code> key. To un-tag it, press the <code>Insert</code> key again.</p>
<h3 id="tagging-groups-of-files">Tagging Groups of Files</h3>
<p>To tag a group of files or directories according to a selection criteria, such as a wildcard pattern, press the <code>+</code> key. This will display a dialog where the pattern may be specified.</p>
<div class="figure">
<img src="images/adventure_mc-tagging.png" alt="File tagging dialog" ><p class="caption">File tagging dialog</p>
</div>
<p>This dialog stores a history of patterns. To traverse it, use Ctrl up and down arrows.</p>
<p>It is also possible to un-tag a group of files. Pressing the <code>/</code> key will cause a pattern entry dialog to display.</p>
<h2 id="we-need-a-playground">We Need a Playground</h2>
<p>To explore the basic file manipulation features of Midnight Commander, we need a &quot;playground&quot; like we had in chapter 4 of TLCL.</p>
<h3 id="creating-directories">Creating Directories</h3>
<p>The first step in creating a playground is creating a directory called, aptly enough, <code>playground</code>. First, we will navigate to our home directory, then press the F7 key.</p>
<div class="figure">
<img src="images/adventure_mc-createdir.png" alt="Create Directory dialog" ><p class="caption">Create Directory dialog</p>
</div>
<p>Type &quot;playground&quot; into the dialog and press <code>Enter</code>. Next, we want the other panel to display the contents of the playground directory. To do this, highlight the <code>playground</code> directory and press <code>Alt-o</code>.</p>
<p>Now let's put some files into our playground. Press <code>Tab</code> to switch the current panel to the playground directory panel. We'll create a couple of subdirectories by repeating what we did to create <code>playground</code>. Create subdirectories <code>dir1</code> and <code>dir2</code>. Finally, using the command line, we will create a few files:</p>
<pre><code>me@linuxbox: ~/playground $ touch file1 file2 &quot;ugly file&quot;</code></pre>
<div class="figure">
<img src="images/adventure_mc-playground.png" alt="The playground" ><p class="caption">The playground</p>
</div>
<h3 id="copying-and-moving-files">Copying and Moving Files</h3>
<p>Okay, here is where things start to get weird.</p>
<p>Select <code>dir1</code>, then press <code>Alt-o</code> to display <code>dir1</code> in the other panel. Select the file <code>file1</code> and press F5 to copy (The F6-RenMov command is similar). We are now presented with this formidable-looking dialog box:</p>
<div class="figure">
<img src="images/adventure_mc-copydialog.png" alt="Copy dialog" ><p class="caption">Copy dialog</p>
</div>
<p>To see Midnight Commander's default behavior, just press <code>Enter</code> and <code>file1</code> is copied into directory <code>dir1</code> (i.e., the file is copied from the directory displayed in current panel to the directory displayed in the other panel).</p>
<p>That was straightforward, but what if we want to copy <code>file2</code> to a file in <code>dir1</code> named <code>file3</code>? To do this, we select <code>file2</code> and press F5 again and enter the new filename into the Copy dialog:</p>
<div class="figure">
<img src="images/adventure_mc-copydialog2.png" alt="Renaming a file during copy" ><p class="caption">Renaming a file during copy</p>
</div>
<p>Again, this is pretty straightforward. But let's say we tagged a group of files and wanted to copy and rename them as they are copied (or moved). How would we do that? Midnight Commander provides a way of doing it, but it's a little strange.</p>
<p>The secret is the source mask in the copy dialog. At first glance, it appears that the source mask is simply a file selection wildcard, but first appearances can be deceiving. The mask does filter files as we would expect, but only in a limited way. Unlike the range of wildcards available in the shell, the wildcards in the source mask are limited to &quot;?&quot; (for matching single characters) and &quot;*&quot; (for matching multiple characters). What's more, the wildcards have a special property.</p>
<p>It works like this: let's say we had a file name with an embedded space such as &quot;ugly file&quot; and we want to copy (or move) it to <code>dir1</code> as the file &quot;uglyfile&quot;, instead. Using the source mask, we could enter the mask &quot;* *&quot; which means break the source file name into two blocks of text separated by a space. This wildcard pattern will match the file <code>ugly file</code>, since its name consists of two strings of characters separated by a space. Midnight Commander will associate each block of text with a number starting with 1, so block 1 will contain &quot;ugly&quot; and block 2 will contain &quot;file&quot;. Each block can be referred to by a number as with regular expression grouping. So to create a new file name for our target file without the embedded space, we would specify &quot;\1\2&quot; in the &quot;to&quot; field of the copy dialog like so:</p>
<div class="figure">
<img src="images/adventure_mc-copydialog3.png" alt="Using grouping" ><p class="caption">Using grouping</p>
</div>
<p>The &quot;?&quot; wildcard behaves the same way. If we make the source mask &quot;???? ????&quot; (which again matches the file <code>ugly file</code>), we now have eight pieces of text that we can rearrange at will. For example, we could make the &quot;to&quot; mask &quot;\8\7\6\5\4\3\2\1&quot;, and the resulting file name would be &quot;elifylgu&quot;. Pretty neat.</p>
<p>Midnight Commander can also perform case conversion on file names. To do this, we include some additional escape sequences in the to mask:</p>
<ul>
<li><p>\u Converts the next character to uppercase.</p></li>
<li><p>\U Converts all characters to uppercase until another sequence is encountered.</p></li>
<li><p>\l Converts the next character to lowercase.</p></li>
<li><p>\L Converts all characters to lowercase until another sequence is encountered.</p></li>
</ul>
<p>So if we wanted to change the name <code>ugly file</code> to camel case, we could use the mask &quot;\u\L\1\u\L\2&quot; and we would get the name <code>UglyFile</code>.</p>
<h3 id="creating-links">Creating Links</h3>
<p>Midnight Commander can create both hard and symbolic links. They are created using these 3 keyboard commands which cause a dialog to appear where the details of the link can be specified:</p>
<ul>
<li><p><code>Ctrl-x l</code> creates a hard link, in the directory shown in the current panel.</p></li>
<li><p><code>Ctrl-x s</code> creates a symbolic link in the directory shown in the other panel, using an absolute directory path.</p></li>
<li><p><code>Ctrl-x v</code> creates a symbolic link in the directory shown in the other panel, using a relative directory path.</p></li>
</ul>
<p>The two symbolic link commands are basically the same. They differ only in the fact that the paths suggested in the Symbolic Link dialog are absolute or relative.</p>
<p>We'll demonstrate creating a symbolic link by creating a link to <code>file1</code>. To do this, we select <code>file1</code> in the current panel and type <code>Ctrl-x s</code>. The Symbolic Link dialog appears and we can either enter a name for the link or we can accept the program's suggestion. For the sake of clarity, we will change the name to <code>file1-sym</code>.</p>
<div class="figure">
<img src="images/adventure_mc-symlink.png" alt="Symbolic link dialog" ><p class="caption">Symbolic link dialog</p>
</div>
<h3 id="setting-file-modes-and-ownership">Setting File Modes and Ownership</h3>
<p>File modes (i.e., permissions) can be set on the selected or tagged files by typing <code>Ctrl-x c</code>. Doing so will display a dialog box in which each attribute can be turned on or off. If Midnight Commander is being run with superuser privileges, file ownership can be changed by typing <code>Ctrl-x o</code>. A dialog will be displayed where the owner and group owner of selected/tagged files can be set.</p>
<div class="figure">
<img src="images/adventure_mc-chmod.png" alt="Chmod dialog" ><p class="caption">Chmod dialog</p>
</div>
<p>To demonstrate changing file modes, we will make <code>file1</code> executable. First, we will select <code>file1</code> and then type <code>Ctrl-x c</code>. The Chmod command dialog will appear, listing the file's mode settings. By using the arrow keys we can select the check box labeled &quot;execute/search by owner&quot; and toggle its setting by using the space bar.</p>
<h3 id="deleting-files">Deleting Files</h3>
<p>Pressing the <code>F8</code> key deletes the selected or tagged files and directories. By default, Midnight Commander always prompts the user for confirmation before deletion is performed.</p>
<p>We're done with our playground for now, so it's time to clean up. We will enter <code>cd</code> at the shell prompt to get the current panel to list our home directory. Next, we will select <code>playground</code> and press <code>F8</code> to delete the playground directory.</p>
<div class="figure">
<img src="images/adventure_mc-deleteplayground.png" alt="Delete confirmation dialog" ><p class="caption">Delete confirmation dialog</p>
</div>
<h2 id="power-features">Power Features</h2>
<p>Beyond basic file manipulation, Midnight Commander offers a number of additional features, some of which are very interesting.</p>
<h3 id="virtual-file-systems">Virtual File Systems</h3>
<p>Midnight Commander can treat some types of archive files and remote hosts as though they are local file systems. Using the <code>cd</code> command at the shell prompt, we can access these.</p>
<p>For example, we can look at the contents of tar files. To try this out, let's create a compressed tar file containing the files in the <code>/etc</code> directory. We can do this by entering this command at the shell prompt:</p>
<pre><code>me@linuxbox ~ $ tar czf etc.tgz /etc</code></pre>
<p>Once this command completes (there will be some &quot;permission denied&quot; errors but these don't matter for our purposes), the file <code>etc.tgz</code> will appear among the files in the current panel. If we select this file and press <code>Enter</code>, the contents of the archive will be displayed in the current panel. Notice that the shell prompt does not change as it does with ordinary directories. This is because while the current panel is displaying a list of files like before, Midnight Commander cannot treat the virtual file system in the same way as a real one. For example, we cannot delete files from the tar archive, but we can copy files from the archive to the real file system.</p>
<p>Virtual file systems can also treat remote file systems as local directories. In most versions of Midnight Commander, both FTP and FISH (FIles transferred over SHell) protocols are supported and, in some versions, SMB/CIFS as well.</p>
<p>As an example, let's look at the software library FTP site at Georgia Tech, a popular repository for Linux software. Its name is ftp.gtlib.gatech.edu. To connect with <code>/pub</code> directory on this site and browse its files, we enter this <code>cd</code> command:</p>
<pre><code>me@linuxbox ~ $ cd ftp://ftp.gtlib.gatech.edu/pub</code></pre>
<p>Since we don't have write permission on this site, we cannot modify any any files there, but we can copy files from the remote server to our local file system.</p>
<p>The FISH protocol is similar. This protocol can be used to communicate with any Unix-like system that runs a secure shell (SSH) server. If we have write permissions on the remote server, we can operate on the remote system's files as if they were local. This is extremely handy for performing remote administration. The <code>cd</code> command for FISH protocol looks like this:</p>
<pre><code>me@linuxbox ~ $ cd sh://user@remotehost/dir</code></pre>
<h3 id="finding-files">Finding Files</h3>
<p>Midnight Commander has a useful file search feature. When invoked by pressing <code>Alt-?</code>, the following dialog will appear:</p>
<div class="figure">
<img src="images/adventure_mc-finddialog.png" alt="Find dialog" ><p class="caption">Find dialog</p>
</div>
<p>On this dialog we can specify: where the search is to begin, a colon-separated list of directories we would like to skip during our search, any restriction on the names of the files to be searched, and the content of the files themselves. This feature is well-suited to searching large trees of source code or configuration files for specific patterns of text. For example, let's look for every file in <code>/etc</code> that contains the string &quot;bashrc&quot;. To do this, we would fill in the dialog as follows:</p>
<div class="figure">
<img src="images/adventure_mc-findbashrc.png" alt="Search for files containing &quot;bashrc&quot;" ><p class="caption">Search for files containing &quot;bashrc&quot;</p>
</div>
<p>Once the search is completed, we will see a list of files which we can view and/or edit.</p>
<div class="figure">
<img src="images/adventure_mc-findresults.png" alt="Search results" ><p class="caption">Search results</p>
</div>
<h3 id="panelizing">Panelizing</h3>
<p>There is a button at the bottom of the search results dialog labeled &quot;Panelize.&quot; If we click it, the search results become the contents of the current panel. From here, we can act on the files just as we can with any others.</p>
<p>In fact, we can create a panelized list from any command line program that produces a list of path names. For example, the <code>find</code> program. To do this, we use Midnight Commander's &quot;External Panelize&quot; feature. Type <code>Ctrl-x !</code> and the External Panelize dialog appears:</p>
<div class="figure">
<img src="images/adventure_mc-externalpanelize.png" alt="External panelize dialog" ><p class="caption">External panelize dialog</p>
</div>
<p>On this dialog we see a predefined list of panelized commands. Midnight Commander allows us to store commands for repeated use. Let's try it by creating a panelized command that searches the system for every file whose name has the extension <code>.JPG</code> starting from the current panel directory. Select &quot;Other command&quot; from the list and type the following command into the &quot;Command&quot; field:</p>
<pre><code>find . -type f -name &quot;*.JPG&quot;</code></pre>
<p>After typing the command we can either press <code>Enter</code> to execute the command or, for extra fun, we can click the &quot;Add new&quot; button and assign our command a name and save it for future use.</p>
<h3 id="sub-shells">Sub-shells</h3>
<p>We may, at any time, move from the Midnight Commander to a full shell session and back again by pressing <code>Ctrl-o</code>. The sub-shell is a copy of our normal shell, so whatever environment our usual shell establishes (aliases, shell functions, prompt strings, etc.) will be present in the sub-shell as well. If we start a long-running command in the sub-shell and press <code>Ctrl-o</code>, the command is suspended until we return to the sub-shell. Note that once a command is suspended, Midnight Commander cannot execute any further external commands until the suspended command terminates.</p>
<h2 id="the-user-menu">The User Menu</h2>
<p>So far we have avoided discussion of the mysterious <code>F2</code> command. This is the user menu, which may be Midnight Commander's most powerful and useful feature. The user menu is, as the name suggests, a menu of user-defined commands.</p>
<p>When we press the <code>F2</code> key, Midnight Commander looks for a file named <code>.mc.menu</code> in the current directory. If the file does not exist, Midnight Commander looks for <code>~/.config/mc/menu</code>. If that file does not exist, then Midnight Commander falls back to a system-wide menu file named <code>/usr/share/mc/mc.menu</code>.</p>
<p>The neat thing about this scheme is that each directory can have its own set of user menu commands, so that we can create commands appropriate to the contents of the current directory. For example, if we have a &quot;Pictures&quot; directory, we can create commands for processing images; if we have a directory full of HTML files, we can create commands for managing a web site, and so on.</p>
<p>So, after we press <code>F2</code> the first time, we are presented with the default user menu that looks something like this:</p>
<div class="figure">
<img src="images/adventure_mc-usermenu.png" alt="The User Menu" ><p class="caption">The User Menu</p>
</div>
<h3 id="editing-the-user-menu">Editing the User Menu</h3>
<p>The default user menu contains several example entries. These are by no means set in stone. We are encouraged to edit the menu and create our own entries. The menu file is ordinary text and it can be edited with any text editor, but Midnight Commander provides a menu editing feature found in the &quot;Command&quot; pulldown menu. The entry is called &quot;Edit menu file.&quot;</p>
<p>If we select this entry, Midnight Commander offers us a choice of &quot;Local&quot; and &quot;User.&quot; The Local entry allows us to edit the <code>.mc.menu</code> file in the current directory while selecting User will cause us to edit the <code>~/.config/mc/menu</code> file. Note that if we select Local and the current directory does not contain a menu file, Midnight Commander will copy the default menu file into current directory as a starting point for our editing.</p>
<h3 id="menu-file-format">Menu File Format</h3>
<p>Some parts of the user menu file format are pretty simple; other parts, not so much. We'll start with the simple parts first.</p>
<p>A menu file consists of one or more entries. Each entry contains:</p>
<ul>
<li><p>A single character (usually a letter) that will act as a hot key for the entry when the menu is displayed.</p></li>
<li><p>Following the hot key, on the same line, is the description of the menu entry as it will appear on the menu.</p></li>
<li><p>On the following lines are one or more commands to be performed when the menu entry is selected. These are ordinary shell commands. Any number of commands may be specified, so quite sophisticated operations are possible. Each command must be indented by at least one space or tab.</p></li>
<li><p>A blank line to separate one menu entry from the next.</p></li>
<li><p>Comments may appear on their own lines. Each comment line starts with a <code>#</code> character.</p></li>
</ul>
<p>Here is an example user menu entry that creates an HTML template in the current directory:</p>
<pre><code># Create a new HTML file

H   Create a new HTML file
    { echo &quot;&lt;html&gt;&quot;
    echo &quot;\t&lt;head&gt;\n\t&lt;/head&gt;&quot;
    echo &quot;\t&lt;body&gt;\n\t&lt;/body&gt;&quot;
    echo &quot;&lt;/html&gt;&quot;; }  &gt; new_page.html</code></pre>
<p>Notice the absence of the <code>-e</code> option on the <code>echo</code> commands used in this example. Normally, the <code>-e</code> option is required to interpret the backslash escape sequences like <code>\t</code> and <code>\n</code>. The reason they are omitted here is that Midnight Commander does not use <code>bash</code> as the shell when it executes user menu commands. It uses <code>sh</code> instead. Different distributions use different shell programs to emulate <code>sh</code> . For example, Red Hat-based distributions use <code>bash</code> but Debian-based distributions like Ubuntu and Raspian use <code>dash</code> instead. <code>dash</code> is a compact shell program that is <code>sh</code> compatible but lacks many of the features found in <code>bash</code>. The <code>dash</code> man page describes the features of that shell.</p>
<p>This command will reveal which program is actually providing the <code>sh</code> emulation (i.e., is symbolically linked to <code>sh</code>):</p>
<pre><code>me@linuxbox ~ $ ls -l /bin/sh</code></pre>
<h3 id="macros">Macros</h3>
<p>With that bit of silliness out of the way, let's look at how we can get a user menu entry to act on currently selected or tagged files. First, it helps to understand a little about how Midnight Commander executes user menu commands. It's done by writing the commands to a file (essentially a shell script) and then launching <code>sh</code> to execute the contents of the file. During the process of writing the file, Midnight Commander performs <em>macro substitution</em>, replacing embedded symbols in the menu entry with alternate values. These macros are single alphabetic characters preceded by a percent sign. When Midnight Commander encounters one of these macros, it substitutes the value the macro represents. Here are the most commonly used macros:</p>
<table>
<thead>
<tr class="header">
<th align="left">Macro</th>
<th align="left">Meaning</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left">%f</td>
<td align="left">Selected file's name</td>
</tr>
<tr class="even">
<td align="left">%x</td>
<td align="left">Selected file's extension</td>
</tr>
<tr class="odd">
<td align="left">%b</td>
<td align="left">Selected file's name stripped of extension (basename)</td>
</tr>
<tr class="even">
<td align="left">%d</td>
<td align="left">Name of the current directory</td>
</tr>
<tr class="odd">
<td align="left">%t</td>
<td align="left">The list of tagged files</td>
</tr>
<tr class="even">
<td align="left">%s</td>
<td align="left">If files are tagged, they are used, else selected file is used.</td>
</tr>
</tbody>
</table>
<p>Let's say we wanted to create a user menu entry that would resize a JPEG image using the ever-handy <code>convert</code> program from the ImageMagick suite. Using macros, we could write a menu entry like this, which would act on the currently selected file:</p>
<pre><code>#   Resize an image using convert

R   Resize image to fit within 800 pixel bounding square
    size=800
    convert &quot;%f&quot; -resize ${size}x${size} &quot;%b-${size}.%x&quot;</code></pre>
<p>Using the <code>%b</code> and <code>%x</code> macros, we are able to construct a new output file name for the resized image. There is still one potential problem with this menu entry. It's possible to run the menu entry command on a directory, or a non-image file (Doing so would not be good).</p>
<p>We could include some extra code to ensure that <code>%f</code> is actually the name of an image file, but Midnight Commander also provides a method for only displaying menu entries appropriate to the currently selected (or tagged) file(s).</p>
<h3 id="conditionals">Conditionals</h3>
<p>Midnight Commander supports two types of <em>conditionals</em> that affect the behavior of a menu entry. The first, called an <em>addition conditional</em> determines if a menu entry is displayed. The second, called <em>default conditional</em> sets the default entry on a menu.</p>
<p>A conditional is added to a menu entry just before the first line. A conditional starts with either a <code>+</code> (for an addition) or a <code>=</code> (for a default) followed by one or more <em>sub-conditions</em>. Sub-conditions are separated by either a <code>|</code> (meaning or) or a <code>&amp;</code> (meaning and) allowing us to express some complex logic. It is also possible to have a combined addition and default conditional by beginning the conditional with <code>=+</code> or <code>+=</code>. Two separate conditionals, one addition and one default, are also permitted preceding a menu entry.</p>
<p>Let's look at sub-conditions. They consist of one of the following:</p>
<table>
<thead>
<tr class="header">
<th align="left">Sub-condition</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left">f <em>pattern</em></td>
<td align="left">Match currently selected file</td>
</tr>
<tr class="even">
<td align="left">F <em>pattern</em></td>
<td align="left">Match last selected in other panel</td>
</tr>
<tr class="odd">
<td align="left">d <em>pattern</em></td>
<td align="left">Match currently selected directory</td>
</tr>
<tr class="even">
<td align="left">D <em>pattern</em></td>
<td align="left">Match last selected directory in other panel</td>
</tr>
<tr class="odd">
<td align="left">t <em>type</em></td>
<td align="left">Type of currently selected file</td>
</tr>
<tr class="even">
<td align="left">T <em>type</em></td>
<td align="left">Type of last selected file in other panel</td>
</tr>
<tr class="odd">
<td align="left">x <em>filename</em></td>
<td align="left">File is executable</td>
</tr>
<tr class="even">
<td align="left">! <em>sub-cond</em></td>
<td align="left">Negate result of sub-condition</td>
</tr>
</tbody>
</table>
<p><em>pattern</em> is either a shell pattern (i.e., wildcards) or a regular expression according to the global setting configured in the Options/Configuration dialog. This setting can be overridden by adding <code>shell_patterns=0</code> as the first line of the menu file. A value of 1 forces use of shell patterns, while a value of 0 forces regular expressions instead.</p>
<p><em>type</em> is one or more of the following:</p>
<table>
<thead>
<tr class="header">
<th align="left">Type</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left">r</td>
<td align="left">regular file</td>
</tr>
<tr class="even">
<td align="left">d</td>
<td align="left">directory</td>
</tr>
<tr class="odd">
<td align="left">n</td>
<td align="left">not a directory</td>
</tr>
<tr class="even">
<td align="left">l</td>
<td align="left">link</td>
</tr>
<tr class="odd">
<td align="left">x</td>
<td align="left">executable file</td>
</tr>
<tr class="even">
<td align="left">t</td>
<td align="left">tagged</td>
</tr>
<tr class="odd">
<td align="left">c</td>
<td align="left">character device</td>
</tr>
<tr class="even">
<td align="left">b</td>
<td align="left">block device</td>
</tr>
<tr class="odd">
<td align="left">f</td>
<td align="left">FIFO (pipe)</td>
</tr>
<tr class="even">
<td align="left">s</td>
<td align="left">socket</td>
</tr>
</tbody>
</table>
<p>While this seems really complicated, it's not really that bad. To change our image resizing entry to only appear when the currently selected file has the extension <code>.jpg</code> or <code>.JPG</code>, we would add one line to the beginning of the entry (regular expressions are used in this example):</p>
<pre><code>#   Resize an image using convert

+ f \.jpg$ | f \.JPG$
R   Resize image to fit within 800 pixel bounding square
    size=800
    convert &quot;%f&quot; -resize ${size}x${size} &quot;%b-${size}.%x&quot;</code></pre>
<p>The conditional begins with <code>+</code> meaning that it's an addition condition. It is followed by two sub-conditions. The <code>|</code> separating them signifies an &quot;or&quot; relationship between the two. So, the finished conditional means &quot;display this entry if the selected file name ends with <code>.jpg</code> or the selected file name ends with <code>.JPG</code>.&quot;</p>
<p>The default menu file contains many more examples of conditionals. It's worth a look.</p>
<h2 id="summing-up">Summing Up</h2>
<p>Even though it takes a little time to learn, Midnight Commander offers a lot of features and facilities that make file management easier when using the command line. This is particularly true when operating on a remote system where a graphical user interface may not be available. The user menu feature is especially good for specialized file management tasks. With a little configuration, Midnight Commander can become a powerful tool in our command line arsenal.</p>
<h2 id="further-reading">Further Reading</h2>
<ul>
<li><p>The <em>Midnight Commander man page</em> is extensive and discusses even more features than we have covered here.</p></li>
<li><p><em><a href="http://www.midnight-commander.org/">midnight-commander.org</a></em> is the official site for the project.</p></li>
</ul>


						</div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
	<div class="body">
		<hr noshade>
		<p class="fineprint">
		&copy; 2000-2020,
		<a href="mailto:bshotts@users.sourceforge.net">William E. Shotts, Jr.</a>
		Verbatim copying and distribution of this entire article is
		permitted in any medium, provided this copyright notice is preserved.</p>
	
		<p class="fineprint">Linux&reg; is a registered trademark of Linus Torvalds.</p>
	</div>
				</td>
			</tr>
		</table>
	</body>
</html>