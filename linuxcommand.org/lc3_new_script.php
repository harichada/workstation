



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: new_script</title>
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
<h1 id="new_script">new_script</h1>
<p>This is a shell script template generator (i.e. a script that writes scripts). It is used to create the boilerplate portions of a shell script. It asks the user a series of questions about the script to be generated and then writes the resulting script to a file. Scripts generated with new_script include error and signal handling routines, a command-line option and argument parser, and basic command-line help. Complete instructions and examples can be found <a href="http://lcorg.blogspot.com/2012/10/newscript-version-3.html">here.</a></p>
<h2 id="listing">Listing</h2>
<pre class="sourceCode bash" id="new_script"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>
<span class="co"># ---------------------------------------------------------------------------</span>
<span class="co"># new_script - Bash shell script template generator</span>

<span class="co"># Copyright 2012, William Shotts &lt;bshotts@users.sourceforge.net&gt;</span>

<span class="co"># This program is free software: you can redistribute it and/or modify</span>
<span class="co"># it under the terms of the GNU General Public License as published by</span>
<span class="co"># the Free Software Foundation, either version 3 of the License, or</span>
<span class="co"># (at your option) any later version.</span>

<span class="co"># This program is distributed in the hope that it will be useful,</span>
<span class="co"># but WITHOUT ANY WARRANTY; without even the implied warranty of</span>
<span class="co"># MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the</span>
<span class="co"># GNU General Public License at &lt;http://www.gnu.org/licenses/&gt; for</span>
<span class="co"># more details.</span>

<span class="co"># Usage: new_script [-h|--help] [-q|--quiet] [-s|--root] [script]</span>

<span class="co"># Revision history:</span>
<span class="co"># 2014-03-20  Corrected bug in insert_help_message() discovered by</span>
<span class="co">#             Lev Gorenstein &lt;lev@ledorub.poxod.com&gt; (3.3)</span>
<span class="co"># 2014-01-21  Minor formatting corrections (3.2)</span>
<span class="co"># 2014-01-12  Various cleanups (3.1)</span>
<span class="co"># 2012-05-14  Created</span>
<span class="co"># ---------------------------------------------------------------------------</span>

<span class="ot">PROGNAME=${0##</span>*/<span class="ot">}</span>
<span class="ot">VERSION=</span><span class="st">&quot;3.3&quot;</span>
<span class="ot">SCRIPT_SHELL=${SHELL}</span>

<span class="co"># Make some pretty date strings</span>
<span class="ot">DATE=$(</span><span class="kw">date</span> +<span class="st">&#39;%Y-%m-%d&#39;</span><span class="ot">)</span>
<span class="ot">YEAR=$(</span><span class="kw">date</span> +<span class="st">&#39;%Y&#39;</span><span class="ot">)</span>

<span class="co"># Get user&#39;s real name from passwd file</span>
<span class="ot">AUTHOR=$(</span><span class="kw">awk</span> -v <span class="ot">USER=$USER</span> <span class="kw">\</span>
  <span class="st">&#39;BEGIN { FS = &quot;:&quot; } $1 == USER { print $5 }&#39;</span> <span class="kw">&lt;</span> /etc/passwd<span class="ot">)</span>

<span class="co"># Construct the user&#39;s email address from the hostname or the REPLYTO</span>
<span class="co"># environment variable, if defined</span>
<span class="ot">EMAIL_ADDRESS=</span><span class="st">&quot;&lt;</span><span class="ot">${REPLYTO:-${USER}</span>@<span class="ot">$HOSTNAME}</span><span class="st">&gt;&quot;</span>

<span class="co"># Arrays for command-line options and option arguments</span>
<span class="kw">declare</span> -a <span class="ot">opt</span> <span class="ot">opt_desc</span> <span class="ot">opt_long</span> <span class="ot">opt_arg</span> <span class="ot">opt_arg_desc</span>


<span class="fu">clean_up()</span> <span class="kw">{</span> <span class="co"># Perform pre-exit housekeeping</span>
  <span class="kw">return</span>
<span class="kw">}</span>

<span class="fu">error_exit()</span> <span class="kw">{</span>
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
  <span class="kw">echo</span> <span class="st">&quot;Usage: </span><span class="ot">${PROGNAME}</span><span class="st"> [-h|--help ] [-q|--quiet] [-s|--root] [script]&quot;</span>
<span class="kw">}</span>

<span class="fu">help_message()</span> <span class="kw">{</span>
  <span class="kw">cat</span> <span class="kw">&lt;&lt;</span>- _EOF_
  <span class="ot">${PROGNAME}</span> <span class="ot">${VERSION}</span>
  Bash shell script template generator.

  <span class="ot">$(</span>usage<span class="ot">)</span>

  Options:

  -h, --help    Display this <span class="kw">help</span> message and exit.
  -q, --quiet   Quiet mode<span class="kw">.</span> No prompting<span class="kw">.</span> Outputs default script.
  -s, --root    Output script requires root privileges to run.

_EOF_
<span class="kw">}</span>

<span class="fu">insert_license()</span> <span class="kw">{</span>

  <span class="kw">if </span>[[ -z <span class="ot">$script_license</span> ]]; <span class="kw">then</span>
    <span class="kw">echo</span> <span class="st">&quot;# All rights reserved.&quot;</span>
    <span class="kw">return</span>
  <span class="kw">fi</span>
  <span class="kw">cat</span> <span class="kw">&lt;&lt;</span>- _EOF_
  
<span class="co"># This program is free software: you can redistribute it and/or modify</span>
<span class="co"># it under the terms of the GNU General Public License as published by</span>
<span class="co"># the Free Software Foundation, either version 3 of the License, or</span>
<span class="co"># (at your option) any later version.</span>

<span class="co"># This program is distributed in the hope that it will be useful,</span>
<span class="co"># but WITHOUT ANY WARRANTY; without even the implied warranty of</span>
<span class="co"># MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the</span>
<span class="co"># GNU General Public License at &lt;http://www.gnu.org/licenses/&gt; for</span>
<span class="co"># more details.</span>
_EOF_
<span class="kw">}</span>

<span class="fu">insert_usage()</span> <span class="kw">{</span>

  <span class="kw">echo</span> -e <span class="st">&quot;usage() {\n  echo </span><span class="dt">\&quot;</span><span class="ot">$usage_str</span><span class="dt">\&quot;</span><span class="st">\n}&quot;</span>
<span class="kw">}</span>

<span class="fu">insert_help_message()</span> <span class="kw">{</span>

  <span class="kw">local</span> <span class="ot">arg</span> <span class="ot">i</span> <span class="ot">long</span>

  <span class="kw">echo</span> -e <span class="st">&quot;help_message() {&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;  cat &lt;&lt;- _EOF_&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;  </span><span class="dt">\$</span><span class="st">PROGNAME ver. </span><span class="dt">\$</span><span class="st">VERSION&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;  </span><span class="ot">$script_purpose</span><span class="st">&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;\n  </span><span class="dt">\$</span><span class="st">(usage)&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;\n  Options:&quot;</span>
  <span class="ot">i=</span>0
  <span class="kw">while [[</span> <span class="ot">${opt[i]}</span><span class="kw"> ]]</span>; <span class="kw">do</span>
    <span class="ot">long=</span>
    <span class="ot">arg=</span>
   <span class="kw"> [[</span> <span class="ot">${opt_long[i]}</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="ot">long=</span><span class="st">&quot;, --</span><span class="ot">${opt_long[i]}</span><span class="st">&quot;</span>
   <span class="kw"> [[</span> <span class="ot">${opt_arg[i]}</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="ot">arg=</span><span class="st">&quot; </span><span class="ot">${opt_arg[i]}</span><span class="st">&quot;</span>
    <span class="kw">echo</span> -e <span class="st">&quot;  -</span><span class="ot">${opt[i]}$long$arg</span><span class="st">  </span><span class="ot">${opt_desc[i]}</span><span class="st">&quot;</span>
   <span class="kw"> [[</span> <span class="ot">${opt_arg[i]}</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="kw">\</span>
      <span class="kw">echo</span> -e <span class="st">&quot;    Where &#39;</span><span class="ot">${opt_arg[i]}</span><span class="st">&#39; is the </span><span class="ot">${opt_arg_desc[i]}</span><span class="st">.&quot;</span>
    <span class="kw">((</span>++i<span class="kw">))</span>
  <span class="kw">done</span>
 <span class="kw"> [[</span> <span class="ot">$root_mode</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="kw">\</span>
    <span class="kw">echo</span> -e <span class="st">&quot;\n  NOTE: You must be the superuser to run this script.&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;\n_EOF_&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;  return\n}&quot;</span>
<span class="kw">}</span>

<span class="fu">insert_root_check()</span> <span class="kw">{</span>

  <span class="kw">if </span>[[ <span class="ot">$root_mode</span> ]]; <span class="kw">then</span>
    <span class="kw">echo</span> -e <span class="st">&quot;# Check for root UID&quot;</span>
    <span class="kw">echo</span> -e <span class="st">&quot;if [[ </span><span class="dt">\$</span><span class="st">(id -u) != 0 ]]; then&quot;</span>
    <span class="kw">echo</span> -e <span class="st">&quot;  error_exit </span><span class="dt">\&quot;</span><span class="st">You must be the superuser to run this script.</span><span class="dt">\&quot;</span><span class="st">&quot;</span>
    <span class="kw">echo</span> -e <span class="st">&quot;fi&quot;</span>
  <span class="kw">fi</span>
<span class="kw">}</span>

<span class="fu">insert_parser()</span> <span class="kw">{</span>

  <span class="kw">local</span> <span class="ot">i</span>
  
  <span class="kw">echo</span> -e <span class="st">&quot;while [[ -n </span><span class="dt">\$</span><span class="st">1 ]]; do\n  case </span><span class="dt">\$</span><span class="st">1 in&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;    -h | --help)\n      help_message; graceful_exit ;;&quot;</span>
  <span class="kw">for</span> <span class="kw">((</span> i = 1; i &lt; <span class="ot">${#opt[@]}</span>; i++ <span class="kw">))</span>; <span class="kw">do</span>
    <span class="kw">echo</span> -ne <span class="st">&quot;    -</span><span class="ot">${opt[i]}</span><span class="st">&quot;</span>
   <span class="kw"> [[</span> <span class="ot">-n</span> <span class="ot">${opt_long[i]}</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="kw">echo</span> -ne <span class="st">&quot; | --</span><span class="ot">${opt_long[i]}</span><span class="st">&quot;</span>
    <span class="kw">echo</span> -ne <span class="st">&quot;)\n      echo </span><span class="dt">\&quot;</span><span class="ot">${opt_desc[i]}</span><span class="dt">\&quot;</span><span class="st">&quot;</span>
   <span class="kw"> [[</span> <span class="ot">-n</span> <span class="ot">${opt_arg[i]}</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="kw">echo</span> -ne <span class="st">&quot;; shift; </span><span class="ot">${opt_arg[i]}</span><span class="st">=</span><span class="dt">\&quot;\$</span><span class="st">1</span><span class="dt">\&quot;</span><span class="st">&quot;</span>
    <span class="kw">echo</span> <span class="st">&quot; ;;&quot;</span>
  <span class="kw">done</span>
  <span class="kw">echo</span> -e <span class="st">&quot;    -* | --*)\n      usage&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;      error_exit </span><span class="dt">\&quot;</span><span class="st">Unknown option </span><span class="dt">\$</span><span class="st">1</span><span class="dt">\&quot;</span><span class="st"> ;;&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;    *)\n      echo </span><span class="dt">\&quot;</span><span class="st">Argument </span><span class="dt">\$</span><span class="st">1 to process...</span><span class="dt">\&quot;</span><span class="st"> ;;&quot;</span>
  <span class="kw">echo</span> -e <span class="st">&quot;  esac\n  shift\ndone&quot;</span>
<span class="kw">}</span>

<span class="fu">write_script()</span> <span class="kw">{</span>

<span class="co">#############################################################################</span>
<span class="co"># START SCRIPT TEMPLATE</span>
<span class="co">#############################################################################</span>
<span class="kw">cat</span> <span class="kw">&lt;&lt;</span> _EOF_
<span class="co">#!$SCRIPT_SHELL</span>
<span class="co"># ---------------------------------------------------------------------------</span>
<span class="co"># $script_name - $script_purpose</span>

<span class="co"># Copyright $YEAR, $AUTHOR $EMAIL_ADDRESS</span>
<span class="ot">$(</span>insert_license<span class="ot">)</span>

<span class="co"># Usage: $script_name$usage_message</span>

<span class="co"># Revision history:</span>
<span class="co"># $DATE Created by $PROGNAME ver. $VERSION</span>
<span class="co"># ---------------------------------------------------------------------------</span>

<span class="ot">PROGNAME=</span><span class="dt">\${0##*/}</span>
<span class="ot">VERSION=</span><span class="st">&quot;0.1&quot;</span>

<span class="fu">clean_up()</span> <span class="kw">{</span> <span class="co"># Perform pre-exit housekeeping</span>
  <span class="kw">return</span>
<span class="kw">}</span>

<span class="fu">error_exit()</span> <span class="kw">{</span>
  <span class="kw">echo</span> -e <span class="st">&quot;</span><span class="dt">\$</span><span class="st">{PROGNAME}: </span><span class="dt">\$</span><span class="st">{1:-&quot;</span>Unknown Error<span class="st">&quot;}&quot;</span> <span class="kw">&gt;&amp;2</span>
  clean_up
  <span class="kw">exit</span> 1
<span class="kw">}</span>

<span class="fu">graceful_exit()</span> <span class="kw">{</span>
  clean_up
  <span class="kw">exit</span>
<span class="kw">}</span>

<span class="fu">signal_exit()</span> <span class="kw">{</span> <span class="co"># Handle trapped signals</span>
  <span class="kw">case</span> <span class="dt">\$</span>1<span class="kw"> in</span>
    INT<span class="kw">)</span>
      error_exit <span class="st">&quot;Program interrupted by user&quot;</span> <span class="kw">;;</span>
    TERM<span class="kw">)</span>
      <span class="kw">echo</span> -e <span class="st">&quot;\n</span><span class="dt">\$</span><span class="st">PROGNAME: Program terminated&quot;</span> <span class="kw">&gt;&amp;2</span>
      graceful_exit <span class="kw">;;</span>
    *<span class="kw">)</span>
      error_exit <span class="st">&quot;</span><span class="dt">\$</span><span class="st">PROGNAME: Terminating on unknown signal&quot;</span> <span class="kw">;;</span>
  <span class="kw">esac</span>
<span class="kw">}</span>

<span class="fu">usage()</span> <span class="kw">{</span>
  <span class="kw">echo</span> -e <span class="st">&quot;Usage: </span><span class="dt">\$</span><span class="st">PROGNAME</span><span class="ot">$usage_message</span><span class="st">&quot;</span>
<span class="kw">}</span>

<span class="ot">$(</span>insert_help_message<span class="ot">)</span>

<span class="co"># Trap signals</span>
<span class="kw">trap</span> <span class="st">&quot;signal_exit TERM&quot;</span> TERM HUP
<span class="kw">trap</span> <span class="st">&quot;signal_exit INT&quot;</span>  INT

<span class="ot">$(</span>insert_root_check<span class="ot">)</span>

<span class="co"># Parse command-line</span>
<span class="ot">$(</span>insert_parser<span class="ot">)</span>

<span class="co"># Main logic</span>

graceful_exit

_EOF_
<span class="co">#############################################################################</span>
<span class="co"># END SCRIPT TEMPLATE</span>
<span class="co">#############################################################################</span>

<span class="kw">}</span>

<span class="fu">check_filename()</span> <span class="kw">{</span>

  <span class="kw">local</span> <span class="ot">filename=$1</span>
  <span class="kw">local</span> <span class="ot">pathname=${filename%</span>/*<span class="ot">}</span> <span class="co"># Equals filename if no path specified</span>

  <span class="kw">if </span>[[ <span class="ot">$pathname</span> != <span class="ot">$filename</span> ]]; <span class="kw">then</span>
    <span class="kw">if </span>[[ ! -d <span class="ot">$pathname</span> ]]; <span class="kw">then</span>
     <span class="kw"> [[</span> <span class="ot">$quiet_mode</span><span class="kw"> ]]</span> <span class="kw">||</span> <span class="kw">echo</span> <span class="st">&quot;Directory </span><span class="ot">$pathname</span><span class="st"> does not exist.&quot;</span>
      <span class="kw">return</span> 1
    <span class="kw">fi</span>
  <span class="kw">fi</span>
  <span class="kw">if </span>[[ -n <span class="ot">$filename</span> ]]; <span class="kw">then</span>
    <span class="kw">if </span>[[ -e <span class="ot">$filename</span> ]]; <span class="kw">then</span>
      <span class="kw">if </span>[[ -f <span class="ot">$filename</span> <span class="kw">&amp;&amp;</span> -w <span class="ot">$filename</span> ]]; <span class="kw">then</span>
       <span class="kw"> [[</span> <span class="ot">$quiet_mode</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="kw">return</span> 0
        <span class="kw">read</span> -p <span class="st">&quot;File </span><span class="ot">$filename</span><span class="st"> exists. Overwrite [y/n] &gt; &quot;</span>
       <span class="kw"> [[</span> <span class="ot">$REPLY</span> =~ ^[yY]$<span class="kw"> ]]</span> <span class="kw">||</span> <span class="kw">return</span> 1
      <span class="kw">else</span>
        <span class="kw">return</span> 1
      <span class="kw">fi</span>
    <span class="kw">fi</span>
  <span class="kw">else</span>
   <span class="kw"> [[</span> <span class="ot">$quiet_mode</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="kw">return</span> 0 <span class="co"># Empty filename OK in quiet mode</span>
    <span class="kw">return</span> 1
  <span class="kw">fi</span>
<span class="kw">}</span>

<span class="fu">read_option()</span> <span class="kw">{</span>

  <span class="kw">local</span> <span class="ot">i=$((</span>option_count + 1<span class="ot">))</span>

  <span class="kw">echo</span> -e <span class="st">&quot;\nOption </span><span class="ot">$i</span><span class="st">:&quot;</span>
  <span class="kw">read</span> -p <span class="st">&quot;Enter option letter [a-z] (Enter to end) &gt; &quot;</span> 
 <span class="kw"> [[</span> <span class="ot">-n</span> <span class="ot">$REPLY</span><span class="kw"> ]]</span> <span class="kw">||</span> <span class="kw">return</span> 1 <span class="co"># prevent array element if REPLY is empty</span>
  <span class="ot">opt[i]=$REPLY</span>
  <span class="kw">read</span> -p <span class="st">&quot;Description of option -------------------&gt; &quot;</span> <span class="ot">opt_desc[i]</span>
  <span class="kw">read</span> -p <span class="st">&quot;Enter long alternate name (optional) ----&gt; &quot;</span> <span class="ot">opt_long[i]</span>
  <span class="kw">read</span> -p <span class="st">&quot;Enter option argument (if any) ----------&gt; &quot;</span> <span class="ot">opt_arg[i]</span>
 <span class="kw"> [[</span> <span class="ot">-n</span> <span class="ot">${opt_arg[i]}</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="kw">\</span>
  <span class="kw">read</span> -p <span class="st">&quot;Description of argument (if any)---------&gt; &quot;</span> <span class="ot">opt_arg_desc[i]</span>
  <span class="kw">return</span> 0 <span class="co"># force 0 return status regardless of test outcome above</span>
<span class="kw">}</span>

<span class="co"># Trap signals</span>
<span class="kw">trap</span> <span class="st">&quot;signal_exit TERM&quot;</span> TERM HUP
<span class="kw">trap</span> <span class="st">&quot;signal_exit INT&quot;</span>  INT

<span class="co"># Parse command-line</span>
<span class="ot">quiet_mode=</span>
<span class="ot">root_mode=</span>
<span class="ot">script_license=</span>
<span class="kw">while [[</span> <span class="ot">-n</span> <span class="ot">$1</span><span class="kw"> ]]</span>; <span class="kw">do</span>
  <span class="kw">case</span> <span class="ot">$1</span><span class="kw"> in</span>
    -h <span class="kw">|</span> --help<span class="kw">)</span>
      help_message; graceful_exit <span class="kw">;;</span>
    -q <span class="kw">|</span> --quiet<span class="kw">)</span>
      <span class="ot">quiet_mode=</span>yes <span class="kw">;;</span>
    -s <span class="kw">|</span> --root<span class="kw">)</span>
      <span class="ot">root_mode=</span>yes <span class="kw">;;</span>
    -* <span class="kw">|</span> --*<span class="kw">)</span>
      usage; error_exit <span class="st">&quot;Unknown option </span><span class="ot">$1</span><span class="st">&quot;</span> <span class="kw">;;</span>
    *<span class="kw">)</span>
      <span class="ot">tmp_script=$1</span>; break <span class="kw">;;</span>
  <span class="kw">esac</span>
  <span class="kw">shift</span>
<span class="kw">done</span>

<span class="co"># Main logic</span>

<span class="kw">if </span>[[ <span class="ot">$quiet_mode</span> ]]; <span class="kw">then</span>
  <span class="ot">script_filename=</span><span class="st">&quot;</span><span class="ot">$tmp_script</span><span class="st">&quot;</span>
  check_filename <span class="st">&quot;</span><span class="ot">$script_filename</span><span class="st">&quot;</span> <span class="kw">||</span> <span class="kw">\</span>
    error_exit <span class="st">&quot;</span><span class="ot">$script_filename</span><span class="st"> is not writable.&quot;</span>
  <span class="ot">script_purpose=</span><span class="st">&quot;[Enter purpose of script here.]&quot;</span>
<span class="kw">else</span>
  <span class="co"># Get script filename</span>
  <span class="ot">script_filename=</span>
  <span class="kw">while [[</span> <span class="ot">-z</span> <span class="ot">$script_filename</span><span class="kw"> ]]</span>; <span class="kw">do</span>
    <span class="kw">if </span>[[ -n <span class="ot">$tmp_script</span> ]]; <span class="kw">then</span>
      <span class="ot">script_filename=</span><span class="st">&quot;</span><span class="ot">$tmp_script</span><span class="st">&quot;</span>
      <span class="ot">tmp_script=</span>
    <span class="kw">else</span>
      <span class="kw">read</span> -p <span class="st">&quot;Enter script output filename: &quot;</span> <span class="ot">script_filename</span>
    <span class="kw">fi</span>
    <span class="kw">if </span>! check_filename <span class="st">&quot;</span><span class="ot">$script_filename</span><span class="st">&quot;</span>; <span class="kw">then</span>
      <span class="kw">echo</span> <span class="st">&quot;</span><span class="ot">$script_filename</span><span class="st"> is not writable.&quot;</span>
      <span class="kw">echo</span> -e <span class="st">&quot;Please choose another name.\n&quot;</span>
      <span class="ot">script_filename=</span>
    <span class="kw">fi</span>
  <span class="kw">done</span>

  <span class="co"># Purpose</span>
  <span class="kw">read</span> -p <span class="st">&quot;Enter purpose of script: &quot;</span> <span class="ot">script_purpose</span>

  <span class="co"># License</span>
  <span class="kw">read</span> -p <span class="st">&quot;Include GPL license header [y/n]? &gt; &quot;</span>
 <span class="kw"> [[</span> <span class="ot">$REPLY</span> =~ ^[yY]$<span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="ot">script_license=</span><span class="st">&quot;GPL&quot;</span>
  
  <span class="co"># Requires superuser?</span>
  <span class="kw">read</span> -p <span class="st">&quot;Does this script require superuser privileges [y/n]? &quot;</span>
 <span class="kw"> [[</span> <span class="ot">$REPLY</span> =~ ^[yY]$<span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="ot">root_mode=</span><span class="st">&quot;yes&quot;</span>

  <span class="co"># Command-line options</span>
  <span class="ot">option_count=</span>0
  <span class="kw">read</span> -p <span class="st">&quot;Does this script support command-line options [y/n]? &quot;</span>
 <span class="kw"> [[</span> <span class="ot">$REPLY</span> =~ ^[yY]$<span class="kw"> ]]</span> <span class="kw">\</span>
    <span class="kw">&amp;&amp;</span> <span class="kw">while</span> read_option; <span class="kw">do</span> <span class="kw">((</span>++option_count<span class="kw">))</span>; <span class="kw">done</span>
<span class="kw">fi</span>

<span class="ot">script_name=${script_filename##</span>*/<span class="ot">}</span> <span class="co"># Strip path from filename</span>
<span class="ot">script_name=${script_name:-</span><span class="st">&quot;[Untitled Script]&quot;</span><span class="ot">}</span> <span class="co"># Set default if enmpty</span>

<span class="co"># &quot;help&quot; option included by default</span>
<span class="ot">opt[0]=</span><span class="st">&quot;h&quot;</span>
<span class="ot">opt_long[0]=</span><span class="st">&quot;help&quot;</span>
<span class="ot">opt_desc[0]=</span><span class="st">&quot;Display this help message and exit.&quot;</span>

<span class="co"># Create usage message</span>
<span class="ot">usage_message=</span>  
<span class="ot">i=</span>0
<span class="kw">while [[</span> <span class="ot">${opt[i]}</span><span class="kw"> ]]</span>; <span class="kw">do</span>
  <span class="ot">arg=</span><span class="st">&quot;]&quot;</span>
 <span class="kw"> [[</span> <span class="ot">${opt_arg[i]}</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="ot">arg=</span><span class="st">&quot; </span><span class="ot">${opt_arg[i]}</span><span class="st">]&quot;</span>
  <span class="ot">usage_message=</span><span class="st">&quot;</span><span class="ot">$usage_message</span><span class="st"> [-</span><span class="ot">${opt[i]}</span><span class="st">&quot;</span>
 <span class="kw"> [[</span> <span class="ot">${opt_long[i]}</span><span class="kw"> ]]</span> <span class="kw">\</span>
    <span class="kw">&amp;&amp;</span> <span class="ot">usage_message=</span><span class="st">&quot;</span><span class="ot">$usage_message</span><span class="st">|--</span><span class="ot">${opt_long[i]}</span><span class="st">&quot;</span>
  <span class="ot">usage_message=</span><span class="st">&quot;</span><span class="ot">$usage_message$arg</span><span class="st">&quot;</span>
  <span class="kw">((</span>++i<span class="kw">))</span>
<span class="kw">done</span>

<span class="co"># Generate script</span>
<span class="kw">if </span>[[ <span class="ot">$script_filename</span> ]]; <span class="kw">then</span> <span class="co"># Write script to file</span>
  write_script <span class="kw">&gt;</span> <span class="st">&quot;</span><span class="ot">$script_filename</span><span class="st">&quot;</span>
  <span class="kw">chmod</span> +x <span class="st">&quot;</span><span class="ot">$script_filename</span><span class="st">&quot;</span>
<span class="kw">else</span>
  write_script <span class="co"># Write script to stdout</span>
<span class="kw">fi</span>
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