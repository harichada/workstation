



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: More Redirection</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="">
		<link rel="next" href="">
		<link rel="contents" href="">
	</head>

	<body>
	<a name="top"></a>
		<table class="page" summary="This table is used for graphic layout.">
			<tr>
				<td>
					<div class="colorblock"></div>
				</td>
				<td></td>
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
<h1 id="more-redirection">More Redirection</h1>
<p>As we learned in chapter 6 of TLCL, I/O redirection is one of the most useful and powerful features of the shell. With redirection, our commands can send and receive streams of data to and from files and devices, as well as allow us to connect different programs together into pipelines.</p>
<p>In this adventure, we will look at redirection in a little more depth to see how it works and to discover some additional features and useful redirection techniques.</p>
<h2 id="whats-really-going-on">What's Really Going On</h2>
<p>Whenever a new program is run on the system, the kernel creates a table of <em>file descriptors</em> for the program to use. File descriptors are pointers to files. By convention, the first 3 entries in the table (descriptors 0, 1, and 2) are used as standard input (stdin), standard output (stdout), and standard error (stderr). Initially, all three descriptors point to the terminal device (which the system treats as a read/write file), so that standard input comes from the keyboard and standard output and standard error go to the terminal display.</p>
<p>When a program is started as a child process of another (for instance, when we run an executable program in the shell), the newly launched program inherits a copy of the parent's file descriptor table. Redirection is the process of manipulating the file descriptors so that input and output can be routed from/to different files.</p>
<p>The shell hides the presence of file descriptors in common redirections such as:</p>
<p><em>command</em> &gt; <em>file</em></p>
<p>where we redirect standard output to a file, but the full syntax of the redirection operator includes an optional file descriptor. We could write the above statement this way and it would have exactly the same effect:</p>
<p><em>command</em> 1&gt; <em>file</em></p>
<p>As a convenience, the shell assumes we want to redirect standard output if the file descriptor is omitted. Likewise, the following two statements are equivalent when referring to standard input:</p>
<p><em>command</em> &lt; <em>file</em></p>
<p><em>command</em> 0&lt; <em>file</em></p>
<h2 id="duplicating-file-descriptors">Duplicating File Descriptors</h2>
<p>It is sometimes desirable to write more than one output stream (for example standard output and standard error) to the same file. To do this, we would write something like this:</p>
<p><em>command</em> &gt; <em>file</em> 2&gt;&amp;1</p>
<p>We'll add the assumed file descriptor to the first redirection to make things a little clearer:</p>
<p><em>command</em> 1&gt; <em>file</em> 2&gt;&amp;1</p>
<p>This is an example of <em>duplication</em>. When we read this statement, we see that file descriptor 1 is changed from pointing to the terminal device to instead pointing to <em>file</em>. This is followed by the the second redirection that causes file descriptor 2 to be a duplicate (i.e., it points to the same file) of file descriptor 1. When we look at things this way, it's easy to see why the order of redirections is important. For example, if we reverse the order:</p>
<p><em>command</em> 2&gt;&amp;1 1&gt; <em>file</em></p>
<p>file descriptor 2 becomes a duplicate of file descriptor 1 (which points to the terminal) and then file descriptor 1 is set to point to <em>file</em>. When all is said and done, file descriptor 1 points to <em>file</em> while file descriptor 2 still points to the terminal.</p>
<h2 id="exec">exec</h2>
<p>Before we go any farther, we need to take a brief detour and talk about a shell builtin that we didn't cover in TLCL. This builtin is named <code>exec</code> and it does some interesting things. Its main purpose is to terminate the shell and launch another program in its place. This is often used in startup scripts that initiate system services. However, it is not common in scripts used for other purposes.</p>
<p>Usage of <code>exec</code> is described below:</p>
<p><code>exec</code> [<em>program</em>] [<em>redirections</em>]</p>
<p><em>program</em> is the name of the program that will start and take the place of the shell. <em>redirections</em> are the redirections to be used by the new program.</p>
<p>One feature of <code>exec</code> is useful for our study of redirection. If <em>program</em> is omitted, any specified redirections are performed on the current shell. For example, if we included this near the beginning of a script:</p>
<pre><code>exec 1&gt; output.txt</code></pre>
<p>from that point on, every command using standard output would send its data to <code>output.txt</code>. It should be noted that if this trick is performed by a script, it is no longer possible to redirect that script's output at runtime using the command line. For example, if we had the following script:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>

<span class="co"># exec-test - Test external redirection and exec</span>

<span class="kw">exec</span> <span class="kw">1&gt;</span> ~/foo1.txt
<span class="kw">echo</span> <span class="st">&quot;Boo.&quot;</span>

<span class="co"># End of script</span></code></pre>
<p>and tried to invoke it with redirection:</p>
<pre><code>me@linuxbox ~ $ ./exec-test &gt; ~/foo2.txt</code></pre>
<p>the attempted redirection would have no effect. The word &quot;Boo&quot; would still be written to the file <code>foo1.txt</code>, not <code>foo2.txt</code> as specified on the command line. This is because the redirection performed inside the script via <code>exec</code> is performed after the redirection on the command line, and thus, takes precedence.</p>
<p>Another way we can use <code>exec</code> is to open and close additional file descriptors. While we most often use descriptors 0, 1, and 2, it is possible to use others. Here are examples of opening and closing file descriptor 3:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co"># Open fd 3</span>
<span class="kw">exec</span> <span class="kw">3&gt;</span> some_file.txt

<span class="co"># Close fd 3</span>
<span class="kw">exec</span> <span class="kw">3&gt;&amp;</span>-</code></pre>
<p>It's easy to open and use file descriptors 3-9 in the shell, and it's even possible to use file descriptors 10 and above, though the <code>bash</code> man page cautions against it.</p>
<p>So why would we want to use additional file descriptors? That's a little hard to answer. In most cases we don't need to. We <em>could</em> open several descriptors in a script and use them to redirect output to different files, but it's just as easy to specify (using shell variables, if desired) the names of the files to which we want to redirect since most commands are going to send their data to standard output anyway.</p>
<p>There is one case in which using an additional file descriptor would be helpful. It's the case of a filter program that accepts standard input and sends its filtered data to standard output. Such programs are quite common, for example <code>sort</code> and <code>grep</code>. But what if we want to create a filter program that also writes stuff on the terminal display while it was filtering? We can't use standard output to do it, because standard output is being used to output the filtered data. We could use standard error to display stuff on the screen, but let's say we wanted to keep it restricted to just error messages (this is good for logging). Using <code>exec</code>, we could do something like this:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>

<span class="co"># counter-exec - Count number of lines in a pipe</span>

<span class="kw">exec</span> <span class="kw">3&gt;</span> /dev/tty <span class="co"># open fd 3 and point to controlling terminal</span>

<span class="ot">count=</span>0
<span class="kw">while</span> <span class="kw">read</span>; <span class="ot">do</span>  <span class="co"># read line from stdin</span>
  <span class="kw">echo</span> <span class="st">&quot;</span><span class="ot">$REPLY</span><span class="st">&quot;</span> <span class="co"># send line to stdout</span>
  <span class="kw">((</span>count++<span class="kw">))</span>
  <span class="kw">printf</span> <span class="st">&quot;\b\b\b\b\b\b%06d&quot;</span> <span class="ot">$count</span> <span class="kw">&gt;&amp;3</span>
<span class="kw">done</span>
<span class="kw">echo</span> <span class="st">&quot; Lines Counted&quot;</span> <span class="kw">&gt;&amp;3</span>

<span class="kw">exec</span> <span class="kw">3&gt;&amp;</span>- <span class="co"># close fd 3</span></code></pre>
<p>This program simply copies standard input to standard output, but it displays a running count of the number of lines that it has copied. If we invoke it this way, we can see it in action:</p>
<pre><code>me@linuxbox ~ $ find /usr/share | ./counter-exec &gt; ~/find_list.txt</code></pre>
<p>In this pipeline example, we generate a list of files using <code>find</code>, and then count them before writing the list in a file named <code>find_list.txt</code>.</p>
<p>The script works by reading a line from the standard input and writing the <code>REPLY</code> variable (which contains the line of text from <code>read</code>) to standard output. The <code>printf</code> format specifier contains a series of six backspaces and a formatted integer that is always six digits long padded with leading zeros.</p>
<h2 id="devtty">/dev/tty</h2>
<p>The mysterious part of the script above is the <code>exec</code>. The <code>exec</code> is used to open a file using file descriptor 3 which is set to point to <code>/dev/tty</code>. <code>/dev/tty</code> is one of several <em>special files</em> that we can access from the shell. Special files are usually not &quot;real&quot; files in the sense that they are files that exists on a physical disk. Rather, they are virtual like the files in the <code>/proc</code> directory. The <code>/dev/tty</code> file is a device that always points to a program's <em>controlling terminal</em>, that is, the terminal that is responsible for launching the program. If we run the command <code>ps aux</code> on our system, we will see a listing of every process. At the top of the listing is a column labeled &quot;TTY&quot; (short for &quot;Teletype&quot; reflecting its historical roots) that contains the name of the controlling terminal. Most entries in this column will contain &quot;?&quot; meaning that the process has no controlling terminal (the process was not launched interactively), but others will contain a name like &quot;pts/1&quot; which refers to the device <code>/dev/pts/1</code>.</p>
<h2 id="noclobber">Noclobber</h2>
<p>When the shell encounters a command with output redirection, such as:</p>
<p><em>command</em> &gt; <em>file</em></p>
<p>the first thing that happens is that the output stream is started by either creating <em>file</em> or, if <em>file</em> already exists, truncating it to zero length. This means that if <em>command</em> completely fails or doesn't even exist, <em>file</em> will end up with zero length. This can be a safety issue for new users who might overwrite (or truncate) a valuable file.</p>
<p>To avoid this, we can do one of two things. First we can use the &quot;&gt;&gt;&quot; operator instead of &quot;&gt;&quot; so that output will be appended to the end of <em>file</em> rather than the beginning. Second, we can set the &quot;noclobber&quot; shell option which prevents redirection from overwriting an existing file. To activate this, we enter:</p>
<pre><code>set -o noclobber</code></pre>
<p>Once we set this option, attempts to overwrite an existing file will cause the following error:</p>
<pre><code>bash: file: cannot overwrite existing file</code></pre>
<p>The effect of the <code>noclobber</code> option can be overridden by using the <code>&gt;|</code> redirection operator like so:</p>
<p><em>command</em> <code>&gt;|</code> <em>file</em></p>
<p>To turn off the noclobber option we enter this command:</p>
<pre><code>set +o noclobber</code></pre>
<h2 id="summing-up">Summing Up</h2>
<p>While this adventure may be more on the &quot;interesting&quot; side than the &quot;fun&quot; side, it does provide some useful insight into how redirection actually works and some of the interesting ways we can use it. In a later adventure, we will put this new knowledge to work expanding the power of our scripts.</p>
<h2 id="further-reading">Further Reading</h2>
<ul>
<li><p>A good visual tutorial can be found at The Bash Hackers Wiki: <a href="http://wiki.bash-hackers.org/howto/redirection_tutorial"><code class="url">http://wiki.bash-hackers.org/howto/redirection_tutorial</code></a></p></li>
<li><p>For a little background on file descriptors, see this Wikipedia article: <a href="http://en.wikipedia.org/wiki/File_descriptor"><code class="url">http://en.wikipedia.org/wiki/File_descriptor</code></a></p></li>
<li><p>This <em>Linux Journal</em> article covers using <code>exec</code> to manage redirection: <a href="http://www.linuxjournal.com/content/bash-redirections-using-exec"><code class="url">http://www.linuxjournal.com/content/bash-redirections-using-exec</code></a></p></li>
<li><p><em>The Linux Command Line</em> covers redirection in chapters 6 (main discussion), 25 (here documents), 28 (here strings), and 36 (command grouping, subshells, process substitution, named pipes).</p></li>
<li><p>The REDIRECTION section of the <code>bash</code> man page, of course, has all the details.</p></li>
</ul>


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