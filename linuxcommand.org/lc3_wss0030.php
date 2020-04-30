



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 3: Here Scripts</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0020.php">
		<link rel="next" href="lc3_wss0040.php">
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
			href="lc3_wss0020.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0040.php">Next</a></p>
		</div><h1>Here Scripts</h1>

<p>Beginning with this lesson, we will construct a
useful application. This application will produce
an HTML document that contains information about
your system. I spent a lot of time thinking about
how to teach shell programming, and the approach I
have chosen is very different from most
others that I have seen. Most favor a
systematic treatment of shell features, and
often presume experience with other programming
languages. Although I do not assume that you
already know how to program, I realize that many
people today know how to write HTML, so our
program will produce a web page. As we construct our
script, we will discover step by step the tools
needed to solve the problem at hand.</p>

<h2>Writing an HTML File with a Script</h2>

<p>As you may know, a well formed HTML file
contains the following content:</p>

<div class="codeexample">
<pre>
<tt>&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;
    The title of your page
    &lt;/title&gt;
&lt;/head&gt;

&lt;body&gt;
    Your page content goes here.
&lt;/body&gt;
&lt;/html&gt;</tt>
</pre>
</div>

<p>Now, with what we already know, we could write
a script to produce the above content:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

# sysinfo_page - A script to produce an html file

<tt class="user">echo</tt> "&lt;html&gt;"
<tt class="user">echo</tt> "&lt;head&gt;"
<tt class="user">echo</tt> "  &lt;title&gt;"
<tt class="user">echo</tt> "  The title of your page"
<tt class="user">echo</tt> "  &lt;/title&gt;"
<tt class="user">echo</tt> "&lt;/head&gt;"
<tt class="user">echo</tt> ""
<tt class="user">echo</tt> "&lt;body&gt;"
<tt class="user">echo</tt> "  Your page content goes here."
<tt class="user">echo</tt> "&lt;/body&gt;"
<tt class="user">echo</tt> "&lt;/html&gt;"
       </tt>
</pre>
</div>

<p>This script can be used as follows:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">sysinfo_page &gt; sysinfo_page.html</tt></p>
</div>

<p>It has been said that the greatest programmers
are also the laziest. They write programs to save
themselves work. Likewise, when clever programmers
write programs, they try to save themselves
typing.</p>

<p>The first improvement to this script will be to
replace the repeated use of the <tt>echo</tt> command with a
single instance by using quotation more efficiently:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

# sysinfo_page - A script to produce an HTML file

<tt class="user">echo</tt> "&lt;html&gt;
 &lt;head&gt;
   &lt;title&gt;
   The title of your page
   &lt;/title&gt;
 &lt;/head&gt;
 
 &lt;body&gt;
   Your page content goes here.
 &lt;/body&gt;
 &lt;/html&gt;"
</tt>
</pre>
</div>

<p>Using quotation, it is possible to embed
carriage returns in our text and have the <tt>echo</tt> command's
argument span multiple lines.</p>

<p>While this is certainly an improvement, it does have a limitation.
Since many types of markup used in html incorporate quotation marks themselves,
it makes using a quoted string a little awkward. A quoted string can be used but
each embedded quotation mark will need to be escaped with a backslash character.</p>

<p>In order to avoid the additional typing, we need to look for a better way
to produce our text. Fortunately, the shell provides one. It's called a
<i>here script</i>.</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

# sysinfo_page - A script to produce an HTML file

cat &lt;&lt; _EOF_
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;
    The title of your page
    &lt;/title&gt;
&lt;/head&gt;

&lt;body&gt;
    Your page content goes here.
&lt;/body&gt;
&lt;/html&gt;
_EOF_
       </tt>
</pre>
</div>

<p>A here script (also sometimes called a here
document) is an additional form of <a href=
"lc3_lts0070.php">I/O redirection</a>. It provides a
way to include content that will be given to the
standard input of a command. In the case of the
script above, the standard input of the <tt>cat</tt> command
was given a stream of text from our script.</p>

<p>A here script is constructed like this:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">command</tt> &lt;&lt; token
content to be used as command's standard input
token
       </tt>
</pre>
</div>

<p><i>token</i> can be any string of characters. I
use "_EOF_" (EOF is short for "End Of File")
because it is traditional, but you can use anything,
as long as it does not conflict with a bash
reserved word. The token that ends the here script
must exactly match the one that starts it, or else
the remainder of your script will be interpreted as
more standard input to the command.</p>

<p>There is one additional trick that can be used
with a here script. Often you will want to indent
the content portion of the here script to improve
the readability of your script. You can do this if you change the
script as follows:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

# sysinfo_page - A script to produce an HTML file

cat &lt;&lt;- _EOF_
    &lt;html&gt;
    &lt;head&gt;
        &lt;title&gt;
        The title of your page
        &lt;/title&gt;
    &lt;/head&gt;

    &lt;body&gt;
        Your page content goes here.
    &lt;/body&gt;
    &lt;/html&gt;
_EOF_
       </tt>
</pre>
</div>

<p>Changing the the "&lt;&lt;" to "&lt;&lt;-"
causes bash to ignore the leading tabs (but not spaces) in the
here script. The output from the cat command will
not contain any of the leading tab
characters.</p>

<p>O.k., let's make our page. We will edit our page
to get it to say something:</p>

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

<p>In our next lesson, we will make our script
produce real information about the system.</p>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0020.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0040.php">Next</a></p>
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