



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: program_list</title>
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
<h1 id="program_list">program_list</h1>
<p>Have you ever wondered what all that stuff in <code>/usr/bin</code> does? Of course you have! Well, you could perform a <code>whatis</code> on every file in the directory (which can number a thousand or more on a typical system), or you could run the script below.</p>
<p><code>program_list</code> is a program that creates an annotated list of programs in a directory (it defaults to <code>/usr/bin</code>) showing the description of each program. What's more, it also lists the name of the package the program belongs to; another helpful clue for determining what a program does.</p>
<p>The program sends its output to standard output in one of 3 different formats; plain text (the default), tab-separated values (great for post-processing the listing with other tools or loading it into a spreadsheet), and Markdown format (with pandoc extensions) for direct conversion into HTML and other formats.</p>
<p><code>program_list</code> should work on any <code>rpm</code> (Red Hat, CentOS, Fedora, etc.) or <code>deb</code> (Debian, Ubuntu, etc.) based system. Note however, that due to the slow speed of package look up on most systems, <code>program_list</code> can take a long time to run (up to a half hour or more) depending the speed of your system and number of files involved.</p>
<p>In addition to the default directory <code>/usr/bin</code>, it's also good with <code>/bin</code>, <code>/sbin</code>, and <code>/usr/sbin</code>.</p>
<h2 id="examples">Examples</h2>
<pre><code>me@linuxbox ~ $ program_list &gt; program_list.txt</code></pre>
<p>Create a plain text listing of <code>/usr/bin</code> and store it in a file named <code>program_list.txt</code>.</p>
<pre><code>me@linuxbox ~ $ program_list -t /usr/sbin &gt; program_list_usr_sbin.tsv</code></pre>
<p>Create a tab-separated value listing of <code>/usr/sbin</code> and store it in a file named <code>program_list_usr_sbin.tsv</code>.</p>
<h2 id="listing">Listing</h2>
<pre class="sourceCode bash" id="program_list"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>
<span class="co"># ---------------------------------------------------------------------------</span>
<span class="co"># program_list - Produce an annotated listing of programs</span>

<span class="co"># Copyright 2014, William Shotts &lt;bshotts@users.sourceforge.net&gt;</span>
  
<span class="co"># This program is free software: you can redistribute it and/or modify</span>
<span class="co"># it under the terms of the GNU General Public License as published by</span>
<span class="co"># the Free Software Foundation, either version 3 of the License, or</span>
<span class="co"># (at your option) any later version.</span>

<span class="co"># This program is distributed in the hope that it will be useful,</span>
<span class="co"># but WITHOUT ANY WARRANTY; without even the implied warranty of</span>
<span class="co"># MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the</span>
<span class="co"># GNU General Public License at &lt;http://www.gnu.org/licenses/&gt; for</span>
<span class="co"># more details.</span>

<span class="co"># This program creates an annotated list of the programs in /usr/bin</span>
<span class="co"># (or user-specified directory) including the filename, the package</span>
<span class="co"># from which it was installed and a brief description taken from the</span>
<span class="co"># program&#39;s man page, if available. The format of the listing can be</span>
<span class="co"># plain text (the default), tab-separated values (useful for importing</span>
<span class="co"># the listing into other programs), or Markdown format (with pandoc</span>
<span class="co"># table extensions).</span>

<span class="co"># Usage:  program_list [-h|--help]</span>
<span class="co">#         program_list [[-m|--markdown]|[-t|--tabs]] [directory]</span>

<span class="co"># Revision history:</span>
<span class="co"># 2014-01-27 Strengthened against ugly file names (ver. 1.1)</span>
<span class="co"># 2014-01-17 Created by new_script ver. 3.1</span>
<span class="co"># ---------------------------------------------------------------------------</span>

<span class="ot">PROGNAME=${0##</span>*/<span class="ot">}</span>
<span class="ot">VERSION=</span><span class="st">&quot;1.1&quot;</span>

<span class="fu">clean_up()</span> <span class="kw">{</span> <span class="co"># Perform pre-exit housekeeping</span>
  <span class="kw">return</span>
<span class="kw">}</span>

<span class="fu">error_exit()</span> <span class="kw">{</span> <span class="co"># Handle fatal errors</span>
  <span class="kw">echo</span> -e <span class="st">&quot;</span><span class="ot">${PROGNAME}</span><span class="st">: </span><span class="ot">${1:-</span><span class="st">&quot;Unknown Error&quot;</span><span class="ot">}</span><span class="st">&quot;</span> <span class="kw">&gt;&amp;2</span>
  clean_up
  <span class="kw">exit</span> 1
<span class="kw">}</span>

<span class="fu">graceful_exit()</span> <span class="kw">{</span>
  clean_up
  <span class="kw">exit</span>
<span class="kw">}</span>

<span class="fu">signal_exit()</span> <span class="kw">{</span> <span class="co"># Handle trapped signals</span>
  <span class="kw">case</span> <span class="ot">$1</span><span class="kw"> in</span>
    INT<span class="kw">)</span>
      error_exit <span class="st">&quot;Program interrupted by user&quot;</span> <span class="kw">;;</span>
    TERM<span class="kw">)</span>
      <span class="kw">echo</span> -e <span class="st">&quot;\n</span><span class="ot">$PROGNAME</span><span class="st">: Program terminated&quot;</span> <span class="kw">&gt;&amp;2</span>
      graceful_exit <span class="kw">;;</span>
    *<span class="kw">)</span>
      error_exit <span class="st">&quot;</span><span class="ot">$PROGNAME</span><span class="st">: Terminating on unknown signal&quot;</span> <span class="kw">;;</span>
  <span class="kw">esac</span>
<span class="kw">}</span>

<span class="fu">usage()</span> <span class="kw">{</span>
  <span class="kw">echo</span> -e <span class="st">&quot;Usage: </span><span class="ot">$PROGNAME</span><span class="st"> [-h|--help]|[[-m|-t] [directory]]&quot;</span>
<span class="kw">}</span>

<span class="fu">help_message()</span> <span class="kw">{</span>
  <span class="kw">cat</span> <span class="kw">&lt;&lt;</span>- _EOF_
  <span class="ot">$PROGNAME</span> ver<span class="kw">.</span> <span class="ot">$VERSION</span>
  Produce an annotated listing of programs <span class="kw">in</span> a directory

  <span class="ot">$(</span>usage<span class="ot">)</span>

  Options:
  -h, --help      Display this <span class="kw">help</span> message and exit.
  -m, --markdown  Output Markdown formatted text <span class="kw">(</span>with pandoc
                  extensions<span class="kw">)</span>.
  -t, --tabs      Output tab-separated values.
  
  directory is optional<span class="kw">.</span> Default is /usr/bin.

_EOF_
  <span class="kw">return</span>
<span class="kw">}</span>

<span class="fu">set_mode()</span> <span class="kw">{</span> <span class="co"># Set the output mode</span>
  <span class="kw">if </span>[[ <span class="ot">$mode</span> == <span class="st">&quot;empty&quot;</span> ]]; <span class="kw">then</span>
    <span class="ot">mode=$1</span>
  <span class="kw">else</span>
    error_exit <span class="st">&quot;Only one mode (-m or -t) is allowed.&quot;</span>
  <span class="kw">fi</span>
<span class="kw">}</span>

<span class="fu">string()</span> <span class="kw">{</span> <span class="co"># Write a string of character &quot;char&quot; repeated &quot;width&quot; times</span>

  <span class="kw">local</span> -i <span class="ot">width=</span><span class="st">&quot;</span><span class="ot">$1</span><span class="st">&quot;</span>
  <span class="kw">local</span> <span class="ot">char=</span><span class="st">&quot;</span><span class="ot">$2</span><span class="st">&quot;</span>

  <span class="kw">head</span> -c <span class="st">&quot;</span><span class="ot">$width</span><span class="st">&quot;</span> <span class="kw">&lt;</span> /dev/zero <span class="kw">|</span> <span class="kw">tr</span> <span class="st">&#39;\0&#39;</span> <span class="st">&quot;</span><span class="ot">$char</span><span class="st">&quot;</span>
<span class="kw">}</span>

<span class="fu">find_package()</span> <span class="kw">{</span> <span class="co"># Search for package name based on distro</span>

  <span class="kw">local</span> <span class="ot">filename=</span><span class="st">&quot;</span><span class="ot">$1</span><span class="st">&quot;</span> <span class="ot">raw_package</span>

  <span class="kw">case</span> <span class="ot">$distro_style</span><span class="kw"> in</span>
    debian<span class="kw">)</span>
      <span class="ot">raw_package=</span><span class="st">&quot;</span><span class="ot">$(</span>dpkg-query -S <span class="st">&quot;</span><span class="ot">$filename</span><span class="st">&quot;</span> <span class="kw">2&gt;</span> /dev/null <span class="kw">|</span> <span class="kw">tail</span> -1<span class="ot">)</span><span class="st">&quot;</span>
      <span class="kw">echo</span> <span class="st">&quot;</span><span class="ot">${raw_package%</span>:*<span class="ot">}</span><span class="st">&quot;</span>
      <span class="kw">;;</span>
    redhat<span class="kw">)</span>
      rpm -qf <span class="st">&quot;</span><span class="ot">$filename</span><span class="st">&quot;</span> <span class="kw">2&gt;</span> /dev/null
      <span class="kw">;;</span>
    *<span class="kw">)</span>
      error_exit <span class="st">&quot;Unsupported distribution.&quot;</span>
      <span class="kw">;;</span>
  <span class="kw">esac</span>
<span class="kw">}</span>

<span class="co"># Trap signals</span>
<span class="kw">trap</span> <span class="st">&quot;signal_exit TERM&quot;</span> TERM HUP
<span class="kw">trap</span> <span class="st">&quot;signal_exit INT&quot;</span>  INT

<span class="co"># Parse command-line</span>
<span class="ot">mode=</span>empty
<span class="ot">program_directory=</span>/usr/bin
<span class="kw">while [[</span> <span class="ot">-n</span> <span class="st">&quot;</span><span class="ot">$1</span><span class="st">&quot;</span><span class="kw"> ]]</span>; <span class="kw">do</span>
  <span class="kw">case</span> <span class="st">&quot;</span><span class="ot">$1</span><span class="st">&quot;</span><span class="kw"> in</span>
    -h <span class="kw">|</span> --help<span class="kw">)</span>
      help_message
      graceful_exit
      <span class="kw">;;</span>
    -m <span class="kw">|</span> --markdown<span class="kw">)</span>
      set_mode markdown
      <span class="kw">;;</span>
    -t <span class="kw">|</span> --tabs<span class="kw">)</span>
      set_mode tsv
      <span class="kw">;;</span>
    -* <span class="kw">|</span> --*<span class="kw">)</span>
      usage
      error_exit <span class="st">&quot;Unknown option </span><span class="ot">$1</span><span class="st">&quot;</span>
      <span class="kw">;;</span>
    *<span class="kw">)</span>
      <span class="ot">program_directory=</span><span class="st">&quot;</span><span class="ot">$1</span><span class="st">&quot;</span>
      <span class="kw">break</span>
      <span class="kw">;;</span>
  <span class="kw">esac</span>
  <span class="kw">shift</span>
<span class="kw">done</span>

<span class="co"># Main logic</span>

<span class="kw">declare</span> -a <span class="ot">filenames</span> <span class="ot">packages</span> <span class="ot">descriptions</span>
<span class="kw">declare</span> -i <span class="ot">index=</span>1 <span class="ot">max_fn_len=</span>0 <span class="ot">fn_len=</span>0 <span class="ot">col1_width</span> <span class="ot">col2_width</span>
<span class="ot">distro_style=</span><span class="st">&quot;unknown&quot;</span>

<span class="co"># Determine type of packaging system</span>
<span class="kw">[[</span> <span class="ot">-x</span> /usr/bin/apt-get<span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="ot">distro_style=</span><span class="st">&quot;debian&quot;</span>
<span class="kw">[[</span> <span class="ot">-x</span> /bin/rpm || <span class="ot">-x</span> /usr/bin/rpm<span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="ot">distro_style=</span><span class="st">&quot;redhat&quot;</span>

<span class="co"># Check if program_directory is valid</span>
<span class="kw">[[</span> <span class="ot">-d</span> <span class="st">&quot;</span><span class="ot">$program_directory</span><span class="st">&quot;</span><span class="kw"> ]]</span> <span class="kw">||</span> <span class="kw">\</span>
  error_exit <span class="st">&quot;</span><span class="ot">$program_directory</span><span class="st"> cannot be read&quot;</span>
  
<span class="co"># Load arrays with filenames, packages, and descriptions</span>
<span class="kw">while</span> <span class="ot">IFS=</span> read -r i; do
  <span class="ot">filenames[index]=</span><span class="st">&quot;</span><span class="ot">${i##</span>*/<span class="ot">}</span><span class="st">&quot;</span>
  <span class="ot">fn_len=</span>$<span class="dt">{#filenames[index]}</span>
  <span class="co"># Determine longest filename for column width calculation</span>
 <span class="kw"> [[</span> <span class="ot">$fn_len</span> <span class="ot">-gt</span> <span class="ot">$max_fn_len</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="ot">max_fn_len=$fn_len</span>

  <span class="ot">packages[index]=</span><span class="st">&quot;</span><span class="ot">$(</span>find_package <span class="st">&quot;</span><span class="ot">$i</span><span class="st">&quot;</span><span class="ot">)</span><span class="st">&quot;</span>

  <span class="co"># Get program description, strip off beginning and capitalize</span>
  <span class="co"># first letter of first word.</span>
  <span class="ot">raw_description=</span><span class="st">&quot;</span><span class="ot">$(</span><span class="kw">whatis</span> <span class="st">&quot;</span><span class="ot">${filenames[index]}</span><span class="st">&quot;</span> <span class="kw">2&gt;</span>/dev/null <span class="kw">|</span> <span class="kw">head</span> -1<span class="ot">)</span><span class="st">&quot;</span>
  <span class="ot">raw_description=</span><span class="st">&quot;</span><span class="ot">${raw_description##</span>*<span class="st">&#39; - &#39;</span><span class="ot">}</span><span class="st">&quot;</span>
  <span class="ot">descriptions[index]=</span><span class="st">&quot;</span><span class="ot">${raw_description</span><span class="er">^*</span><span class="ot">}</span><span class="st">&quot;</span>

  <span class="kw">((</span>++index<span class="kw">))</span>
<span class="kw">done</span> <span class="kw">&lt;</span> <span class="kw">&lt;(find</span> <span class="st">&quot;</span><span class="ot">$program_directory</span><span class="st">&quot;</span> -mindepth 1 -maxdepth 1 -executable <span class="kw">\</span>
          -not -type d <span class="kw">|</span> <span class="kw">sort</span> -u<span class="kw">)</span>

<span class="co"># Insert Markdown header</span>
<span class="kw">if </span>[[ <span class="ot">$mode</span> == <span class="st">&quot;markdown&quot;</span> ]]; <span class="kw">then</span>
  <span class="ot">markdown_header=</span><span class="st">&quot;Programs in </span><span class="ot">$program_directory</span><span class="st">&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;</span><span class="ot">$markdown_header</span><span class="st">\n</span><span class="ot">$(</span>string <span class="ot">${#markdown_header}</span> <span class="st">&quot;=&quot;</span><span class="ot">)</span><span class="st">\n\n&quot;</span>
  <span class="kw">((</span>max_fn_len += 4<span class="kw">))</span> <span class="co"># allow for extra characters added to filenames</span>
<span class="kw">fi</span>

<span class="co"># Calculate column widths</span>
<span class="ot">col1_width=$((</span>max_fn_len + 1<span class="ot">))</span>
<span class="ot">col2_width=$((</span>80 - col1_width<span class="ot">))</span>

<span class="co"># Insert Markdown table</span>
<span class="kw">if </span>[[ <span class="ot">$mode</span> == <span class="st">&quot;markdown&quot;</span> ]]; <span class="kw">then</span>
  <span class="kw">echo</span> <span class="st">&quot;</span><span class="ot">$(</span>string <span class="ot">$max_fn_len</span> <span class="st">&#39;-&#39;</span><span class="ot">)</span><span class="st"> </span><span class="ot">$(</span>string <span class="ot">$col2_width</span> <span class="st">&#39;-&#39;</span><span class="ot">)</span><span class="st">&quot;</span>
<span class="kw">fi</span>

<span class="kw">for</span> <span class="kw">((</span>i=1; i&lt;index; ++i<span class="kw">))</span>; <span class="kw">do</span>
  <span class="kw">case</span> <span class="ot">$mode</span><span class="kw"> in</span>
    empty<span class="kw">)</span>
      <span class="kw">printf</span> <span class="st">&quot;%-</span><span class="ot">${max_fn_len}</span><span class="st">s Package:%s\n&quot;</span> <span class="kw">\</span>
        <span class="st">&quot;</span><span class="ot">${filenames[i]}</span><span class="st">&quot;</span> <span class="kw">\</span>
        <span class="st">&quot;</span><span class="ot">${packages[i]}</span><span class="st">&quot;</span>
      <span class="co"># Fold description for second column</span>
      <span class="kw">echo</span> <span class="st">&quot;</span><span class="ot">${descriptions[i]}</span><span class="st">&quot;</span> <span class="kw">|</span> <span class="kw">\</span>
        fold -s -w <span class="ot">$col2_width</span> <span class="kw">|</span> <span class="kw">\</span>
        <span class="kw">pr</span> -T -o <span class="ot">$col1_width</span>
      <span class="kw">echo</span>
      <span class="kw">;;</span>
    tsv<span class="kw">)</span>
      <span class="kw">printf</span> <span class="st">&quot;%s\t%s\t%s\n&quot;</span> <span class="kw">\</span>
        <span class="st">&quot;</span><span class="ot">${filenames[i]}</span><span class="st">&quot;</span> <span class="kw">\</span>
        <span class="st">&quot;</span><span class="ot">${packages[i]}</span><span class="st">&quot;</span> <span class="kw">\</span>
        <span class="st">&quot;</span><span class="ot">${descriptions[i]}</span><span class="st">&quot;</span> 
      <span class="kw">;;</span>
    markdown<span class="kw">)</span>
      <span class="kw">printf</span> <span class="st">&quot;%-</span><span class="ot">${max_fn_len}</span><span class="st">s Package:%s\n\n&quot;</span> <span class="kw">\</span>
        <span class="st">&quot;**</span><span class="ot">${filenames[i]}</span><span class="st">**&quot;</span> <span class="kw">\</span>
        <span class="st">&quot;</span><span class="ot">${packages[i]}</span><span class="st">&quot;</span>
      <span class="kw">echo</span> <span class="st">&quot;</span><span class="ot">${descriptions[i]}</span><span class="st">&quot;</span> <span class="kw">|</span> <span class="kw">\</span>
        fold -s -w <span class="ot">$col2_width</span> <span class="kw">|</span> <span class="kw">\</span>
        <span class="kw">pr</span> -T -o <span class="ot">$col1_width</span>
      <span class="kw">echo</span>
      <span class="kw">;;</span>
  <span class="kw">esac</span>
<span class="kw">done</span>

<span class="co"># Close Markdown table</span>
<span class="kw">[[</span> <span class="ot">$mode</span> <span class="ot">==</span> <span class="st">&quot;markdown&quot;</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="kw">echo</span> -e <span class="st">&quot;</span><span class="ot">$(</span>string 80 <span class="st">&#39;-&#39;</span><span class="ot">)</span><span class="st">\n&quot;</span>

graceful_exit</code></pre>


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