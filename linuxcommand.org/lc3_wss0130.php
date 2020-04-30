



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 13: Flow Control - Part 3</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0120.php">
		<link rel="next" href="lc3_wss0140.php">
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
			href="lc3_wss0120.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0140.php">Next</a></p>
		</div>
<h1>Flow Control - Part 3</h1>

<p>Now that you have learned about positional
parameters, it is time to cover the remaining flow
control statement, <tt class="user"><a href="lc3_man_pages/forh.html">for</a></tt>. Like
<tt class="user">while</tt> and <tt class=
"user">until</tt>, <tt class="user">for</tt> is
used to construct loops. <tt class="user">for</tt>
works like this:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">for</tt> variable <tt class=
"user">in</tt> words; <tt class="user">do</tt>
    commands
<tt class="user">done</tt>
     </tt>
</pre>
</div>

<p>In essence, <tt class="user">for</tt> assigns a
word from the list of words to the specified
variable, executes the commands, and repeats this
over and over until all the words have been used
up. Here is an example:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

<tt class="user">for</tt> i <tt class=
"user">in</tt> word1 word2 word3; <tt class="user">do</tt>
    <tt class="user">echo</tt> $i
<tt class="user">done</tt>
     </tt>
</pre>
</div>

<p>In this example, the variable <tt>i</tt> is
assigned the string "<tt>word1</tt>", then the
statement <tt>echo $i</tt> is executed, then the
variable <tt>i</tt> is assigned the string
"<tt>word2</tt>", and the statement <tt>echo $i</tt>
is executed, and so on, until all the words in the
list of words have been assigned.</p>

<p>The interesting thing about <tt class=
"user">for</tt> is the many ways you can construct
the list of words. All kinds of expansions can
be used. In the next example, we will construct the
list of words using command substitution:</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

count=0
<tt class="user">for</tt> i <tt class=
"user">in</tt> $(cat ~/.bash_profile); <tt class="user">do</tt>
    count=$((count + 1))
    <tt class=
"user">echo</tt> "Word $count ($i) contains $(echo -n $i | wc -c) characters"
<tt class="user">done</tt></tt></pre></div>

<p>Here we take the file <tt>.bash_profile</tt> and
count the number of words in the file and the
number of characters in each word.</p>

<p>So what's this got to do with positional
parameters? Well, one of the features of <tt class=
"user">for</tt> is that it can use the positional
parameters as the list of words:</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

<tt class="user">for</tt> i <tt class="user">in</tt> "$@"; <tt class=
"user">do</tt>
    <tt class="user">echo</tt> $i
<tt class="user">done</tt></tt></pre></div>

<p>The shell variable <tt>"$@"</tt> contains the list
of command line arguments. This technique is often used to process a list of files on
the command line. Here is a another example:</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

<tt class="user">for</tt> filename <tt class="user">in</tt> "$@"; <tt
class="user">do</tt>
    result=
    <tt class="user">if</tt> <tt class=
"user">[</tt> -f "$filename" <tt class="user">];</tt> <tt class=
"user">then</tt>
        result="$filename is a regular file"
    <tt class="user">else</tt>
        <tt class="user">if</tt> <tt class=
"user">[</tt> -d "$filename" <tt class="user">];</tt> <tt class=
"user">then</tt>
            result="$filename is a directory"
        <tt class="user">fi</tt>
    <tt class="user">fi</tt>
    <tt class="user">if</tt> <tt class=
"user">[</tt> -w "$filename" <tt class="user">];</tt> <tt class=
"user">then</tt>
        result="$result and it is writable"
    <tt class="user">else</tt>
        result="$result and it is not writable"
    <tt class="user">fi</tt>
    <tt class="user">echo</tt> "$result"
<tt class="user">done</tt></tt></pre></div>

<p>Try this script. Give it a list of files or a
wildcard like "<tt>*</tt>" to see it work.</p>

<p>Here is another example script. This one
compares the files in two directories and lists
which files in the first directory are missing from
the second.</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

# cmp_dir - program to compare two directories

# Check for required arguments
<tt class="user">if</tt> <tt class="user">[</tt> $# -ne 2 <tt
class="user">];</tt> <tt class="user">then</tt>
    <tt class=
"user">echo</tt> "usage: $0 directory_1 directory_2" 1&gt;&amp;2
    <tt class="user">exit</tt> 1
<tt class="user">fi</tt>

# Make sure both arguments are directories
<tt class="user">if</tt> <tt class="user">[</tt> ! -d $1 <tt class=
"user">];</tt> <tt class="user">then</tt>
    <tt class="user">echo</tt> "$1 is not a directory!" 1&gt;&amp;2
    <tt class="user">exit</tt> 1
<tt class="user">fi</tt>

<tt class="user">if</tt> <tt class="user">[</tt> ! -d $2 <tt class=
"user">];</tt> <tt class="user">then</tt>
    <tt class="user">echo</tt> "$2 is not a directory!" 1&gt;&amp;2
    <tt class="user">exit</tt> 1
<tt class="user">fi</tt>

# Process each file in directory_1, comparing it to directory_2
missing=0
<tt class="user">for</tt> filename <tt class=
"user">in</tt> $1/*; <tt class="user">do</tt>
    fn=$(basename "$filename")
    <tt class="user">if</tt> <tt class=
"user">[</tt> -f "$filename" <tt class="user">];</tt> <tt class=
"user">then</tt>
        <tt class="user">if</tt> <tt class=
"user">[</tt> ! -f "$2/$fn" <tt class="user">];</tt> <tt class=
"user">then</tt>
            <tt class="user">echo</tt> "$fn is missing from $2"
            missing=$((missing + 1))
        <tt class="user">fi</tt>
    <tt class="user">fi</tt>
<tt class="user">done</tt>
<tt class="user">echo</tt> "$missing files missing"</tt></pre></div>

<p>Now on to the real work. We are going to improve
the <tt>home_space</tt> function in our script to
output more information. You will recall that our
previous version looked like this:</p>


<div class="codeexample">
<pre><tt>home_space()
{
    # Only the superuser can get this information

    <tt class="user">if</tt> <tt class=
"user">[</tt> "$(id -u)" = "0" <tt class="user">];</tt> <tt class=
"user">then</tt>
    <tt class=
"user">echo</tt> "&lt;h2&gt;Home directory space by user&lt;/h2&gt;"
    <tt class="user">echo</tt> "&lt;pre&gt;"
    <tt class="user">echo</tt> "Bytes Directory"
        du -s /home/* | sort -nr
    <tt class="user">echo</tt> "&lt;/pre&gt;"
    <tt class="user">fi</tt>

}   # end of home_space
     </tt>
</pre>
</div>

<p>Here is the new version:</p>

<div class="codeexample">
<pre><tt>home_space()
{
    <tt class=
"user">echo</tt> "&lt;h2&gt;Home directory space by user&lt;/h2&gt;"
    <tt class="user">echo</tt> "&lt;pre&gt;"
    format="%8s%10s%10s   %-s\n"
    printf "$format" "Dirs" "Files" "Blocks" "Directory"
    printf "$format" "----" "-----" "------" "---------"
    <tt class="user">if</tt> <tt class=
"user">[</tt> $(id -u) = "0" <tt class="user">];</tt> <tt class=
"user">then</tt>
        dir_list="/home/*"
    <tt class="user">else</tt>
        dir_list=$HOME
    <tt class="user">fi</tt>
    <tt class="user">for</tt> home_dir <tt class=
"user">in</tt> $dir_list; <tt class="user">do</tt>
        total_dirs=$(find $home_dir -type d | wc -l)
        total_files=$(find $home_dir -type f | wc -l)
        total_blocks=$(du -s $home_dir)
        printf "$format" $total_dirs $total_files $total_blocks
    <tt class="user">done</tt>
    <tt class="user">echo</tt> "&lt;/pre&gt;"

}   # end of home_space</tt></pre></div>


<p>This improved version introduces a new command
<tt class="user"><a href=
"lc3_man_pages/printf1.html">printf</a></tt>, which is
used to produce formatted output according to the
contents of a <i>format string</i>. <tt class=
"user">printf</tt> comes from the C programming
language and has been implemented in many other
programming languages including C++, Perl, awk,
java, PHP, and of course, bash. You can read more
about <tt class="user">printf</tt> format strings
at:</p>

<ul>
<li><a href=
"http://www.gnu.org/software/gawk/manual/html_node/Control-Letters.html#Control-Letters">
GNU Awk User's Guide - Control Letters</a></li>

<li><a href=
"http://www.gnu.org/software/gawk/manual/html_node/Format-Modifiers.html#Format-Modifiers">
GNU Awk User's Guide - Format Modifiers</a></li>
</ul>

<p>We also introduce the <tt class="user"><a href=
"man_pages/find1.html">find</a></tt> command. <tt
class="user">find</tt> is used to search for files
or directories that meet specific criteria. In the
<tt>home_space</tt> function, we use <tt class=
"user">find</tt> to list the directories and
regular files in each home directory. Using the <tt
class="user">wc</tt> command, we count the number
of files and directories found.</p>

<p>The really interesting thing about
<tt>home_space</tt> is how we deal with the problem
of superuser access. You will notice that we test
for the superuser with <tt class="user">id</tt> and,
according to the outcome of the test, we assign
different strings to the variable
<tt>dir_list</tt>, which becomes the list of words
for the <tt class="user">for</tt> loop that
follows. This way, if an ordinary user runs the
script, only his/her home directory will be
listed.</p>

<p>Another function that can use a <tt class=
"user">for</tt> loop is our unfinished
<tt>system_info</tt> function. We can build it like
this:</p>

<div class="codeexample">
<pre><tt>system_info()
{
    # Find any release files in /etc

    <tt class=
"user">if</tt> ls /etc/*release 1&gt;/dev/null 2&gt;&amp;1; <tt
class="user">then</tt>
        <tt class=
"user">echo</tt> "&lt;h2&gt;System release info&lt;/h2&gt;"
        <tt class="user">echo</tt> "&lt;pre&gt;"
        <tt class="user">for</tt> i <tt class=
"user">in</tt> /etc/*release; <tt class="user">do</tt>

            # Since we can't be sure of the
            # length of the file, only
            # display the first line.

            head -n 1 $i
        <tt class="user">done</tt>
        uname -orp
        <tt class="user">echo</tt> "&lt;/pre&gt;"
    <tt class="user">fi</tt>

}   # end of system_info</tt></pre></div>

<p>In this function, we first determine if there
are any release files to process. The release files
contain the name of the vendor and the version of
the distribution. They are located in the
<tt>/etc</tt> directory. To detect them, we perform
an <tt class="user">ls</tt> command and throw away
all of its output. We are only interested in the
exit status. It will be true if any files are
found.</p>

<p>Next, we output the HTML for this section of the
page, since we now know that there are release files
to process. To process the files, we start a <tt
class="user">for</tt> loop to act on each one.
Inside the loop, we use the <tt class="user"><a
href="lc3_man_pages/head1.html">head</a></tt> command
to return the first line of each file.</p>

<p>Finally, we use the <tt class="user"><a href=
"lc3_man_pages/uname1.html">uname</a></tt> command with
the "o", "r", and "p" options to obtain some
additional information from the system.</p>



		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0120.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0140.php">Next</a></p>
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