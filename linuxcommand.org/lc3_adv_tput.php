



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: tput</title>
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
<h1 id="tput">tput</h1>
<p>While our command line environment is certainly powerful, it can be be somewhat lacking when it comes to visual appeal. Our terminals cannot create the rich environment of the graphical user interface, but it doesn't mean we are doomed to always look at plain characters on a plain background.</p>
<p>In this adventure, we will look at <code>tput</code>, a command used to manipulate our terminal. With it, we can change the color of text, apply effects, and generally brighten things up. More importantly, we can use <code>tput</code> to improve the human factors of our scripts. For example, we can use color and text effects to better present information to our users.</p>
<h2 id="availability">Availability</h2>
<p><code>tput</code> is part of the <code>ncurses</code> package and is supplied with most Linux distributions.</p>
<h2 id="what-it-doeshow-it-works">What It Does/How It Works</h2>
<p>Long ago, when computers were centralized, interactive computer users communicated with remote systems by using a physical terminal or a terminal emulator program running on some other system. In their heyday, there were many kinds of terminals and they all used different sequences of control characters to manage their screens and keyboards.</p>
<p>When we start a terminal session on our Linux system, the terminal emulator sets the <code>TERM</code> environment variable with the name of a <em>terminal type</em>. If we examine <code>TERM</code>, we can see this:</p>
<pre><code>[me@linuxbox ~]$ echo $TERM
xterm</code></pre>
<p>In this example, we see that our terminal type is named &quot;xterm&quot; suggesting that our terminal behaves like the classic X terminal emulator program <code>xterm</code>. Other common terminal types are &quot;linux&quot; for the Linux console, and &quot;screen&quot; used by terminal multiplexers such as <code>screen</code> and <code>tmux</code>. While we will encounter these 3 types most often, there are, in fact, thousands of different terminal types. Our Linux system contains a database called <em>terminfo</em> that describes them. We can examine a typical terminfo entry using the <code>infocmp</code> command followed by a terminal type name:</p>
<pre><code>[me@linuxbox ~]$ infocmp screen
#   Reconstructed via infocmp from file: /lib/terminfo/s/screen
screen|VT 100/ANSI X3.64 virtual terminal,
    am, km, mir, msgr, xenl,
    colors#8, cols#80, it#8, lines#24, ncv@, pairs#64,
    acsc=++\,\,--..00``aaffgghhiijjkkllmmnnooppqqrrssttuuvvwwxxyyzz{{||}}~~,
    bel=^G, blink=\E[5m, bold=\E[1m, cbt=\E[Z, civis=\E[?25l,
    clear=\E[H\E[J, cnorm=\E[34h\E[?25h, cr=^M,
    csr=\E[%i%p1%d;%p2%dr, cub=\E[%p1%dD, cub1=^H,
    cud=\E[%p1%dB, cud1=^J, cuf=\E[%p1%dC, cuf1=\E[C,
    cup=\E[%i%p1%d;%p2%dH, cuu=\E[%p1%dA, cuu1=\EM,
    cvvis=\E[34l, dch=\E[%p1%dP, dch1=\E[P, dl=\E[%p1%dM,
    dl1=\E[M, ed=\E[J, el=\E[K, el1=\E[1K, enacs=\E(B\E)0,
    flash=\Eg, home=\E[H, ht=^I, hts=\EH, ich=\E[%p1%d@,
    il=\E[%p1%dL, il1=\E[L, ind=^J, is2=\E)0, kbs=\177,
    kcbt=\E[Z, kcub1=\EOD, kcud1=\EOB, kcuf1=\EOC, kcuu1=\EOA,
    kdch1=\E[3~, kend=\E[4~, kf1=\EOP, kf10=\E[21~,
    kf11=\E[23~, kf12=\E[24~, kf2=\EOQ, kf3=\EOR, kf4=\EOS,
    kf5=\E[15~, kf6=\E[17~, kf7=\E[18~, kf8=\E[19~, kf9=\E[20~,
    khome=\E[1~, kich1=\E[2~, kmous=\E[M, knp=\E[6~, kpp=\E[5~,
    nel=\EE, op=\E[39;49m, rc=\E8, rev=\E[7m, ri=\EM, rmacs=^O,
    rmcup=\E[?1049l, rmir=\E[4l, rmkx=\E[?1l\E&gt;, rmso=\E[23m,
    rmul=\E[24m, rs2=\Ec\E[?1000l\E[?25h, sc=\E7,
    setab=\E[4%p1%dm, setaf=\E[3%p1%dm,
    sgr=\E[0%?%p6%t;1%;%?%p1%t;3%;%?%p2%t;4%;%?%p3%t;7%;%?%p4%t;5%;m%?%p9%t\016%e\017%;,
    sgr0=\E[m\017, smacs=^N, smcup=\E[?1049h, smir=\E[4h,
    smkx=\E[?1h\E=, smso=\E[3m, smul=\E[4m, tbc=\E[3g,</code></pre>
<p>The example above is the terminfo entry for the terminal type &quot;screen&quot;. What we see in the output of <code>infocmp</code> is a comma-separated list of <em>terminal capability names</em> or <em>capnames</em>. Some of the capabilities are standalone - like the first few in the list - while others are assigned cryptic values. Standalone terminal capabilities indicate something the terminal can do. For example, the capability &quot;am&quot; indicates the terminal has an automatic right margin. Terminal capabilities with assigned values contain strings, which are interpreted as commands by the terminal. The values starting with &quot;\E&quot; (which represents the escape character) are sequences of control codes that cause the terminal to perform an action such as moving the cursor to a specified location, or setting the text color.</p>
<p>The <code>tput</code> command can be used to test for a particular capability or to output the assigned value. Here are some examples:</p>
<pre><code>tput longname</code></pre>
<p>This outputs the full name of the current terminal type. We can specify another terminal type by including the <code>-T</code> option. Here, we will ask for the full name of the terminal type named &quot;screen&quot;:</p>
<pre><code>tput -T screen longname</code></pre>
<p>We can inquire values from the terminfo database, like the number of supported colors and the number of columns in the current terminal:</p>
<pre><code>tput colors
tput cols</code></pre>
<p>We can test for particular capability. For example, to see if the current terminal supports &quot;bce&quot; (background color erase - meaning that clearing or erasing text will be done using the currently defined background color) we type:</p>
<pre><code>tput bce &amp;&amp; echo &quot;True&quot;</code></pre>
<p>We can send instructions to the terminal. For example, to move the cursor to the position 20 characters to the right and 5 rows down:</p>
<pre><code>tput cup 5 20</code></pre>
<p>There are many different terminal types defined in the terminfo database and there are many terminal capnames. The terminfo man page contains a complete list. Note, however, that in general practice, there are only a relative handful of capnames supported by all of the terminal types we are likely to encounter on Linux systems.</p>
<h2 id="reading-terminal-attributes">Reading Terminal Attributes</h2>
<p>For the following capnames, <code>tput</code> outputs a value to stdout:</p>
<table>
<thead>
<tr class="header">
<th align="left">Capname</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>longname</code></td>
<td align="left">Full name of the terminal type</td>
</tr>
<tr class="even">
<td align="left"><code>lines</code></td>
<td align="left">Number of lines in the terminal</td>
</tr>
<tr class="odd">
<td align="left"><code>cols</code></td>
<td align="left">Number of columns in the terminal</td>
</tr>
<tr class="even">
<td align="left"><code>colors</code></td>
<td align="left">Number of colors available</td>
</tr>
</tbody>
</table>
<p>The <code>lines</code> and <code>cols</code> values are dynamic. That is, they are updated as the size of the terminal window changes. Here is a handy alias that creates a command to view the current size of our terminal window:</p>
<pre><code>alias term_size=`echo &quot;Rows=$(tput lines) Cols=$(tput cols)&quot;&#39;</code></pre>
<p>If we define this alias and execute it, we will see the size of the current terminal displayed. If we then change the size of the terminal window and execute the alias a second time, we will see the values have been updated.</p>
<p>One interesting feature we can use in our scripts is the SIGWINCH signal. This signal is sent each time the terminal window is resized. We can include a signal handler (i.e., a trap) in our scripts to detect this signal and act upon it:</p>
<pre class="sourceCode bash" id="term_size2"><code class="sourceCode bash">    <span class="co">#!/bin/bash</span>
    <span class="co"># term_size2 - Dynamically display terminal window size</span>

    <span class="fu">redraw()</span> <span class="kw">{</span>
        <span class="kw">clear</span>
        <span class="kw">echo</span> <span class="st">&quot;Width = </span><span class="ot">$(</span>tput cols<span class="ot">)</span><span class="st"> Height = </span><span class="ot">$(</span>tput lines<span class="ot">)</span><span class="st">&quot;</span>
    <span class="kw">}</span>

    <span class="kw">trap</span> redraw WINCH

    redraw
    <span class="kw">while</span> <span class="kw">true</span>; <span class="kw">do</span>
        <span class="kw">:</span>
    <span class="kw">done</span></code></pre>
<p>With this script, we start an empty infinite loop, but since we set a trap for the SIGWINCH signal, each time the terminal window is resized the trap is triggered and the new terminal size is displayed. To exit this script, we type <code>Ctrl-c</code>.</p>
<div class="figure">
<img src="images/adventure_tput_term_size2.png" alt="term_size2" ><p class="caption">term_size2</p>
</div>
<h2 id="controlling-the-cursor">Controlling The Cursor</h2>
<p>The capnames below output strings containing control codes that instruct the terminal to manipulate the cursor:</p>
<table>
<thead>
<tr class="header">
<th align="left">Capname</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>sc</code></td>
<td align="left">Save the cursor position</td>
</tr>
<tr class="even">
<td align="left"><code>rc</code></td>
<td align="left">Restore the cursor position</td>
</tr>
<tr class="odd">
<td align="left"><code>home</code></td>
<td align="left">Move the cursor to upper left corner (0,0)</td>
</tr>
<tr class="even">
<td align="left"><code>cup &lt;row&gt; &lt;col&gt;</code></td>
<td align="left">Move the cursor to position row, col</td>
</tr>
<tr class="odd">
<td align="left"><code>cud1</code></td>
<td align="left">Move the cursor down 1 line</td>
</tr>
<tr class="even">
<td align="left"><code>cuu1</code></td>
<td align="left">Move the cursor up 1 line</td>
</tr>
<tr class="odd">
<td align="left"><code>civis</code></td>
<td align="left">Set to cursor to be invisible</td>
</tr>
<tr class="even">
<td align="left"><code>cnorm</code></td>
<td align="left">Set the cursor to its normal state</td>
</tr>
</tbody>
</table>
<p>We can modify our previous script to use cursor positioning and to place the window dimensions in the center as the terminal is resized:</p>
<pre class="sourceCode bash" id="term_size3"><code class="sourceCode bash">    <span class="co">#!/bin/bash</span>
    <span class="co"># term_size3 - Dynamically display terminal window size</span>
    <span class="co">#              with text centering</span>

    <span class="fu">redraw()</span> <span class="kw">{</span>
        <span class="kw">local</span> <span class="ot">str</span> <span class="ot">width</span> <span class="ot">height</span> <span class="ot">length</span>
        
        <span class="ot">width=$(</span>tput cols<span class="ot">)</span>
        <span class="ot">height=$(</span>tput lines<span class="ot">)</span>
        <span class="ot">str=</span><span class="st">&quot;Width = </span><span class="ot">$width</span><span class="st"> Height = </span><span class="ot">$height</span><span class="st">&quot;</span>
        <span class="ot">length=${#str}</span>
        <span class="kw">clear</span>
        tput cup <span class="ot">$((</span>height / 2<span class="ot">))</span> <span class="ot">$((</span>(width / 2) - (length / 2)<span class="ot">))</span>
        <span class="kw">echo</span> <span class="st">&quot;</span><span class="ot">$str</span><span class="st">&quot;</span>
    <span class="kw">}</span>

    <span class="kw">trap</span> redraw WINCH

    redraw
    <span class="kw">while</span> <span class="kw">true</span>; <span class="kw">do</span>
        <span class="kw">:</span>
    <span class="kw">done</span></code></pre>
<p>As in the previous script, we set a trap for the SIGWINCH signal and start an infinite loop. The redraw function in this script is a bit more complicated, since it has to calculate the center of the terminal window each time its size changes.</p>
<div class="figure">
<img src="images/adventure_tput_term_size3.png" alt="term_size3" ><p class="caption">term_size3</p>
</div>
<h2 id="text-effects">Text Effects</h2>
<p>Like the capnames used for cursor manipulation, the following capnames output strings of control codes that affect the way our terminal displays text characters:</p>
<table>
<thead>
<tr class="header">
<th align="left">Capname</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>bold</code></td>
<td align="left">Start bold text</td>
</tr>
<tr class="even">
<td align="left"><code>smul</code></td>
<td align="left">Start underlined text</td>
</tr>
<tr class="odd">
<td align="left"><code>rmul</code></td>
<td align="left">End underlined text</td>
</tr>
<tr class="even">
<td align="left"><code>rev</code></td>
<td align="left">Start reverse video</td>
</tr>
<tr class="odd">
<td align="left"><code>blink</code></td>
<td align="left">Start blinking text</td>
</tr>
<tr class="even">
<td align="left"><code>invis</code></td>
<td align="left">Start invisible text</td>
</tr>
<tr class="odd">
<td align="left"><code>smso</code></td>
<td align="left">Start &quot;standout&quot; mode</td>
</tr>
<tr class="even">
<td align="left"><code>rmso</code></td>
<td align="left">End &quot;standout&quot; mode</td>
</tr>
<tr class="odd">
<td align="left"><code>sgr0</code></td>
<td align="left">Turn off all attributes</td>
</tr>
<tr class="even">
<td align="left"><code>setaf &lt;value&gt;</code></td>
<td align="left">Set foreground color</td>
</tr>
<tr class="odd">
<td align="left"><code>setab &lt;value&gt;</code></td>
<td align="left">Set background color</td>
</tr>
</tbody>
</table>
<p>Some capabilities, such as underline and standout, have capnames to turn the attribute both on and off while others only have a capname to turn the attribute on. In these cases, the <code>sgr0</code> capname can be used to return the text rendering to a &quot;normal&quot; state. Here is a simple script that demonstrates the common text effects:</p>
<pre class="sourceCode bash" id="tput_characters"><code class="sourceCode bash">    <span class="co">#!/bin/bash</span>

    <span class="co"># tput_characters - Test various character attributes</span>

    <span class="kw">clear</span>

    <span class="kw">echo</span> <span class="st">&quot;tput character test&quot;</span>
    <span class="kw">echo</span> <span class="st">&quot;===================&quot;</span>
    <span class="kw">echo</span>

    tput bold;  <span class="kw">echo</span> <span class="st">&quot;This text has the bold attribute.&quot;</span>;     tput sgr0

    tput smul;  <span class="kw">echo</span> <span class="st">&quot;This text is underlined (smul).&quot;</span>;       tput rmul

    <span class="co"># Most terminal emulators do not support blinking text (though xterm</span>
    <span class="co"># does) because blinking text is considered to be in bad taste ;-)</span>
    tput blink; <span class="kw">echo</span> <span class="st">&quot;This text is blinking (blink).&quot;</span>;        tput sgr0

    tput <span class="kw">rev</span>;   <span class="kw">echo</span> <span class="st">&quot;This text has the reverse attribute&quot;</span>;   tput sgr0

    <span class="co"># Standout mode is reverse on many terminals, bold on others. </span>
    tput smso;  <span class="kw">echo</span> <span class="st">&quot;This text is in standout mode (smso).&quot;</span>; tput rmso

    tput sgr0
    <span class="kw">echo</span></code></pre>
<div class="figure">
<img src="images/adventure_tput_tput_characters.png" alt="tput_characters" ><p class="caption">tput_characters</p>
</div>
<h3 id="text-color">Text Color</h3>
<p>Most terminals support 8 foreground text colors and 8 background colors (though some support as many as 256). Using the <code>setaf</code> and <code>setab</code> capabilities, we can set the foreground and background colors. The exact rendering of colors is a little hard to predict. Many desktop managers impose &quot;system colors&quot; on terminal windows, thereby modifying foreground and background colors from the standard. Despite this, here are what the colors should be:</p>
<table>
<thead>
<tr class="header">
<th align="left">Value</th>
<th align="left">Color</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left">0</td>
<td align="left">Black</td>
</tr>
<tr class="even">
<td align="left">1</td>
<td align="left">Red</td>
</tr>
<tr class="odd">
<td align="left">2</td>
<td align="left">Green</td>
</tr>
<tr class="even">
<td align="left">3</td>
<td align="left">Yellow</td>
</tr>
<tr class="odd">
<td align="left">4</td>
<td align="left">Blue</td>
</tr>
<tr class="even">
<td align="left">5</td>
<td align="left">Magenta</td>
</tr>
<tr class="odd">
<td align="left">6</td>
<td align="left">Cyan</td>
</tr>
<tr class="even">
<td align="left">7</td>
<td align="left">White</td>
</tr>
<tr class="odd">
<td align="left">8</td>
<td align="left">Not used</td>
</tr>
<tr class="even">
<td align="left">9</td>
<td align="left">Reset to default color</td>
</tr>
</tbody>
</table>
<p>The following script uses the <code>setaf</code> and <code>setab</code> capabilities to display the available foreground/background color combinations:</p>
<pre class="sourceCode bash" id="tput_colors"><code class="sourceCode bash">    <span class="co">#!/bin/bash</span>

    <span class="co"># tput_colors - Demonstrate color combinations.</span>

    <span class="kw">for</span> fg_color <span class="kw">in</span> <span class="dt">{0..7}</span>; <span class="kw">do</span>
        <span class="ot">set_foreground=$(</span>tput setaf <span class="ot">$fg_color)</span>
        <span class="kw">for</span> bg_color <span class="kw">in</span> <span class="dt">{0..7}</span>; <span class="kw">do</span>
            <span class="ot">set_background=$(</span>tput setab <span class="ot">$bg_color)</span>
            <span class="kw">echo</span> -n <span class="ot">$set_background$set_foreground</span>
            <span class="kw">printf</span> <span class="st">&#39; F:%s B:%s &#39;</span> <span class="ot">$fg_color</span> <span class="ot">$bg_color</span>
        <span class="kw">done</span>
        <span class="kw">echo</span> <span class="ot">$(</span>tput sgr0<span class="ot">)</span>
    <span class="kw">done</span></code></pre>
<div class="figure">
<img src="images/adventure_tput_tput_colors.png" alt="tput_colors" ><p class="caption">tput_colors</p>
</div>
<h2 id="clearing-the-screen">Clearing The Screen</h2>
<p>These capnames allow us to selectively clear portions of the terminal display:</p>
<table>
<thead>
<tr class="header">
<th align="left">Capname</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>smcup</code></td>
<td align="left">Save screen contents</td>
</tr>
<tr class="even">
<td align="left"><code>rmcup</code></td>
<td align="left">Restore screen contents</td>
</tr>
<tr class="odd">
<td align="left"><code>el</code></td>
<td align="left">Clear from the cursor to the end of the line</td>
</tr>
<tr class="even">
<td align="left"><code>el1</code></td>
<td align="left">Clear from the cursor to the beginning of the line</td>
</tr>
<tr class="odd">
<td align="left"><code>ed</code></td>
<td align="left">Clear from the cursor to the end of the screen</td>
</tr>
<tr class="even">
<td align="left"><code>clear</code></td>
<td align="left">Clear the entire screen and home the cursor</td>
</tr>
</tbody>
</table>
<p>Using some of these terminal capabilities, we can construct a script with a menu and a separate output area to display some system information:</p>
<pre class="sourceCode bash" id="tput_menu"><code class="sourceCode bash">    <span class="co">#!/bin/bash</span>

    <span class="co"># tput_menu: a menu driven system information program</span>

    <span class="ot">BG_BLUE=</span><span class="st">&quot;</span><span class="ot">$(</span>tput setab 4<span class="ot">)</span><span class="st">&quot;</span>
    <span class="ot">BG_BLACK=</span><span class="st">&quot;</span><span class="ot">$(</span>tput setab 0<span class="ot">)</span><span class="st">&quot;</span>
    <span class="ot">FG_GREEN=</span><span class="st">&quot;</span><span class="ot">$(</span>tput setaf 2<span class="ot">)</span><span class="st">&quot;</span>
    <span class="ot">FG_WHITE=</span><span class="st">&quot;</span><span class="ot">$(</span>tput setaf 7<span class="ot">)</span><span class="st">&quot;</span>

    <span class="co"># Save screen</span>
    tput smcup

    <span class="co"># Display menu until selection == 0</span>
    <span class="kw">while [[</span> <span class="ot">$REPLY</span> <span class="ot">!=</span> 0<span class="kw"> ]]</span>; <span class="kw">do</span>
      <span class="kw">echo</span> -n <span class="ot">${BG_BLUE}${FG_WHITE}</span>
      <span class="kw">clear</span>
      <span class="kw">cat</span> <span class="kw">&lt;&lt;</span>- _EOF_
        Please Select:

        1<span class="kw">.</span> Display Hostname and Uptime
        2<span class="kw">.</span> Display Disk Space
        3<span class="kw">.</span> Display Home Space Utilization
        0<span class="kw">.</span> Quit

    _EOF_

      <span class="kw">read</span> -p <span class="st">&quot;Enter selection [0-3] &gt; &quot;</span> <span class="ot">selection</span>
      
      <span class="co"># Clear area beneath menu</span>
      tput cup 10 0
      <span class="kw">echo</span> -n <span class="ot">${BG_BLACK}${FG_GREEN}</span>
      tput <span class="kw">ed</span>
      tput cup 11 0

      <span class="co"># Act on selection</span>
      <span class="kw">case</span> <span class="ot">$selection</span><span class="kw"> in</span>
        1<span class="kw">)</span>  <span class="kw">echo</span> <span class="st">&quot;Hostname: </span><span class="ot">$HOSTNAME</span><span class="st">&quot;</span>
            <span class="kw">uptime</span>
            <span class="kw">;;</span>
        2<span class="kw">)</span>  <span class="kw">df</span> -h
            <span class="kw">;;</span>
        3<span class="kw">)</span>  <span class="kw">if </span>[[ <span class="ot">$(</span><span class="kw">id</span> -u<span class="ot">)</span> -eq 0 ]]; <span class="kw">then</span>
              <span class="kw">echo</span> <span class="st">&quot;Home Space Utilization (All Users)&quot;</span>
              <span class="kw">du</span> -sh /home/* <span class="kw">2&gt;</span> /dev/null
            <span class="kw">else</span>
              <span class="kw">echo</span> <span class="st">&quot;Home Space Utilization (</span><span class="ot">$USER</span><span class="st">)&quot;</span>
              <span class="kw">du</span> -s <span class="ot">$HOME</span>/* <span class="kw">2&gt;</span> /dev/null <span class="kw">|</span> <span class="kw">sort</span> -nr
            <span class="kw">fi</span>
            <span class="kw">;;</span>
        0<span class="kw">)</span>  <span class="kw">break</span>
            <span class="kw">;;</span>
        *<span class="kw">)</span>  <span class="kw">echo</span> <span class="st">&quot;Invalid entry.&quot;</span>
            <span class="kw">;;</span>
      <span class="kw">esac</span>
      <span class="kw">printf</span> <span class="st">&quot;\n\nPress any key to continue.&quot;</span>
      <span class="kw">read</span> -n 1
    <span class="kw">done</span>

    <span class="co"># Restore screen</span>
    tput rmcup
    <span class="kw">echo</span> <span class="st">&quot;Program terminated.&quot;</span></code></pre>
<div class="figure">
<img src="images/adventure_tput_tput_menu-2.png" alt="tput_menu" ><p class="caption">tput_menu</p>
</div>
<h2 id="making-time">Making Time</h2>
<p>For our final exercise, we will make something useful; a large character clock. To do this, we first need to install a program called <code>banner</code>. The <code>banner</code> program accepts one or more words as arguments and displays them like so:</p>
<pre><code>[me@linuxbox ~]$ banner &quot;BIG TEXT&quot;
######    ###    #####          ####### ####### #     # #######
#     #    #    #     #            #    #        #   #     #
#     #    #    #                  #    #         # #      #
######     #    #  ####            #    #####      #       #
#     #    #    #     #            #    #         # #      #
#     #    #    #     #            #    #        #   #     #
######    ###    #####             #    ####### #     #    #</code></pre>
<p>This program has been around for a long time and there are several different implementations. On Debian-based systems (such as Ubuntu) the package is called &quot;sysvbanner&quot;, on Red Hat-based systems the package is called simply &quot;banner&quot;. Once we have <code>banner</code> installed we can run this script to display our clock:</p>
<pre class="sourceCode bash" id="tclock"><code class="sourceCode bash">    <span class="co">#!/bin/bash</span>

    <span class="co"># tclock - Display a clock in a terminal</span>

    <span class="ot">BG_BLUE=</span><span class="st">&quot;</span><span class="ot">$(</span>tput setab 4<span class="ot">)</span><span class="st">&quot;</span>
    <span class="ot">FG_BLACK=</span><span class="st">&quot;</span><span class="ot">$(</span>tput setaf 0<span class="ot">)</span><span class="st">&quot;</span>
    <span class="ot">FG_WHITE=</span><span class="st">&quot;</span><span class="ot">$(</span>tput setaf 7<span class="ot">)</span><span class="st">&quot;</span>

    <span class="fu">terminal_size()</span> <span class="kw">{</span> <span class="co"># Calculate the size of the terminal</span>
      
      <span class="ot">terminal_cols=</span><span class="st">&quot;</span><span class="ot">$(</span>tput cols<span class="ot">)</span><span class="st">&quot;</span>
      <span class="ot">terminal_rows=</span><span class="st">&quot;</span><span class="ot">$(</span>tput lines<span class="ot">)</span><span class="st">&quot;</span>
    <span class="kw">}</span>

    <span class="fu">banner_size()</span> <span class="kw">{</span>

      <span class="co"># Because there are different versions of banner, we need to</span>
      <span class="co"># calculate the size of our banner&#39;s output</span>

      <span class="ot">banner_cols=</span>0
      <span class="ot">banner_rows=</span>0
      
      <span class="kw">while</span> <span class="kw">read</span>; <span class="ot">do</span>
       <span class="kw"> [[</span> <span class="ot">${#REPLY}</span> <span class="ot">-gt</span> <span class="ot">$banner_cols</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="ot">banner_cols=${#REPLY}</span>
        <span class="kw">((</span>++banner_rows<span class="kw">))</span>
      <span class="kw">done</span> <span class="kw">&lt;</span> <span class="kw">&lt;(</span>banner <span class="st">&quot;12:34 PM&quot;</span><span class="kw">)</span>
    <span class="kw">}</span>

    <span class="fu">display_clock()</span> <span class="kw">{</span>
      
      <span class="co"># Since we are putting the clock in the center of the terminal,</span>
      <span class="co"># we need to read each line of banner&#39;s output and place it in the</span>
      <span class="co"># right spot.</span>
      
      <span class="kw">local</span> <span class="ot">row=$clock_row</span>
      
      <span class="kw">while</span> <span class="kw">read</span>; <span class="ot">do</span>
        tput cup <span class="ot">$row</span> <span class="ot">$clock_col</span>
        <span class="kw">echo</span> -n <span class="st">&quot;</span><span class="ot">$REPLY</span><span class="st">&quot;</span>
        <span class="kw">((</span>++row<span class="kw">))</span>
      <span class="kw">done</span> <span class="kw">&lt;</span> <span class="kw">&lt;(</span>banner <span class="st">&quot;</span><span class="ot">$(</span><span class="kw">date</span> +<span class="st">&#39;%I:%M %p&#39;</span><span class="ot">)</span><span class="st">&quot;</span><span class="kw">)</span>
    <span class="kw">}</span>

    <span class="co"># Set a trap to restore terminal on Ctrl-c (exit).</span>
    <span class="co"># Reset character attributes, make cursor visible, and restore</span>
    <span class="co"># previous screen contents (if possible).</span>

    <span class="kw">trap</span> <span class="st">&#39;tput sgr0; tput cnorm; tput rmcup || clear; exit 0&#39;</span> SIGINT

    <span class="co"># Save screen contents and make cursor invisible</span>
    tput smcup; tput civis

    <span class="co"># Calculate sizes and positions</span>
    terminal_size
    banner_size
    <span class="ot">clock_row=$((</span>(terminal_rows - banner_rows) / 2<span class="ot">))</span>
    <span class="ot">clock_col=$((</span>(terminal_cols - banner_cols) / 2<span class="ot">))</span>
    <span class="ot">progress_row=$((</span>clock_row + banner_rows + 1<span class="ot">))</span>
    <span class="ot">progress_col=$((</span>(terminal_cols - 60) / 2<span class="ot">))</span>

    <span class="co"># In case the terminal cannot paint the screen with a background</span>
    <span class="co"># color (tmux has this problem), create a screen-size string of </span>
    <span class="co"># spaces so we can paint the screen the hard way.</span>

    <span class="ot">blank_screen=</span>
    <span class="kw">for</span> <span class="kw">((</span>i=0; i &lt; (terminal_cols * terminal_rows); ++i<span class="kw">))</span>; <span class="kw">do</span>
      <span class="ot">blank_screen=</span><span class="st">&quot;</span><span class="ot">${blank_screen}</span><span class="st"> &quot;</span>
    <span class="kw">done</span>

    <span class="co"># Set the foreground and background colors and go!</span>
    <span class="kw">echo</span> -n <span class="ot">${BG_BLUE}${FG_WHITE}</span>
    <span class="kw">while</span> <span class="kw">true</span>; <span class="kw">do</span>

      <span class="co"># Set the background and draw the clock</span>
      
      if tput bce; <span class="kw">then</span> <span class="co"># Paint the screen the easy way if bce is supported</span>
        <span class="kw">clear</span>
      <span class="kw">else</span> <span class="co"># Do it the hard way</span>
        tput home
        <span class="kw">echo</span> -n <span class="st">&quot;</span><span class="ot">$blank_screen</span><span class="st">&quot;</span>
      <span class="kw">fi</span>
      tput cup <span class="ot">$clock_row</span> <span class="ot">$clock_col</span>
      display_clock
      
      <span class="co"># Draw a black progress bar then fill it in white</span>
      tput cup <span class="ot">$progress_row</span> <span class="ot">$progress_col</span>
      <span class="kw">echo</span> -n <span class="ot">${FG_BLACK}</span>
      <span class="kw">echo</span> -n <span class="st">&quot;###########################################################&quot;</span>
      tput cup <span class="ot">$progress_row</span> <span class="ot">$progress_col</span>
      <span class="kw">echo</span> -n <span class="ot">${FG_WHITE}</span>

      <span class="co"># Advance the progress bar every second until a minute is used up</span>
      <span class="kw">for</span> <span class="kw">((</span>i = <span class="ot">$(</span><span class="kw">date</span> +%S<span class="ot">)</span>;i &lt; 60; ++i<span class="kw">))</span>; <span class="kw">do</span>
        <span class="kw">echo</span> -n <span class="st">&quot;#&quot;</span>
        <span class="kw">sleep</span> 1
      <span class="kw">done</span>
    <span class="kw">done</span></code></pre>
<div class="figure">
<img src="images/adventure_tput_tclock.png" alt="tclock script in action" ><p class="caption">tclock script in action</p>
</div>
<p>Our script paints the screen blue and places the current time in the center of the terminal window. This script does not dynamically update the display's position if the terminal is resized (that's an enhancement left to the reader). A progress bar is displayed beneath the clock and it is updated every second until the next minute is reached, when the clock itself is updated.</p>
<p>One interesting feature of the script is how it deals with painting the screen. Terminals that support the &quot;bce&quot; capability erase using the current background color. So, on terminals that support bce, this is easy. We simply set the background color and then clear the screen. Terminals that do not support bce always erase to the default color (usually black).</p>
<p>To solve this problem, our this script creates a long string of spaces that will fill the screen. On terminal types that do not support bce (for example, screen) the background color is set, the cursor is moved to the home position and then the string of spaces is drawn to fill the screen with the desired background color.</p>
<h2 id="summing-up">Summing Up</h2>
<p>Using <code>tput</code>, we can easily add visual enhancements to our scripts. While it's important not to get carried away, lest we end up with a colorful, blinking mess, adding text effects and color can increase the visual appeal of our work and improve the readability of information we present to our users.</p>
<h2 id="further-reading">Further Reading</h2>
<ul>
<li><p>The terminfo man page contains the entire list of terminal capabilities defined terminfo database.</p></li>
<li><p>On most systems, the <code>/lib/terminfo</code> and <code>/usr/share/terminfo</code> directories contain the all of the terminals supported by terminfo.</p></li>
<li><p><a href="http://wiki.bash-hackers.org/scripting/terminalcodes/" title="Bash     Hackers Wiki">Bash Hacker's Wiki</a> has a good entry on the subject of text effects using <code>tput</code>. The page also has some interesting example scripts.</p></li>
<li><p><a href="http://mywiki.wooledge.org/BashFAQ/037" title="Greg&#39;s Wiki">Greg's Wiki</a> contains useful information about setting text colors using <code>tput</code>.</p></li>
<li><p><a href="http://www.tldp.org/HOWTO/Bash-Prompt-HOWTO/x405.html" title="Bash     Prompt HOWTO">Bash Prompt HOWTO</a> discusses using <code>tput</code> to apply text effects to the shell prompt.</p></li>
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