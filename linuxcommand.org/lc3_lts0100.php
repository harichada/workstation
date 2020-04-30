



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Learning the shell - Lesson 10: Job Control</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_lts0090.php">
		<link rel="next" href="lc3_writing_shell_scripts.php">
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
			href="lc3_lts0090.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="lc3_writing_shell_scripts.php">Next</a></p>
		</div>
<h1>Job Control</h1>

<p>In the previous lesson, we looked at some of the
implications of Linux being a multi-user operating
system. In this lesson, we will examine the
multitasking nature of Linux, and how this is
manipulated with the command line interface.</p>

<p>As with any multitasking operating system, Linux
executes multiple, simultaneous processes. Well,
they appear simultaneous, anyway. Actually, a single
processor computer can only execute one process at
a time but the Linux kernel manages to give each
process its turn at the processor and each appears
to be running at the same time.</p>

<p>There are several commands that can be used to
control processes. They are:</p>

<ul>
	<li><tt class="user"><a href=
	"lc3_man_pages/ps1.html">ps</a></tt> - list the
	processes running on the system</li>

	<li><tt class="user"><a href=
	"lc3_man_pages/kill1.html">kill</a></tt> - send a
	signal to one or more processes (usually to
	"kill" a process)</li>

	<li><tt class="user"><a href=
	"lc3_man_pages/jobs1.html">jobs</a></tt> - an
	alternate way of listing your own processes</li>

	<li><tt class="user"><a href=
	"lc3_man_pages/bg1.html">bg</a></tt> - put a process
	in the background</li>

	<li><tt class="user"><a href=
	"lc3_man_pages/fg1.html">fg</a></tt> - put a process
	in the forground</li>
</ul>

<h2>A Practical Example</h2>

<p>While it may seem that this subject is rather
obscure, it can be very practical for the average
user who mostly works with the graphical user
interface. You might not know this, but most (if not
all) of the graphical programs can be launched from
the command line. Here's an example: there is a
small program supplied with the X Window system
called <tt class="user">xload</tt> which displays a
graph representing system load. You can excute this
program by typing the following:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">xload</tt></p>
</div>

<p>Notice that the small <tt class=
"user">xload</tt> window appears and begins to
display the system load graph. Notice also that
your prompt did not reappear after the program
launched. The shell is waiting for the program to
finish before control returns to you. If you close
the <tt class="user">xload</tt> window, the <tt
class="user">xload</tt> program terminates and the
prompt returns.</p>

<h2>Putting a Program into the Background</h2>

<p>Now, in order to make life a little easier, we
are going to launch the <tt class="user">xload</tt>
program again, but this time we will put it in the
background so that the prompt will return. To do
this, we execute xload like this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">xload &amp;</tt><br>
<tt class="prompt">[1] 1223</tt></p>

<p><tt class="prompt">[me@linuxbox me]$</tt></p>
</div>
<p>In this case, the prompt returned because the
process was put in the background.</p>

<p>Now imagine that you forgot to use the "&amp;"
symbol to put the program into the background.
There is still hope. You can type Ctrl-z and the
process will be suspended. The process still exists,
but is idle. To resume the process in the
background, type the <tt class="user">bg</tt>
command (short for background). Here is an
example:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">xload</tt><br>
<tt class="prompt">[2]+ Stopped xload</tt><br>
</p>

<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">bg</tt><br>
<tt class="prompt">[2]+ xload &amp;</tt></p>
</div>

<h2>Listing Your Processes</h2>

<p>Now that we have a process in the background, it
would be helpful to display a list of the processes
we have launched. To do this, we can use either the
<tt class="user">jobs</tt> command or the more
powerful <tt class="user">ps</tt> command.</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">jobs</tt><br>
<tt class="prompt">[1]+ Running xload
&amp;</tt><br>
</p>

<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">ps</tt><br>
<tt class="prompt">PID TTY TIME CMD</tt><br>
<tt class="prompt">1211 pts/4 00:00:00
bash</tt><br>
<tt class="prompt">1246 pts/4 00:00:00
xload</tt><br>
<tt class="prompt">1247 pts/4 00:00:00 ps</tt><br>
</p>

<p><tt class="prompt">[me@linuxbox me]$</tt></p>
</div>

<h2>Killing a Process</h2>

<p>Suppose that you have a program that becomes
unresponsive;
how do you get rid of it? You use the <tt class=
"user">kill</tt> command, of course. Let's try this
out on xload. First, you need to identify the
process you want to kill. You can use either <tt
class="user">jobs</tt> or <tt class="user">ps</tt>,
to do this. If you use <tt class="user">jobs</tt>
you will get back a job number. With <tt class=
"user">ps</tt>, you are given a process id (PID).
We will do it both ways:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">xload &amp;</tt><br>
<tt class="prompt">[1] 1292</tt><br>
</p>

<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">jobs</tt><br>
<tt class="prompt">[1]+ Running xload
&amp;</tt><br>
</p>

<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">kill %1</tt><br>
</p>

<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">xload &amp;</tt><br>
<tt class="prompt">[2] 1293</tt><br>
<tt class="prompt">[1] Terminated xload</tt><br>
</p>

<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">ps</tt><br>
<tt class="prompt">PID TTY TIME CMD</tt><br>
<tt class="prompt">1280 pts/5 00:00:00
bash</tt><br>
<tt class="prompt">1293 pts/5 00:00:00
xload</tt><br>
<tt class="prompt">1294 pts/5 00:00:00 ps</tt><br>
</p>

<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">kill 1293</tt><br>
<tt class="prompt">[2]+ Terminated xload</tt><br>
</p>

<p><tt class="prompt">[me@linuxbox me]$</tt></p>
</div>

<h2>A Little More About kill</h2>

<p>While the <tt class="user">kill</tt> command is
used to "kill" processes, its real purpose is to
send <i>signals</i> to processes. Most of the time
the signal is intended to tell the process to go
away, but there is more to it than that. Programs
(if they are properly written) listen for signals
from the operating system and respond to them, most
often to allow some graceful method of terminating.
For example, a text editor might listen for any
signal that indicates that the user is logging off,
or that the computer is shutting down. When it
receives this signal, it saves the work in progress
before it exits. The <tt class="user">kill</tt>
command can send a variety of signals to processes.
Typing:</p>

<pre>
    kill -l
</pre>

<p>will give you a list of the signals it supports.
Most are rather obscure, but several are useful to
know:<br>
<br>
</p>

<table cellpadding="8" border>
	<tr>
		<td valign="top">
		<p><strong>Signal&nbsp;#</strong></p>
		</td>

		<td valign="top">
		<p><strong>Name</strong></p>
		</td>

		<td valign="top">
		<p><strong>Description</strong></p>
		</td>
	</tr>

	<tr>
		<td><strong>1</strong></td>

		<td><strong>SIGHUP</strong></td>

		<td>
		<p>Hang up signal. Programs can listen for
		this signal and act upon it. This signal is sent
		to processes running in a terminal when you close
		the terminal.</p>
		</td>
	</tr>

	<tr>
		<td><strong>2</strong></td>

		<td><strong>SIGINT</strong></td>

		<td>
		<p>Interrupt signal. This signal is given
		to processes to interrupt them.
		Programs can process this signal and act upon
		it. You can also issue this signal directly
		by typing Ctrl-c in the terminal window
		where the program is running.</p>
		</td>
	</tr>

	<tr>
		<td><strong>15</strong></td>

		<td><strong>SIGTERM</strong></td>

		<td>
		<p>Termination signal. This signal is given
		to processes to terminate them. Again,
		programs can process this signal and act upon
		it. This is the default signal sent by the <tt class=
		"user">kill</tt> command if no signal is
		specified.</p>
		</td>
	</tr>

	<tr>
		<td><strong>9</strong></td>

		<td><strong>SIGKILL</strong></td>

		<td>
		<p>Kill signal. This signal causes the
		immediate termination of the process by the
		Linux kernel. Programs cannot listen for this
		signal.</p>
		</td>
	</tr>
</table>

<p>Now let's suppose that you have a program that
is hopelessly hung and you want
to get rid of it. Here's what you do:</p>

<ol>
	<li>Use the <tt class="user">ps</tt> command to
	get the process id (PID) of the process you want
	to terminate.</li>

	<li>Issue a <tt class="user">kill</tt> command
	for that PID.</li>

	<li>If the process refuses to terminate (i.e., it
	is ignoring the signal), send increasingly harsh
	signals until it does terminate.</li>
</ol>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">ps x | grep bad_program</tt><br>
<tt class="prompt">PID TTY STAT TIME
COMMAND</tt><br>
<tt class="prompt">2931 pts/5 SN 0:00
bad_program</tt><br>
</p>

<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">kill -SIGTERM 2931</tt><br>
</p>

<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">kill -SIGKILL 2931</tt><br>
</p>
</div>

<p>In the example above I used the <tt class=
"user">ps</tt> command with the x option to list all
of my processes (even those not launched from the
current terminal). In addition, I piped the output of the
<tt class="user">ps</tt> command into <tt class="user">grep</tt>
to list only list the program I was interested in.
Next, I used <tt class="user">kill</tt> to issue a SIGTERM
signal to the troublesome program. In
actual practice, it is more common to do it in the
following way since the default signal sent by <tt
class="user">kill</tt> is SIGTERM and <tt class=
"user">kill</tt> can also use the signal number
instead of the signal name:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">kill 2931</tt></p>
</div>

<p>Then, if the process does not terminate, force
it with the SIGKILL signal:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">kill -9 2931</tt></p>
</div>

<h2>That's It!</h2>

<p>This concludes the "Learning the shell" series
of lessons. In the next series, "Writing shell
scripts," we will look at how to automate tasks
with the shell.</p>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_lts0090.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_writing_shell_scripts.php">Next</a></p>
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