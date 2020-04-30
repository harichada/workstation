



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Learning the shell - Lesson 5: Manipulating Files</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_lts0040.php">
		<link rel="next" href="lc3_lts0060.php">
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
			href="lc3_lts0040.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="lc3_lts0060.php">Next</a></p>
		</div>
<h1>Manipulating Files</h1>

<p>This lesson will introduce you to the following
commands:</p>

<ul>
	<li><tt class="user"><a href=
	"lc3_man_pages/cp1.html">cp</a></tt> - copy files and
	directories</li>

	<li><tt class="user"><a href=
	"lc3_man_pages/mv1.html">mv</a></tt> - move or rename
	files and directories</li>

	<li><tt class="user"><a href=
	"lc3_man_pages/rm1.html">rm</a></tt> - remove files
	and directories</li>

	<li><tt class="user"><a href=
	"lc3_man_pages/mkdir1.html">mkdir</a></tt> - create
	directories</li>
</ul>

<p>These four commands are among the most
frequently used Linux commands. They are the basic
commands for manipulating both files and
directories.</p>

<p>Now, to be frank, some of the tasks performed by
these commands are more easily done with a
graphical file manager. With a file manager, you
can drag and drop a file from one directory to
another, cut and paste files, delete files, etc. So
why use these old command line programs?</p>

<p>The answer is power and flexibility. While it is
easy to perform simple file manipulations with a
graphical file manager, complicated tasks can be
easier with the command line programs. For example,
how would you copy all the HTML files from one
directory to another, but only copy files that did
not exist in the destination directory or were
newer than the versions in the destination
directory? Pretty hard with with a file manager.
Pretty easy with the command line:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">cp -u *.html destination</tt></p>
</div>

<h2>Wildcards</h2>

<p>Before I begin with our commands, I want to talk
about a shell feature that makes these commands so
powerful. Since the shell uses filenames so much,
it provides special characters to help you rapidly
specify groups of filenames. These special
characters are called <i>wildcards</i>. Wildcards
allow you to select filenames based on patterns of
characters. The table below lists the wildcards and
what they select:<br>
<br>
</p>

<table cellpadding="8" border summary=
"Summary of wildcards and their meanings">
	<caption>
		Summary of wildcards and their meanings
	</caption>

	<tr>
		<th><strong>Wildcard</strong></th>

		<th><strong>Meaning</strong></th>
	</tr>

	<tr>
		<td>
		<p><strong>*</strong></p>
		</td>

		<td>
		<p>Matches any characters</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><strong>?</strong></p>
		</td>

		<td>
		<p>Matches any single character</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><strong>[<i>characters</i>]</strong></p>
		</td>

		<td>
		<p>Matches any character that is a member of
		the set <i>characters</i>. The set of
		characters may also be expressed as a <i>POSIX
		character class</i> such as one of the following:</p>
		<table summary="POSIX Character Classes" cellpadding="3" align="center">
			<caption>POSIX Character Classes</caption>
			<tr>
				<td><strong>[:alnum:]</strong></td>
				<td>Alphanumeric characters</td>
			</tr>
			<tr>
				<td><strong>[:alpha:]</strong></td>
				<td>Alphabetic characters</td>
			</tr>
			<tr>
				<td><strong>[:digit:]</strong></td>
				<td>Numerals</td>
			</tr>
			<tr>
				<td><strong>[:upper:]</strong></td>
				<td>Uppercase alphabetic characters</td>
			</tr>
			<tr>
				<td><strong>[:lower:]</strong></td>
				<td>Lowercase alphabetic characters</td>
			</tr>
		</table>
		</td>
	</tr>

	<tr>
		<td>
		<p><strong>[!<i>characters</i>]</strong></p>
		</td>

		<td>
		<p>Matches any character that is not a member
		of the set <i>characters</i></p>
		</td>
	</tr>
</table>

<p>Using wildcards, it is possible to construct
very sophisticated selection criteria for
filenames. Here are some examples of patterns and
what they match:<br>
<br>
</p>

<table cellpadding="8" border summary=
"Examples of wildcard matching.">
	<caption>
		Examples of wildcard matching
	</caption>

	<tr>
		<th><strong>Pattern</strong></th>

		<th><strong>Matches</strong></th>
	</tr>

	<tr>
		<td>
		<pre class="bold">*</pre>
		</td>

		<td>
		<p>All filenames</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">g*</pre>
		</td>

		<td>
		<p>All filenames that begin with the
		character "g"</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">b*.txt</pre>
		</td>

		<td>
		<p>All filenames that begin with the
		character "b" and end with the characters
		".txt"</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">Data???</pre>
		</td>

		<td>
		<p>Any filename that begins with the
		characters "Data" followed by exactly 3 more
		characters</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">[abc]*</pre>
		</td>

		<td>
		<p>Any filename that begins with "a" or "b"
		or "c" followed by any other characters</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">[[:upper:]]*</pre>
		</td>

		<td>
		<p>Any filename that begins with an uppercase
		letter. This is an example of a character class.</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">BACKUP.[[:digit:]][[:digit:]]</pre>
		</td>

		<td>
		<p>Another example of character classes. This pattern
		matches any filename that begins with the
		characters "BACKUP." followed by exactly two
		numerals.</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">*[![:lower:]]</pre>
		</td>

		<td>
		<p>Any filename that does not end with a
		lowercase letter.</p>
		</td>
	</tr>
</table>

<p>You can use wildcards with any command that
accepts filename arguments.</p>

<h2><a name="cp">cp</a></h2>

<p>The <tt class="user">cp</tt> program copies
files and directories. In its simplest form, it
copies a single file:</p>

<div class="display">
				<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
                class="cmd">cp <i>file1 file2</i></tt></p>
</div>

<p>It can also be used to copy multiple files (and/or directories) to a
different directory:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">cp <i>file... directory</i></tt></p>
</div>

<p><b>A note on notation:</b> ... signifies that an item can be
repeated one or more times.</p>

<p>Other useful examples of <tt class=
"user">cp</tt> and its options include:<br>
<br>
</p>

<table cellpadding="8" border summary=
	"Examples of the cp command.">
	<caption>
		Examples of the cp command
	</caption>

	<tr>
		<th><strong>Command</strong></th>

		<th><strong>Results</strong></th>
	</tr>

	<tr>
		<td>
		<pre class="bold">cp <i>file1 file2</i></pre>
		</td>

		<td>
		<p>Copies the contents of <i>file1</i> into
		<i>file2</i>. If <i>file2</i> does not exist,
		it is created; <b>otherwise, <i>file2</i> is
		silently overwritten with the contents of
		<i>file1</i>.</b></p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">cp -i <i>file1 file2</i></pre>
		</td>

		<td>
		<p>Like above however, since the "-i"
		(interactive) option is specified, if
		<i>file2</i> exists, the user is prompted
		before it is overwritten with the contents of
		<i>file1</i>.</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">cp <i>file1 dir1</i></pre>
		</td>

		<td>
		<p>Copy the contents of <i>file1</i> (into a
		file named <i>file1</i>) inside of directory
		<i>dir1</i>.</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">cp -R <i>dir1 dir2</i></pre>
		</td>

		<td>
		<p>Copy the contents of the directory
		<i>dir1</i>. If directory <i>dir2</i> does
		not exist, it is created. Otherwise, it
		creates a directory named <i>dir1</i> within
		directory <i>dir2</i>.</p>
		</td>
	</tr>
</table>

<h2>mv</h2>

<p>The <tt class="user">mv</tt> command moves or renames
files and directories depending on how it is
used. It will either move one or more files to a
different directory, or it will rename a file or
directory. To rename a file, it is used like
this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">mv <i>filename1 filename2</i></tt></p>
</div>

<p>To move files (and/or directories) to a different directory:</p>
<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">mv <i>file... directory</i></tt></p>
</div>

<p>Examples of <tt class="user">mv</tt> and its
options include:<br>
<br>
</p>

<table cellpadding="8" border summary=
	"Examples of the mv command">
	<caption>
		Examples of the mv command
	</caption>

	<tr>
		<th><strong>Command</strong></th>

		<th><strong>Results</strong></th>
	</tr>

	<tr>
		<td>
		<pre class="bold">mv <i>file1 file2</i></pre>
		</td>

		<td>
		<p>If <i>file2</i> does not exist, then
		<i>file1</i> is renamed <i>file2</i>. <b>If
		<i>file2</i> exists, its contents are
		silently replaced with the contents of
		<i>file1</i>.</b></p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">mv -i <i>file1 file2</i></pre>
		</td>

		<td>
		<p>Like above however, since the "-i"
		(interactive) option is specified, if
		<i>file2</i> exists, the user is prompted
		before it is overwritten with the contents of
		<i>file1</i>.</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">mv <i>file1 file2 file3 dir1</i></pre>
		</td>

		<td>
		<p>The files <i>file1, file2, file3</i> are
		moved to directory <i>dir1</i>. If <i>dir1</i>
		does not exist, <tt class="user">mv</tt> will
		exit with an error.</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">mv <i>dir1 dir2</i></pre>
		</td>

		<td>
		<p>If <i>dir2</i> does not exist, then
		<i>dir1</i> is renamed <i>dir2</i>. If
		<i>dir2</i> exists, the directory <i>dir1</i>
		is moved within directory <i>dir2</i>.</p>
		</td>
	</tr>
</table>

<h2>rm</h2>

<p>The <tt class="user">rm</tt> command removes (deletes)
files and directories.</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">rm <i>file...</i></tt></p>
</div>

<p>It can also be used to delete directories:</p>

<div class="display">
	<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
	class="cmd">rm -r <i>directory...</i></tt></p>
</div>

<p>Examples of <tt class="user">rm</tt> and its
options include:<br>
<br>
</p>

<table cellpadding="8" border summary=
"Examples of the rm command.">
	<caption>
		Examples of the rm command
	</caption>

	<tr>
		<th><strong>Command</strong></th>

		<th><strong>Results</strong></th>
	</tr>

	<tr>
		<td>
		<pre class="bold">rm <i>file1 file2</i></pre>
		</td>

		<td>
		<p>Delete <i>file1</i> and <i>file2</i>.</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">rm -i <i>file1 file2</i></pre>
		</td>

		<td>
		<p>Like above however, since the "-i"
		(interactive) option is specified, the user
		is prompted before each file is deleted.</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">rm -r <i>dir1 dir2</i></pre>
		</td>

		<td>
		<p>Directories <i>dir1</i> and <i>dir2</i>
		are deleted along with all of their
		contents.</p>
		</td>
	</tr>
</table>
<br>

<div class="warning">
<h2>Be careful with rm!</h2>

<p>Linux does not have an undelete
command. Once you delete something with <tt class=
"user">rm</tt>, it's gone. You can inflict terrific
damage on your system with <tt class="user">rm</tt>
if you are not careful, particularly with
wildcards.</p>

<p><b><i>Before you use <tt class=
"user">rm</tt> with wildcards, try this helpful
trick:</i></b> construct your command using <tt class=
"user">ls</tt> instead. By doing this, you can see
the effect of your wildcards before you delete
files. After you have tested your command with <tt
class="user">ls</tt>, recall the command with the
up-arrow key and then substitute <tt class=
"user">rm</tt> for <tt class="user">ls</tt> in the
command.</p>
</div>

<h2><a name="mkdir">mkdir</a></h2>

<p>The <tt class="user">mkdir</tt> command is used
to create directories. To use it, you simply
type:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">mkdir <i>directory...</i></tt></p>
</div>

<h2>Using Commands with Wildcards</h2>

<p>Since the commands we have covered here accept multiple
file and directories names as arguments, you can use wildcards to
specify them. Here are a few examples:</p>

<table cellpadding="8" border summary="Using commands with wildcards.">
	<caption>
		Command examples using wildcards
	</caption>

	<tr>
		<th><strong>Command</strong></th>

		<th><strong>Results</strong></th>
	</tr>

	<tr>
		<td>
		<pre class="bold">cp *.txt text_files</pre>
		</td>

		<td>
		<p>Copy all files in the current working directory with names
		ending with the characters ".txt" to an existing directory named
		<i>text_files</i>.</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">mv my_dir ../*.bak my_new_dir</pre>
		</td>

		<td>
		<p>Move the subdirectory <i>my_dir</i> and all the files ending
		in ".bak" in the current working directory's parent directory
		to an existing directory named <i>my_new_dir</i>.</p>
		</td>
	</tr>

	<tr>
		<td>
		<pre class="bold">rm *~</pre>
		</td>

		<td>
		<p>Delete all files in the current working directory that end
		with the character "~". Some applications create backup files
		using this naming scheme. Using this command will clean them
		out of a directory.</p>
		</td>
	</tr>
</table>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_lts0040.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_lts0060.php">Next</a></p>
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