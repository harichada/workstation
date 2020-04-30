



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: Learning the shell.</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="index.php">
		<link rel="next" href="lc3_lts0010.php">
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
					<img src="images/LearningTheShell.png" alt="Title graphic">
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
			href="index.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="lc3_lts0010.php">Next</a></p>
		</div>
<h1>Why Bother?</h1>

<p>Why do you need to learn the command line
anyway? Well, let me tell you a story. A few years ago
we had a problem where I used to work. There was a shared
drive on one of our file servers that kept getting
full. I won't mention that this legacy operating
system did not support user quotas; that's another
story. But the server kept getting full and it
stopped people from working. One of our software
engineers spent the better part of a
day writing a C++ program that would look through all the
user's directories and add up the space they were
using and make a listing of the results. Since I was
forced to use the legacy OS while I was on the job,
I installed <a href="http://www.cygwin.com/">a Linux-like
command line environment for it.</a> When I
heard about the problem, I realized I could do all the
work this engineer had done with this single
line:</p>

<pre>
du -s * | sort -nr &gt; $HOME/user_space_report.txt
</pre>

<p>Graphical user interfaces (GUIs) are helpful for
many tasks, but they are not good for all tasks. I
have long felt that most computers today are not powered by
electricity. They instead seem to be powered by the
"pumping" motion of the mouse! Computers were
supposed to free us from manual labor, but how many
times have you performed some task you felt sure
the computer should be able to do but you ended up
doing the work yourself by tediously working the mouse?
Pointing and clicking, pointing and clicking.</p>

<p>I once heard an author say that when you are
a child you use a computer by looking at the
pictures. When you grow up, you learn to read and
write. Welcome to Computer Literacy 101. Now let's
get to work.</p>

<h2><a name="contents">Contents</a></h2>

<ol>
	<li>
		<a href="lc3_lts0010.php">What is "the Shell"?</a>
	</li>

	<li>
		<a href="lc3_lts0020.php">Navigation</a>
	</li>
	
	<li>
		<a href="lc3_lts0030.php">Looking Around</a>
	</li>

	<li>
		<a href="lc3_lts0040.php">A Guided Tour</a>
	</li>

	<li>
		<a href="lc3_lts0050.php">Manipulating Files</a>
	</li>

	<li>
		<a href="lc3_lts0060.php">Working with Commands</a>
	</li>

	<li>
		<a href="lc3_lts0070.php">I/O Redirection</a>
	</li>

	<li>
		<a href="lc3_lts0080.php">Expansion</a>
	</li>

	<li>
		<a href="lc3_lts0090.php">Permissions</a>
	</li>

	<li>
		<a href="lc3_lts0100.php">Job Control</a>
	</li>
</ol>


		<div class="pagenav">
			<p class="right"><a
			href="index.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_lts0010.php">Next</a></p>
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