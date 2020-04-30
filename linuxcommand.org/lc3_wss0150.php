



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 15: Errors and Signals and Traps (Oh, My!) - Part 2</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0140.php">
		<link rel="next" href="tlcl.php">
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
			href="lc3_wss0140.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="tlcl.php">Next</a></p>
		</div>
<h1>Errors and Signals and Traps (Oh, My!) - Part 2</h1>

<p>Errors are not the only way that a script can terminate unexpectedly.  You also
have to be concerned with signals.  Consider the following program:</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

<tt class="user">echo</tt> "this script will endlessly loop until you stop it"
<tt class="user">while</tt> true; <tt class="user">do</tt>
	<tt class="user">:</tt> # Do nothing
<tt class="user">done</tt>
</tt></pre></div>

<p>After you launch this script it will appear to hang.  Actually, like most
programs that appear to hang, it is really stuck inside a loop.  In this case, it is
waiting for the <tt>true</tt> command to return a non-zero exit status, which it never
does.  Once started, the script will continue until bash receives a signal that
will stop it.  You can send such a signal by typing Ctrl-c which is the signal
called SIGINT (short for SIGnal INTerrupt).

<h2>Cleaning Up After Yourself</h2>
 
<p>Okay, so a signal can come along and make your script terminate.  Why does it matter? 
Well, in many cases it doesn't matter and you can ignore signals, but in some
cases it will matter.</p>

<p>Let's take a look at another script:</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

# Program to print a text file with headers and footers

TEMP_FILE=/tmp/printfile.txt

pr $1 &gt; $TEMP_FILE

<tt class="user">echo</tt> -n "Print file? [y/n]: "
<tt class="user">read</tt>
<tt class="user">if</tt> <tt class="user">[</tt> "$REPLY" = "y" <tt class="user">];</tt> <tt class="user">then</tt>
	lpr $TEMP_FILE
<tt class="user">fi</tt>
</tt></pre></div>

<p>This script processes a text file specified on the command line with the <tt class="user"><a href="man_pages/pr1.html">pr</a></tt>
command and stores the result in a temporary file.  Next, it asks the user if
they want to print the file.  If the user types "y", then the temporary file is
passed to the <tt class="user"><a href="man_pages/lpr1.html">lpr</a></tt> program for printing (you may substitute <tt>less</tt> for <tt>lpr</tt> if you
don't actually have a printer attached to your system.)</p>

<p>Now, I admit this script has a lot of design problems.  While it needs a file
name passed on the command line, it doesn't check that it got one, and it
doesn't check that the file actually exists.  But the problem I want to focus
on here is the fact that when the script terminates, it leaves behind the
temporary file.</p>

<p>Good practice would dictate that we delete the temporary file <tt>$TEMP_FILE</tt> when
the script terminates.  This is easily accomplished by adding the following to
the end of the script:</p>

<div class="codeexample">
<pre><tt>rm $TEMP_FILE
</tt></pre></div>

<p>This would seem to solve the problem, but what happens if the user types ctrl-c
when the "Print file? [y/n]:" prompt appears?  The script will
terminate at the <tt>read</tt> command and the <tt>rm</tt> command is never executed.  Clearly,
we need a way to respond to signals such as SIGINT when
the Ctrl-c key is typed.</p>

<p>Fortunately, bash provides a method to perform commands if and when signals are
received.</p>

<h2>trap</h2>

<p>The <tt>trap</tt> command allows you to execute a command when a signal is received by
your script.  It works like this:</p>

<div class="codeexample">
<pre><tt><tt class="user">trap</tt> arg signals
</tt></pre></div>

<p>"signals" is a list of signals to intercept and "arg" is a command to execute
when one of the signals is received.  For our printing script, we might handle
the signal problem this way:</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

# Program to print a text file with headers and footers

TEMP_FILE=/tmp/printfile.txt

<tt class="user">trap</tt> "rm $TEMP_FILE; exit" SIGHUP SIGINT SIGTERM

pr $1 &gt; $TEMP_FILE

<tt class="user">echo</tt> -n "Print file? [y/n]: "
<tt class="user">read</tt>
<tt class="user">if</tt> <tt class="user">[</tt> "$REPLY" = "y" <tt class="user">];</tt> <tt class="user">then</tt>
	lpr $TEMP_FILE
<tt class="user">fi</tt>
rm $TEMP_FILE
</tt></pre></div>

<p>Here we have added a <tt>trap</tt> command that will execute "<tt>rm $TEMP_FILE</tt>" if any of
the listed signals is received.  The three signals listed are the most common
ones that you will encounter, but there are many more that can be
specified.  For a complete list, type "<tt>trap -l</tt>".  In addition to listing the
signals by name, you may alternately specify them by number.</p>

<div class="sidebar">
<h2>Signal 9 from Outer Space</h2>

<p>There is one signal that you cannot trap: SIGKILL or signal 9.  The
kernel immediately terminates any process sent this signal and no signal
handling is performed.  Since it will always terminate a program that is stuck,
hung, or otherwise screwed up, it is tempting to think that it's the easy
way out when you have to get something to stop and go away.  Often you will see
references to the following command which sends the SIGKILL signal:</p>

<tt>kill -9</tt>

<p>However, despite its apparent ease, you must remember that when you send this
signal, no processing is done by the application.  Often this is OK, but with
many programs it's not.  In particular, many complex programs (and some
not-so-complex) create <i>lock files</i> to prevent multiple copies of the program
from running at the same time.  When a program that uses a lock file is sent a
SIGKILL, it doesn't get the chance to remove the lock file when it terminates. 
The presence of the lock file will prevent the program from restarting until
the lock file is manually removed.</p>

<p>Be warned.  Use SIGKILL as a last resort.</p>
</div>

<h2>A clean_up Function</h2>

<p>While the trap command has solved the problem, we can see that it has some
limitations.  Most importantly, it will only accept a single string containing
the command to be performed when the signal is received.  You could get clever
and use ";" and put multiple commands in the string to get more complex
behavior, but frankly, it's ugly.  A better way would be to create a function
that is called when you want to perform any actions at the end of your script. 
In my scripts, I call this function <tt>clean_up</tt>.</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

# Program to print a text file with headers and footers

TEMP_FILE=/tmp/printfile.txt

clean_up() {

	# Perform program exit housekeeping
	rm $TEMP_FILE
	<tt class="user">exit</tt>
}

<tt class="user">trap</tt> clean_up SIGHUP SIGINT SIGTERM

pr $1 &gt; $TEMP_FILE

<tt class="user">echo</tt> -n "Print file? [y/n]: "
<tt class="user">read</tt>
<tt class="user">if</tt> <tt class="user">[</tt> "$REPLY" = "y" <tt class="user">];</tt> <tt class="user">then</tt>
	lpr $TEMP_FILE
<tt class="user">fi</tt>
clean_up
</tt></pre></div>

<p>The use of a clean up function is a good idea for your error handling routines
too.  After all, when your program terminates (for whatever reason), you should
clean up after yourself.  Here is finished version of our program with improved
error and signal handling:</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

# Program to print a text file with headers and footers

# Usage: printfile file

# Create a temporary file name that gives preference
# to the user's local tmp directory and has a name
# that is resistant to "temp race attacks"

<tt class="user">if</tt> <tt class="user">[</tt> -d "~/tmp" <tt class="user">];</tt> <tt class="user">then</tt>
	TEMP_DIR=~/tmp
<tt class="user">else</tt>
	TEMP_DIR=/tmp
<tt class="user">fi</tt>
TEMP_FILE=$TEMP_DIR/printfile.$$.$RANDOM
PROGNAME=$(basename $0)

usage() {

	# Display usage message on standard error
	<tt class="user">echo</tt> "Usage: $PROGNAME file" 1&gt;&2
}

clean_up() {

	# Perform program exit housekeeping
	# Optionally accepts an exit status
	rm -f $TEMP_FILE
	<tt class="user">exit</tt> $1
}

error_exit() {

	# Display error message and exit
	<tt class="user">echo</tt> "${PROGNAME}: ${1:-"Unknown Error"}" 1&gt;&2
	clean_up 1
}

<tt class="user">trap</tt> clean_up SIGHUP SIGINT SIGTERM

<tt class="user">if</tt> <tt class="user">[</tt> $# != "1" <tt class="user">];</tt> <tt class="user">then</tt>
	usage
	error_exit "one file to print must be specified"
<tt class="user">fi</tt>
<tt class="user">if</tt> <tt class="user">[</tt> ! -f "$1" <tt class="user">];</tt> <tt class="user">then</tt>
	error_exit "file $1 cannot be read"
<tt class="user">fi</tt>

pr $1 &gt; $TEMP_FILE || error_exit "cannot format file"

<tt class="user">echo</tt> -n "Print file? [y/n]: "
<tt class="user">read</tt>
<tt class="user">if</tt> <tt class="user">[</tt> "$REPLY" = "y" <tt class="user">];</tt> <tt class="user">then</tt>
	lpr $TEMP_FILE || error_exit "cannot print file"
<tt class="user">fi</tt>
clean_up
</tt></pre></div>

<h2>Creating Safe Temporary Files</h2>

<p>In the program above, there a number of steps taken to help secure the
temporary file used by this script.  It is a Unix tradition to use a directory
called <tt>/tmp</tt> to place temporary files used by programs.  Everyone may write
files into this directory.  This naturally leads to some
security concerns.  If possible, avoid writing files in the <tt>/tmp</tt> directory. 
The preferred technique is to write them in a local directory such as <tt>~/tmp</tt> (a
tmp subdirectory in the user's home directory.)  If you must write files in
<tt>/tmp</tt>, you must take steps to make sure the file names are not predictable. 
Predictable file names allow an attacker to create symbolic links to other
files that the attacker wants you to overwrite.</p>

<p>A good file name will help you figure out what wrote the file, but will not be
entirely predictable.  In the script above, the following line of code created
the temporary file <tt>$TEMP_FILE</tt>:</p>

<div class="codeexample">
<pre><tt>TEMP_FILE=$TEMP_DIR/printfile.$$.$RANDOM
</tt></pre></div>

<p>The <tt>$TEMP_DIR</tt> variable contains either <tt>/tmp</tt> or <tt>~/tmp</tt> depending on the
availability of the directory.  It is common practice to embed the name of the
program into the file name. We have done that with the string "printfile". 
Next, we use the <tt>$$</tt> shell variable to embed the process id (pid) of the
program.  This further helps identify what process is responsible for the
file.  Surprisingly, the process id alone is not unpredictable enough to make
the file safe, so we add the <tt>$RANDOM</tt> shell variable to append a random number
to the file name.  With this technique, we create a file name that is both
easily identifiable and unpredictable.</p>

<h2>There You Have It</h2>

<p>This concludes the LinuxCommand.org tutorials. I sincerely hope you found them both useful and
enjoyable. If you did, continue your command line adventure by downloading <a href="tlcl.php">my book</a>.</p>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0140.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="tlcl.php">Next</a></p>
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
