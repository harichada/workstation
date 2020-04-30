



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 14: Errors and Signals and Traps (Oh My!) - Part 1</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0130.php">
		<link rel="next" href="lc3_wss0150.php">
		<link rel="contents" href="lc3_writing_shell_scripts.php#contents">
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
		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0130.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0150.php">Next</a></p>
		</div>


<h1>Errors and Signals and Traps (Oh My!) - Part 1</h1>

<p>In this lesson, we're going to look at handling errors during the
execution of your scripts.</p>

<p>The difference between a good program and a poor one is often measured
in terms of the program's <i>robustness</i>.  That is, the program's
ability to handle situations in which something goes wrong. </p>

<h2>Exit Status</h2>

<p>As you recall from previous lessons, every well-written program returns
an exit status when it finishes.  If a program finishes successfully, the
exit status will be zero.  If the exit status is anything other than zero,
then the program failed in some way.</p>

<p>It is very important to check the exit status of programs you call in
your scripts.  It is also important that your scripts return a meaningful
exit status when they finish.  I once had a Unix system administrator who
wrote a script for a production system containing the following 2 lines of
code:</p>

<div class="codeexample">
<pre><tt># Example of a really bad idea

cd $some_directory
rm *</tt></pre></div>

<p>Why is this such a bad way of doing it?  It's not, if nothing goes
wrong.  The two lines change the working directory to the name contained
in <tt>$some_directory</tt> and delete the files in that directory. 
That's the intended behavior.  But what happens if the directory named in
<tt>$some_directory</tt> doesn't exist?  In that case, the <tt>cd</tt>
command will fail and the script executes the <tt>rm</tt> command on the
current working directory.  Not the intended behavior!</p>

<p>By the way, my hapless system administrator's script suffered this very
failure and it destroyed a large portion of an important production
system.  Don't let this happen to you!</p>

<p>The problem with the script was that it did not check the exit
status of the <tt>cd</tt> command before proceeding with the
<tt>rm</tt> command.</p>

<h2>Checking the Exit Status</h2>

<p>There are several ways you can get and respond to the exit status of a
program.  First, you can examine the contents of the <tt>$?</tt>
environment variable.  <tt>$?</tt> will contain the exit status of the
last command executed.  You can see this work with the following:</p>

<div class="display"><pre>
<tt class="prompt">[me] $</tt><tt class="cmd"> true; echo $?</tt>
<tt class="prompt">0
[me] $</tt> <tt class="cmd">false; echo $?</tt>
<tt class="prompt">1</tt></pre>
</div>

<p>The <tt>true</tt> and <tt>false</tt> commands are programs that do
nothing except return an exit status of zero and one, respectively.  Using
them, we can see how the <tt>$?</tt> environment variable contains the exit
status of the previous program.</p>

<p>So to check the exit status, we could write the script this way:</p>

<div class="codeexample">
<pre><tt># Check the exit status

<tt class="user">cd</tt> $some_directory
<tt class="user">if</tt> <tt class="user">[</tt> "$?" = "0" <tt class="user">];</tt> <tt class="user">then</tt>
	rm *
<tt class="user">else</tt>
	<tt class="user">echo</tt> "Cannot change directory!" 1&gt;&2
	<tt class="user">exit</tt> 1
<tt class="user">fi</tt>
</tt></pre></div>

<p>In this version, we examine the exit status of the <tt>cd</tt> command
and if it's not zero, we print an error message on standard error and
terminate the script with an exit status of 1.</p>

<p>While this is a working solution to the problem, there are more clever
methods that will save us some typing.  The next approach we can try is to
use the <tt>if</tt> statement directly, since it evaluates the exit status
of commands it is given.</p>

<p>Using <tt>if</tt>, we could write it this way:</p>

<div class="codeexample">
<pre><tt># A better way

<tt class="user">if</tt> <tt class="user">cd</tt> $some_directory; <tt class="user">then</tt>
	rm *
<tt class="user">else</tt>
	<tt class="user">echo</tt> "Could not change directory! Aborting." 1&gt;&2
	<tt class="user">exit</tt> 1
<tt class="user">fi</tt>
</tt></pre></div>

<p>Here we check to see if the <tt>cd</tt> command is successful.  Only
then does <tt>rm</tt> get executed; otherwise an error message is output
and the program exits with a code of 1, indicating that an error has
occurred.</p>

<h2>An Error Exit Function</h2>

<p>Since we will be checking for errors often in our programs, it makes
sense to write a function that will display error messages.  This will
save more typing and promote laziness.</p>

<div class="codeexample">
<pre><tt># An error exit function

error_exit()
{
	<tt class="user">echo</tt> "$1" 1&gt;&2
	<tt class="user">exit</tt> 1
}

# Using error_exit

<tt class="user">if</tt> <tt class="user">cd</tt> $some_directory; <tt class="user">then</tt>
	rm *
<tt class="user">else</tt>
	error_exit "Cannot change directory!  Aborting."
<tt class="user">fi</tt>
</tt></pre></div>

<h2>AND and OR Lists</h2>

<p>Finally, we can further simplify our script by using the AND and OR
control operators.  To explain how they work, I will quote from the <tt
class="user"><a href="man_pages/bash1.html">bash</a></tt> man page:</p>

<p>"The  control operators && and || denote AND lists and OR lists,
respectively.  An AND list has the form</p>

<div class="codeexample">
<tt>command1 && command2</tt>
</div>

<p><tt>command2</tt> is executed if, <i>and only if</i>, <tt>command1</tt>
returns an exit status of zero.</p>

<p>An OR list has the form</p>

<div class="codeexample">
<tt>command1 || command2</tt>
</div>

<p><tt>command2</tt> is executed if, and only if, <tt>command1</tt>
returns a non-zero exit status.   The  exit status of AND and OR lists
is the exit status of the last command executed in the list."</p>

<p>Again, we can use the <tt>true</tt> and <tt>false</tt> commands to see
this work:</p>

<div class="display">
<pre><tt><tt class="prompt">[me] $</tt> <tt class="cmd">true || echo "echo executed"</tt>
<tt class="prompt">[me] $</tt> <tt class="cmd">false || echo "echo executed"</tt>
<tt class="prompt">echo executed</tt>
<tt class="prompt">[me] $</tt> <tt class="cmd">true && echo "echo executed"</tt>
<tt class="prompt">echo executed</tt>
<tt class="prompt">[me] $</tt> <tt class="cmd">false && echo "echo executed"</tt>
<tt class="prompt">[me] $</tt></tt></pre>
</div>

<p>Using this technique, we can write an even simpler version:</p>

<div class="codeexample">
<pre><tt># Simplest of all

<tt class="user">cd</tt> $some_directory || error_exit "Cannot change directory! Aborting"
rm *
</tt></pre></div>

<p>If an exit is not required in case of error, then you can even do this:</p>

<div class="codeexample">
<pre><tt># Another way to do it if exiting is not desired

<tt class="user">cd</tt> $some_directory && rm *
</tt></pre></div>

<p>I want to point out that even with the defense against errors we have
introduced in our example for the use of <tt>cd</tt>, this code is still vulnerable
to a common programming error, namely, what happens if the name of the variable
containing the name of the directory is misspelled?  In that case, the shell
will interpret the variable as empty and the <tt>cd</tt> succeed, but it will
change directories to the user's home directory, so beware!</p>

<h2>Improving the Error Exit Function</h2>

<p>There are a number of improvements that we can make to the
<tt>error_exit</tt> function.  I like to include the name of the program
in the error message to make clear where the error is coming from.  This
becomes more important as your programs get more complex and you start
having scripts launching other scripts, etc.  Also, note the inclusion of
the <tt>LINENO</tt> environment variable which will help you identify the
exact line within your script where the error occurred.</p>

<div class="codeexample">
<pre><tt>#!/bin/bash

# A slicker error handling routine

# I put a variable in my scripts named PROGNAME which
# holds the name of the program being run.  You can get this
# value from the first item on the command line ($0).

PROGNAME=$(basename $0)

error_exit()
{

#	----------------------------------------------------------------
#	Function for exit due to fatal program error
#		Accepts 1 argument:
#			string containing descriptive error message
#	----------------------------------------------------------------


	<tt class="user">echo</tt> "${PROGNAME}: ${1:-"Unknown Error"}" 1&gt;&2
	<tt class="user">exit</tt> 1
}

# Example call of the error_exit function.  Note the inclusion
# of the LINENO environment variable.  It contains the current
# line number.

<tt class="user">echo</tt> "Example of error with line number and message"
error_exit "$LINENO: An error has occurred."
</tt></pre></div>

<p>The use of the curly braces within the <tt>error_exit</tt> function is an example
of <i>parameter expansion</i>.  You can surround a variable name with curly braces
(as with <tt>${PROGNAME}</tt>) if you need to be sure it is separated from surrounding
text.  Some people just put them around every variable out of habit.  That usage is
simply a style thing.  The second use,
<tt>${1:-"Unknown Error"}</tt> means that if parameter 1 (<tt>$1</tt>) is undefined,
substitute the string "Unknown Error" in its place.  Using parameter expansion, it is
possible to perform a number of useful string manipulations.  You can read more about
parameter expansion in the <tt class="user"><a href="lc3_man_pages/bash1.html">bash</a></tt> man page
under the topic "EXPANSIONS".</p>
 

		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0130.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0150.php">Next</a></p>
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