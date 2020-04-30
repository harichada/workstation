



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 4: Variables</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0030.php">
		<link rel="next" href="lc3_wss0050.php">
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
			href="lc3_wss0030.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0050.php">Next</a></p>
		</div>
<h1>Variables</h1>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

# sysinfo_page - A script to produce an HTML file

cat &lt;&lt;- _EOF_
    &lt;html&gt;
    &lt;head&gt;
        &lt;title&gt;
        My System Information
        &lt;/title&gt;
    &lt;/head&gt;

    &lt;body&gt;
    &lt;h1&gt;My System Information&lt;/h1&gt;
    &lt;/body&gt;
    &lt;/html&gt;
_EOF_
       </tt>
</pre>
</div>

<p>Now that we have our script working, let's
improve it. First off, we'll make some changes
because we want to be lazy. In the script above, we
see that the phrase "My System Information" is
repeated. This is wasted typing (and extra work!)
so we improve it like this:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

# sysinfo_page - A script to produce an HTML file

title="My System Information"

cat &lt;&lt;- _EOF_
    &lt;html&gt;
    &lt;head&gt;
        &lt;title&gt;
        $title
        &lt;/title&gt;
    &lt;/head&gt;

    &lt;body&gt;
    &lt;h1&gt;$title&lt;/h1&gt;
    &lt;/body&gt;
    &lt;/html&gt;
_EOF_
       </tt>
</pre>
</div>

<p>As you can see, we added a line to the beginning
of the script and replaced the two occurrences of
the phrase "My System Information" with
<tt>$title</tt>.</p>

<h2>Variables</h2>

<p>What we have done is to introduce a very
fundamental idea that appears in almost every
programming language, <i>variables</i>. Variables
are areas of memory that can be used to store
information and are referred to by a name. In the
case of our script, we created a variable called
"title" and placed the phrase "My System
Information" into memory. Inside the here script
that contains our HTML, we use "$title" to tell the
shell to perform <i>parameter expansion</i> and replace
the name of the variable with the variable's contents.</p>

<p>Whenever the shell sees a word that
begins with a "$", it tries to find out what was
assigned to the variable and substitutes it.</p>

<h2>How to Create a Variable</h2>

<p>To create a variable, put a line in your script
that contains the name of the variable followed
immediately by an equal sign ("="). No spaces are
allowed. After the equal sign, assign the
information you wish to store.</p>

<h2>Where Do Variable Names Come From?</h2>

<p>You make them up. That's right; you get to choose
the names for your variables. There are a few
rules.</p>

<ol>
	<li>Names must start with a letter.</li>

	<li>A name must not contain embedded spaces. Use
	underscores instead.</li>

	<li>You cannot use punctuation marks.</li>

</ol>

<h2>How Does This Increase Our Laziness?</h2>

<p>The addition of the <tt>title</tt> variable made our life
easier in two ways. First, it reduced the amount of
typing we had to do. Second and more importantly,
it made our script easier to maintain.</p>

<p>As you write more and more scripts (or do any
other kind of programming), you will learn that
programs are rarely ever finished. They are
modified and improved by their creators and others.
After all, that's what open source development is
all about. Let's say that you wanted to change the
phrase "My System Information" to "Linuxbox System
Information." In the previous version of the
script, you would have had to change this in two
locations. In the new version with the <tt>title</tt>
variable, you only have to change it in one place.
Since our script is so small, this might seem like
a trivial matter, but as scripts get larger and
more complicated, it becomes very important.

<h2>Environment Variables</h2>

<p>When you start your shell session, some
variables are already set by the startup file we
looked at earlier. To see all the variables that are in your
environment, use the <tt class="user">printenv</tt>
command. One variable in your environment contains
the host name for your system. We will add this
variable to our script like so:</p>

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
    &lt;/body&gt;
    &lt;/html&gt;
_EOF_
       </tt>
</pre>
</div>

<p>Now our script will always include the name of
the machine on which we are running. Note that, by
convention, environment variables names are
uppercase.</p>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0030.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0050.php">Next</a></p>
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