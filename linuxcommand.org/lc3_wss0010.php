



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 1: Writing your first script and getting it to work</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_writing_shell_scripts.php">
		<link rel="next" href="lc3_wss0020.php">
		<link rel="contents" href="lc3_writing_shell_scripts.php#contents">
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
			href="lc3_writing_shell_scripts.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0020.php">Next</a></p>
		</div>
<h1>Writing Your First Script and Getting It to
Work</h1>

<p>To successfully write a shell script, you have
to do three things:</p>

<ol>
	<li>Write a script</li>

	<li>Give the shell permission to execute it</li>

	<li>Put it somewhere the shell can find it</li>
</ol>

<h2>Writing a Script</h2>

<p>A shell script is a file that contains ASCII
text. To create a shell script, you use a <i>text
editor</i>. A text editor is a program, like a word
processor, that reads and writes ASCII text files.
There are many, many text editors available for
your Linux system, both for the command line
environment and the GUI environment. Here is a list
of some common ones:<br>
<br>
</p>

<table cellpadding="8" summary="Common text editor programs" border>
	<tr>
		<td valign="top">
		<p><strong>Name</strong></p>
		</td>

		<td valign="top">
		<p><strong>Description</strong></p>
		</td>

		<td valign="top">
		<p><strong>Interface</strong></p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p><tt class="user"><a href=
		"lc3_man_pages/vim1.html">vi, vim</a></tt></p>
		</td>

		<td valign="top">
		<p>The granddaddy of Unix text editors, <tt
		class="user">vi</tt>, is infamous for its
		difficult, non-intuitive command structure.
		On the bright side, <tt class="user">vi</tt>
		is powerful, lightweight, and fast. Learning
		<tt class="user">vi</tt> is a Unix rite of
		passage, since it is universally available on
		Unix-like systems.  On most Linux 
		distributions, an enhanced version of the traditional
		<tt class="user">vi</tt>
		editor called <tt class="user">vim</tt> is used.</p>
		</td>

		<td valign="top">
		<p>command line</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p><tt class="user">Emacs</tt></p>
		</td>

		<td valign="top">
		<p>The true giant in the world of text
		editors is Emacs by <a
		href="http://en.wikipedia.org/wiki/Richard_Stallman">Richard
		Stallman</a>. Emacs
		contains (or can be made to contain) every
		feature ever conceived for a text editor. It
		should be noted that <tt class="user">vi</tt>
		and Emacs fans fight
		bitter religious wars over which is
		better.</p>
		</td>

		<td valign="top">
		<p>command line</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p><tt class="user"><a href=
		"lc3_man_pages/nano1.html">nano</a></tt></p>
		</td>

		<td valign="top">
		<p><tt class="user">nano</tt> is a free clone of the text
		editor supplied with the <tt class="user">pine</tt>
		email program. <tt class="user">nano</tt> is
		very easy to use but is very short on
		features. I recommend <tt class=
		"user">nano</tt> for first-time users who
		need a command line editor.</p>
		</td>

		<td valign="top">
		<p>command line</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p><tt class="user"><a href="lc3_man_pages/gedit1.html">gedit</a></tt></p>
		</td>

		<td valign="top">
		<p><tt class="user">gedit</tt> is the editor
		supplied with the Gnome desktop
		environment.</p>
		</td>

		<td valign="top">
		<p>graphical</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p><tt class="user">kwrite</tt></p>
		</td>

		<td valign="top">
		<p><tt class="user">kwrite</tt> is the
		"advanced editor" supplied with KDE. It has
		syntax highlighting, a helpful feature for
		programmers and script writers.</p>
		</td>

		<td valign="top">
		<p>graphical</p>
		</td>
	</tr>
</table>

<p>Now, fire up your text editor and type in your
first script as follows:</p>

<div class="codeexample"><pre>
<tt>#!/bin/bash
# My first script

echo "Hello World!"
</tt>
</pre>
</div>

<p>The clever among you will have figured out how
to copy and paste the text into your text editor
;-)</p>

<p>If you have ever opened a book on programming,
you would immediately recognize this as the
traditional "Hello World" program. Save your file
with some descriptive name. How about
<tt>hello_world</tt>?</p>

<p>The first line of the script is important. This
is a special clue, called a <i>shebang</i>, given to the shell indicating
what program is used to interpret the script. In
this case, it is <tt>/bin/bash</tt>. Other scripting
languages such as <tt>Perl, awk, tcl, Tk,</tt> and
<tt>python</tt> also use this mechanism.</p>

<p>The second line is a <i>comment</i>. Everything
that appears after a "#" symbol is ignored by <tt
class="user">bash</tt>. As your scripts become
bigger and more complicated, comments become vital.
They are used by programmers to explain what is
going on so that others can figure it out. The last
line is the <tt class="user"><a href=
"lc3_man_pages/echo1.html">echo</a></tt> command. This
command simply prints its arguments on the
display.</p>

<h2>Setting Permissions</h2>

<p>The next thing we have to do is give the shell
permission to execute your script. This is done
with the <tt class="user"><a href=
"lc3_man_pages/chmod1.html">chmod</a></tt> command as
follows:</p>


<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">chmod 755 hello_world</tt></p>
</div>

<p>The "755" will give you read, write, and execute
permission. Everybody else will get only read and
execute permission. If you want your script to be
private (i.e., only you can read and execute), use
"700" instead.</p>

<h2>Putting It in Your Path</h2>

<p>At this point, your script will run. Try
this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">./hello_world</tt></p>
</div>

<p>You should see "Hello World!" displayed. If you
do not, see what directory you really saved your
script in, go there and try again.</p>

<p>Before we go any further, I have to stop and
talk a while about paths. When you type in the name
of a command, the system does not search the entire
computer to find where the program is located. That
would take a long time. You have noticed that you
don't usually have to specify a complete path name
to the program you want to run, the shell just
seems to know.</p>

<p>Well, you are right. The shell does know. Here's
how: the shell maintains a list of directories
where executable files (programs) are kept, and only
searches the directories in that list. If it does
not find the program after searching each directory
in the list, it will issue the famous <tt>command
not found</tt> error message.</p>

<p>This list of directories is called your
<i>path</i>. You can view the list of directories
with the following command:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">echo $PATH</tt></p>
</div>

<p>This will return a colon separated list of
directories that will be searched if a specific
path name is not given when a command is attempted.
In our first attempt to execute your new script, we
specified a pathname ("./") to the file.</p>

<p>You can add directories to your path with the
following command, where <i>directory</i> is the
name of the directory you want to add:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">export
PATH=$PATH:<i>directory</i></tt></p>
</div>

<p>A better way would be to edit your
<tt>.bash_profile</tt> or <tt>.profile</tt> file (depending on your distribution)
to include the above
command. That way, it would be done automatically
every time you log in.</p>

<p>Most Linux distributions encourage a
practice in which each user has a specific
directory for the programs he/she personally uses.
This directory is called <tt>bin</tt> and is a
subdirectory of your home directory. If you do not
already have one, create it with the following
command:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">mkdir bin</tt></p>
</div>

<p>Move your script into your new <tt>bin</tt>
directory and you're all set. Now you just have to
type:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">hello_world</tt></p>
</div>

<p>and your script will run. On some distributions, most notably
Ubuntu, you will need to open a new terminal session before your
newly created <tt>bin</tt> directory will be recognised.</p>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_writing_shell_scripts.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0020.php">Next</a></p>
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