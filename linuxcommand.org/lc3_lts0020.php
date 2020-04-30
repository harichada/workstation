



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Learning the shell - Lesson 2: Navigation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_lts0010.php">
		<link rel="next" href="lc3_lts0030.php">
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
			href="lc3_lts0010.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="lc3_lts0030.php">Next</a></p>
		</div>	<h1>Navigation</h1>

	<p>In this lesson, I will introduce your first
	three commands: <tt class="user"><a href="lc3_man_pages/pwdh.html">pwd</a></tt> (print
	working directory), <tt class="user"><a href="lc3_man_pages/cdh.html">cd</a></tt>
	(change directory), and <tt class="user"><a href=
	"lc3_man_pages/ls1.html">ls</a></tt> (list files and
	directories).</p>

	<p>If you have not worked with a command line
	interface before, you will need to pay close
	attention to this lesson, since the concepts will
	take some getting used to.</p>

	<h2>File System Organization</h2>

	<p>Like that legacy operating system, the files on
	a Linux system are arranged in what is called a
	<i>hierarchical directory structure</i>. This means
	that they are organized in a tree-like pattern of
	<i>directories</i> (called folders in other systems),
	which may contain files and other directories. The
	first directory in the file system is called the
	<i>root directory</i>. The root directory contains
	files and subdirectories, which contain more files
	and subdirectories and so on and so on.</p>

	<p>Most graphical environments today include a file
	manager program to view and manipulate the contents
	of the file system. Often you will see the file
	system represented like this:<br>

	<img src="images/file_manager.jpg" alt=
	"directory tree"></p>

	<p>One important difference between the legacy
	operating system and Unix-like operating systems such as Linux is that Linux does
	not employ the concept of drive letters. While
	drive letters split the file system into a series
	of different trees (one for each drive), Linux
	always has a single tree. Different storage devices
	may contain different branches of the tree, but
	there is always a single tree.</p>

	<h2>pwd</h2>

	<p>Since a command line interface cannot provide
	graphic pictures of the file system structure, it
	must have a different way of representing it. Think
	of the file system tree as a maze, and you are
	standing in it. At any given moment, you are located in a
	single directory. Inside that directory, you can
	see its files and the pathway to its <i>parent
	directory</i> and the pathways to the subdirectories of
	the directory in which you are standing.</p>

	<p>The directory you are standing in is called the
	<i>working directory</i>. To find the name of the
	working directory, use the <tt class=
	"user">pwd</tt> command.</p>

	<div class="display">
		<p><tt>[me@linuxbox me]$</tt> <tt
        class="cmd">pwd</tt><br>
        <tt>/home/me</tt></p>
 	</div>

	<p>When you first log on to a Linux system, the
	working directory is set to your <i>home directory</i>.
	This is where you put your files. On most systems,
	your home directory will be called
	/home/your_user_name, but it can be anything
	according to the whims of the system
	administrator.</p>

	<p>To list the files in the working directory, use
	the <tt class="user">ls</tt> command.</p>
	<div class="display">
<pre><tt>[me@linuxbox me]$</tt> <tt	class="cmd">ls</tt><tt>
Desktop     Xrootenv.0    linuxcmd
GNUstep     bin           nedit.rpm
GUILG00.GZ  hitni123.jpg  nsmail
</tt></pre></div>

	<p>I will come back to <tt class="user">ls</tt> in
	the next lesson. There are a lot of fun things you
	can do with it, but I have to talk about pathnames
	and directories a bit first.</p>

	<h2>cd</h2>

	<p>To change your working directory (where you are
	standing in the maze) you use the <tt class=
	"user">cd</tt> command. To do this, type <tt class=
	"user">cd</tt> followed by the <i>pathname</i> of
	the desired working directory. A pathname is the
	route you take along the branches of the tree to
	get to the directory you want. Pathnames can be
	specified in one of two different ways; <i>absolute
	pathnames</i> or <i>relative pathnames</i>. Let's
	look with absolute pathnames first.</p>

	<p>An absolute pathname begins with the root
	directory and follows the tree branch by branch
	until the path to the desired directory or file is
	completed. For example, there is a directory on
	your system in which most programs are installed. The pathname of the directory is
	/usr/bin. This means from the root directory
	(represented by the leading slash in the pathname)
	there is a directory called "usr" which contains a directory
	called "bin".</p>

	<p>Let's try this out:</p>

	<div class="display">
<pre><tt>[me@linuxbox me]$</tt> <tt class="cmd">cd /usr/bin</tt>
<tt>[me@linuxbox bin]$</tt> <tt class="cmd">pwd</tt>
<tt>/usr/bin</tt>
<tt>[me@linuxbox bin]$</tt> <tt class="cmd">ls</tt><tt>
[                     lwp-request
2to3                  lwp-rget
2to3-2.6              lxterm
a2p                   lz
aalib-config          lzcat
aconnect              lzma
acpi_fakekey          lzmadec
acpi_listen           lzmainfo
add-apt-repository    m17n-db
addpart               magnifier

and many more...
</tt></pre></div>

	<p>Now we can see that we have changed the current
	working directory to /usr/bin and that it is
	full of files. Notice how your prompt has changed?
	As a convenience, it is usually set up to display
	the name of the working directory.</p>

	<p>Where an absolute pathname starts from the root
	directory and leads to its destination, a relative
	pathname starts from the working directory. To do
	this, it uses a couple of special notations to
	represent relative positions in the file system
	tree. These special notations are "." (dot) and ".."
	(dot dot).</p>

	<p>The "." notation refers to the working directory
	itself and the ".." notation refers to the working
	directory's parent directory. Here is how it works.
	Let's change the working directory to
	/usr/bin again:</p>

	<div class="display">
		<p><tt>[me@linuxbox me]$</tt> <tt
		class="cmd">cd /usr/bin</tt><br>
		<tt>[me@linuxbox bin]$</tt> <tt
		class="cmd">pwd</tt><br>
		<tt>/usr/bin</tt></p>
	</div>

	<p>O.K., now let's say that we wanted to change the
	working directory to the parent of /usr/bin
	which is /usr. We could do that two different
	ways. First, with an absolute pathname:</p>

	<div class="display">
		<p><tt>[me@linuxbox bin]$</tt> <tt
		class="cmd">cd /usr</tt><br>
		<tt>[me@linuxbox usr]$</tt> <tt
		class="cmd">pwd</tt><br>
		<tt>/usr</tt></p>
	</div>

	<p>Or, with a relative pathname:</p>

	<div class="display">
		<p><tt>[me@linuxbox bin]$</tt> <tt
        class="cmd">cd ..</tt><br>
        <tt>[me@linuxbox usr]$</tt> <tt
        class="cmd">pwd</tt><br>
        <tt>/usr</tt></p>
    </div>

	<p>Two different methods with identical results.
	Which one should you use? The one that requires
	the least typing!</p>

	<p>Likewise, we can change the working directory
	from /usr to /usr/bin in two different
	ways. First using an absolute pathname:</p>

	<div class="display">
		<p><tt>[me@linuxbox usr]$</tt> <tt
		class="cmd">cd /usr/bin</tt><br>
		<tt>[me@linuxbox bin]$</tt> <tt
		class="cmd">pwd</tt><br>
		<tt>/usr/bin</tt></p>
	</div>

	<p>Or, with a relative pathname:</p>
	<div class="display">
		<p><tt>[me@linuxbox usr]$</tt> <tt
		class="cmd">cd ./bin</tt><br>
		<tt>[me@linuxbox bin]$</tt> <tt
		class="cmd">pwd</tt><br>
		<tt>/usr/bin</tt></p>
	</div>

	<p>Now, there is something important that I must
	point out here. In almost all cases, you can omit
	the "./". It is implied. Typing:</p>

	<div class="display">
		<p><tt>[me@linuxbox usr]$</tt> <tt
		class="cmd">cd bin</tt></p>
	</div>

	<p>would do the same thing. In general, if you do
	not specify a pathname to something, the working
	directory will be assumed. There is one important
	exception to this, but we won't get to that for a
	while.</p>

	<h2>A Few Shortcuts</h2>

	<p>If you type <tt class="user">cd</tt> followed by
	nothing, <tt class="user">cd</tt> will change the
	working directory to your home directory.</p>

	<p>A related shortcut is to type <tt class=
	"user">cd ~<i>user_name</i></tt>. In this case, <tt
	class="user">cd</tt> will change the working
	directory to the home directory of the specified
	user.</p>
	
	<p>Typing <tt class="user">cd -</tt> changes the working
	directory to the previous one.</p>

	<div class="sidebar">

		<h2>Important facts about file names</h2>

		<ol>
			<li>File names that begin with a period character
			are hidden. This only means that <tt class=
			"user">ls</tt> will not list them unless you say
			<tt class="user">ls -a</tt>. When your account
			was created, several hidden files were placed in
			your home directory to configure things for your
			account. Later on we will take a closer look at
			some of these files to see how you can customize
			your <i>environment</i>. In addition, some applications
			will place their configuration and settings files
			in your home directory as hidden files.<br>
			<br>
			</li>

			<li>File names in Linux, like Unix, are case
			sensitive. The file names "File1" and "file1"
			refer to different files.<br>
			<br>
			</li>

			<li>Linux has no concept of a "file extension"
			like legacy operating systems. You may name files
			any way you like. However, while Linux itself does not care
			about file extensions, many application programs do.<br>
			<br>
			</li>

			<li>Though Linux supports long file names which
			may contain embedded spaces and punctuation
			characters, limit the punctuation characters to
			period, dash, and underscore. <strong>Most
			importantly, do not embed spaces in file
			names.</strong> If you want to represent spaces
			between words in a file name, use underscore
			characters. You will thank yourself later.<br>
			<br>
			</li>
		</ol>
	</div>



		<div class="pagenav">
			<p class="right"><a
			href="lc3_lts0010.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_lts0030.php">Next</a></p>
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