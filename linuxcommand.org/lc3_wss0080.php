



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 8: Flow Control - Part 1</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0070.php">
		<link rel="next" href="lc3_wss0090.php">
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
			href="lc3_wss0070.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0090.php">Next</a></p>
		</div>
<h1>Flow Control - Part 1</h1>

<p>In this lesson, we will look at how to add
intelligence to our scripts. So far, our project script
has only consisted of a sequence of commands that
starts at the first line and continues line by line
until it reaches the end. Most programs do much more
than this. They make decisions and perform
different actions depending on
conditions.</p>

<p>The shell provides several commands that we can
use to control the flow of execution in our
program. In this lesson, we will look at the following:</p>

<ul>
	<li><tt class="user"><a href="lc3_man_pages/ifh.html">if</a></tt></li>

	<li><tt class="user"><a href="lc3_man_pages/testh.html">test</a></tt></li>

	<li><tt class="user"><a href="lc3_man_pages/exith.html">exit</a></tt></li>
</ul>

<h2>if</h2>

<p>The first command we will look at is <tt class=
"user">if</tt>. The <tt class="user">if</tt>
command is fairly simple on the surface; it makes a
decision based on the <i>exit status</i> of a command. The <tt class=
"user">if</tt> command's syntax looks like this:</p>

<p>The if statement has the following syntax:</p>

<pre><tt>if commands; then
commands
[elif commands; then
commands...]
[else
commands]
fi</tt></pre>

<p>where <i>commands</i> is a list of commands. This is a little confusing at first glance. But
before we can clear this up, we have to look at how the shell evaluates the success or
failure of a command.</p>

<h2>Exit Status</h2>

<p>Commands (including the scripts and shell functions we write) issue a value to the system
when they terminate, called an exit status. This value, which is an integer in the range of
0 to 255, indicates the success or failure of the command’s execution. By convention, a
value of zero indicates success and any other value indicates failure. The shell provides a
parameter that we can use to examine the exit status. Here we see it in action:</p>

<div class="display">
<tt class="prompt">[me@linuxbox ~]$</tt> <tt class="cmd">ls -d /usr/bin</tt><br>
<tt class="prompt">/usr/bin<br>
[me@linuxbox ~]$</tt> <tt class="cmd">echo $?</tt><br>
<tt class="prompt">0<br>
[me@linuxbox ~]$</tt> <tt class="cmd">ls -d /bin/usr</tt><br>
<tt class="prompt">ls: cannot access /bin/usr: No such file or directory<br>
[me@linuxbox ~]$</tt> <tt class="cmd">echo $?</tt><br>
<tt class="prompt">2</tt>
</div>

<p>In this example, we execute the <tt class="user">ls</tt> command twice. The first time, the command
executes successfully. If we display the value of the parameter <tt class="user">$?</tt>, we see that it is zero.
We execute the ls command a second time, producing an error and examine the
parameter <tt class="user">$?</tt> again. This time it contains a 2, indicating that the command encountered
an error. Some commands use different exit status values to provide diagnostics for
errors, while many commands simply exit with a value of one when they fail. Man pages
often include a section entitled “Exit Status,” describing what codes are used. However,
a zero always indicates success.</p>

<p>The shell provides two extremely simple builtin commands that do nothing except
terminate with either a zero or one exit status. The <tt class="user">true</tt> command always executes
successfully and the <tt class="user">false</tt> command always executes unsuccessfully:</p>

<div class="display">
<tt class="prompt">[me@linuxbox~]$</tt> <tt class="cmd">true</tt><br>
<tt class="prompt">[me@linuxbox~]$</tt> <tt class="cmd">echo $?</tt><br>
<tt class="prompt">0<br>
[me@linuxbox~]$</tt> <tt class="cmd">false</tt><br>
<tt class="prompt">[me@linuxbox~]$</tt> <tt class="cmd">echo $?</tt><br>
<tt class="prompt">1</tt><br>
</div>

<p>We can use these commands to see how the <tt class="user">if</tt> statement works. What the <tt class="user">if</tt> statement
really does is evaluate the success or failure of commands:</p>

<div class="display">
<tt class="prompt">[me@linuxbox ~]$</tt> <tt class="cmd">if true; then echo "It's true."; fi</tt><br>
<tt class="prompt">It's true.<br>
[me@linuxbox ~]$</tt> <tt class="cmd">if false; then echo "It's true."; fi</tt><br>
<tt class="prompt">[me@linuxbox ~]$</tt><br>
</div>

<p>The command <tt>echo "It's true."</tt> is executed when the command following <tt class="user">if</tt>
executes successfully, and is not executed when the command following <tt class="user">if</tt> does not
execute successfully.

<h2>test</h2>

<p>The <tt class="user">test</tt> command is used
most often with the <tt class="user">if</tt>
command to perform true/false decisions. The
command is unusual in that it has two different
syntactic forms:</p>


<div class="codeexample"><pre>
<tt># First form

<tt class="user">test</tt> <i>expression</i>

# Second form

<tt class="user">[</tt> <i>expression</i> <tt class="user">]</tt>
       </tt>
</pre>
</div>

<p>The <tt class="user">test</tt> command works
simply. If the given expression is true, <tt class=
"user">test</tt> exits with a status of zero;
otherwise it exits with a status of 1.</p>

<p>The neat feature of <tt class="user">test</tt>
is the variety of expressions you can create. Here
is an example:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">if</tt> <tt class=
"user">[</tt> -f .bash_profile <tt class="user">];</tt> <tt class=
"user">then</tt>
    <tt class=
"user">echo</tt> "You have a .bash_profile. Things are fine."
<tt class="user">else</tt>
    <tt class="user">echo</tt> "Yikes! You have no .bash_profile!"
<tt class="user">fi</tt>
       </tt>
</pre>
</div>

<p>In this example, we use the expression " <tt
class="user">-f .bash_profile</tt> ". This
expression asks, "Is .bash_profile a file?" If the
expression is true, then <tt class="user">test</tt>
exits with a zero (indicating true) and the <tt
class="user">if</tt> command executes the
command(s) following the word <tt class=
"user">then</tt>. If the expression is false, then
<tt class="user">test</tt> exits with a status of
one and the <tt class="user">if</tt> command
executes the command(s) following the word <tt
class="user">else</tt>.</p>

<p>Here is a partial list of the conditions that
<tt class="user">test</tt> can evaluate. Since <tt
class="user">test</tt> is a shell builtin, use "<tt
class="user">help test</tt>" to see a complete
list.<br>
<br>
</p>

<table cellpadding="8" border>
	<tr>
		<td valign="top">
		<p><strong>Expression</strong></p>
		</td>

		<td valign="top">
		<p><strong>Description</strong></p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>-d <i>file</i></p>
		</td>

		<td valign="top">
		<p>True if <i>file</i> is a directory.</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>-e <i>file</i></p>
		</td>

		<td valign="top">
		<p>True if <i>file</i> exists.</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>-f <i>file</i></p>
		</td>

		<td valign="top">
		<p>True if <i>file</i> exists and is a
		regular file.</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>-L <i>file</i></p>
		</td>

		<td valign="top">
		<p>True if <i>file</i> is a symbolic
		link.</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>-r <i>file</i></p>
		</td>

		<td valign="top">
		<p>True if <i>file</i> is a file readable by
		you.</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>-w <i>file</i></p>
		</td>

		<td valign="top">
		<p>True if <i>file</i> is a file writable by
		you.</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>-x <i>file</i></p>
		</td>

		<td valign="top">
		<p>True if <i>file</i> is a file executable
		by you.</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p><i>file1</i> -nt <i>file2</i></p>
		</td>

		<td valign="top">
		<p>True if <i>file1</i> is newer than
		(according to modification time)
		<i>file2</i></p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p><i>file1</i> -ot <i>file2</i></p>
		</td>

		<td valign="top">
		<p>True if <i>file1</i> is older than
		<i>file2</i></p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>-z <i>string</i></p>
		</td>

		<td valign="top">
		<p>True if <i>string</i> is empty.</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>-n <i>string</i></p>
		</td>

		<td valign="top">
		<p>True if <i>string</i> is not empty.</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>
		<i>string1</i>&nbsp;=&nbsp;<i>string2</i></p>
		</td>

		<td valign="top">
		<p>True if <i>string1</i> equals
		<i>string2.</i></p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>
		<i>string1</i>&nbsp;!=&nbsp;<i>string2</i></p>
		</td>

		<td valign="top">
		<p>True if <i>string1</i> does not equal
		<i>string2.</i></p>
		</td>
	</tr>
</table>

<p>Before we go on, I want to explain the rest of
the example above, since it also reveals more
important ideas.</p>

<p>In the first line of the script, we see the <tt
class="user">if</tt> command followed by the <tt
class="user">test</tt> command, followed by a
semicolon, and finally the word <tt class=
"user">then</tt>. I chose to use the <tt class=
"user">[ <i>expression</i> ]</tt> form of the <tt
class="user">test</tt> command since most people
think it's easier to read. Notice that the spaces required
between the "<tt class="user">[</tt>" and the
beginning of the expression are required. Likewise,
the space between the end of the expression and the
trailing "<tt class="user">]</tt>".</p>

<p>The semicolon is a command separator. Using it
allows you to put more than one command on a line.
For example:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">clear; ls</tt></p>
</div>

<p>will clear the screen and execute the ls
command.</p>

<p>I use the semicolon as I did to allow me to put
the word <tt class="user">then</tt> on the same
line as the <tt class="user">if</tt> command,
because I think it is easier to read that way.</p>

<p>On the second line, there is our old friend <tt
class="user">echo</tt>. The only thing of note on
this line is the indentation. Again for the benefit
of readability, it is traditional to indent all
blocks of conditional code; that is, any code that
will only be executed if certain conditions are
met. The shell does not require this; it is done to
make the code easier to read.</p>

<p>In other words, we could write the following and
get the same results:</p>

<div class="codeexample">
<pre>
<tt># Alternate form

<tt class="user">if</tt> <tt class=
"user">[</tt> -f .bash_profile <tt class="user">]</tt>
<tt class="user">then</tt>
    <tt class=
"user">echo</tt> "You have a .bash_profile. Things are fine."
<tt class="user">else</tt>
    <tt class="user">echo</tt> "Yikes! You have no .bash_profile!"
<tt class="user">fi</tt>

# Another alternate form

<tt class="user">if</tt> <tt class=
"user">[</tt> -f .bash_profile <tt class="user">]</tt>
<tt class="user">then</tt> <tt class=
"user">echo</tt> "You have a .bash_profile. Things are fine."
<tt class="user">else</tt> <tt class=
"user">echo</tt> "Yikes! You have no .bash_profile!"
<tt class="user">fi</tt>
       </tt>
</pre>
</div>

<h2>exit</h2>

<p>In order to be good script writers, we must set
the exit status when our scripts finish. To do
this, use the <tt class="user">exit</tt> command.
The <tt class="user">exit</tt> command causes the
script to terminate immediately and set the exit
status to whatever value is given as an argument.
For example:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">exit</tt> 0
       </tt>
</pre>
</div>

<p>exits your script and sets the exit status to 0
(success), whereas</p>

<div class="codeexample">
<pre>
<tt><tt class="user">exit</tt> 1
       </tt>
</pre>
</div>
<p>exits your script and sets the exit status to 1
(failure).</p>

<h2>Testing for Root</h2>

<p>When we last left our script, we required that
it be run with superuser privileges. This is
because the <tt class="user">home_space</tt> function needs to examine
the size of each user's home directory, and only
the superuser is allowed to do that.</p>

<p>But what happens if a regular user runs our
script? It produces a lot of ugly error messages.
What if we could put something in the script to
stop it if a regular user attempts to run it?</p>

<p>The <tt class="user"><a href=
"lc3_man_pages/id1.html">id</a></tt> command can tell
us who the current user is. When executed with the
"-u" option, it prints the numeric user id of the
current user.</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">id -u</tt><br>
<tt class="prompt">501</tt><br>
<tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">su</tt><br>
<tt class="prompt">Password:</tt><br>
<tt class="prompt">[root@linuxbox me]#</tt> <tt
class="cmd">id -u</tt><br>
<tt class="prompt">0</tt></p>
</div>

<p>If the superuser executes <tt class="user">id
-u</tt>, the command will output "0." This fact can
be the basis of our test:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">if</tt> <tt class=
"user">[</tt> $(id -u) = "0" <tt class="user">];</tt> <tt class=
"user">then</tt>
    <tt class="user">echo</tt> "superuser"
<tt class="user">fi</tt>
       </tt>
</pre>
</div>

<p>In this example, if the output of the command
<tt class="user">id -u</tt> is equal to the string
"0", then print the string "superuser."</p>

<p>While this code will detect if the user is the
superuser, it does not really solve the problem
yet. We want to stop the script if the user is not
the superuser, so we will code it like so:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">if</tt> <tt class=
"user">[</tt> $(id -u) != "0" <tt class="user">];</tt> <tt class=
"user">then</tt>
    <tt class=
"user">echo</tt> "You must be the superuser to run this script" &gt;&amp;2
    <tt class="user">exit</tt> 1
<tt class="user">fi</tt>
       </tt>
</pre>
</div>

<p>With this code, if the output of the <tt class=
"user">id -u</tt> command is not equal to "0", then
the script prints a descriptive error message, exits,
and sets the exit status to 1, indicating to the
operating system that the script executed
unsuccessfully.</p>

<p>Notice the "&gt;&amp;2" at the end of the <tt
class="user">echo</tt> command. This is another
form of I/O direction. You will often notice this
in routines that display error messages. If this
redirection were not done, the error message would
go to standard output. With this redirection, the
message is sent to standard error. Since we are
executing our script and redirecting its standard
output to a file, we want the error messages
separated from the normal output.</p>

<p>We could put this routine near the beginning of
our script so it has a chance to detect a possible
error before things get under way, but in order to
run this script as an ordinary user, we will use
the same idea and modify the <tt>home_space</tt>
function to test for proper privileges instead,
like so:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">function</tt> home_space
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

<p>This way, if an ordinary user runs the script,
the troublesome code will be passed over, rather
than executed and the problem will be solved.</p>



		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0070.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0090.php">Next</a></p>
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