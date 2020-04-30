



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Learning the shell - Lesson 7: I/O Redirection</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_lts0060.php">
		<link rel="next" href="lc3_lts0080.php">
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
			href="lc3_lts0060.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="lc3_lts0080.php">Next</a></p>
		</div>
<h1>I/O Redirection</h1>

<p>In this lesson, we will explore a powerful
feature used by many command line programs called
<i>input/output redirection</i>. As we have seen,
many commands such as <tt class="user">ls</tt>
print their output on the display. This does not
have to be the case, however. By using some special
notations we can <i>redirect</i> the output of many
commands to files, devices, and even to the input
of other commands.</p>

<h2>Standard Output</h2>

<p>Most command line programs that display their
results do so by sending their results to a
facility called <i>standard output</i>. By default,
standard output directs its contents to the
display. To redirect standard output to a file, the
"&gt;" character is used like this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">ls &gt; file_list.txt</tt></p>
</div>

<p>In this example, the <tt class="user">ls</tt>
command is executed and the results are written in
a file named file_list.txt. Since the output of <tt
class="user">ls</tt> was redirected to the file, no
results appear on the display.</p>

<p>Each time the command above is repeated,
file_list.txt is overwritten from the beginning
with the output of the command <tt class=
"user">ls</tt>. If you want the new results to be
<i>appended</i> to the file instead, use "&gt;&gt;"
like this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">ls &gt;&gt; file_list.txt</tt></p>
</div>

<p>When the results are appended, the new results
are added to the end of the file, thus making the
file longer each time the command is repeated. If
the file does not exist when you attempt to append
the redirected output, the file will be
created.</p>

<h2>Standard Input</h2>

<p>Many commands can accept input from a facility
called <i>standard input</i>. By default, standard
input gets its contents from the keyboard, but like
standard output, it can be redirected. To redirect
standard input from a file instead of the keyboard,
the "&lt;" character is used like this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">sort &lt; file_list.txt</tt></p>
</div>

<p>In the example above, we used the <tt class=
"user"><a href="lc3_man_pages/sort1.html">sort</a></tt>
command to process the contents of file_list.txt.
The results are output on the display since the
standard output was not redirected.
We could redirect standard output to another file
like this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">sort &lt; file_list.txt &gt;
sorted_file_list.txt</tt></p>
</div>

<p>As you can see, a command can have both its
input and output redirected. Be aware that the
order of the redirection does not matter. The only
requirement is that the redirection operators (the
"&lt;" and "&gt;") must appear after the other
options and arguments in the command.</p>

<h2>Pipelines</h2>

<p>The most useful and powerful thing you
can do with I/O redirection is to connect multiple
commands together with what are called
<i>pipelines</i>. With pipelines, the standard output of
one command is fed into the standard input of
another. Here is my absolute favorite:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">ls -l | less</tt></p>
</div>

<p>In this example, the output of the <tt class=
"user">ls</tt> command is fed into <tt class=
"user">less</tt>. By using this <tt class="user">"|
less"</tt> trick, you can make any command have
scrolling output. I use this technique all the
time.</p>

<p>By connecting commands together, you can
acomplish amazing feats. Here are some examples
you'll want to try:<br>
<br>
</p>

<table cellpadding="8" border summary=
"Examples of various commands used together with pipelines.">
	<caption>
		Examples of commands used together with pipelines
	</caption>

	<tr>
		<th><strong>Command</strong></th>

		<th><strong>What it does</strong></th>
	</tr>

	<tr>
		<td>
		<p><tt class="user">ls -lt | <a href=
		"lc3_man_pages/head1.html">head</a></tt></p>
		</td>

		<td>
		<p>Displays the 10 newest files in the
		current directory.</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><tt class="user"><a href=
		"lc3_man_pages/du1.html">du</a> | sort
		-nr</tt></p>
		</td>

		<td>
		<p>Displays a list of directories and how
		much space they consume, sorted from the
		largest to the smallest.</p>
		</td>
	</tr>

	<tr>
		<td nowrap>
		<p><tt class="user"><a href=
		"lc3_man_pages/find1.html">find</a> . -type f
		-print | <a href="lc3_man_pages/wc1.html">wc</a>
		-l</tt></p>
		</td>

		<td>
		<p>Displays the total number of files in the
		current working directory and all of its
		subdirectories.</p>
		</td>
	</tr>
</table>

<h2><a name="filters">Filters</a></h2>

<p>One kind of program frequently used in pipelines is
called <i>filters</i>. Filters take standard input
and perform an operation upon it and send the
results to standard output. In this way, they can be
combined to process information in powerful ways. Here
are some of the common programs that can act as
filters:<br>
<br>
</p>

<table cellpadding="8" border summary=
"Talbe of common filter commands.">
	<caption>
		Common filter commands
	</caption>

	<tr>
		<th><strong>Program</strong></th>

		<th><strong>What it does</strong></th>
	</tr>

	<tr>
		<td>
		<p><tt class="user"><a href=
		"lc3_man_pages/sort1.html">sort</a></tt></p>
		</td>

		<td>
		<p>Sorts standard input then outputs the
		sorted result on standard output.</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><tt class="user"><a href=
		"lc3_man_pages/uniq1.html">uniq</a></tt></p>
		</td>

		<td>
		<p>Given a sorted stream of data from
		standard input, it removes duplicate lines of
		data (i.e., it makes sure that every line is
		unique).</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><tt class="user"><a href=
		"lc3_man_pages/grep1.html">grep</a></tt></p>
		</td>

		<td>
		<p>Examines each line of data it receives
		from standard input and outputs every line
		that contains a specified pattern of
		characters.</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><tt class="user"><a href=
		"lc3_man_pages/fmt1.html">fmt</a></tt></p>
		</td>

		<td>
		<p>Reads text from standard input, then
		outputs formatted text on standard
		output.</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><tt class="user"><a href=
		"lc3_man_pages/pr1.html">pr</a></tt></p>
		</td>

		<td>
		<p>Takes text input from standard input and
		splits the data into pages with page breaks,
		headers and footers in preparation for
		printing.</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><tt class="user"><a href=
		"lc3_man_pages/head1.html">head</a></tt></p>
		</td>

		<td>
		<p>Outputs the first few lines of its input.
		Useful for getting the header of a file.</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><tt class="user"><a href=
		"lc3_man_pages/tail1.html">tail</a></tt></p>
		</td>

		<td>
		<p>Outputs the last few lines of its input.
		Useful for things like getting the most
		recent entries from a log file.</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><tt class="user"><a href=
		"lc3_man_pages/tr1.html">tr</a></tt></p>
		</td>

		<td>
		<p>Translates characters. Can be used to
		perform tasks such as upper/lowercase
		conversions or changing line termination
		characters from one type to another (for
		example, converting DOS text files into Unix
		style text files).</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><tt class="user"><a href=
		"lc3_man_pages/sed1.html">sed</a></tt></p>
		</td>

		<td>
		<p>Stream editor. Can perform more
		sophisticated text translations than <tt
		class="user">tr</tt>.</p>
		</td>
	</tr>

	<tr>
		<td>
		<p><tt class="user"><a href=
		"lc3_man_pages/gawk1.html">awk</a></tt></p>
		</td>

		<td>
		<p>An entire programming language designed
		for constructing filters. Extremely
		powerful.</p>
		</td>
	</tr>
</table>
<br>

<div class="sidebar">
<h2>Performing tasks with pipelines</h2>

<ol>
	<li>
		<strong>Printing from the command line.</strong> Linux
		provides a program called <tt class="user"><a
		href="lc3_man_pages/lpr1.html">lpr</a></tt> that
		accepts standard input and sends it to the
		printer. It is often used with pipes and
		filters. Here are a couple of examples:
<pre><tt class="narrow">
cat poorly_formatted_report.txt | fmt | pr | lpr

cat unsorted_list_with_dupes.txt | sort | uniq | pr | lpr
</tt>
</pre>

		<p>In the first example, we use <tt class=
		"user">cat</tt> to read the file and output it
		to standard output, which is piped into the
		standard input of <tt class="user">fmt.
		fmt</tt> formats the text into neat paragraphs
		and outputs it to standard output, which is
		piped into the standard input of <tt class=
		"user">pr. pr</tt> splits the text neatly into
		pages and outputs it to standard output, which
		is piped into the standard input of <tt class=
		"user">lpr. lpr</tt> takes its standard input
		and sends it to the printer.</p>

		<p>The second example starts with an unsorted
		list of data with duplicate entries. First, <tt
		class="user">cat</tt> sends the list into <tt
		class="user">sort</tt> which sorts it and feeds
		it into <tt class="user">uniq</tt> which
		removes any duplicates. Next <tt class=
		"user">pr</tt> and <tt class="user">lpr</tt>
		are used to paginate and print the list.<br>
		<br>
		</p>
	</li>

	<li>
		<strong>Viewing the contents of tar files</strong>
		Often you will see software distributed as a
		<i>gzipped tar file</i>. This is a traditional
		Unix style tape archive file (created with <tt
		class="user"><a href=
		"lc3_man_pages/tar1.html">tar</a></tt>) that has
		been compressed with <tt class="user"><a href=
		"lc3_man_pages/gzip1.html">gzip</a></tt>. You can
		recognize these files by their traditional file
		extensions, ".tar.gz" or ".tgz". You can use the
		following command to view the directory of such
		a file on a Linux system:
<pre>
<tt>tar tzvf name_of_file.tar.gz | less
</tt>
</pre>
		<br>
		<br>
	</li>
</ol>
</div>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_lts0060.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_lts0080.php">Next</a></p>
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