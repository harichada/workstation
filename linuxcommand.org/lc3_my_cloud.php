



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: my_cloud</title>
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
<h1 id="my_cloud">my_cloud</h1>
<p>This script provides a sort of &quot;stone-age Dropbox&quot; if you have access to a remote host running a secure shell (ssh) server. To use this script you will need a directory named <code>cloud</code> inside your HOME directory on the remote host. You can then copy files to (put), copy files from (get), list files in, and delete files in your <code>cloud</code> directory on the remote host.</p>
<h2 id="examples">Examples</h2>
<pre><code>me@linuxbox ~ $ my_cloud -c me@remotehost -l</code></pre>
<p>Lists the files in the <code>cloud</code> directory on the remote host.</p>
<pre><code>me@linuxbox ~ $ my_cloud -c me@remotehost -p .bashrc</code></pre>
<p>Copies the file <code>.bashrc</code> on the local host into the <code>cloud</code> directory on the remote host.</p>
<pre><code>me@linuxbox ~ $ my_cloud -c me@remotehost -g my_file</code></pre>
<p>Copies the file <code>my_file</code> from the <code>cloud</code> directory on the remote host to the current directory on the local host.</p>
<pre><code>me@linuxbox ~ $ my_cloud -c me@remotehost -d my_file</code></pre>
<p>Deletes the file <code>my_file</code> from the <code>cloud</code> directory on the remote host.</p>
<p>Note that the script does not copy directories, only files between systems, nor does it provide syncing of one directory with another like a &quot;real&quot; cloud storage client.</p>
<h2 id="tip">Tip</h2>
<p>To improve ease-of-use, you can add an alias to your <code>.bashrc</code> file to eliminate the need for specifying the user@host for hosts you frequently use:</p>
<pre><code>alias mc_remotehost=&#39;my_cloud -c me@remotehost&#39;</code></pre>
<h2 id="listing">Listing</h2>
<pre class="sourceCode bash" id="my_cloud"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>
<span class="co"># ---------------------------------------------------------------------------</span>
<span class="co"># my_cloud - Store and retrieve files on a remote server</span>

<span class="co"># Copyright 2013, William Shotts &lt;bshotts@users.sourceforge.com&gt;</span>

<span class="co"># This program is free software: you can redistribute it and/or modify</span>
<span class="co"># it under the terms of the GNU General Public License as published by</span>
<span class="co"># the Free Software Foundation, either version 3 of the License, or</span>
<span class="co"># (at your option) any later version.</span>

<span class="co"># This program is distributed in the hope that it will be useful,</span>
<span class="co"># but WITHOUT ANY WARRANTY; without even the implied warranty of</span>
<span class="co"># MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the</span>
<span class="co"># GNU General Public License at &lt;http://www.gnu.org/licenses/&gt; for</span>
<span class="co"># more details.</span>

<span class="co"># Prerequsites:</span>
<span class="co"># my_cloud expect that remote hosts have a directory named &#39;cloud&#39;</span>
<span class="co"># within the user&#39;s home directory. </span>

<span class="co"># Usage:</span>
<span class="co"># my_cloud -h|--help</span>
<span class="co"># my_cloud -c|--cloud user@host -l|--list</span>
<span class="co"># my_cloud -c|--cloud user@host -g|--get file...</span>
<span class="co"># my_cloud -c|--cloud user@host -p|--put file...</span>
<span class="co"># my_cloud -c|--cloud user@host -d|--delete file...</span>

<span class="co"># Revision history:</span>
<span class="co"># 2013-12-30  Created by new_script ver. 3.0</span>
<span class="co"># ---------------------------------------------------------------------------</span>

<span class="ot">PROGNAME=${0##</span>*/<span class="ot">}</span>
<span class="ot">VERSION=</span><span class="st">&quot;0.1&quot;</span>

<span class="fu">clean_up()</span> <span class="kw">{</span> <span class="co"># Perform pre-exit housekeeping</span>
  <span class="kw">return</span>
<span class="kw">}</span>

<span class="fu">error_exit()</span> <span class="kw">{</span> <span class="co"># Handle fatal error</span>
  <span class="kw">echo</span> -e <span class="st">&quot;</span><span class="ot">${PROGNAME}</span><span class="st">: </span><span class="ot">${1:-</span><span class="st">&quot;Unknown Error&quot;</span><span class="ot">}</span><span class="st">&quot;</span> <span class="kw">&gt;&amp;2</span>
  clean_up
  <span class="kw">exit</span> 1
<span class="kw">}</span>

<span class="fu">graceful_exit()</span> <span class="kw">{</span> <span class="co"># Normal exit</span>
  clean_up
  <span class="kw">exit</span>
<span class="kw">}</span>

<span class="fu">signal_exit()</span> <span class="kw">{</span> <span class="co"># Handle trapped signals</span>
  <span class="kw">case</span> <span class="ot">$1</span><span class="kw"> in</span>
    INT<span class="kw">)</span>    error_exit <span class="st">&quot;Program interrupted by user&quot;</span> <span class="kw">;;</span>
    TERM<span class="kw">)</span>   <span class="kw">echo</span> -e <span class="st">&quot;\nnew_script: Program terminated&quot;</span> <span class="kw">&gt;&amp;2</span> ; graceful_exit <span class="kw">;;</span>
    *<span class="kw">)</span>      error_exit <span class="st">&quot;new_script: Terminating on unknown signal&quot;</span> <span class="kw">;;</span>
  <span class="kw">esac</span>
<span class="kw">}</span>

<span class="fu">usage()</span> <span class="kw">{</span>
  <span class="kw">echo</span> -e <span class="st">&quot;Usage: </span><span class="ot">$PROGNAME</span><span class="st"> [-h ]|[-c user@host [-l]|[-g|-p|-d file...]]&quot;</span>
<span class="kw">}</span>

<span class="fu">help_message()</span> <span class="kw">{</span>
  <span class="kw">cat</span> <span class="kw">&lt;&lt;</span>- _EOF_
  <span class="ot">$PROGNAME</span> ver<span class="kw">.</span> <span class="ot">$VERSION</span>
  Store and retrieve files on a remote server

  <span class="ot">$(</span>usage<span class="ot">)</span>

  Options:
  -h, --help              Display this <span class="kw">help</span> message and exit.
  -c, --cloud user@host   Remote server <span class="kw">login</span>, where <span class="st">&#39;user@host&#39;</span> 
                          is the <span class="kw">login</span> name and host.
  -l, --list              List files on remote server
  -g, --get file..<span class="kw">.</span>       Get <span class="kw">file(</span>s<span class="kw">)</span> from remote server
  -p, --put file..<span class="kw">.</span>       Put <span class="kw">file(</span>s<span class="kw">)</span> on remote server
  -d, --delete file..<span class="kw">.</span>    Delete <span class="kw">file(</span>s<span class="kw">)</span> on remote server

_EOF_
  <span class="kw">return</span>
<span class="kw">}</span>

<span class="fu">set_mode()</span> <span class="kw">{</span>
  <span class="kw">if </span>[[ <span class="ot">$mode</span> == <span class="st">&quot;empty&quot;</span> ]]; <span class="kw">then</span>
    <span class="ot">mode=$1</span>
  <span class="kw">else</span>
    error_exit <span class="st">&quot;Only one mode (-l, -g, -p, -d) is allowed.&quot;</span>
  <span class="kw">fi</span>
<span class="kw">}</span>

<span class="co"># Trap signals</span>
<span class="kw">trap</span> <span class="st">&quot;signal_exit TERM&quot;</span> TERM HUP
<span class="kw">trap</span> <span class="st">&quot;signal_exit INT&quot;</span>  INT

<span class="co"># Parse command-line</span>
<span class="ot">mode=</span>empty
<span class="ot">file_list=</span>
<span class="kw">while [[</span> <span class="ot">-n</span> <span class="ot">$1</span><span class="kw"> ]]</span>; <span class="kw">do</span>
  <span class="kw">case</span> <span class="ot">$1</span><span class="kw"> in</span>
    -h <span class="kw">|</span> --help<span class="kw">)</span>    help_message; graceful_exit <span class="kw">;;</span>
    -c <span class="kw">|</span> --cloud<span class="kw">)</span>   <span class="kw">shift</span>; <span class="ot">user_host=</span><span class="st">&quot;</span><span class="ot">$1</span><span class="st">&quot;</span> <span class="kw">;;</span>
    -l <span class="kw">|</span> --list<span class="kw">)</span>    set_mode list <span class="kw">;;</span>
    -g <span class="kw">|</span> --get<span class="kw">)</span>     set_mode get <span class="kw">;;</span>
    -p <span class="kw">|</span> --put<span class="kw">)</span>     set_mode put <span class="kw">;;</span>
    -d <span class="kw">|</span> --delete<span class="kw">)</span>  set_mode delete <span class="kw">;;</span>
    -* <span class="kw">|</span> --*<span class="kw">)</span>       usage; error_exit <span class="st">&quot;Unknown option </span><span class="ot">$1</span><span class="st">&quot;</span> <span class="kw">;;</span>
    *<span class="kw">)</span>  <span class="co"># Process arguments</span>
        <span class="kw">case</span> <span class="ot">$mode</span><span class="kw"> in</span>
          get<span class="kw">)</span> <span class="ot">file_list=</span><span class="st">&quot;</span><span class="ot">$file_list</span><span class="st"> </span><span class="ot">$user_host</span><span class="st">:cloud/</span><span class="ot">$1</span><span class="st">&quot;</span>
            <span class="kw">;;</span>
          put<span class="kw">) [[</span> <span class="ot">-f</span> <span class="st">&quot;</span><span class="ot">$1</span><span class="st">&quot;</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="ot">file_list=</span><span class="st">&quot;</span><span class="ot">$file_list</span><span class="st"> </span><span class="ot">$1</span><span class="st">&quot;</span>
            <span class="kw">;;</span>
          delete<span class="kw">)</span> <span class="ot">file_list=</span><span class="st">&quot;</span><span class="ot">$file_list</span><span class="st"> </span><span class="ot">$1</span><span class="st">&quot;</span>
            <span class="kw">;;</span>
        <span class="kw">esac</span>
        <span class="kw">;;</span>
  <span class="kw">esac</span>
  <span class="kw">shift</span>
<span class="kw">done</span>

<span class="co"># Main logic</span>

<span class="co"># quit if no remote host is specified</span>
<span class="kw">[[</span> <span class="ot">-n</span> <span class="st">&quot;</span><span class="ot">$user_host</span><span class="st">&quot;</span><span class="kw"> ]]</span> <span class="kw">||</span> error_exit <span class="st">&quot;You must specify a user@host (-c).&quot;</span>
<span class="ot">host=${user_host##</span>*@<span class="ot">}</span>

<span class="kw">case</span> <span class="ot">$mode</span><span class="kw"> in</span>
  list <span class="kw">)</span>  <span class="kw">echo</span> -e <span class="st">&quot;\n### Files on host </span><span class="ot">${host}</span><span class="st">: ###&quot;</span>
    <span class="kw">ssh</span> <span class="ot">$user_host</span> <span class="st">&#39;ls -lA cloud&#39;</span>
    <span class="kw">;;</span>
  get <span class="kw">)</span> <span class="kw">echo</span> -e <span class="st">&quot;\n### Getting </span><span class="ot">$file_list</span><span class="st"> from host </span><span class="ot">$host</span><span class="st"> ###&quot;</span>
    <span class="kw">scp</span> -p <span class="ot">$file_list</span> .
    <span class="kw">;;</span>
  put <span class="kw">)</span> <span class="kw">echo</span> -e <span class="st">&quot;\n### Putting </span><span class="ot">$file_list</span><span class="st"> on host </span><span class="ot">$host</span><span class="st"> ###&quot;</span>
    <span class="kw">scp</span> -p <span class="ot">$file_list</span> <span class="ot">$user_host</span>:cloud
    <span class="kw">;;</span>
  delete <span class="kw">)</span> <span class="kw">echo</span> -e <span class="st">&quot;\n### Deleting </span><span class="ot">$file_list</span><span class="st"> from host </span><span class="ot">$host</span><span class="st"> ###&quot;</span>
    <span class="kw">ssh</span> <span class="ot">$user_host</span> <span class="st">&quot;cd cloud &amp;&amp; rm </span><span class="ot">$file_list</span><span class="st">&quot;</span>
    <span class="kw">;;</span>
<span class="kw">esac</span>
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