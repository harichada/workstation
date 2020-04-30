



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Learning the shell - Lesson 3: Looking around</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_lts0020.php">
		<link rel="next" href="lc3_lts0040.php">
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
			href="lc3_lts0020.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="lc3_lts0040.php">Next</a></p>
		</div>
<h1>Looking Around</h1>

<p>Now that you know how to move from working
directory to working directory, we're going to take
a tour of your Linux system and, along the way,
learn some things about what makes it tick. But
before we begin, I have to teach you some tools
that will come in handy during our adventure. These
are:</p>

<ul>
<li type="disk"><tt class="user"><a href=
"lc3_man_pages/ls1.html">ls</a></tt> (list files and
directories)</li>

<li type="disk"><tt class="user"><a href=
"lc3_man_pages/less1.html">less</a></tt> (view text
files)</li>

<li type="disk"><tt class="user"><a href=
"lc3_man_pages/file1.html">file</a></tt> (classify a
file's contents)</li>
</ul>

<h2>ls</h2>

<p>The <tt class="user">ls</tt> command is used to
list the contents of a directory. It is probably
the most commonly used Linux command. It can be
used in a number of different ways. Here are some
examples:<br>
<br>
</p>

<table cellpadding="8" border summary=
"Table containing examples of the ls command.">
	<caption>
		Examples of the ls command
	</caption>

	<tr>
		<th width="150" valign="top">
		<strong>Command</strong></th>

		<th><strong>Result</strong></th>
	</tr>

	<tr>
		<td><tt class="user">ls</tt></td>

		<td valign="top">
		<p>List the files in the working
		directory</p>
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><tt class=
		"user">ls /bin</tt></td>

		<td valign="top">
		<p>List the files in the /bin directory (or
		any other directory you care to specify)</p>
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><tt class=
		"user">ls -l</tt></td>

		<td valign="top">
		<p>List the files in the working directory in
		long format</p>
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><tt class=
		"user">ls -l /etc /bin</tt></td>

		<td valign="top">
		<p>List the files in the /bin directory and
		the /etc directory in long format</p>
		</td>
	</tr>

	<tr>
		<td width="150" valign="top"><tt class=
		"user">ls -la ..</tt></td>

		<td valign="top">
		<p>List all files (even ones with names
		beginning with a period character, which are
		normally hidden) in the parent of the working
		directory in long format</p>
		</td>
	</tr>
</table>

<p>These examples also point out an important
concept about commands. Most commands operate like
this:</p>

<pre>
    <i>command -options arguments</i>
</pre>

<p>where <i>command</i> is the name of the command,
<i>-options</i> is one or more adjustments to the
command's behavior, and <i>arguments</i> is one or
more "things" upon which the command operates.</p>

<p>In the case of <tt class="user">ls</tt>, we see
that <tt class="user">ls</tt> is the name of the
command, and that it can have one or more options,
such as <tt class="user">-a</tt> and <tt class="user">-l</tt>,
and it can operate on one or
more files or directories.</p>

<h3>A Closer Look at Long Format</h3>

<p>If you use the <tt class="user">-l</tt> option with <tt class=
"user">ls</tt>, you will get a file listing that
contains a wealth of information about the files
being listed. Here's an example:<br>
<br>
</p>
<hr>
<pre><tt class="user">
-rw-------   1 bshotts  bshotts       576 Apr 17  1998 weather.txt
drwxr-xr-x   6 bshotts  bshotts      1024 Oct  9  1999 web_page
-rw-rw-r--   1 bshotts  bshotts    276480 Feb 11 20:41 web_site.tar
-rw-------   1 bshotts  bshotts      5743 Dec 16  1998 xmas_file.txt

----------     -------  -------  -------- ------------ -------------
    |             |        |         |         |             |
    |             |        |         |         |         File Name
    |             |        |         |         |
    |             |        |         |         +---  Modification Time
    |             |        |         |
    |             |        |         +-------------   Size (in bytes)
    |             |        |
    |             |        +-----------------------        Group
    |             |
    |             +--------------------------------        Owner
    |
    +----------------------------------------------   File Permissions
</tt>
</pre>
<hr>

<dl>
	<dt><strong>File Name</strong></dt>

	<dd>The name of the file or directory.</dd>

	<dt><strong>Modification Time</strong></dt>

	<dd>The last time the file was modified. If the
	last modification occurred more than six months
	in the past, the date and year are displayed.
	Otherwise, the time of day is shown.</dd>

	<dt><strong>Size</strong></dt>

	<dd>The size of the file in bytes.</dd>

	<dt><strong>Group</strong></dt>

	<dd>The name of the group that has file
	permissions in addition to the file's owner.</dd>

	<dt><strong>Owner</strong></dt>

	<dd>The name of the user who owns the file.</dd>

	<dt><strong>File Permissions</strong></dt>

	<dd>A representation of the file's access
	permissions. The first character is the type of
	file. A "-" indicates a regular (ordinary) file.
	A "d" indicates a directory. The second set of
	three characters represent the read, write, and
	execution rights of the file's owner. The next
	three represent the rights of the file's group,
	and the final three represent the rights granted
	to everybody else. I'll discuss this in more detail
	in a later lesson.</dd>
</dl>

<h2>less</h2>

<p><tt class="user">less</tt> is a program that
lets you view text files. This is very handy since
many of the files used to control and configure
Linux are human readable.</p>

<div class="sidebar">
<h2>What is "text"?</h2>

<p>There are many ways to represent information on
a computer. All methods involve defining a
relationship between the information and some
numbers that will be used to represent it.
Computers, after all, only understand numbers and
all data is converted to numeric
representation.</p>

<p>Some of these representation systems are very
complex (such as compressed multimedia files), while
others are rather simple. One of the earliest and
simplest is called <i>ASCII text</i>. <a href=
"lc3_man_pages/ascii7.html">ASCII</a> (pronounced
"As-Key") is short for American Standard Code for
Information Interchange. This is a simple encoding
scheme that was first used on Teletype machines to
map keyboard characters to numbers.</p>

<p>Text is a simple one-to-one mapping of
characters to numbers. It is very compact. Fifty
characters of text translates to fifty bytes of
data. Throughout a Linux system, many files are
stored in text format and there are many Linux
tools that work with text files. Even the legacy
operating systems recognize the importance of this
format. The well-known NOTEPAD.EXE program is an
editor for plain ASCII text files.</p>
</div>

<p>The <tt class="user">less</tt> program is
invoked by simply typing:</p>

<pre>
less <i>text_file</i>
</pre>

<p>This will display the file.</p>

<h3>Controlling less</h3>

<p>Once started, <tt class="user">less</tt> will
display the text file one page at a time. You may
use the Page Up and Page Down keys to move through
the text file. To exit <tt class="user">less</tt>,
type "q". Here are some commands that <tt class=
"user">less</tt> will accept:<br>
<br>
</p>

<table cellpadding="8" border summary=
	"Table containing summary of keyboard commands for the less program.">
	<caption>
		Keyboard commands for the less program
	</caption>

	<tr>
		<th valign="top"><strong>Command</strong></th>

		<th valign="top"><strong>Action</strong></th>
	</tr>

	<tr>
		<td valign="top">
		<p>Page Up or b</p>
		</td>

		<td valign="top">
		<p>Scroll back one page</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>Page Down or space</p>
		</td>

		<td valign="top">
		<p>Scroll forward one page</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>G</p>
		</td>

		<td valign="top">
		<p>Go to the end of the text file</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>1G</p>
		</td>

		<td valign="top">
		<p>Go to the beginning of the text file</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>/<i>characters</i></p>
		</td>

		<td valign="top">
		<p>Search forward in the text file for an
		occurrence of the specified
		<i>characters</i></p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>n</p>
		</td>

		<td valign="top">
		<p>Repeat the previous search</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>h</p>
		</td>

		<td valign="top">
		<p>Display a complete list less commands and options</p>
		</td>
	</tr>
	
	<tr>
		<td valign="top">
		<p>q</p>
		</td>

		<td valign="top">
		<p>Quit</p>
		</td>
	</tr>
</table>

<h2>file</h2>

<p>As you wander around your Linux system, it is
helpful to determine what kind of data a file contains before
you try to view it. This is where the <tt class=
"user">file</tt> command comes in. <tt class=
"user">file</tt> will examine a file and tell you
what kind of file it is.</p>

<p>To use the <tt class="user">file</tt> program,
just type:</p>

<pre>
<tt>file <i>name_of_file</i>
</tt>
</pre>

<p>The <tt class="user">file</tt> program can
recognize most types of files, such as:<br>
<br>
</p>

<table cellpadding="8" border summary=
	"Table describing various types of files.">
	<caption>
		Various kinds of files
	</caption>

	<tr>
		<th valign="top"><strong>File Type</strong></th>

		<th valign="top"><strong>Description</strong></th>

		<th valign="top"><strong>Viewable as
		text?</strong></th>
	</tr>

	<tr>
		<td valign="top">
		<p>ASCII text</p>
		</td>

		<td valign="top">
		<p>The name says it all</p>
		</td>

		<td valign="top">
		<p>yes</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>Bourne-Again shell script text</p>
		</td>

		<td valign="top">
		<p>A <tt class="user">bash</tt> script</p>
		</td>

		<td valign="top">
		<p>yes</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>ELF 32-bit LSB core file</p>
		</td>

		<td valign="top">
		<p>A core dump file (a program will create
		this when it crashes)</p>
		</td>

		<td valign="top">
		<p>no</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>ELF 32-bit LSB executable</p>
		</td>

		<td valign="top">
		<p>An executable binary program</p>
		</td>

		<td valign="top">
		<p>no</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>ELF 32-bit LSB shared object</p>
		</td>

		<td valign="top">
		<p>A shared library</p>
		</td>

		<td valign="top">
		<p>no</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>GNU tar archive</p>
		</td>

		<td valign="top">
		<p>A tape archive file. A common way of
		storing groups of files.</p>
		</td>

		<td valign="top">
		<p>no, use <tt class="user">tar tvf</tt> to
		view listing.</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>gzip compressed data</p>
		</td>

		<td valign="top">
		<p>An archive compressed with <tt class=
		"user">gzip</tt></p>
		</td>

		<td valign="top">
		<p>no</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>HTML document text</p>
		</td>

		<td valign="top">
		<p>A web page</p>
		</td>

		<td valign="top">
		<p>yes</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>JPEG image data</p>
		</td>

		<td valign="top">
		<p>A compressed JPEG image</p>
		</td>

		<td valign="top">
		<p>no</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>PostScript document text</p>
		</td>

		<td valign="top">
		<p>A PostScript file</p>
		</td>

		<td valign="top">
		<p>yes</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>RPM</p>
		</td>

		<td valign="top">
		<p>A Red Hat Package Manager archive</p>
		</td>

		<td valign="top">
		<p>no, use <tt class="user">rpm -q</tt> to
		examine contents.</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>Zip archive data</p>
		</td>

		<td valign="top">
		<p>An archive compressed with <tt class=
		"user">zip</tt></p>
		</td>

		<td valign="top">
		<p>no</p>
		</td>
	</tr>
</table>

<p>While it may seem that most files cannot be
viewed as text, you will be surprised how many can.
This is especially true of the important
configuration files. You will also notice during
our adventure that many features of the operating
system are controlled by shell scripts. In Linux,
there are no secrets!</p>



		<div class="pagenav">
			<p class="right"><a
			href="lc3_lts0020.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_lts0040.php">Next</a></p>
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