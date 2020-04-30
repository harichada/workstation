



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: photo2mail</title>
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
<h1 id="photo2mail">photo2mail</h1>
<p>Digital cameras today tend to produce very large image files. Files unsuitable for inclusion in email messages and other forms of online communication. This script solves that problem by reading one or more image files then writing new files with a more appropriate size. It does this with the help of the <code>convert</code> program supplied with the ImageMagick package.</p>
<h2 id="examples">Examples</h2>
<pre><code>me@linuxbox ~ $ photo2mail image.jpg</code></pre>
<p>In its simplest form, <code>photo2mail</code> reads the file <code>image.jpg</code> and creates a new image file called <code>image-1024.jpg</code> in the same directory as the original.</p>
<pre><code>me@linuxbox ~ $ photo2mail -s 800 image.jpg</code></pre>
<p>By default, the script resizes images to fit within a square bounding box 1024 pixels in size. By using the <code>-s</code> option, other sizes can be specified.</p>
<pre><code>me@linuxbox ~ $ photo2mail -d ../resized image.jpg</code></pre>
<p>By including the <code>-d</code> option, an alternate directory for output can be specified.</p>
<pre><code>me@linuxbox ~ $ photo2mail -j image.png</code></pre>
<p>By default, <code>photo2mail</code> writes the resized image in the same file format as the original. The <code>-j</code> option forces <code>photo2mail</code> to write a JPEG file instead.</p>
<h2 id="listing">Listing</h2>
<pre class="sourceCode bash" id="photo2mail"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>
<span class="co"># ---------------------------------------------------------------------------</span>
<span class="co"># photo2mail - Resize images for use as email attachments</span>

<span class="co"># Copyright 2013, William Shotts &lt;bshotts@users.sourceforge.net&gt;</span>

<span class="co"># This program is free software: you can redistribute it and/or modify</span>
<span class="co"># it under the terms of the GNU General Public License as published by</span>
<span class="co"># the Free Software Foundation, either version 3 of the License, or</span>
<span class="co"># (at your option) any later version.</span>

<span class="co"># This program is distributed in the hope that it will be useful,</span>
<span class="co"># but WITHOUT ANY WARRANTY; without even the implied warranty of</span>
<span class="co"># MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the</span>
<span class="co"># GNU General Public License at &lt;http://www.gnu.org/licenses/&gt; for</span>
<span class="co"># more details.</span>

<span class="co"># Usage: photo2mail [-h|--help] [--options] file...</span>

<span class="co"># Options:</span>
<span class="co"># -d, --directory dir   Directory for output images. Default</span>
<span class="co">#                       is same directory as source.</span>
<span class="co"># -j, --jpeg            Force output image to be JPEG regardless</span>
<span class="co">#                       of source image format.</span>
<span class="co"># -s, --size size       Size of output image bounding box. Default</span>
<span class="co">#                       is 1024 pixels.</span>

<span class="co"># This program produces resized images from originals using the &#39;convert&#39;</span>
<span class="co"># program from the ImageMagick suite. Output images are created in the</span>
<span class="co"># same directory as the originals and have the image size appended to</span>
<span class="co"># their names for easy identification. The &#39;size&#39; argument is the</span>
<span class="co"># width, in pixels, of the square bounding box containing the resized</span>
<span class="co"># image.</span>

<span class="co"># Revision history:</span>
<span class="co"># 2014-01-12  More cleanups (1.2)</span>
<span class="co"># 2014-01-04  Various cleanups (1.1)</span>
<span class="co"># 2013-01-11  Created by new_script ver. 3.0.1</span>
<span class="co"># ---------------------------------------------------------------------------</span>

<span class="ot">PROGNAME=${0##</span>*/<span class="ot">}</span>
<span class="ot">VERSION=</span><span class="st">&quot;1.2&quot;</span>
<span class="ot">DEFAULT_SIZE=</span>1024
<span class="ot">REQUIRED_PROGS=</span><span class="st">&quot;identify convert&quot;</span>

<span class="fu">clean_up()</span> <span class="kw">{</span> <span class="co"># Perform pre-exit housekeeping</span>
  <span class="kw">return</span>
<span class="kw">}</span>

<span class="fu">error_exit()</span> <span class="kw">{</span>
  <span class="kw">echo</span> -e <span class="st">&quot;</span><span class="ot">${PROGNAME}</span><span class="st">: </span><span class="ot">${1:-</span><span class="st">&quot;Unknown Error&quot;</span><span class="ot">}</span><span class="st">&quot;</span> <span class="kw">&gt;&amp;2</span>
  clean_up
  <span class="kw">exit</span> 1
<span class="kw">}</span>

<span class="fu">error_warning()</span> <span class="kw">{</span>
  <span class="kw">echo</span> -e <span class="st">&quot;</span><span class="ot">${PROGNAME}</span><span class="st">: Warning - </span><span class="ot">$1</span><span class="st">&quot;</span> <span class="kw">&gt;&amp;2</span>
  <span class="kw">return</span>
<span class="kw">}</span>

<span class="fu">graceful_exit()</span> <span class="kw">{</span>
  clean_up
  <span class="kw">exit</span>
<span class="kw">}</span>

<span class="fu">signal_exit()</span> <span class="kw">{</span> <span class="co"># Handle trapped signals</span>
  <span class="kw">case</span> <span class="ot">$1</span><span class="kw"> in</span>
    INT<span class="kw">)</span>    error_exit <span class="st">&quot;Program interrupted by user&quot;</span> <span class="kw">;;</span>
    TERM<span class="kw">)</span>   <span class="kw">echo</span> -e <span class="st">&quot;\n</span><span class="ot">$PROGNAME</span><span class="st">: Program terminated&quot;</span> <span class="kw">&gt;&amp;2</span>
            graceful_exit <span class="kw">;;</span>
    *<span class="kw">)</span>      error_exit <span class="st">&quot;</span><span class="ot">$PROGNAME</span><span class="st">: Terminating on unknown signal&quot;</span> <span class="kw">;;</span>
  <span class="kw">esac</span>
<span class="kw">}</span>

<span class="fu">usage()</span> <span class="kw">{</span>
  <span class="kw">echo</span> -e <span class="st">&quot;Usage: </span><span class="ot">$PROGNAME</span><span class="st"> [-h|--help] [--options] file...&quot;</span>
<span class="kw">}</span>

<span class="fu">help_message()</span> <span class="kw">{</span>
  <span class="kw">cat</span> <span class="kw">&lt;&lt;</span> _EOF_
<span class="ot">$PROGNAME</span> ver<span class="kw">.</span> <span class="ot">$VERSION</span>
Resize images <span class="kw">for</span> use <span class="kw">as</span> email attachments

<span class="ot">$(</span>usage<span class="ot">)</span>

Options:
-d, --directory <span class="kw">dir</span> Directory <span class="kw">for</span> output images<span class="kw">.</span> Default
                    is same directory <span class="kw">as</span> source.
-j, --jpeg          Force output image to be JPEG regardless
                    of <span class="kw">source</span> image format.
-s, --size <span class="kw">size</span>     Size of output image bounding box<span class="kw">.</span> Default
                    is 1024 pixels.

_EOF_
  <span class="kw">return</span>
<span class="kw">}</span>

<span class="co"># Trap signals</span>
<span class="kw">trap</span> <span class="st">&quot;signal_exit TERM&quot;</span> TERM HUP
<span class="kw">trap</span> <span class="st">&quot;signal_exit INT&quot;</span>  INT

<span class="ot">size=$DEFAULT_SIZE</span>
<span class="ot">f_ext=</span>
<span class="ot">f_path=</span>

<span class="co"># Parse command-line</span>
<span class="kw">while [[</span> <span class="ot">-n</span> <span class="ot">$1</span><span class="kw"> ]]</span>; <span class="kw">do</span>
  <span class="kw">case</span> <span class="ot">$1</span><span class="kw"> in</span>
    -d <span class="kw">|</span> --directory<span class="kw">)</span> <span class="kw">shift</span>; <span class="ot">f_path=</span><span class="st">&quot;</span><span class="ot">$1</span><span class="st">&quot;</span> <span class="kw">;;</span>
    -h <span class="kw">|</span> --help<span class="kw">)</span>      help_message; graceful_exit <span class="kw">;;</span>
    -j <span class="kw">|</span> --jpeg<span class="kw">)</span>      <span class="ot">f_ext=</span><span class="st">&quot;jpg&quot;</span> <span class="kw">;;</span>
    -s <span class="kw">|</span> --size<span class="kw">)</span>      <span class="kw">shift</span>; <span class="ot">size=</span><span class="st">&quot;</span><span class="ot">$1</span><span class="st">&quot;</span> <span class="kw">;;</span>
    -* <span class="kw">|</span> --*<span class="kw">)</span>         usage; error_exit <span class="st">&quot;Unknown option </span><span class="ot">$1</span><span class="st">&quot;</span> <span class="kw">;;</span>
    *<span class="kw">)</span>                <span class="kw">break</span> <span class="kw">;;</span>
  <span class="kw">esac</span>
  <span class="kw">shift</span>
<span class="kw">done</span>

<span class="co"># Main logic</span>

<span class="co"># Check validity of options</span>
<span class="kw">[[</span> <span class="st">&quot;</span><span class="ot">$size</span><span class="st">&quot;</span> =~ ^[0-9]+$<span class="kw"> ]]</span> <span class="kw">\</span>
  <span class="kw">||</span> error_exit <span class="st">&quot;output size must be an integer.&quot;</span>
<span class="kw">[[</span> <span class="ot">-z</span> <span class="st">&quot;</span><span class="ot">$f_path</span><span class="st">&quot;</span> || <span class="ot">-d</span> <span class="st">&quot;</span><span class="ot">$f_path</span><span class="st">&quot;</span><span class="kw"> ]]</span> <span class="kw">\</span>
  <span class="kw">||</span> error_exit <span class="st">&quot;output directory &#39;</span><span class="ot">$f_path</span><span class="st">&#39; does not exist.&quot;</span>

<span class="co"># Make sure that required ImageMagick programs are installed</span>
<span class="kw">for</span> i <span class="kw">in</span> <span class="ot">$REQUIRED_PROGS</span>; <span class="kw">do</span>
  <span class="kw">type</span> <span class="st">&quot;</span><span class="ot">$i</span><span class="st">&quot;</span> <span class="kw">&amp;&gt;</span> /dev/null <span class="kw">\</span>
    <span class="kw">||</span> error_exit <span class="st">&quot;required program &#39;</span><span class="ot">$i</span><span class="st">&#39; not found.&quot;</span>
<span class="kw">done</span>

<span class="co"># Processing loop</span>
<span class="kw">for</span> input_file <span class="kw">in</span> <span class="st">&quot;</span><span class="ot">$@</span><span class="st">&quot;</span>; <span class="kw">do</span>
  <span class="kw">if </span>[[ -r <span class="st">&quot;</span><span class="ot">$input_file</span><span class="st">&quot;</span> ]] <span class="kw">&amp;&amp;</span> identify <span class="st">&quot;</span><span class="ot">$input_file</span><span class="st">&quot;</span> <span class="kw">&amp;&gt;</span> /dev/null; <span class="kw">then</span>
    <span class="ot">filename=</span><span class="st">&quot;</span><span class="ot">${input_file##</span>*/<span class="ot">}</span><span class="st">&quot;</span>
    <span class="kw">if </span>[[ -z <span class="st">&quot;</span><span class="ot">$f_path</span><span class="st">&quot;</span> ]]; <span class="kw">then</span>
      <span class="ot">path=</span><span class="st">&quot;</span><span class="ot">${input_file%</span>/*<span class="ot">}</span><span class="st">&quot;</span>
    <span class="kw">else</span>
      <span class="ot">path=</span><span class="st">&quot;</span><span class="ot">$f_path</span><span class="st">&quot;</span>
    <span class="kw">fi</span>
   <span class="kw"> [[</span> <span class="st">&quot;</span><span class="ot">$filename</span><span class="st">&quot;</span> <span class="ot">==</span> <span class="st">&quot;</span><span class="ot">$path</span><span class="st">&quot;</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="ot">path=</span><span class="st">&quot;.&quot;</span>
    <span class="ot">base=</span><span class="st">&quot;</span><span class="ot">${filename%</span>.*<span class="ot">}</span><span class="st">&quot;</span>
    <span class="kw">if </span>[[ -z <span class="st">&quot;</span><span class="ot">$f_ext</span><span class="st">&quot;</span> ]]; <span class="kw">then</span>
      <span class="ot">ext=</span><span class="st">&quot;</span><span class="ot">${filename##</span>*.<span class="ot">}</span><span class="st">&quot;</span>
    <span class="kw">else</span>
      <span class="ot">ext=</span><span class="st">&quot;</span><span class="ot">$f_ext</span><span class="st">&quot;</span>
    <span class="kw">fi</span>
    <span class="ot">output_file=</span><span class="st">&quot;</span><span class="ot">$path</span><span class="st">/</span><span class="ot">$base</span><span class="st">-</span><span class="ot">$size</span><span class="st">.</span><span class="ot">$ext</span><span class="st">&quot;</span>
    convert <span class="st">&quot;</span><span class="ot">$input_file</span><span class="st">&quot;</span> -resize <span class="ot">${size}</span>x<span class="ot">${size}</span> <span class="st">&quot;</span><span class="ot">$output_file</span><span class="st">&quot;</span> <span class="kw">\</span>
      <span class="kw">||</span> error_warning <span class="st">&quot;Cannot convert &#39;</span><span class="ot">$input_file</span><span class="st">&#39;. Skipping...&quot;</span>
  <span class="kw">else</span>
    error_warning <span class="st">&quot;&#39;</span><span class="ot">$input_file</span><span class="st">&#39; not a valid image file. Skipping...&quot;</span>
  <span class="kw">fi</span>
<span class="kw">done</span>

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