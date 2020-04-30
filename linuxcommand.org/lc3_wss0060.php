



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 6: Shell Functions</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0050.php">
		<link rel="next" href="lc3_wss0070.php">
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
			href="lc3_wss0050.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0070.php">Next</a></p>
		</div>
<h1>Shell Functions</h1>

<p>As programs get longer and more complex, they
become more difficult to design, code, and
maintain. As with any large endeavor, it is often
useful to break a single, large task into a series
of smaller tasks.</p>

<p>In this lesson, we will begin to break our
single monolithic script into a number of separate
functions.</p>

<p>To get familiar with this idea, let's consider
the description of an everyday task -- going to the
market to buy food. Imagine that we were going to
describe the task to a man from Mars.</p>

<p>Our first top-level description might look like
this:</p>

<ol>
	<li>Leave house</li>

	<li>Drive to market</li>

	<li>Park car</li>

	<li>Enter market</li>

	<li>Purchase food</li>

	<li>Drive home</li>

	<li>Park car</li>

	<li>Enter house</li>
</ol>

<p>This description covers the overall process of
going to the market; however a man from Mars will
probably require additional detail. For example,
the "Park car" sub task could be described as
follows:</p>

<ol>
	<li>Find parking space</li>

	<li>Drive car into space</li>

	<li>Turn off motor</li>

	<li>Set parking brake</li>

	<li>Exit car</li>

	<li>Lock car</li>
</ol>

<p>Of course the task "Turn off motor" has a number
of steps such as "turn off ignition" and "remove
key from ignition switch," and so on.</p>

<p>This process of identifying the top-level steps
and developing increasingly detailed views of those
steps is called <i>top-down design</i>. This
technique allows you to break large complex tasks
into many small, simple tasks.</p>

<p>As our script continues to grow, we will use top
down design to help us plan and code our
script.</p>

<p>If we look at our script's top-level tasks, we
find the following list:</p>

<ol>
	<li>Open page</li>

	<li>Open head section</li>

	<li>Write title</li>

	<li>Close head section</li>

	<li>Open body section</li>

	<li>Write title</li>

	<li>Write time stamp</li>

	<li>Close body section</li>

	<li>Close page</li>
</ol>

<p>All of these tasks are implemented, but we want
to add more. Let's insert some additional tasks
after task 7:</p>

<ol start="7">
	<li>Write time stamp</li>

	<li>Write system release info</li>

	<li>Write up-time</li>

	<li>Write drive space</li>

	<li>Write home space</li>

	<li>Close body section</li>

	<li>Close page</li>
</ol>

<p>It would be great if there were commands that
performed these additional tasks. If there were, we could
use command substitution to place them in our
script like so:</p>


<div class="codeexample"><pre>
<tt>#!/bin/bash

# sysinfo_page - A script to produce a system information HTML file

##### Constants

TITLE="System Information for $HOSTNAME"
RIGHT_NOW=$(date +"%x %r %Z")
TIME_STAMP="Updated on $RIGHT_NOW by $USER"

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

<p>While there are no commands that do exactly what
we need, we can create them using <i>shell
functions</i>.</p>

<p>As we learned in lesson 2, shell functions act
as "little programs within programs" and allow us
to follow top-down design principles. To add the
shell functions to our script, we change it so:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

# sysinfo_page - A script to produce an system information HTML file

##### Constants

TITLE="System Information for $HOSTNAME"
RIGHT_NOW=$(date +"%x %r %Z")
TIME_STAMP="Updated on $RIGHT_NOW by $USER"

##### Functions

system_info()
{

}


show_uptime()
{

}


drive_space()
{

}


home_space()
{

}

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

<p>A couple of important points about functions:
First, they must appear before you attempt to use
them. Second, the function body (the portions of
the function between the { and } characters) must
contain at least one valid command. As written, the
script will not execute without error, because the
function bodies are empty. The simple way to fix
this is to place a <tt class="user">return</tt>
statement in each function body. After you do this,
our script will execute successfully again.</p>

<h2>Keep Your Scripts Working</h2>

<p>When you are developing a program, it is is
often a good practice to add a small amount of
code, run the script, add some more code, run the
script, and so on. This way, if you introduce a
mistake into your code, it will be easier to find
and correct.</p>

<p>As you add functions to your script, you can
also use a technique called <i>stubbing</i> to help
watch the logic of your script develop. Stubbing
works like this: imagine that we are going to
create a function called "system_info" but we
haven't figured out all of the details of its code
yet. Rather than hold up the development of the
script until we are finished with system_info, we
just add an <tt class="user">echo</tt> command like
this:</p>

<div class="codeexample">
<pre>
<tt>system_info()
{
    # Temporary function stub
    <tt class="user">echo</tt> "function system_info"
}
       </tt>
</pre>
</div>

<p>This way, our script will still execute
successfully, even though we do not yet have a
finished system_info function. We will later
replace the temporary stubbing code with the
complete working version.</p>

<p>The reason we use an <tt class="user">echo</tt> command is so we get
some feedback from the script to indicate that the
functions are being executed.</p>

<p>Let's go ahead and write stubs for our new
functions and keep the script working.</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

# sysinfo_page - A script to produce an system information HTML file

##### Constants

TITLE="System Information for $HOSTNAME"
RIGHT_NOW=$(date +"%x %r %Z")
TIME_STAMP="Updated on $RIGHT_NOW by $USER"

##### Functions

system_info()
{
    # Temporary function stub
    <tt class="user">echo</tt> "function system_info"
}


show_uptime()
{
    # Temporary function stub
    <tt class="user">echo</tt> "function show_uptime"
}


drive_space()
{
    # Temporary function stub
    <tt class="user">echo</tt> "function drive_space"
}


home_space()
{
    # Temporary function stub
    <tt class="user">echo</tt> "function home_space"
}


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


		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0050.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0070.php">Next</a></p>
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