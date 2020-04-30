



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Learning the shell - Lesson 4: A Guided Tour</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_lts0030.php">
		<link rel="next" href="lc3_lts0050.php">
		<link rel="contents" href="lc3_learning_the_shell.php#contents">
	</head>

	<body>
	<a name="top"></a>
		<table class="page" summary="This table is used for graphic layout.">
			<tr>
				<td>
					<div class="colorblock"></div>
				</td>
				<td>
					<div class="body">
					<img src="images/blank_title.jpg" alt="Title graphic">
					</div>
				</td>
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
		<div class="pagenav">
			<p class="right"><a
			href="lc3_lts0030.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="lc3_lts0050.php">Next</a></p>
		</div>
<h1>A Guided Tour</h1>

<p>It's time to take our tour. The table below
lists some interesting places to explore. This is
by no means a complete list, but it should prove to
be an interesting adventure. For each of the
directories listed below, do the following:</p>

<ul>
	<li type="disk"><tt class="user">cd</tt> into
	each directory.</li>

	<li type="disk">Use <tt class="user">ls</tt> to
	list the contents of the directory.</li>

	<li type="disk">If you see an interesting file,
	use the <tt class="user">file</tt> command to
	determine its contents.</li>

	<li type="disk">For text files, use <tt class=
	"user">less</tt> to view them.</li>
</ul>

<table cellpadding="8" border summary=
	"Various interesting directories found on the system and their contents.">
	<caption>
		Interesting directories and their contents
	</caption>

	<tr>
		<th width="150" valign="top">
		<strong>Directory</strong></th>

		<th valign="top"><strong>Description</strong></th>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"root"></a><tt class="user">/</tt></td>

		<td valign="top">
		The root directory where the file system
		begins. In most cases the root directory only
		contains subdirectories.
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"boot"></a><tt class="user">/boot</tt></td>

		<td valign="top">
		This is where the Linux kernel and boot loader
		files are kept. The kernel is a file called <tt class=
		"user">vmlinuz</tt>.
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"etc"></a><tt class="user">/etc</tt></td>

		<td valign="top">
		The <tt class="user">/etc</tt> directory
		contains the configuration files for the
		system. All of the files in <tt class=
		"user">/etc</tt> should be text files. Points of
		interest:

		<dl>
			<dt><tt class="user">/etc/passwd</tt></dt>

			<dd>The <tt class="user">passwd</tt> file
			contains the essential information for each
			user. It is here that users are
			defined.</dd>

			<dt><tt class="user">/etc/fstab</tt></dt>

			<dd>The <tt class="user">fstab</tt> file
			contains a table of devices that get mounted
			when your system boots.  This file defines
			your disk drives.</dd>

			<dt><tt class="user">/etc/hosts</tt></dt>

			<dd>This file lists the network host names
			and IP addresses that are intrinsically known
			to the system.</dd>

			<dt><tt class="user">/etc/init.d</tt></dt>

			<dd>This directory contains the scripts
			that start various system services typically
			at boot time.</dd>
		</dl>
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"bin"></a><tt class="user">/bin,
		/usr/bin</tt></td>

		<td valign="top">
		These two directories contain most of the
		programs for the system. The <tt class=
		"user">/bin</tt> directory has the essential
		programs that the system requires to operate,
		while <tt class="user">/usr/bin</tt> contains
		applications for the system's users.
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"sbin"></a><tt class="user">/sbin,
		/usr/sbin</tt></td>

		<td valign="top">
		The <tt class="user">sbin</tt> directories
		contain programs for system administration,
		mostly for use by the superuser.
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"usr"></a><tt class="user">/usr</tt></td>

		<td valign="top">
		The <tt class="user">/usr</tt> directory
		contains a variety of things that support
		user applications. Some highlights:

		<dl>
			<dt><tt class="user">/usr/share/X11</tt></dt>

			<dd>Support files for the X Window system</dd>

			<dt><tt class="user">/usr/share/dict</tt></dt>

			<dd>Dictionaries for the spelling checker.
			Bet you didn't know that Linux had a
			spelling checker. See <a href=
			"lc3_man_pages/look1.html"><tt class=
			"user">look</tt></a> and <a href=
			"lc3_man_pages/aspell1.html"><tt class=
			"user">aspell</tt></a>.</dd>

			<dt><tt class="user">/usr/share/doc</tt></dt>

			<dd>Various documentation files in a
			variety of formats.</dd>

			<dt><tt class="user">/usr/share/man</tt></dt>

			<dd>The man pages are kept here.</dd>

			<dt><tt class="user">/usr/src</tt></dt>

			<dd>Source code files. If you installed the
			kernel source code package, you will find
			the entire Linux kernel source code
			here.</dd>
		</dl>
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"local"></a><tt class=
		"user">/usr/local</tt></td>

		<td valign="top">
		<tt class="user">/usr/local</tt> and its
		subdirectories are used for the installation
		of software and other files for use on the
		local machine. What this really means is that
		software that is not part of the official
		distribution (which usually goes in <tt
		class="user">/usr/bin</tt>) goes here.<br><br>

		When you find interesting programs to
		install on your system, they should be
		installed in one of the <tt class=
		"user">/usr/local</tt> directories. Most
		often, the directory of choice is <tt class=
		"user">/usr/local/bin</tt>.
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"var"></a><tt class="user">/var</tt></td>

		<td valign="top">
		The <tt class="user">/var</tt> directory
		contains files that change as the system is
		running. This includes:

		<dl>
			<dt><tt class="user">/var/log</tt></dt>

			<dd>Directory that contains log files.
			These are updated as the system runs. You
			should view the files in this directory
			from time to time, to monitor the health of
			your system.</dd>

			<dt><tt class="user">/var/spool</tt></dt>

			<dd>This directory is used to hold files
			that are queued for some process, such as
			mail messages and print jobs. When a user's
			mail first arrives on the local system
			(assuming you have local mail), the
			messages are first stored in <tt class=
			"user">/var/spool/mail</tt></dd>
		</dl>
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"lib"></a><tt class="user">/lib</tt></td>

		<td valign="top">
		The shared libraries (similar to DLLs in
		that other operating system) are kept
		here.
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"home"></a><tt class="user">/home</tt></td>

		<td valign="top">
		<tt class="user">/home</tt> is where users
		keep their personal work. In general, this is
		the only place users are allowed to write
		files. This keeps things nice and clean
		:-)
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"root_home"></a><tt class=
		"user">/root</tt></td>

		<td valign="top">
		This is the superuser's home
		directory.
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"tmp"></a><tt class="user">/tmp</tt></td>

		<td valign="top">
		<tt class="user">/tmp</tt> is a directory
		in which programs can write their temporary
		files.
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"dev"></a><tt class="user">/dev</tt></td>

		<td valign="top">
		The <tt class="user">/dev</tt> directory
		is a special directory, since it does not
		really contain files in the usual sense.
		Rather, it contains devices that are available
		to the system. In Linux (like Unix), devices
		are treated like files. You can read and
		write devices as though they were files. For
		example <tt class="user">/dev/fd0</tt> is the
		first floppy disk drive, <tt class=
		"user">/dev/sda</tt> (<tt class=
		"user">/dev/hda</tt> on older systems) is the first hard
		drive. All the devices that the kernel
		understands are represented here.
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"proc"></a><tt class="user">/proc</tt></td>

		<td valign="top">
		The <tt class="user">/proc</tt> directory
		is also special. This directory does not
		contain files. In fact, this directory does
		not really exist at all. It is entirely
		virtual. The <tt class="user">/proc</tt>
		directory contains little peep holes into the
		kernel itself. There are a group of numbered
		entries in this directory that correspond to
		all the processes running on the system. In
		addition, there are a number of named entries
		that permit access to the current
		configuration of the system. Many of these
		entries can be viewed. Try viewing <tt class=
		"user">/proc/cpuinfo</tt>. This entry will
		tell you what the kernel thinks of your
		CPU.
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><a name=
		"mnt"></a><tt class="user">/media,/mnt</tt></td>

		<td valign="top">
		Finally, we come to <tt class=
		"user">/media</tt>, a normal directory which is
		used in a special way. The <tt class=
		"user">/media</tt> directory is used for
		<i>mount points</i>. As we learned in the <a
		href="lts0020.php">second lesson</a>, the
		different physical storage devices (like hard
		disk drives) are attached to the file system
		tree in various places. This process of
		attaching a device to the tree is called
		<i>mounting</i>. For a device to be
		available, it must first be mounted.<br><br>

		When your system boots, it reads a list of
		mounting instructions in the file <tt class=
		"user">/etc/fstab</tt>, which describes which
		device is mounted at which mount point in the
		directory tree. This takes care of the hard
		drives, but you may also have devices that
		are considered temporary, such as CD-ROMs, thumb drives, and
		floppy disks. Since these are removable, they
		do not stay mounted all the time. The <tt
		class="user">/media</tt> directory is used by the
		automatic device mounting mechanisms found in
		modern desktop oriented Linux distributions.
		On systems that require manual mounting of 
		removable devices, the <tt class=
		"user">/mnt</tt> directory provides a
		convenient place for mounting these temporary
		devices. You will often
		see the directories <tt class=
		"user">/mnt/floppy</tt> and <tt class=
		"user">/mnt/cdrom</tt>. To see what devices
		and mount points are used, type <a href=
		"lc3_man_pages/mount8.html"><tt class=
		"user">mount</tt></a>.
		</td>
	</tr>
</table><br>

<div class="sidebar">
<h2>A weird kind of file...</h2>

<p>During your tour, you probably noticed a strange
kind of directory entry, particularly in the <tt
class="user">/boot</tt> and <tt class=
"user">/lib</tt> directories. When listed with <tt
class="user">ls -l</tt>, you would have seen
something like this:</p>

<pre><tt class="narrow">
lrwxrwxrwx     25 Jul  3 16:42 System.map -&gt; /boot/System.map-2.0.36-3
-rw-r--r-- 105911 Oct 13  1998 System.map-2.0.36-0.7
-rw-r--r-- 105935 Dec 29  1998 System.map-2.0.36-3
-rw-r--r-- 181986 Dec 11  1999 initrd-2.0.36-0.7.img
-rw-r--r-- 182001 Dec 11  1999 initrd-2.0.36.img
lrwxrwxrwx     26 Jul  3 16:42 module-info -&gt; /boot/module-info-2.0.36-3
-rw-r--r--  11773 Oct 13  1998 module-info-2.0.36-0.7
-rw-r--r--  11773 Dec 29  1998 module-info-2.0.36-3
lrwxrwxrwx     16 Dec 11  1999 vmlinuz -&gt; vmlinuz-2.0.36-3
-rw-r--r-- 454325 Oct 13  1998 vmlinuz-2.0.36-0.7
-rw-r--r-- 454434 Dec 29  1998 vmlinuz-2.0.36-3
</tt>
</pre>

<p>Notice the files, <tt>System.map,
module-info</tt> and <tt>vmlinuz</tt>. See the
strange notation after the file names?</p>

<p>These three files are called <i>symbolic
links</i>. Symbolic links are a special type of
file that points to another file. With symbolic
links, it is possible for a single file to have
multiple names. Here's how it works: Whenever the
system is given a file name that is a symbolic
link, it transparently maps it to the file it is
pointing to.</p>

<p>Just what is this good for? This is a very handy
feature. Let's consider the directory listing above
(which is the <tt>/boot</tt> directory of an old
Red Hat 5.2 system). This system has had multiple
versions of the Linux kernel installed. We can see
this from the files <tt>vmlinuz-2.0.36-0.7</tt> and
<tt>vmlinuz-2.0.36-3</tt>. These file names suggest
that both version 2.0.36-0.7 and 2.0.36-3 are
installed. Because the file names contain the
version it is easy to see the differences in the
directory listing. However, this would be confusing
to programs that rely on a fixed name for the
kernel file. These programs might expect the kernel
to simply be called <tt>"vmlinuz"</tt>. Here is
where the beauty of the symbolic link comes in. By
creating a symbolic link called <tt>vmlinuz</tt>
that points to <tt>vmlinuz-2.0.36-3</tt>, we have
solved the problem.</p>

<p>To create symbolic links, use the <a href=
"lc3_man_pages/ln1.html"><tt class="user">ln</tt></a>
command.</p>
</div>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_lts0030.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_lts0050.php">Next</a></p>
		</div>
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