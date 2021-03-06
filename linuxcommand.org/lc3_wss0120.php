



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 12: Positional Parameters</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0110.php">
		<link rel="next" href="lc3_wss0130.php">
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
			href="lc3_wss0110.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0130.php">Next</a></p>
		</div>
<h1>Positional Parameters</h1>

<p>
When we last left our script, it looked something
like this:
</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

# sysinfo_page - A script to produce a system information HTML file

##### Constants

TITLE="System Information for $HOSTNAME"
RIGHT_NOW=$(date +"%x %r %Z")
TIME_STAMP="Updated on $RIGHT_NOW by $USER"

##### Functions

system_info()
{
    <tt class="user">echo</tt> "&lt;h2&gt;System release info&lt;/h2&gt;"
    <tt class="user">echo</tt> "&lt;p&gt;Function not yet implemented&lt;/p&gt;"

}   # end of system_info


show_uptime()
{
    <tt class="user">echo</tt> "&lt;h2&gt;System uptime&lt;/h2&gt;"
    <tt class="user">echo</tt> "&lt;pre&gt;"
    uptime
    <tt class="user">echo</tt> "&lt;/pre&gt;"

}   # end of show_uptime


drive_space()
{
    <tt class="user">echo</tt> "&lt;h2&gt;Filesystem space&lt;/h2&gt;"
    <tt class="user">echo</tt> "&lt;pre&gt;"
    df
    <tt class="user">echo</tt> "&lt;/pre&gt;"

}   # end of drive_space


home_space()
{
    # Only the superuser can get this information

    <tt class="user">if</tt> <tt class="user">[</tt> "$(id -u)" = "0" <tt class="user">];</tt> <tt class="user">then</tt>
        <tt class="user">echo</tt> "&lt;h2&gt;Home directory space by user&lt;/h2&gt;"
        <tt class="user">echo</tt> "&lt;pre&gt;"
        <tt class="user">echo</tt> "Bytes Directory"
        du -s /home/* | sort -nr
        <tt class="user">echo</tt> "&lt;/pre&gt;"
    <tt class="user">fi</tt>

}   # end of home_space



##### Main

cat &lt;&lt;- _EOF_
  &lt;html&gt;
  &lt;head&gt;
      &lt;title&gt;$TITLE&lt;/title&gt;
  &lt;/head&gt;
  &lt;body&gt;
      &lt;h1&gt;$TITLE&lt;/h1&gt;
      &lt;p&gt;$TIME_STAMP&lt;/p&gt;
      $(system_info)
      $(show_uptime)
      $(drive_space)
      $(home_space)
  &lt;/body&gt;
  &lt;/html&gt;
_EOF_
</tt>
</pre>
</div>

<p>
We have most things working, but there are
several more features I want to add:
</p>
<ol>
<li>
	I want to specify the name of the output file
	on the command line, as well as set a default
	output file name if no name is specified.<br>
	<br>
</li>
<li>
	I want to offer an interactive mode that will
	prompt for a file name and warn the user if the
	file exists and prompt the user to overwrite
	it.<br>
	<br>
</li>
<li>
	Naturally, we want to have a help option that
	will display a usage message.
</li>
</ol>
<p>
All of these features involve using command line
options and arguments. To handle options on the
command line, we use a facility in the shell
called <i>positional parameters</i>. Positional
parameters are a series of special variables
(<tt>$0</tt> through <tt>$9</tt>) that contain
the contents of the command line.
</p>
<p>
Let's imagine the following command line:
</p>

<div class="display">
<p>
<tt class="prompt">[me@linuxbox me]$</tt>
<tt class="cmd">some_program word1 word2
word3</tt>
</p>
</div>

<p>
If <tt>some_program</tt> were a bash shell script,
we could read each item on the command line
because the positional parameters contain the
following:
</p>
<ul>
	<li>
		$0 would contain "some_program"
	</li>
	<li>
		$1 would contain "word1"
	</li>
	<li>
		$2 would contain "word2"
	</li>
	<li>
		$3 would contain "word3"
	</li>
	</ul>
<p>
Here is a script you can use to try this out:
</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

<tt class="user">echo</tt> "Positional Parameters"
<tt class="user">echo</tt> '$0 = ' $0
<tt class="user">echo</tt> '$1 = ' $1
<tt class="user">echo</tt> '$2 = ' $2
<tt class="user">echo</tt> '$3 = ' $3
</tt>
</pre>
</div>

<h2>Detecting Command Line Arguments</h2>

<p>
Often, you will want to check to see if you have
arguments on which to act. There are a couple of ways
to do this. First, you could simply check to see
if <tt>$1</tt> contains anything like so:
</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

<tt class="user">if</tt> <tt class="user">[</tt> "$1" != "" <tt class="user">];</tt> <tt class="user">then</tt>
    <tt class="user">echo</tt> "Positional parameter 1 contains something"
<tt class="user">else</tt>
    <tt class="user">echo</tt> "Positional parameter 1 is empty"
<tt class="user">fi</tt>
</tt>
</pre>
</div>

<p>
Second, the shell maintains a variable called
<tt>$#</tt> that contains the number of items on
the command line in addition to the name of the
command (<tt>$0</tt>).
</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

<tt class="user">if</tt> <tt class="user">[</tt> $# -gt 0 <tt class="user">];</tt> <tt class="user">then</tt>
    <tt class="user">echo</tt> "Your <tt class="user">command</tt> line contains $# arguments"
<tt class="user">else</tt>
    <tt class="user">echo</tt> "Your <tt class="user">command</tt> line contains no arguments"
<tt class="user">fi</tt>
</tt>
</pre>
</div>

<h2>Command Line Options</h2>

<p>
As we discussed before, many programs,
particularly ones from <a href=
"http://www.gnu.org">the GNU Project</a>, support
both short and long command line options. For
example, to display a help message for many of
these programs, you may use either the
"<tt>-h</tt>" option or the longer
"<tt>--help</tt>" option. Long option names are
typically preceded by a double dash. We will
adopt this convention for our scripts.
</p>
<p>
Here is the code we will use to process our
command line:
</p>

<div class="codeexample">
<pre><tt>interactive=
filename=~/sysinfo_page.html

<tt class="user">while</tt> <tt class="user">[</tt> "$1" != "" <tt class="user">];</tt> <tt class="user">do</tt>
    <tt class="user">case</tt> $1 in
        -f | --file )           <tt class="user">shift</tt>
                                filename=$1
                                ;;
        -i | --interactive )    interactive=1
                                ;;
        -h | --help )           usage
                                <tt class="user">exit</tt>
                                ;;
        * )                     usage
                                <tt class="user">exit</tt> 1
    <tt class="user">esac</tt>
    <tt class="user">shift</tt>
<tt class="user">done</tt>
</tt>
</pre>
</div>

<p>
This code is a little tricky, so bear with me as
I attempt to explain it.
</p>
<p>
The first two lines are pretty easy. We set the
variable <tt>interactive</tt> to be empty. This
will indicate that the interactive mode has not
been requested. Then we set the variable
<tt>filename</tt> to contain a default file name.
If nothing else is specified on the command line,
this file name will be used.
</p>
<p>
After these two variables are set, we have
default settings, in case the user does not
specify any options.
</p>
<p>
Next, we construct a <tt class="user">while</tt>
loop that will cycle through all the items on the
command line and process each one with
	<tt class="user">case</tt>. The <tt class="user">case</tt> will
	detect each possible option and process it
	accordingly.
</p>
<p>
Now the tricky part. How does that loop work? It
relies on the magic of <tt class=
"user">shift</tt>.
</p>
<p>
<tt class="user">shift</tt> is a shell builtin
that operates on the positional parameters. Each
time you invoke <tt class="user">shift</tt>, it
"shifts" all the positional parameters down by
one. <tt>$2</tt> becomes <tt>$1</tt>, <tt>$3</tt>
becomes <tt>$2</tt>, <tt>$4</tt> becomes
<tt>$3</tt>, and so on. Try this:
</p>


<div class="codeexample">
<pre><tt>#!/bin/bash

<tt class="user">echo</tt> "You start with $# positional parameters"

# Loop until all parameters are used up
<tt class="user">while</tt> <tt class="user">[</tt> "$1" != "" <tt class="user">];</tt> <tt class="user">do</tt>
    <tt class="user">echo</tt> "Parameter 1 equals $1"
    <tt class="user">echo</tt> "You now have $# positional parameters"

    # Shift all the parameters down by one
    <tt class="user">shift</tt>

<tt class="user">done</tt>
</tt>
</pre>
</div>

<h2>Getting an Option's Argument</h2>

<p>
Our "<tt>-f</tt>" option requires a valid file name as an
argument. We use <tt class=
"user">shift</tt> again to get the next item from
the command line and assign it to
<tt>filename</tt>. Later we will have to check
the content of <tt>filename</tt> to make sure it
is valid.
</p>

<h2>Integrating the Command Line Processor into the Script</h2>

<p>
We will have to move a few things around and add
a usage function to get this new routine
integrated into our script. We'll also add some
test code to verify that the command line
processor is working correctly. Our script now
looks like this:
</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

# sysinfo_page - A script to produce a system information HTML file

##### Constants

TITLE="System Information <tt class="user">for</tt> $HOSTNAME"
RIGHT_NOW=$(date +"%x %r %Z")
TIME_STAMP="Updated on $RIGHT_NOW by $USER"

##### Functions

system_info()
{
    <tt class="user">echo</tt> "&lt;h2&gt;System release info&lt;/h2&gt;"
    <tt class="user">echo</tt> "&lt;p&gt;Function not yet implemented&lt;/p&gt;"

}   # end of system_info


show_uptime()
{
    <tt class="user">echo</tt> "&lt;h2&gt;System uptime&lt;/h2&gt;"
    <tt class="user">echo</tt> "&lt;pre&gt;"
    uptime
    <tt class="user">echo</tt> "&lt;/pre&gt;"

}   # end of show_uptime


drive_space()
{
    <tt class="user">echo</tt> "&lt;h2&gt;Filesystem space&lt;/h2&gt;"
    <tt class="user">echo</tt> "&lt;pre&gt;"
    df
    <tt class="user">echo</tt> "&lt;/pre&gt;"

}   # end of drive_space


home_space()
{
    # Only the superuser can get this information

    <tt class="user">if</tt> <tt class="user">[</tt> "$(id -u)" = "0" <tt class="user">];</tt> <tt class="user">then</tt>
        <tt class="user">echo</tt> "&lt;h2&gt;Home directory space by user&lt;/h2&gt;"
        <tt class="user">echo</tt> "&lt;pre&gt;"
        <tt class="user">echo</tt> "Bytes Directory"
        du -s /home/* | sort -nr
        <tt class="user">echo</tt> "&lt;/pre&gt;"
    <tt class="user">fi</tt>

}   # end of home_space


write_page()
{
    cat &lt;&lt;- _EOF_
    &lt;html&gt;
        &lt;head&gt;
        &lt;title&gt;$TITLE&lt;/title&gt;
        &lt;/head&gt;
        &lt;body&gt;
        &lt;h1&gt;$TITLE&lt;/h1&gt;
        &lt;p&gt;$TIME_STAMP&lt;/p&gt;
        $(system_info)
        $(show_uptime)
        $(drive_space)
        $(home_space)
        &lt;/body&gt;
    &lt;/html&gt;
_EOF_

}

usage()
{
    <tt class="user">echo</tt> "usage: sysinfo_page [[[-f file ] [-i]] | [-h]]"
}


##### Main

interactive=
filename=~/sysinfo_page.html

<tt class="user">while</tt> <tt class="user">[</tt> "$1" != "" <tt class="user">];</tt> <tt class="user">do</tt>
    <tt class="user">case</tt> $1 in
        -f | --file )           <tt class="user">shift</tt>
                                filename=$1
                                ;;
        -i | --interactive )    interactive=1
                                ;;
        -h | --help )           usage
                                <tt class="user">exit</tt>
                                ;;
        * )                     usage
                                <tt class="user">exit</tt> 1
    <tt class="user">esac</tt>
    <tt class="user">shift</tt>
<tt class="user">done</tt>


# Test code to verify command line processing

<tt class="user">if</tt> <tt class="user">[</tt> "$interactive" = "1" <tt class="user">];</tt> <tt class="user">then</tt>
	<tt class="user">echo</tt> "interactive is on"
<tt class="user">else</tt>
	<tt class="user">echo</tt> "interactive is off"
<tt class="user">fi</tt>
<tt class="user">echo</tt> "output file = $filename"


# Write page (comment out until testing is complete)

# write_page &gt; $filename
</tt>
</pre>
</div>

<h2>Adding Interactive Mode</h2>

<p>
The interactive mode is implemented with the
following code:
</p>

<div class="codeexample">
<pre><tt><tt class="user">if</tt> <tt class="user">[</tt> "$interactive" = "1" <tt class="user">];</tt> <tt class="user">then</tt>

    response=

    <tt class="user">echo</tt> -n "Enter name of output file [$filename] &gt; "
    <tt class="user">read</tt> response
    <tt class="user">if</tt> <tt class="user">[</tt> -n "$response" <tt class="user">];</tt> <tt class="user">then</tt>
        filename=$response
    <tt class="user">fi</tt>

    <tt class="user">if</tt> <tt class="user">[</tt> -f $filename <tt class="user">];</tt> <tt class="user">then</tt>
        <tt class="user">echo</tt> -n "Output file exists. Overwrite? (y/n) &gt; "
        <tt class="user">read</tt> response
        <tt class="user">if</tt> <tt class="user">[</tt> "$response" != "y" <tt class="user">];</tt> <tt class="user">then</tt>
            <tt class="user">echo</tt> "Exiting program."
            <tt class="user">exit</tt> 1
        <tt class="user">fi</tt>
    <tt class="user">fi</tt>
<tt class="user">fi</tt>
</tt>
</pre>
</div>

<p>
First, we check if the interactive mode is on,
otherwise we don't have anything to do. Next, we
ask the user for the file name. Notice the way
the prompt is worded:
</p>

<div class="codeexample">
<pre><tt><tt class="user">echo</tt> -n "Enter name of output file [$filename] &gt; "
</tt>
</pre>
</div>

<p>
We display the current value of <tt>filename</tt>
since, the way this routine is coded, if the user
just presses the enter key, the default value of
<tt>filename</tt> will be used. This is
accomplished in the next two lines where the
value of <tt>response</tt> is checked. If
<tt>response</tt> is not empty, then
<tt>filename</tt> is assigned the value of
<tt>response</tt>. Otherwise, <tt>filename</tt> is
left unchanged, preserving its default value.
</p>
<p>
After we have the name of the output file, we
check if it already exists. If it does, we prompt
the user. If the user response is not "y," we
give up and exit, otherwise we can proceed.
</p>



		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0110.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0130.php">Next</a></p>
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