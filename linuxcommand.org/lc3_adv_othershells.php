



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: Other Shells</title>
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
<h1 id="other-shells">Other Shells</h1>
<p>While we have spent a great deal of time learning the bash shell, it's not the only &quot;game in town.&quot; Unix has had several popular shells and almost all are available for Linux, too. In this adventure, we will look at some of these, mostly for their historical significance. With a couple of possible exceptions, there is very little reason to switch, as <code>bash</code> is a pretty good shell. Some of these alternate shells are still popular on other Unix and Unix-like systems, but are rarely used in Linux except when compatibility with other systems is required.</p>
<h2 id="the-evolution-of-shells">The Evolution of Shells</h2>
<p>The first Unix shell was developed in 1971 by Ken Thompson who, along with Dennis Richie, created Unix at AT&amp;T Bell Laboratories. The <em>Thompson shell</em> introduced many of the core ideas that we see in shells today. These include I/O redirection, pipelines, and the ability to place processes in the background. This early shell was intended only for interactive use, not for use as a programming language.</p>
<p>The Thompson shell was followed in 1975 by the <em>Mashey shell</em>, written by John Mashey. This shell extended the Thompson shell to support shell scripting by including variables, a built-in if/then/else, and other rudimentary flow control constructs.</p>
<p>At this point we come to a big division in shell design philosophies. In 1978 Steve Bourne created the <em>Bourne shell</em>. The following year, Bill Joy (the original author of <code>vi</code>) released the <em>C shell</em>.</p>
<p>The Bourne shell added a lot of features that greatly improved shell scripting. These included flow control structures, better variables, command substitutions, and here scripts. The Bourne shell contains much of the functionality that we see in the bash shell today.</p>
<p>On the other hand, the C shell was designed to improve interactive use by adding command history and job control. The C shell, as its name would imply, uses a syntax that mimics the C programming language. C language programmers abounded in the Unix community, so many preferred this style. Ironically, the C shell is not very good at scripting. For example, it lacks user defined functions and the shell's parser (the portion of the shell that reads and figures out what the script is saying) suffers from serious limitations.</p>
<p>In 1983, in an effort to improve the Bourne shell, David Korn released the <em>Korn shell</em>. Command history, job control, associative arrays, vi and Emacs style command editing are among the features that were added. In the the 1993 release (known as <em>ksh93</em>), floating point arithmetic was added. The Korn shell was good for both interactive use and scripting. Unfortunately, the Korn shell was proprietary software distributed under license from AT&amp;T. This changed in 2000 when it was released under an open source license.</p>
<p>When POSIX standardized the shell for use on Unix systems, it specified a subset of the Korn shell that would be largely compatible with the earlier Bourne shell. As a result, most Bourne-type shells now conform with the POSIX standard, but include various extensions.</p>
<p>Partially in response to the proprietary licensing of the Korn shell, the GNU project developed <code>bash</code>, which includes many Korn shell features. The first version, written by Brian Fox was released in 1989 and is today maintained by Chet Ramey. Bash is best known as the default shell in most Linux distributions. It is also the default shell in modern versions of OS X; however, due to Apple's obsession with secrecy and lock-down, they refuse to update <code>bash</code> to version 4 because of provisions in the GNU GPLv3.</p>
<p>Since the development of <code>bash</code>, one new shell has emerged that is gaining traction among Linux and OS X users. It's the <em>Z shell</em> (zsh). Sometimes described as &quot;the Emacs of shells&quot; because of its large feature set, <code>zsh</code> adds a number of features to enhance interactive use.</p>
<h2 id="modern-implementations">Modern Implementations</h2>
<p>Modern Linux users have a variety of shell programs from which to choose. Of course, the overwhelming favorite is <code>bash</code>, since it is the default shell supplied with most Linux distributions. That said, users migrating from other Unix and Unix-like systems may be more comfortable with other shells. There is also the issue of portability. If a script is required to run on multiple Unix-like systems, then care must be taken to either: 1) make sure that all the systems are running the same shell program, or 2) write a script that conforms to the POSIX standard, since most modern Bourne shell derivatives are POSIX complaint.</p>
<h3 id="a-reference-script">A Reference Script</h3>
<p>In order to compare the various shell dialects, we'll start with this <code>bash</code> script taken from chapter 33 of TLCL:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>

<span class="co"># longest-word : find longest string in a file</span>

<span class="kw">for</span> i; <span class="kw">do</span>
  <span class="kw">if </span>[[ -r <span class="st">&quot;</span><span class="ot">$i</span><span class="st">&quot;</span> ]]; <span class="kw">then</span>
    <span class="ot">max_word=</span>
    <span class="ot">max_len=</span>0
    <span class="kw">for</span> j <span class="kw">in</span> <span class="ot">$(</span><span class="kw">strings</span> <span class="st">&quot;</span><span class="ot">$i</span><span class="st">&quot;</span><span class="ot">)</span>; <span class="kw">do</span>
      <span class="ot">len=${#j}</span>
      <span class="kw">if ((</span> len &gt; max_len <span class="kw">))</span>; <span class="kw">then</span>
        <span class="ot">max_len=$len</span>
        <span class="ot">max_word=$j</span>
      <span class="kw">fi</span>
    <span class="kw">done</span>
    <span class="kw">echo</span> <span class="st">&quot;</span><span class="ot">$i</span><span class="st">: &#39;</span><span class="ot">$max_word</span><span class="st">&#39; (</span><span class="ot">$max_len</span><span class="st"> characters)&quot;</span>
  <span class="kw">fi</span>
<span class="kw">done</span></code></pre>
<h3 id="dash---debian-almquist-shell">dash - Debian Almquist Shell</h3>
<p>The Debian Almquist shell is Debian's adaptation of the <em>Almquist shell</em> (ash) originally written in the 1980s by Kenneth Almquist. The ash shell is the default shell on several of the BSD flavors of Unix. <code>dash</code>, like its ancestor <code>ash</code>, has the advantage of being small and fast; however, it achieves this by forgoing conveniences intended for interactive use such as command history and editing. It also lacks some builtin commands, relying instead on external programs. Its main use is the execution of shell scripts, particularly during system startup. On Debian and related distributions such as Ubuntu, <code>dash</code> is linked to <code>/bin/sh</code>, the shell used to run the system initialization scripts.</p>
<p><code>dash</code> is a POSIX compliant shell, so it supports Bourne shell syntax with a few additional Korn shell features:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/dash</span>

<span class="co"># longest-word.dash : find longest string in a file</span>

<span class="kw">for</span> i; <span class="kw">do</span>
  <span class="kw">if </span>[ -r <span class="st">&quot;</span><span class="ot">$i</span><span class="st">&quot;</span> ]; <span class="kw">then</span>
    <span class="ot">max_word=</span>
    <span class="ot">max_len=</span>0
    <span class="kw">for</span> j <span class="kw">in</span> <span class="ot">$(</span><span class="kw">strings</span> <span class="st">&quot;</span><span class="ot">$i</span><span class="st">&quot;</span><span class="ot">)</span>; <span class="kw">do</span>
      <span class="ot">len=${#j}</span>
      <span class="kw">if </span>[ <span class="ot">$len</span> -gt <span class="ot">$max_len</span> ]; <span class="kw">then</span>
        <span class="ot">max_len=$len</span>
        <span class="ot">max_word=$j</span>
      <span class="kw">fi</span>
    <span class="kw">done</span>
    <span class="kw">echo</span> <span class="st">&quot;</span><span class="ot">$i</span><span class="st">: &#39;</span><span class="ot">$max_word</span><span class="st">&#39; (</span><span class="ot">$max_len</span><span class="st"> characters)&quot;</span>
  <span class="kw">fi</span>
<span class="kw">done</span></code></pre>
<p>Here we see that the dash script is mostly the same as the <code>bash</code> reference script, but we do see some differences. For one thing, <code>dash</code> does not support the '[[' syntax for conditional tests; it uses the older Bourne shell syntax. The POSIX specification is also missing the <em>((expression))</em> method for arithmetic expansion and brace expansion. <code>dash</code> and the POSIX specification do support the <em>$(cmd)</em> syntax for command substitution in addition to the older `cmd` method.</p>
<h3 id="tcsh---tenex-c-shell">tcsh - TENEX C Shell</h3>
<p>The <code>tcsh</code> program was developed in the early 1980s by Ken Greer as an enhanced replacement for the original <code>csh</code> program. The name TENEX comes from the operating system of the same name, which was influential in the design of the interactive features in <code>tcsh</code>. Compared to <code>csh</code>, <code>tcsh</code> added additional command history features, Emacs and vi-style command line editing, spelling correction, and other improvements intended for interactive use. Early versions of Apple's OS X used <code>tcsh</code> as the default shell. It is still the default root shell on several BSD distributions.</p>
<p><code>tcsh</code>, like the C shell, is not POSIX compliant as we can see here:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/usr/bin/tcsh</span>

<span class="co"># longest-word.tcsh : find longest string in a file</span>

foreach i <span class="kw">(</span><span class="ot">$argv</span><span class="kw">)</span>
  <span class="kw">set</span> <span class="ot">max_word=</span><span class="st">&quot;&quot;</span>
  <span class="kw">set</span> <span class="ot">max_len=</span>0
  foreach j <span class="kw">(`strings</span> <span class="ot">$i</span><span class="kw">`)</span>
    <span class="kw">set</span> <span class="ot">len=</span>$%j
    <span class="kw">if (</span><span class="ot">$len</span> <span class="kw">&gt;</span> <span class="ot">$max_len</span><span class="kw">)</span> <span class="kw">then</span>
      <span class="kw">set</span> <span class="ot">max_word=$j</span>
      <span class="kw">set</span> <span class="ot">max_len=$len</span>
    endif
  end
  <span class="kw">echo</span> <span class="st">&quot;</span><span class="ot">$1</span><span class="st"> : </span><span class="ot">$max_word</span><span class="st"> (</span><span class="ot">$max_len</span><span class="st"> characters)&quot;</span>
end</code></pre>
<p>Our <code>tcsh</code> version of the script demonstrates many differences from Bourne style syntax. In C shell, most of the flow control statements are different. We see for example, that the outer loop starts with a <code>foreach</code> statement incrementing the variable <code>i</code> with succeeding values from the word list <code>$argv</code>. <code>argv</code>, taken from the C programming language, refers to an array containing the list of command line arguments.</p>
<p>While this simple script works, <code>tcsh</code> is not very capable when things get more complicated. It has two major weaknesses. First, it does not support user-defined functions. As a workaround, separate scripts can be called from the main script to carry out the individual functions. Second, many complex constructs easily accomplished with the POSIX shell, such as:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="kw">{</span> <span class="kw">if </span>[[ <span class="st">&quot;</span><span class="ot">$a</span><span class="st">&quot;</span> ]]; <span class="kw">then</span>
    <span class="kw">grep</span> <span class="st">&quot;string1&quot;</span>
  <span class="kw">else</span>
    <span class="kw">grep</span> <span class="st">&quot;string2&quot;</span>
  <span class="kw">fi</span>
<span class="kw">}</span> <span class="kw">&lt;</span> file.txt</code></pre>
<p>are not possible because the C shell parser cannot handle redirection with flow control statements. The parser also makes quoting very troublesome.</p>
<h3 id="ksh---korn-shell">ksh - Korn Shell</h3>
<p>The Korn shell comes in several different flavors. Basically, there are two groups, ksh88 and ksh93, reflecting the year of their release. There is a public domain version of ksh88 called <code>pdksh</code>, and more official versions of both <code>ksh88</code> and <code>ksh93</code>. All three are available for Linux. <code>ksh93</code> would be the preferred version for most users, as it is the version found on most modern commercial Unix systems. During installation is it often symlinked to <code>ksh</code>.</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/usr/bin/ksh</span>

<span class="co"># longest-word.ksh : find longest string in a file</span>

<span class="kw">for</span> i; <span class="kw">do</span>
  <span class="kw">if </span>[[ -r <span class="st">&quot;</span><span class="ot">$i</span><span class="st">&quot;</span> ]]; <span class="kw">then</span>
    <span class="ot">max_word=</span>
    <span class="ot">max_len=</span>0
    <span class="kw">for</span> j <span class="kw">in</span> <span class="ot">$(</span><span class="kw">strings</span> <span class="st">&quot;</span><span class="ot">$i</span><span class="st">&quot;</span><span class="ot">)</span>; <span class="kw">do</span>
      <span class="ot">len=${#j}</span>
      <span class="kw">if ((</span> len &gt; max_len <span class="kw">))</span>; <span class="kw">then</span>
        <span class="ot">max_len=$len</span>
        <span class="ot">max_word=$j</span>
      <span class="kw">fi</span>
    <span class="kw">done</span>
    print <span class="st">&quot;</span><span class="ot">$i</span><span class="st">: &#39;</span><span class="ot">$max_word</span><span class="st">&#39; (</span><span class="ot">$max_len</span><span class="st"> characters)&quot;</span>
  <span class="kw">fi</span>
<span class="kw">done</span></code></pre>
<p>As we can see in this example, <code>ksh</code> syntax is very close to <code>bash</code>. The one visible difference is the <code>print</code> command used in place of <code>echo</code>. Korn shell has <code>echo</code> too, but <code>print</code> is the preferred Korn shell command for outputting text. Another subtle difference is the way that pipelines work in <code>ksh</code>. As we learned in chapter 28 of TLCL, a construct such as:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>
<span class="ot">str=</span><span class="st">&quot;&quot;</span>
<span class="kw">echo</span> <span class="st">&quot;foo&quot;</span> <span class="kw">|</span> <span class="kw">read</span> <span class="ot">str</span>
<span class="kw">echo</span> <span class="ot">$str</span></code></pre>
<p>always produces an empty result because, in <code>bash</code> pipelines, each command in a pipeline is executed in a subshell, so its data is destroyed when the subshell exits. In this example, the final command (<code>read</code>) is in a subshell, and thus <code>str</code> remains empty in the parent process.</p>
<p>In <code>ksh</code>, the internal organization of pipelines is different. When we do this in <code>ksh</code>:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/usr/bin/ksh</span>
<span class="ot">str=</span><span class="st">&quot;&quot;</span>
<span class="kw">echo</span> <span class="st">&quot;foo&quot;</span> <span class="kw">|</span> <span class="kw">read</span> <span class="ot">str</span>
<span class="kw">echo</span> <span class="ot">$str</span></code></pre>
<p>The output is &quot;foo&quot; because in the <code>ksh</code> pipeline, the <code>echo</code> is in the subshell rather than the <code>read</code>.</p>
<h3 id="zsh---z-shell">zsh - Z Shell</h3>
<p>At first glance, the Z shell does not differ very much from <code>bash</code> when it comes to scripting:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/zsh</span>

<span class="co"># longest-word.zsh : find longest string in a file</span>

<span class="kw">for</span> i; <span class="kw">do</span>
  <span class="kw">if </span>[[ -r <span class="st">&quot;</span><span class="ot">$i</span><span class="st">&quot;</span> ]]; <span class="kw">then</span>
    <span class="ot">max_word=</span>
    <span class="ot">max_len=</span>0
    <span class="kw">for</span> j <span class="kw">in</span> <span class="ot">$(</span><span class="kw">strings</span> <span class="st">&quot;</span><span class="ot">$i</span><span class="st">&quot;</span><span class="ot">)</span>; <span class="kw">do</span>
      <span class="ot">len=${#j}</span>
      <span class="kw">if ((</span> len &gt; max_len <span class="kw">))</span>; <span class="kw">then</span>
        <span class="ot">max_len=$len</span>
        <span class="ot">max_word=$j</span>
      <span class="kw">fi</span>
    <span class="kw">done</span>
    print <span class="st">&quot;</span><span class="ot">$i</span><span class="st">: &#39;</span><span class="ot">$max_word</span><span class="st">&#39; (</span><span class="ot">$max_len</span><span class="st"> characters)&quot;</span>
  <span class="kw">fi</span>
<span class="kw">done</span></code></pre>
<p>It runs scripts the same way that <code>bash</code> does. This is to be expected, as <code>zsh</code> is intended to be a drop-in replacement for <code>bash</code> in most cases. A couple of things to note however. First, <code>zsh</code> handles pipelines like the Korn shell does; the last command in a pipeline is executed in the current shell. Second, in <code>zsh</code>, the first element of an array is index 1, not 0 as it in <code>bash</code> and <code>ksh</code>.</p>
<p>Where <code>zsh</code> does differ significantly is in the number of bells and whistles it provides for interactive use (some of which can be applied to scripting as well). Let's take a look at a few:</p>
<h4 id="tab-completion">Tab Completion</h4>
<p>Many kinds of tab completion are supported by <code>zsh</code> to complete command names, command options, and arguments.</p>
<p>When using the <code>cd</code> command, repeatedly pressing the tab key first displays a list of the available directories, then begins to cycle through them. For example:</p>
<pre><code>me@linuxbox ~ $ cd &lt;tab&gt;

me@linuxbox ~ $ cd &lt;tab&gt;
Desktop/    Documents/  Downloads/  Music/  Pictures/   Public/
Templates/  Videos/

me@linuxbox ~ $ cd Desktop/&lt;tab&gt;
Desktop/    Documents/  Downloads/  Music/  Pictures/   Public/
Templates/  Videos/

me@linuxbox ~ $ cd Documents/
Desktop/    Documents/  Downloads/  Music/  Pictures/   Public/
Templates/  Videos/</code></pre>
<p><code>zsh</code> can be configured to display a highlighted selector on the list of directories, and we can use the arrow keys to directly move the highlight to the desired entry in the list to select it.</p>
<p>We can also switch directories by replacing one part of a path name with another:</p>
<pre><code>me@linuxbox ~ $ cd /usr/local/share
me@linuxbox share $ cd share bin
me@linuxbox bin $ pwd
/usr/local/bin</code></pre>
<p>Pathnames can be abbreviated as long as they are unambiguous. If we type:</p>
<pre><code>me@linuxbox ~ $ ls /u/l/share&lt;tab&gt;</code></pre>
<p><code>zsh</code> will expand it into:</p>
<pre><code>me@linuxbox ~ $ ls /usr/local/share/</code></pre>
<p>That can save a lot of typing!</p>
<p>Help for options and arguments is provided for many commands. To invoke this feature, we type the command and the leading dash for an option, then hit the tab key:</p>
<pre><code>me@linuxbox ~ $ rm -&lt;tab&gt;
--force             -f      -- ignore nonexistent files, never prompt
--help                      -- display help message and exit
-i                          -- prompt before every removal
-I                          -- prompt when removing many files
--interactive               -- prompt under given condition
                               (defaulting to always)
--no-preserve-root          -- do not treat / specially
--one-file-system           -- stay within file systems of files given
                               as arguments
--preserve-root             -- do not remove / (default)
--recursive         -R  -r  -- remove directories and their contents
                               recursively
--verbose           -v      -- explain what is being done
--version                   -- output version information and exit</code></pre>
<p>This displays a list of options for the command, and like the <code>cd</code> above, repeated tabs cause <code>zsh</code> to cycle through the available options.</p>
<h4 id="pathname-expansion">Pathname Expansion</h4>
<p>The Z shell provides several powerful additions to pathname expansion that can save steps when specifying files as command arguments.</p>
<p>We can use &quot;**&quot; to cause recursive expansion. For example, if we wanted to list every file name ending with <code>.txt</code> in our home directory and its subdirectories, we would have to do this in <code>bash</code>:</p>
<pre><code>me@linuxbox ~ $ find . -name &quot;*.txt&quot; | sort</code></pre>
<p>In <code>zsh</code>, we could do this:</p>
<pre><code>me@linuxbox ~ $ ls **/*.txt</code></pre>
<p>and get the same result.</p>
<p>And if that weren't cool enough, we can also add <em>qualifiers</em> to the wildcard to perform many of the same tests as the <code>find</code> command. For example:</p>
<pre><code>me@linuxbox ~ $ **/*.txt(@)</code></pre>
<p>will only display the files whose names end in <code>.txt</code> and are symbolic links.</p>
<p>There are many supported qualifiers and they may be combined to perform very fine grained file selection. Here are some examples:</p>
<table>
<thead>
<tr class="header">
<th align="left">Qualifier</th>
<th align="left">Description</th>
<th align="left">Example</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left">.</td>
<td align="left">Regular files</td>
<td align="left"><code>ls *.txt(.)</code></td>
</tr>
<tr class="even">
<td align="left">/</td>
<td align="left">Directories</td>
<td align="left"><code>ls *.txt(/)</code></td>
</tr>
<tr class="odd">
<td align="left">@</td>
<td align="left">Symbolic links</td>
<td align="left"><code>ls *.txt(@)</code></td>
</tr>
<tr class="even">
<td align="left">*</td>
<td align="left">Executable files</td>
<td align="left"><code>ls *(*)</code></td>
</tr>
<tr class="odd">
<td align="left">F</td>
<td align="left">Non-empty (&quot;full&quot;) directories</td>
<td align="left"><code>ls *(F)</code></td>
</tr>
<tr class="even">
<td align="left">/^F</td>
<td align="left">Empty directories</td>
<td align="left"><code>ls *(/^F)</code></td>
</tr>
<tr class="odd">
<td align="left">m<em>n</em></td>
<td align="left">Modified exactly <em>n</em> days ago</td>
<td align="left"><code>ls *(m5)</code></td>
</tr>
<tr class="even">
<td align="left">m-<em>n</em></td>
<td align="left">Modified less than <em>n</em> days ago</td>
<td align="left"><code>ls *(m-5)</code></td>
</tr>
<tr class="odd">
<td align="left">m+<em>n</em></td>
<td align="left">Modified more than <em>n</em> days ago</td>
<td align="left"><code>ls *(m+5)</code></td>
</tr>
<tr class="even">
<td align="left">L0</td>
<td align="left">Empty (zero length) file</td>
<td align="left"><code>ls *(L0)</code></td>
</tr>
<tr class="odd">
<td align="left">LM+<em>n</em></td>
<td align="left">File larger than <em>n</em> megabytes</td>
<td align="left"><code>ls *(LM+5)</code></td>
</tr>
<tr class="even">
<td align="left">LK-<em>n</em></td>
<td align="left">File smaller than <em>n</em> kilobytes</td>
<td align="left"><code>ls *(LK-100)</code></td>
</tr>
</tbody>
</table>
<h4 id="global-aliases">Global aliases</h4>
<p>Z shell provides more powerful aliases. With <code>zsh</code> we can define an alias in the usual way, such as:</p>
<pre><code>me@linuxbox ~ $ alias vi=&#39;/usr/bin/vim&#39;</code></pre>
<p>and it will behave just as it would in <code>bash</code>. But we can also define a <em>global alias</em> that can be used at any position on the command line, not just at the beginning. For example, we can define a commonly used file name as an alias:</p>
<pre><code>me@linuxbox ~ $ alias -g LOG=&#39;/var/log/syslog&#39;</code></pre>
<p>and then use it anywhere on a command line:</p>
<pre><code>me@linuxbox ~ $ less LOG</code></pre>
<p>The use of an uppercase alias name is not a requirement, it's just a custom to make its use easier to see. We can also use global aliases to define common redirections:</p>
<pre><code>me@linuxbox ~ $ alias -g L=&#39;| less&quot;</code></pre>
<p>or</p>
<pre><code>me@linuxbox ~ $ alias -g W=&#39;| wc -l&#39;</code></pre>
<p>Then we can do things like this:</p>
<pre><code>me@linuxbox ~ $ cat LOG W</code></pre>
<p>to display the number of lines in <code>/var/log/syslog</code>.</p>
<h4 id="suffix-aliases">Suffix aliases</h4>
<p>What's more, we can define aliases to act like an &quot;open with...&quot; by defining a <em>suffix alias</em>. For example, we can define an alias that says all files that end with &quot;.txt&quot; should be viewed with less:</p>
<pre><code>me@linuxbox ~ $ alias -s txt=&#39;less&#39;</code></pre>
<p>Then we can just type the name of a text file, and it will be opened by the application specified by the alias:</p>
<pre><code>me@linuxbox ~ $ dir-list.txt</code></pre>
<p>How cool is that?</p>
<h4 id="improved-history-search">Improved history search</h4>
<p><code>zsh</code> adds a neat trick to history searching. In <code>bash</code> (and <code>zsh</code> too) we can perform a reverse incremental history search by typing <code>Ctrl-r</code>, and each subsequent keystroke will refine the search. <code>zsh</code> goes one better by allowing us to simply type a few letters of the desired search string on the command line and then press up-arrow. It moves back through the history to find the first match, and each time we press the up-arrow, the next match is displayed.</p>
<h4 id="environment-variable-editing">Environment variable editing</h4>
<p><code>zsh</code> provides a shell builtin called <code>vared</code> for editing shell variables. For example, if we wanted to make a quick change to our <code>PATH</code> variable we can do this:</p>
<pre><code>me@linuxbox ~ $ vared PATH</code></pre>
<p>and the contents of the <code>PATH</code> variable appear in the command editor, so we can make a change and press Enter and the change takes effect.</p>
<h4 id="frameworks">Frameworks</h4>
<p>We have only touched on a few of the features available in <code>zsh</code>. It has a lot. But with a large feature set comes complexity, and configuring <code>zsh</code> to take advantage of its full potential can be daunting. Heck, its man page is a only a table of contents to the other 10+ man pages that cover various topics. Fortunately, communities have sprung up to provide <em>frameworks</em> that supply ready-to-use configurations and add-ons for <code>zsh</code>. By far, the most popular of these is Oh-My-Zsh, a project led by Robby Russell.</p>
<p>Oh-My-Zsh is a large collection of configuration files, plugins, aliases, and themes. It offers support for tailoring <code>zsh</code> for many types of common tasks, particularly software development and system administration.</p>
<h2 id="changing-to-another-shell">Changing To Another Shell</h2>
<p>Now that we have learned a little about the different shells available for Linux, how can we experiment with them? First, we can simply enter the name of the shell from our <code>bash</code> prompt. This will launch the second shell as a child process of <code>bash</code>:</p>
<pre><code>me@linuxbox ~ $ tcsh
%</code></pre>
<p>Here we have launched <code>tcsh</code> from the <code>bash</code> prompt and are presented with the default <code>tcsh</code> prompt, a percent sign. Since we have not yet created any startup files for the new shell, we get a very bare-bones environment. Each shell has its own configuration file(s) for interactive use just as <code>bash</code> has the <code>.bashrc</code> file to configure its interactive sessions.</p>
<p>Here is a table that lists the configuration files for each of the shells when used as an interactive (i.e., not a login) shell:</p>
<table>
<thead>
<tr class="header">
<th align="left">Shell</th>
<th align="left">Config File(s)</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>dash</code></td>
<td align="left">User-defined by setting the ENV variable in <code>~/.profile</code></td>
</tr>
<tr class="even">
<td align="left"><code>bash</code></td>
<td align="left"><code>~/.bashrc</code></td>
</tr>
<tr class="odd">
<td align="left"><code>ksh</code></td>
<td align="left"><code>~/.kshrc</code></td>
</tr>
<tr class="even">
<td align="left"><code>tcsh</code></td>
<td align="left"><code>~/.tchrc</code></td>
</tr>
<tr class="odd">
<td align="left"><code>zsh</code></td>
<td align="left"><code>~/.zshrc</code></td>
</tr>
</tbody>
</table>
<p>We'll need to consult the respective shell's man page (always a fun exercise!) to see the complete list of shell features. Most shells also include additional documentation and example configuration files in the <code>/usr/share/doc</code> directory.</p>
<p>To exit our temporary shell, we simply enter the <code>exit</code> command:</p>
<pre><code>% exit
me@linuxbox ~ $</code></pre>
<p>Once we are done with our experimentation and configuration, we can change our default shell from <code>bash</code> to our new shell by using the <code>chsh</code> command. For example, to change from <code>bash</code> to <code>zsh</code>, we could do this:</p>
<pre><code>me@linuxbox ~ $ chsh
password:
Changing the login shell for me
Enter the new value, or press ENTER for the default
   Login Shell [/bin/bash]: /usr/bin/zsh

~ 23:30:40
$</code></pre>
<p>We are prompted for our password and then prompted for the name of the new shell whose name must appear in the <code>/etc/shells</code> file. This is a safety precaution to prevent an invalid name from being specified and thus preventing us from logging in again. That would be bad.</p>
<h2 id="summing-up">Summing Up</h2>
<p>Because of the growing popularity of Linux among Unix-like operating systems, <code>bash</code> has become the world's predominant shell program. It has many of the best features of earlier shells and a few tricks of its own. However, if light weight and quick script execution is needed (for example, in embedded systems), <code>dash</code> is a good choice. Likewise, if working with other Unix systems is required, <code>ksh</code> or <code>tcsh</code> will provide the necessary compatibility. For the adventuresome among us, the advanced interactive features of <code>zsh</code> can enhance our day-to-day shell experience.</p>
<h2 id="further-reading">Further Reading</h2>
<p>Shells and their history:</p>
<ul>
<li>A history of Unix shells from IBM Developer Works: <a href="http://www.ibm.com/developerworks/library/l-linux-shells/"><code class="url">http://www.ibm.com/developerworks/library/l-linux-shells/</code></a></li>
</ul>
<p>C shell:</p>
<ul>
<li><p>A comparison of bash and tcsh syntax by Joe Linoff: <a href="http://joelinoff.com/blog/?page_id=235"><code class="url">http://joelinoff.com/blog/?page_id=235</code></a></p></li>
<li><p>Tom Christiansen's famous &quot;Csh Programming Considered Harmful&quot; explains the many ways that csh bugs out when scripting: <a href="http://www.perl.com/doc/FMTEYEWTK/versus/csh.whynot"><code class="url">http://www.perl.com/doc/FMTEYEWTK/versus/csh.whynot</code></a></p></li>
<li><p>And on a related note, here are the &quot;Top Ten Reasons not to use the C shell&quot; by Bruce Barnett: <a href="http://www.grymoire.com/unix/CshTop10.txt"><code class="url">http://www.grymoire.com/unix/CshTop10.txt</code></a></p></li>
</ul>
<p>Korn shell:</p>
<ul>
<li><p>Korn shell documentation: <a href="http://www.kornshell.com/doc/"><code class="url">http://www.kornshell.com/doc/</code></a></p></li>
<li><p>The on-line version of &quot;Learning the Korn Shell&quot; from O'Reilly: <a href="http://web.deu.edu.tr/doc/oreily/unix/ksh/index.htm"><code class="url">http://web.deu.edu.tr/doc/oreily/unix/ksh/index.htm</code></a></p></li>
</ul>
<p>Z shell:</p>
<ul>
<li><p>Brendon Rapp's slide presentation on &quot;Why zsh Is Cooler Than Your Shell&quot;: <a href="http://www.slideshare.net/jaguardesignstudio/why-zsh-is-cooler-than-your-shell-16194692"><code class="url">http://www.slideshare.net/jaguardesignstudio/why-zsh-is-cooler-than-your-shell-16194692</code></a></p></li>
<li><p>Joe Wright's list of favorite zsh features: <a href="http://code.joejag.com/2014/why-zsh.html"><code class="url">http://code.joejag.com/2014/why-zsh.html</code></a></p></li>
<li><p>David Fendrich's &quot;No, Really. Use Zsh.&quot;: <a href="http://fendrich.se/blog/2012/09/28/no/"><code class="url">http://fendrich.se/blog/2012/09/28/no/</code></a></p></li>
<li><p>Nacho Caballero's &quot;Master Your Z Shell with These Outrageously Useful Tips&quot;: <a href="http://reasoniamhere.com/2014/01/11/outrageously-useful-tips-to-master-your-z-shell/"><code class="url">http://reasoniamhere.com/2014/01/11/outrageously-useful-tips-to-master-your-z-shell/</code></a></p></li>
<li><p>Home page for Oh-My-Zsh: <a href="http://ohmyz.sh/"><code class="url">http://ohmyz.sh/</code></a></p></li>
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