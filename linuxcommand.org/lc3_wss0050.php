



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 5: Command Substitution and Constants</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0040.php">
		<link rel="next" href="lc3_wss0060.php">
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
			href="lc3_wss0040.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0060.php">Next</a></p>
		</div>
<h1>Command Substitution and Constants</h1>

<p>In the previous lesson, we learned how to create
variables and perform expansions with them. In
this lesson, we will extend this idea to show how we
can substitute the results from a command.</p>

<p>When we last left our script, it could create an
HTML page that contained a few simple lines of text,
including the host name of the machine which we
obtained from the environment variable HOSTNAME.
Now, we will add a time stamp to the page to
indicate when it was last updated, along with the
user that did it.</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

# sysinfo_page - A script to produce an HTML file

title="System Information for"

cat &lt;&lt;- _EOF_
    &lt;html&gt;
    &lt;head&gt;
        &lt;title&gt;
        $title $HOSTNAME
        &lt;/title&gt;
    &lt;/head&gt;

    &lt;body&gt;
    &lt;h1&gt;$title $HOSTNAME&lt;/h1&gt;
    &lt;p&gt;Updated on $(date +"%x %r %Z") by $USER&lt;/p&gt;
    &lt;/body&gt;
    &lt;/html&gt;
_EOF_
       </tt>
</pre>
</div>

<p>As you can see, we employed another environment
variable, <tt>USER</tt>, to get the user name. In
addition, we used this strange looking thing:</p>

<p><tt>$(date +"%x %r %Z")</tt></p>

<p>The characters "$( )" tell the shell,
"substitute the results of the enclosed command."
In our script, we want the shell to insert the
results of the command <tt>date +"%x %r %Z"</tt>
which expresses the current date and time. The <tt
class="user"><a href=
"lc3_man_pages/date1.html">date</a></tt> command has
many features and formatting options. To look at
them all, try this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">date --help | less</tt></p>
</div>

<p>Be aware that there is an older, alternate
syntax for "$(command)" that uses the backtick
character " ` ". This older form is compatible with
the original Bourne shell (sh). I tend not to use
the older form since I am teaching modern <tt>bash</tt> here, not
<tt>sh</tt>, and besides, I think backticks are ugly. The
bash shell fully supports scripts written for sh,
so the following forms are equivalent:</p>

<p><tt>$(command)<br>
`command`</tt></p>

<h2>Assigning a Command's Result to a Variable</h2>

<p>You can also assign the results of a command to
a variable:</p>

<p><tt>right_now=$(date +"%x %r %Z")</tt></p>

<p>You can even nest the variables (place one
inside another), like this:</p>

<p><tt>right_now=$(date +"%x %r %Z")<br>
time_stamp="Updated on $right_now by
$USER"</tt></p>

<h2>Constants</h2>

<p>As the name variable suggests, the content of a
variable is subject to change. This means that it
is expected that during the execution of your
script, a variable may have its content modified by
something you do.</p>

<p>On the other hand, there may be values that,
once set, should never be changed. These are called
<i>constants</i>. I bring this up because it is a
common idea in programming. Most programming
languages have special facilities to support values
that are not allowed to change. Bash also has these
facilities but, to be honest, I never see it used.
Instead, if a value is intended to be a constant,
it is given an uppercase name to remind the programmer
that it should be considered a constant even if it's
not being enforced.</p> 

<p>Environment
variables are usually considered constants since
they are rarely changed. Like constants,
environment variables are given uppercase names by
convention. In the scripts that follow, I will
use this convention - uppercase names for
constants and lowercase names for variables.</p>

<p>So with everything we know, our program looks
like this:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

# sysinfo_page - A script to produce an HTML file

title="System Information for $HOSTNAME"
RIGHT_NOW=$(date +"%x %r %Z")
TIME_STAMP="Updated on $RIGHT_NOW by $USER"

cat &lt;&lt;- _EOF_
    &lt;html&gt;
    &lt;head&gt;
        &lt;title&gt;
        $title
        &lt;/title&gt;
    &lt;/head&gt;

    &lt;body&gt;
    &lt;h1&gt;$title&lt;/h1&gt;
    &lt;p&gt;$TIME_STAMP&lt;/p&gt;
    &lt;/body&gt;
    &lt;/html&gt;
_EOF_
       </tt>
</pre>
</div>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0040.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0060.php">Next</a></p>
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