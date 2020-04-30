



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 8: Some Real Work</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0060.php">
		<link rel="next" href="lc3_wss0080.php">
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
			href="lc3_wss0060.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0080.php">Next</a></p>
		</div>
<h1>Some Real Work</h1>

<p>In this lesson, we will develop some of our shell
functions and get our script to produce some useful
information.</p>

<h2>show_uptime</h2>

<p>The show_uptime function will display the output
of the <a href="lc3_man_pages/uptime1.html"><tt class=
"user">uptime</tt></a> command. The uptime command
outputs several interesting facts about the system,
including the length of time the system has been
"up" (running) since its last re-boot, the number
of users and recent system load.</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">uptime</tt><br>
<tt class="prompt">9:15pm up 2 days, 2:32, 2
users, load average: 0.00, 0.00, 0.00</tt></p>
</div>

<p>To get the output of the uptime command into our
HTML page, we will code our shell function like
this, replacing our temporary stubbing code with
the finished version:</p>

<div class="codeexample">
<pre>
<tt>show_uptime()
{
    <tt class="user">echo</tt> "&lt;h2&gt;System uptime&lt;/h2&gt;"
    <tt class="user">echo</tt> "&lt;pre&gt;"
    uptime
    <tt class="user">echo</tt> "&lt;/pre&gt;"
}
      </tt>
</pre>
</div>

<p>As you can see, this function outputs a stream
of text containing a mixture of HTML tags and
command output. When the command substitution takes place
in the main body of the our program, the output
from our function becomes part of the here
script.</p>

<h2>drive_space</h2>

<p>The drive_space function will use the <a href=
"lc3_man_pages/df1.html"><tt class="user">df</tt></a>
command to provide a summary of the space used by
all of the mounted file systems.</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">df</tt></p>
<pre>
<tt class=
"prompt">Filesystem   1k-blocks      Used Available Use% Mounted on<br>
/dev/hda2       509992    225772    279080  45% /
/dev/hda1        23324      1796     21288   8% /boot
/dev/hda3     15739176   1748176  13832360  12% /home
/dev/hda5      3123888   3039584     52820  99% /usr</tt>
</pre>
</div>

<p>In terms of structure, the drive_space function
is very similar to the show_uptime function:</p>

<div class="codeexample">
<pre>
<tt>drive_space()
{
    <tt class=
"user">echo</tt> "&lt;h2&gt;Filesystem space&lt;/h2&gt;"
    <tt class="user">echo</tt> "&lt;pre&gt;"
    df
    <tt class="user">echo</tt> "&lt;/pre&gt;"
}
      </tt>
</pre>
</div>

<h2>home_space</h2>

<p>The home_space function will display the amount
of space each user is using in his/her home
directory. It will display this as a list, sorted
in descending order by the amount of space
used.</p>

<div class="codeexample">
<pre>
<tt>home_space()
{
    <tt class=
"user">echo</tt> "&lt;h2&gt;Home directory space by user&lt;/h2&gt;"
    <tt class="user">echo</tt> "&lt;pre&gt;"
    <tt class="user">echo</tt> "Bytes Directory"
    du -s /home/* | sort -nr
    <tt class="user">echo</tt> "&lt;/pre&gt;"
}
      </tt>
</pre>
</div>

<p>Note that in order for this function to
successfully execute, the script must be run by the
superuser, since the <a href=
"lc3_man_pages/du1.html"><tt class="user">du</tt></a>
command requires superuser privileges to examine
the contents of the /home directory.</p>

<h2>system_info</h2>

<p>We're not ready to finish the system_info
function yet. In the meantime, we will improve the
stubbing code so it produces valid HTML:</p>

<div class="codeexample">
<pre>
<tt>system_info()
{
    <tt class=
"user">echo</tt> "&lt;h2&gt;System release info&lt;/h2&gt;"
    <tt class=
"user">echo</tt> "&lt;p&gt;Function not yet implemented&lt;/p&gt;"
}
      </tt>
</pre>
</div>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0060.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0080.php">Next</a></p>
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