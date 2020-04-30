



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: Writing shell scripts.</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_lts0100.php">
		<link rel="next" href="lc3_wss0010.php">
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
					<img src="images/WritingShellScripts.png" alt="Title graphic">
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
			href="lc3_lts0100.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0010.php">Next</a></p>
		</div>
	<h1>Here is Where the Fun Begins</h1>

	<p>With the thousands of commands available for the
	command line user, how can you remember them all?
	The answer is, you don't. The real power of the
	computer is its ability to do the work for you. To
	get it to do that, we use the power of the shell to automate
	things. We write <i>shell scripts</i>.</p>

	<h2>What are Shell Scripts?</h2>
	
<p>In the simplest terms, a shell script is a file containing a series of commands. The shell
reads this file and carries out the commands as though they have been entered directly on
the command line.</p>

<p>The shell is somewhat unique, in that it is both a powerful command line interface to the
system and a scripting language interpreter. As we will see, most of the things that can be
done on the command line can be done in scripts, and most of the things that can be done
in scripts can be done on the command line.</p>

<p>We have covered many shell features, but we have focused on those features most often
used directly on the command line. The shell also provides a set of features usually (but
not always) used when writing programs.</p>




<p>Scripts unlock the power of your
Linux machine. So let's have some fun!</p>

<h2><a name="contents">Contents</a></h2>

	<ol>
	<li>
		<a href="lc3_wss0010.php">Writing Your First
		Script and Getting It to Work</a>
	</li>

	<li>
		<a href="lc3_wss0020.php">Editing the Scripts You
		Already Have</a>
	</li>

	<li>
		<a href="lc3_wss0030.php">Here Scripts</a>
	</li>

	<li>
		<a href="lc3_wss0040.php">Variables</a>
	</li>

	<li>
		<a href="lc3_wss0050.php">Command Substitution and Constants</a>
	</li>

	<li>
		<a href="lc3_wss0060.php">Shell Functions</a>
	</li>

	<li>
		<a href="lc3_wss0070.php">Some Real Work</a>
	</li>

	<li>
		<a href="lc3_wss0080.php">Flow Control - Part
		1</a>
	</li>

	<li>
		<a href="lc3_wss0090.php">Stay Out of Trouble</a>
	</li>

	<li>
		<a href="lc3_wss0100.php">Keyboard Input and
		Arithmetic</a>
	</li>

	<li>
		<a href="lc3_wss0110.php">Flow Control - Part
		2</a>
	</li>

	<li>
		<a href="lc3_wss0120.php">Positional
		Parameters</a>
	</li>

	<li><a href="lc3_wss0130.php">Flow Control - Part3</a>
	</li>
	
	<li>
		<a href="lc3_wss0140.php">Errors and Signals and Traps (Oh My!) - Part 1</a>
	</li>
	
	<li>
		<a href="lc3_wss0150.php">Errors and Signals and Traps (Oh My!) - Part 2</a>
	</li>
</ol>



		<div class="pagenav">
			<p class="right"><a
			href="lc3_lts0100.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0010.php">Next</a></p>
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