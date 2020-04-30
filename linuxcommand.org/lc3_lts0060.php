



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Learning the shell - Lesson 6: Working with Commands</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_lts0050.php">
		<link rel="next" href="lc3_lts0070.php">
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
			href="lc3_lts0050.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="lc3_lts0070.php">Next</a></p>
		</div>
<h1>Working with Commands</h1>

<p>Up until now you have seen a number of commands and their
mysterious options and arguments. In this lesson, we will
try to remove some of that mystery. This lesson will introduce the
following commands.</p>

<ul>
	<li><tt class="user"><a href="lc3_man_pages/typeh.html">type</a></tt> - Display information about command type</li>
	<li><tt class="user"><a href="lc3_man_pages/which1.html">which</a></tt> - Locate a command</li>
	<li><tt class="user"><a href="lc3_man_pages/helph.html">help</a></tt> - Display reference page for shell builtin</li>
	<li><tt class="user"><a href="lc3_man_pages/man1.html">man</a></tt> - Display an on-line command reference</li>
</ul>

<h2>What are "Commands?"</h2>

<p>Commands can be one of 4 different kinds:</p>
<ol>
	<li><b>An executable program</b> like all those files we saw in /usr/bin. Within this
category, programs can be <i>compiled binaries</i> such as programs written in C and
C++, or programs written in <i>scripting languages</i> such as the shell, Perl, Python,
Ruby, etc.
</li>
	<li><b>A command built into the shell itself.</b> bash provides a number of commands
internally called <i>shell builtins</i>. The <tt class="user">cd</tt> command,
for example, is a shell builtin.
</li>
	<li><b>A shell function.</b> These are miniature shell scripts incorporated into the
<i>environment</i>. We will cover configuring the environment and writing shell
functions in later lessons, but for now, just be aware that they exist.
</li>
	<li><b>An alias.</b> Commands that you can define yourselves, built from other commands.
	This will be covered in a later lesson.
</li>
</ol>

<h2>Identifying Commands</h2>

<p>It is often useful to know exactly which of the four kinds of commands is being used and
Linux provides a couple of ways to find out.
</p>

<h3>type</h3>

<p>The <tt class="user">type</tt> command is a shell builtin that displays the kind of command the shell will
execute, given a particular command name. It works like this:</p>

<pre>
	type <i>command</i>
</pre>

<p>where “command” is the name of the command you want to examine. Here are some
examples:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">type type</tt><br>
<tt class="prompt">type is a shell builtin</tt></p>
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">type ls</tt><br>
l<tt class="prompt">s is aliased to `ls --color=tty'</tt></p>
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">type cp</tt><br>
<tt class="prompt">cp is /bin/cp</tt></p>
</div>

<p>Here we see the results for three different commands. Notice that the one for ls (taken
from a Fedora system) and how the ls command is actually an alias for the ls command
with the “-- color=tty” option added. Now we know why the output from ls is displayed
in color!</p>


<h3>which</h3>

<p>Sometimes there is more than one version of an executable program installed on a
system. While this is not very common on desktop systems, it's not unusual on large
servers. To determine the exact location of a given executable, the <tt class="user">which</tt> command is
used:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">which ls</tt><br>
<tt class="prompt">/bin/ls</tt></p>
</div>

<p><tt class="user">which</tt> only works for executable programs, not builtins nor aliases that are substitutes
for actual executable programs.</p>

<h2>Getting Command Documentation</h2>

<p>With this knowledge of what a command is, we can now search for the documentation
available for each kind of command.
</p>

<h3>help</h3>

<p><tt class="user">bash</tt> has a built-in help facility
available for each of the shell builtins. To use it, type
“help” followed by the name of the shell builtin.
Optionally, you may add the -m option to change the format
of the output. For example:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">help -m cd</tt><br>
<pre>NAME
    cd - Change the shell working directory.

SYNOPSIS
    cd [-L|-P] [dir]

DESCRIPTION
    Change the shell working directory.
    
    Change the current directory to DIR.  The default DIR is the value of the
    HOME shell variable.
    
    The variable CDPATH defines the search path for the directory containing
    DIR.  Alternative directory names in CDPATH are separated by a colon (:).
    A null directory name is the same as the current directory.  If DIR begins
    with a slash (/), then CDPATH is not used.
    
    If the directory is not found, and the shell option `cdable_vars' is set,
    the word is assumed to be  a variable name.  If that variable has a value,
    its value is used for DIR.
    
    Options:
        -L	force symbolic links to be followed
        -P	use the physical directory structure without following symbolic
    	links
    
    The default is to follow symbolic links, as if `-L' were specified.
    
    Exit Status:
    Returns 0 if the directory is changed; non-zero otherwise.

SEE ALSO
    bash(1)

IMPLEMENTATION
    GNU bash, version 4.1.5(1)-release (i486-pc-linux-gnu)
    Copyright (C) 2009 Free Software Foundation, Inc.
</pre>
</div>

<p><b>A note on notation:</b> When square brackets appear in the description of a command's
syntax, they indicate optional items. A vertical bar character indicates mutually exclusive
items. In the case of the <tt class="user">cd</tt> command above:</p>

<pre>
	cd [-L|-P] [dir]
</pre>

<p>This notation says that the command <tt class="user">cd</tt> may be followed optionally by either a “-L” or a
“-P” and further, optionally followed by the argument “dir”.</p>

<h3>--help</h3>

<p>Many executable programs support a “--help” option that displays a description of the
command's supported syntax and options. For example:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">mkdir --help</tt><br>
<pre>
Usage: mkdir [OPTION] DIRECTORY...
Create the DIRECTORY(ies), if they do not already exist.

   -Z, --context=CONTEXT (SELinux) set security context to CONTEXT
Mandatory arguments to long options are mandatory for short options
too.
   -m, --mode=MODE   set file mode (as in chmod), not a=rwx – umask
   -p, --parents     no error if existing, make parent directories as
                     needed
   -v, --verbose     print a message for each created directory
   --help            display this help and exit
   --version         output version information and exit
</pre></p>
</div>

<p>Some programs don't support the “--help” option, but try it anyway. Often it results in an
error message that will reveal similar usage information.</p>


<h3>man</h3>

<p>Most executable programs intended for command
line use provide a formal piece of
documentation called a <i>manual</i> or <i>man page</i>. A special
paging program called <tt class="user">man</tt> is
used to view them. It is used like this:</p>

<pre>
	man <i>program</i>
</pre>

<p>where “program” is the name of the command to view.
Man pages vary somewhat in format but generally
contain a title, a synopsis of the
command's syntax, a description of the command's
purpose, and a listing and description
of each of the command's options. Man pages, however, do
not usually include examples, and are intended as a
reference, not a tutorial. As an example, let's try
viewing the man pagefor the <tt class="user">ls</tt>
command:
</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">man ls</tt><br>
</div>

<p>On most Linux systems, <tt class="user">man</tt> uses
<tt class="user">less</tt> to display the manual page,
so all of the familiar <tt class="user">less</tt> commands
work while displaying the page.</p>

<h3>README and Other Documentation Files</h3>

<p>Many software packages installed on your system have
documentation files residing in the /usr/share/doc directory.
Most of these are stored in plain text format and can
be viewed with <tt class="user">less</tt>. Some of the files
are in HTML format and can be viewed with your
web browser. You may encounter some files ending with a
“.gz” extension. This indicates that they have been
compressed with the <tt class="user">gzip</tt> compression program. The gzip
package includes a special version of <tt class="user">less</tt>
called <tt class="user">zless</tt> that will display the contents
of gzip-compressed text files.</p>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_lts0050.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_lts0070.php">Next</a></p>
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