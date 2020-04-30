



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: Vim, With Vigor</title>
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
<h1 id="vim-with-vigor">Vim, with Vigor</h1>
<p>TLCL Chapter 12 taught us the basic skills necessary to use the vim text editor. However, we barely scratched the surface of its capabilities. Vim is a very powerful program. In fact, it's safe to say that vim can do anything. It's just a question of figuring out how. In this adventure, we will acquire an intermediate level of skill in this popular tool. In particular, we will look at ways to improve our productivity writing shell programs, configuration files, and documentation. Even better, after we get the hang of some of these additional features, using vim actually becomes fun.</p>
<p>During this adventure, we will be looking at some of the features that make vim so popular among developers and administrators. The community around vim is large and vigorous. Vim is extremely rich in features and is highly scriptable. As a result, there are many plugin add-ons available. However, we are going to restrict ourselves to stock vim and the plugins that normally ship with it.</p>
<p>A note about nomenclature: in TLCL we used the terms &quot;command&quot;, &quot;insert&quot;, and &quot;ex&quot; to identify the three primary modes of vim. We did this to match the traditional modes of vim's ancestor, vi. Since this is an all-vim adventure, we will switch to the names used in the vim documentation which are <em>normal</em>, <em>insert</em>, and <em>command</em>.</p>
<h2 id="lets-get-started">Let's Get Started</h2>
<p>First, we need to be sure we are running the full version of vim. Many distributions only ship with an abbreviated version. To get the full version, install the vim package if it's not already installed. This is also be a good time to add an alias to our <code>.bashrc</code> file to make &quot;vi&quot; run vim (some distributions symbolically link 'vi' to vim, so this step might not be needed):</p>
<pre><code>alias vi=&#39;vim&#39;</code></pre>
<p>Next, let's create a minimal <code>.vimrc</code>, its main configuration file:</p>
<pre><code>[me@linuxbox ~]$ vi ~/.vimrc</code></pre>
<p>Edit the file so it contains these two lines:</p>
<pre><code>set nocompatible
filetype plugin on</code></pre>
<p>This will ensure that vim is not restricted to the vi feature set, and will load a standard plugin that lets vim recognize different file types. After inserting the two lines of text, return to normal mode and (just for fun) type lowercase 'm' followed by uppercase 'V':</p>
<pre><code>mV</code></pre>
<p>Nothing will appear to happen, and that's OK. We'll come back to that later. Now save the file and exit vim:</p>
<pre><code>:wq</code></pre>
<h2 id="getting-help">Getting Help</h2>
<p>Vim has an extensive built-in help system. If we start vim:</p>
<pre><code>[me@linuxbox ~]$ vi</code></pre>
<p>and enter the command:</p>
<pre><code>:help</code></pre>
<p>It will appear at the top of the display.</p>
<div class="figure">
<img src="images/adventure_vimvigor_help.png" alt="Vim help window" ><p class="caption">Vim help window</p>
</div>
<p>While help is extensive and very useful, it immediately presents a problem because it creates a split in the display; a rather advanced feature that needs some explanation.</p>
<p>Vim can divide the display into multiple panes, which in vim parlance are called <em>windows</em>. These are very useful when working with multiple files and other vim features such as help. When the display is divided in this way, we can toggle between the windows by typing <code>Ctrl-w</code> twice. We can manipulate windows with these commands:</p>
<pre><code>:split          Create a new window
Ctrl-w Ctrl-w   Toogle between windows
Ctrl-w _        Enlarge the active window
Ctrl-w =        Make windows the same size
:close          Close active window
:only           Close all other windows</code></pre>
<p>When working with files, it's important to note that &quot;closing&quot; a window (with either <code>:q</code> or <code>:close</code>) does not remove the buffer that contained the window's content; we can recall it at any time. However, when we close the final window, vim terminates.</p>
<p>To exit help, make sure the cursor is in the help window and enter the quit command:</p>
<pre><code>:q</code></pre>
<p>to quit that window.</p>
<p>But enough about windows, let's get back to help. If we scroll around the initial help file, we see that it is a hypertext document full of links to various topics and it begins with the commands we need to navigate the help system. This is all well and good, but it's not the most interesting way to use it.</p>
<p>The best way is to just type :h followed by the thing we are interested in. The fact that we don't have to type out &quot;:help&quot; reveals that most vim commands can be abbreviated. This saves a lot of work. In general, commands can be shortened to their smallest non-ambiguous form. Frequently used commands, like help, are often shortened to a single character but the system of abbreviations isn't predictable, so we have to use help to find them. For the remainder of this adventure, we will try to use the shortest available form.</p>
<p>There is an important table near the beginning of the initial help file:</p>
<pre><code>    WHAT                  PREPEND    EXAMPLE
Normal mode command      (nothing)   :help x
Visual mode command         v_       :help v_u
Insert mode command         i_       :help i_&lt;Esc&gt;
Command-line command        :        :help :quit
Command-line editing        c_       :help c_&lt;Del&gt;
Vim command argument        -        :help -r
Option                      &#39;        :help &#39;textwidth&#39;

Search for help:  Type &quot;:help word&quot;, then hit CTRL-D to see
                  matching help entries for &quot;word&quot;.</code></pre>
<p>This table describes how we should ask for help in particular contexts. We're familiar with the normal mode command 'i' which invokes insert mode. In the case of such a normal mode command, we simply type:</p>
<pre><code>:h i</code></pre>
<p>to display its help page. For command mode commands, we precede the command with a ':', for example:</p>
<pre><code>:h :q</code></pre>
<p>gets help with the <code>:quit</code> command.</p>
<p>There are other contexts for modes we have yet to cover. We'll get to those in a little bit.</p>
<p>As we go along, feel free to use help to learn more about the commands we discuss. As this adventure goes on, the text will include suggested help topics to explore.</p>
<p>Oh, and while we're on the subject of command mode, now is a good time to point out that command mode has command line history similar to the shell. After typing ':' we can use the up and down arrows to scroll through past commands.</p>
<p><strong>Help topics:</strong> <code>:split :close :only ^w</code></p>
<h2 id="starting-a-script">Starting A Script</h2>
<p>In order to demonstrate features in vim, we're going to write a shell script. What it does is not important, in fact, it won't do anything at all except to show how we can edit scripts. To begin, let's start vim with the name of an non-existent script file:</p>
<pre><code>[me@linuxbox ~]$ vi fooscript</code></pre>
<p>and we will get our familiar &quot;new file&quot; window:</p>
<div class="figure">
<img src="images/adventure_vimvigor_newfile.png" alt="New file" ><p class="caption">New file</p>
</div>
<h3 id="setting-the-filetype">Setting the Filetype</h3>
<p>At this point vim has no idea what kind of file we are creating. If we had named the file <code>fooscript.sh</code> the filetype plugin would have determined that we were editing a shell script. We can verify this by asking vim what the current filetype is:</p>
<pre><code>:set ft?</code></pre>
<p>When we use the <code>set</code> command this way, it displays the current value of an option-- in this case the <code>ft</code> (short for <code>filetype</code>) option. It should respond with:</p>
<pre><code>filetype=</code></pre>
<p>indicating that the <code>ft</code> option is unset. For the curious, we can ask for help like this:</p>
<pre><code>:h :set
:h &#39;ft&#39;</code></pre>
<p>to get more information. To see all the current option settings, we can do this:</p>
<pre><code>:set</code></pre>
<p>and the entire list will appear.</p>
<p>Since we want our new file to be treated as a shell script, we can set the filetype manually:</p>
<pre><code>:set ft=sh</code></pre>
<p>Next, let's enter insert mode and type the first couple of lines in our script:</p>
<pre><code>#!/bin/bash

# Script to test editing with vim </code></pre>
<p>Exit insert mode by pressing the <code>Esc</code> key and save the file:</p>
<pre><code>:w</code></pre>
<p>Now that our file contains the shebang on the first line, the filetype plugin will recognize the file as a shell script whenever it is loaded.</p>
<h2 id="using-the-shell">Using The Shell</h2>
<p>One thing we can do with filetypes is create a configuration file for each of the supported types. Normally, these are placed in the <code>~/.vim/ftplugin</code> directory. To do this, we need to create the directory.</p>
<p>We don't have leave vim to do this; we can launch a shell from within vim. This is easily done by entering the command:</p>
<pre><code>:sh</code></pre>
<p>After doing this, a shell prompt will appear and we can enter our shell command:</p>
<pre><code>[me@linuxbox ~]$ mkdir -p ~/.vim/ftplugin</code></pre>
<p>When we're done with the shell, we return to vim by exiting the shell:</p>
<pre><code>[me@linuxbox ~]$ exit</code></pre>
<p>Now that we have a place for our configuration file to live, let's create it. We'll open a new file:</p>
<pre><code>:e ~/.vim/ftplugin/sh.vim</code></pre>
<p>The filename <code>sh.vim</code> is required.</p>
<p><strong>Help topics:</strong> <code>:sh</code></p>
<h2 id="buffers">Buffers</h2>
<p>Before we start editing our new file, let's look at what vim is doing. Each file that we edit is stored in a <em>buffer</em>. We can look the current list of buffers this way:</p>
<pre><code>:ls</code></pre>
<p>This will display the list. There are several ways that we can switch buffers. The first way is to cycle between them:</p>
<pre><code>:bn</code></pre>
<p>This command (short for <code>:bnext</code>) cycles through the buffer list, wrapping around at the end. Likewise, there is a <code>:bp</code> (<code>:bprevious</code>) command which cycles through the buffer list backwards. We can also select a buffer by number:</p>
<pre><code>:b 2</code></pre>
<p>We can even refer to a buffer by using a portion of the file name:</p>
<pre><code>:b fooscript</code></pre>
<p>Let's cycle back to our new buffer and add this line to our configuration file:</p>
<pre><code>setlocal number</code></pre>
<p>This will turn on line numbering each time we load a shell script. Notice that we use the <code>setlocal</code> command rather than <code>set</code>. This is because <code>set</code> will apply an option globally, whereas the <code>setlocal</code> command only applies the option to the current buffer. This will prevent settings conflicts when we edit multiple files of different types.</p>
<p>We can also control syntax highlighting while we're here. We can turn it on with:</p>
<pre><code>syntax on</code></pre>
<p>or turn it off with:</p>
<pre><code>syntax off</code></pre>
<p>We'll save this file now, but before we do that, let's type <code>mS</code> (lowercase m uppercase S), similar to what we did when we saved our initial <code>.vimrc</code>.</p>
<p><strong>Help topics:</strong> <code>:ls :buffers :bnext :bprevious :setlocal 'number' :syntax</code></p>
<h2 id="color-schemes">Color Schemes</h2>
<p>If we return to the buffer containing our shell script, we should see the effects of our <code>sh.vim</code> file. When syntax highlighting is turned on (<code>:syn on</code> will do the trick) it assumes the current color scheme. Vim ships with a bunch of different ones. To see the name of the current scheme, type this command:</p>
<pre><code>:colo</code></pre>
<p>and it will display the name. To see the entire set of available color schemes, type <code>:colo</code> followed by a space, then the tab key. This will trigger vim's autocomplete and we should see the first name in the list. Subsequent use of the tab key will cycle through the list and we can try each one.</p>
<p>The 'desert' color scheme looks pretty good with shell scripts, so let's add this to our <code>sh.vim</code> file. To do this, switch to the buffer containing that file and add the following line:</p>
<pre><code>colorscheme desert</code></pre>
<p>Notice that we used the long form of the <code>colorscheme</code> command. We could have used the abbreviated form <code>colo</code> but it's a common custom to use the long names in configuration files for clarity.</p>
<p>There are many additional color schemes for vim on the Internet. To use one, first create a <code>~/.vim/colors</code> directory and then download the new scheme into it. The new scheme will appear when we cycle through the list.</p>
<p>Now, save the file and return to our shell script.</p>
<p><strong>Help topics:</strong> <code>:colorscheme</code></p>
<h2 id="marks-and-file-marks">Marks And File Marks</h2>
<p>We know there are various ways of moving around within document in vim. For example, to get to the top, we can type:</p>
<pre><code>gg</code></pre>
<p>and to the bottom by typing:</p>
<pre><code>G</code></pre>
<p>but vim (and real vi for that matter) also allows us to <em>mark</em> an arbitrary location within a document that we can recall at will. To demonstrate this, go to the top of the script and type:</p>
<pre><code>ma</code></pre>
<p>then go to the bottom of the document and type:</p>
<pre><code>mb</code></pre>
<p>We have just set two marks, the first called &quot;a&quot; and the second called &quot;b&quot;. To recall a mark, we precede the name of the mark with the ' character, like so:</p>
<pre><code>&#39;a</code></pre>
<p>and we are taken to the top of the file again.</p>
<p>We can use any lowercase letter to name a mark. Now, the clever among us will remember that we set marks in both the <code>.vimrc</code> file, and the <code>sh.vim</code> file but we used uppercase letters.</p>
<p>Yes we did, because they're special. They're called <em>file marks</em> and they let us set a mark in a file that vim will remember between sessions. Since we set the V mark in the <code>.vimrc</code> file and the S mark in <code>sh.vim</code> file, if we ever type:</p>
<pre><code>&#39;V</code></pre>
<p>vim will immediately take us to that mark even if vim has to load the file to do it. By doing this to <code>.vimrc</code> and <code>sh.vim</code>, we're set up to edit our configuration files anytime we get another bright idea about customizing vim.</p>
<p><strong>Help topics:</strong> <code>m '</code></p>
<h2 id="visual-mode">Visual Mode</h2>
<p>Among the best features that vim adds to ordinary vi is <em>visual mode</em>. This mode allows us to visually select text in our document. If we type:</p>
<pre><code>v</code></pre>
<p>An indicator will appear at the bottom of the screen showing that we have entered this mode. While in visual mode, when we move the cursor (using any of the available movement commands), the text is both visually highlighted and selected. Once this is done we can apply the normal editing commands on the selected text such as <code>c</code> (change), <code>d</code> (delete), and <code>y</code> (yank). Typing <code>v</code> a second time will exit visual mode. If we type:</p>
<pre><code>V</code></pre>
<p>we again enter visual mode, but this time selection is done on a line-by-line basis rather than by individual characters. This is handy when cutting and copying blocks of code.</p>
<p>There is a third way of using visual mode. If we type:</p>
<pre><code>Ctrl-v</code></pre>
<p>we are able to select rectangular blocks of text by columns. For example, we could select a column from a table.</p>
<p><strong>Help topics:</strong> <code>v V ^v</code></p>
<h2 id="indentation">Indentation</h2>
<p>We're going to continue working on our shell script, but first we need to talk a little about <em>indentation</em>. As we know, indentation is used in programming to help communicate program structure. The shell does not require any particular style of indentation; it's purely for the benefit of the humans trying to read the code. However, some other computer languages, such as Python, require indentation to express program structure.</p>
<p>Indentation is accomplished in one of two ways; either by inserting tab characters or by inserting a sequence of spaces. To understand the difference, we have to go way back in time to typewriters and teletype machines.</p>
<p>In the beginning, there were typewriters. On a typewriter, in order to make indenting the first line of a paragraph easier, someone invented a mechanical device that would move the carriage over a set amount of space. Over time, these devices became more sophisticated and allowed multiple tab stops to be set. When teletype machines came about, they implemented tabs with a specific ASCII character called HT (horizontal tab, code 9) which, by default, was rendered by moving the cursor to the next character position evenly divisible by 8.</p>
<p>In the early days of computing, when memory was precious, it made sense to conserve space in text files by using tab characters to avoid having to pad the text file with spaces.</p>
<p>Using tab characters creates a problem, though. Since a tab character has no intrinsic width (it only signifies the desire to move to the next tab stop), it's up to the receiving program to render the tab with some defined width. This means that a file containing tabs could be rendered in different ways in different programs and in different contexts.</p>
<p>Since memory is no longer expensive, and using tabs creates this rendering confusion, modern practice calls for spaces instead of tabs to perform indentation (though this remains somewhat controversial). Vim provides a number of options for setting tabs and indentation. An excerpt from the help file for the <code>tabstop</code> option explains the ways vim can treat tabs:</p>
<pre><code>There are four main ways to use tabs in Vim:

1. Always keep &#39;tabstop&#39; at 8, set &#39;softtabstop&#39; and
   &#39;shiftwidth&#39; to 4 (or 3 or whatever you prefer) and use
   &#39;noexpandtab&#39;.  Then Vim will use a mix of tabs and
   spaces, but typing &lt;Tab&gt; and &lt;BS&gt; will behave like a tab
   appears every 4 (or 3) characters.

2. Set &#39;tabstop&#39; and &#39;shiftwidth&#39; to whatever you prefer
   and use &#39;expandtab&#39;.  This way you will always insert
   spaces.  The formatting will never be messed up when
   &#39;tabstop&#39; is changed.

3. Set &#39;tabstop&#39; and &#39;shiftwidth&#39; to whatever you prefer and
   use a |modeline| to set these values when editing the
   file again.  Only works when using Vim to edit the file.

4. Always set &#39;tabstop&#39; and &#39;shiftwidth&#39; to the same value,
   and &#39;noexpandtab&#39;.  This should then work (for initial
   indents only) for any tabstop setting that people use.
   It might be nice to have tabs after the first non-blank
   inserted as spaces if you do this though.  Otherwise,
   aligned comments will be wrong when &#39;tabstop&#39; is
   changed.</code></pre>
<h3 id="indentation-settings-for-scripts">Indentation Settings For Scripts</h3>
<p>For our purposes, we will use method 2 and add the following lines to our <code>sh.vim</code> file to set tabs to indent 2 spaces. This is a popular setting specified in some shell script coding standards.</p>
<pre><code>setlocal tabstop=2
setlocal shiftwidth=2
setlocal expandtab
setlocal softtabstop=2
setlocal autoindent
setlocal smartindent</code></pre>
<p>In addition to the tab settings, we also included the <code>autoindent</code> and <code>smartindent</code> settings, which will automate indentation when we write blocks of code.</p>
<p>After adding the indentation settings to our <code>sh.vim</code> file, we'll add some more lines to our shell script (type this in to see how it behaves):</p>
<pre class="sourceCode bash"><code class="sourceCode bash">     1  <span class="co">#! /bin/bash</span>
     2  
     3  <span class="co"># This is a shell script to demonstrate features in vim. It doesn&#39;t really</span>
     4  <span class="co"># do anything, it just shows what we can do.</span>
     5  
     6  <span class="co"># Constants</span>
     7  <span class="ot">A=</span>1
     8  <span class="ot">B=</span>2
     9  
    10  <span class="kw">if </span>[[ <span class="ot">$A</span> == <span class="ot">$B</span> ]]; <span class="kw">then</span>
    11    <span class="kw">echo</span> <span class="st">&quot;This shows how smartindent works.&quot;</span>
    12    <span class="kw">echo</span> <span class="st">&quot;This shows how autoindent works.&quot;</span>
    13    <span class="kw">echo</span> <span class="st">&quot;A and B match.&quot;</span>
    14  <span class="kw">else</span>
    15    <span class="kw">echo</span> <span class="st">&quot;A and B do not match.&quot;</span>
    16  <span class="kw">fi</span>
    17  
    18  <span class="fu">afunction()</span> <span class="kw">{</span>
    19    cmd1
    20    cmd2
    21  <span class="kw">}</span>
    22  
    23  <span class="kw">if </span>[[ -e <span class="kw">file</span> ]]; <span class="kw">then</span>
    24    cmd1
    25    cmd2
    26  <span class="kw">fi</span></code></pre>
<p>As we type these additional lines into our script, we notice that vim can now automatically provide indentation as needed. The <code>autoindent</code> option causes vim to repeat the previous line's indention while the <code>smartindent</code> option provides indention for certain program structures such as the function and if statements. This saves a lot of time while coding and ensures that our code stays nice and neat.</p>
<p>If we find ourselves editing an existing script with a indentation scheme differing from our current settings, vim can convert the file. This is done by typing:</p>
<pre><code>:retab</code></pre>
<p>and the file will have its tabs adjusted to match our current indentation style.</p>
<p><strong>Help topics:</strong> <code>'tabstop' 'shiftwidth' 'expandtab' 'softtabstop' 'autoindent' 'smartindent'</code></p>
<h2 id="power-moves">Power Moves</h2>
<p>As we learned in TLCL, vim has lots of <em>movement commands</em> we can use to quickly navigate around our documents. These commands can be employed in many useful ways.</p>
<p>Here is a list of the common movement commands. Some of this is review, some is new.</p>
<pre><code>h       Move left (also left-arrow)
l       Move right (also right-arrow)
j       Move down (also down-arrow)
k       Move up (also up-arrow)
0       First character on the line (also the Home key)
^       First non-whitespace character on the line
$       Last character on the line (also the End key)
f{char} Move right to the next occurrence of char on the current
        line
t{char} Move right till (i.e., just before) the next occurrence of
        char on the current line
;       Repeat last f or t command
gg      Go to first line
G       Go to last line. If a count is specified, go to that line.
w       Move forward (right) to beginning of next word
b       Move backward (left) to beginning of previous word
e       Move forward to end of word
)       Move forward to beginning of next sentence
(       Move backward to beginning previous sentence
}       Move forward to beginning of next paragraph
{       Move backward to beginning of previous paragraph</code></pre>
<p>Remember, each of these commands can be preceded with a count of how many times the command is to be performed.</p>
<h3 id="operators">Operators</h3>
<p>Movement commands are often used in conjunction with <em>operators</em>. The movement command determines how much of the text the operator affects. Here is a list of the most commonly used operators:</p>
<pre><code>c   Change (i.e., delete then insert)
d   Delete/cut
y   Yank (i.e., copy)
~   Toggle case
gu  Make lowercase
gU  Make uppercase
gq  Format text (a topic we&#39;ll get to shortly)
g?  ROT13 encoding (for obfiscating text)
&gt;   Shift (i.e., indent) right
&lt;   Shift left</code></pre>
<p>We can use visual mode to easily demonstrate the movement commands. Move the cursor to the beginning of line 3 of our script and type:</p>
<pre><code>vf.</code></pre>
<p>This will select the text from the beginning of the line to the end of the first sentence. Press <code>v</code> again to cancel visual mode. Next, return to the beginning line 3 and type:</p>
<pre><code>v)</code></pre>
<p>to select the first sentence. Cancel visual mode again and type:</p>
<pre><code>v}</code></pre>
<p>to select the entire paragraph (any block of text delimited by a blank line). Pressing } again extends the selection to the next paragraph.</p>
<h3 id="text-object-selection">Text Object Selection</h3>
<p>In addition to the traditional vi movement commands, vim adds a related feature called <em>text object selection</em>. These commands only work in conjunction with operators. These commands are:</p>
<pre><code>a   Select entire (all) text object.
i   Select interior (in) of text object.</code></pre>
<p>The text objects are:</p>
<pre><code>w   Word
s   Sentence
p   Paragraph
t   Tag block (such as &lt;aaa&gt;...&lt;/aaa&gt; used in HTML)
[   [ enclosed block
(   ( enclosed block (b can also be used)
{   { enclosed block (B can also be used)
&quot;   &quot; quoted string
&#39;   &#39; quoted string</code></pre>
<p>The way these work is very interesting. If we place our cursor on a word for example, and type:</p>
<pre><code>caw</code></pre>
<p>(short for &quot;change all word&quot;), vim selects the entire word, deletes it, and switches to insert mode. Text objects work with visual mode too. Try this: move to line 11 and place the cursor inside the quoted string and type:</p>
<pre><code>vi&quot;</code></pre>
<p>The interior of the quoted string will be selected. If we instead type:</p>
<pre><code>va&quot;</code></pre>
<p>the entire string including the quotes is selected.</p>
<p><strong>Help topics:</strong> <code>motion.txt text-objects</code></p>
<h2 id="text-formatting">Text Formatting</h2>
<p>Let's say we wanted to add a license header to the beginning of our script. This would consist of a comment block near the top of the file that includes the text of the copyright notice.</p>
<p>We'll move to line 3 of our script and add the text, but before we start, let's tell vim how long we want the lines of text to be. First we'll ask vim what the current setting is:</p>
<pre><code>:set tw?</code></pre>
<p>Vim should respond:</p>
<pre><code>textwidth=0</code></pre>
<p>&quot;tw&quot; is short for <code>textwidth</code>, the length of lines setting. A value of zero means that vim is not enforcing a limit on line length. Let's set textwidth to another value:</p>
<pre><code>:set tw=75</code></pre>
<p>Vim will now wrap lines (at word boundaries) when the length of a line exceeds this value.</p>
<h3 id="formatting-paragraphs">Formatting Paragraphs</h3>
<p>Normally, we wouldn't want to set a text width while writing code (though keeping line length below 80 characters is a good practice), but for this task it will be useful.</p>
<p>So let's add our text. Type this in:</p>
<pre><code># This program is free software: you can redistribute it and/or modify it
# under the terms of the GNU General Public License as published by the
# Free Software Foundation, either version 3 of the License, or (at your
# option) any later version.

# This program is distributed in the hope that it will be useful, but
# WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General
# Public License at &lt;http://www.gnu.org/licenses/&gt; for more details.</code></pre>
<p>Notice the magic of vim as we type. Each time the length of the line reaches the text width, vim automatically starts a new line including, the comment symbol. While the filetype is set for shell scripting, vim understands certain things about shell syntax and tries to help. Very handy.</p>
<p>Now let's say we were not happy with the length of these lines, or that we have edited the text in such a way that some of the lines are either too long or too short to maintain our well-formatted text. Wouldn't be great is we could reformat our comment block? Well, we can. Very easily, in fact.</p>
<p>To demonstrate, let's change the text width to 65 characters:</p>
<pre><code>:set tw=65</code></pre>
<p>Now place the cursor inside the comment block and type:</p>
<pre><code>gqip</code></pre>
<p>(meaning &quot;format in paragraph&quot;) and watch what happens. Presto, the block is reformatted to the new text width! A little later, we will show how to reduce this four key sequence down to a single key.</p>
<h3 id="comment-blocks">Comment Blocks</h3>
<p>There is a fun trick we can perform on this comment block. When we write code, we frequently perform testing and debugging by commenting out sections. Vim makes this process pretty easy. To try this out, let's first remove the commenting from our block. We will do this by using visual mode to select a block. Place the cursor on the first column of the first line of the comment block, then enter visual mode:</p>
<pre><code>Ctrl-v</code></pre>
<p>Then, move the cursor right one column and then down to the bottom of the block.</p>
<div class="figure">
<img src="images/adventure_vimvigor_block_select.png" alt="Visual block select" ><p class="caption">Visual block select</p>
</div>
<p>Next, type:</p>
<pre><code>d</code></pre>
<p>This will delete the contents of the selected area. Now our block is uncommented.</p>
<p>To comment the block again, move the cursor to the first character of the block and, using visual block selection, select the first 2 columns of the block.</p>
<div class="figure">
<img src="images/adventure_vimvigor_column_select.png" alt="Column selection" ><p class="caption">Column selection</p>
</div>
<p>Next, enter insert mode using <code>Shift-i</code> (command to insert at the beginning of the line), then type the <code>#</code> symbol followed by a space. Finally, press the <code>Esc</code> key twice. Vim will insert the <code>#</code> symbol and space into each line of the block.</p>
<div class="figure">
<img src="images/adventure_vimvigor_completed_block.png" alt="Completed block" ><p class="caption">Completed block</p>
</div>
<h3 id="case-conversion">Case Conversion</h3>
<p>From time to time, we need to change text from upper to lower case and vice versa. vim has the following case conversion commands:</p>
<pre><code>~       Toggle the case of the current character
gU      Convert text to upper case
gu      Convert text to lower case</code></pre>
<p>Both the <code>gU</code> and <code>gu</code> commands can be applied to text selected in visual mode or used in conjunction with either movement commands or text object selections. For example:</p>
<pre><code>gUis    Convert the current sentence to upper case
guf:    Convert text from the cursor position to the next &#39;:&#39;
        character on the current line</code></pre>
<h3 id="file-format-conversion">File Format Conversion</h3>
<p>Once in a while, we are inflicted with a text file that was created on a DOS/Windows system. These files will contain an extra carriage return at the end of each line. Vim will indicate this after loading the file by displaying a &quot;DOS&quot; message at the bottom of the editing window. To correct this annoying condition, do the following:</p>
<pre><code>:set fileformat=unix
:w</code></pre>
<p>and the file will be rewritten in the correct format.</p>
<p><strong>Help topics:</strong> <code>'textwidth' gq 'fileformat' ~ gu gU</code></p>
<h2 id="macros">Macros</h2>
<p>Text editing sometimes means we get stuck with a tedious repetitive editing task where we do the same set of operations over and over again. This is the bane of every computer user. Fortunately, vim provides us a way to record a sequence of operations we can later playback as needed. These recordings are called <em>macros</em>.</p>
<p>To create a macro, we begin recording by typing <code>q</code> followed by a single letter. The character typed after the <code>q</code> becomes the name of the macro. After we start recording, everything we type gets stored in the macro. To conclude recording, we type <code>q</code> again.</p>
<p>To demonstrate, let's consider our comment block again. To create a macro that will remove a comment symbol from the beginning of the line, we would do this: move to the first line in the comment block and type the following command:</p>
<pre><code>qa^xxjq</code></pre>
<p>Let's break down what this sequence does:</p>
<pre><code>qa      Start recording macro &quot;a&quot;
^       Move to the first non-whitespace character in the line
xx      Delete the first two characters under the cursor
j       Move down one line
q       End recording</code></pre>
<p>Now that we have removed the comment symbol from the first line and our cursor is on the second line, we can replay our macro by typing:</p>
<pre><code>@a</code></pre>
<p>and the recorded sequence will be performed. To repeat the macro on succeeding lines, we can use the repeat last macro command which is:</p>
<pre><code>@@</code></pre>
<p>Or we could precede the macro invocation with a count as with other commands. For example, if we type:</p>
<pre><code>5@a</code></pre>
<p>the macro will be repeated 5 times.</p>
<p>We can undo the effect of the macro by repeatedly typing:</p>
<pre><code>u</code></pre>
<p>One nice thing about macros is that vim remembers them. Each time we exit vim, the current macro definitions are stored and ready for reuse the next time we start another editing session.</p>
<p><strong>Help topics:</strong> <code>q @</code></p>
<h2 id="registers">Registers</h2>
<p>We are no doubt familiar with the idea of copying and pasting in text editors. With vim, we know <code>y</code> performs a yank (copy) of the selected text, while <code>p</code> and <code>P</code> each paste text at the current cursor location. The way vim does this involves the use of <em>registers</em>.</p>
<p>Registers are named areas of memory where vim stores text. We can think of them as a series of string variables. Vim uses one particular set to store text that we delete, but there are others that we can use to store text and restore it as we desire. It's like having a multi-element clipboard.</p>
<p>To refer to a register, we type &quot; followed by a lowercase letter or a digit (though these have a special use), for example:</p>
<pre><code>&quot;a</code></pre>
<p>refers to the register named &quot;a&quot;. To place something in the register, we follow the register with an operation like &quot;yank to end of the line&quot;:</p>
<pre><code>&quot;ay$</code></pre>
<p>To recall the contents of a register, we follow the name of the register with a paste operation like so:</p>
<pre><code>&quot;ap</code></pre>
<p>Using registers enables us to place many chunks of text into our clipboard at the same time. But even without consciously trying to use registers, vim is using them while we perform deletes and yanks.</p>
<p>As we mentioned earlier, the registers named 0-9 have a special use. When we perform ordinary yanks and deletes, vim places our latest yank in register 0 and our last nine deletes in registers 1-9. As we continue to make deletions, vim moves the previous deletion to the next number, so register 1 will contain our most recent deletion and register 9 the oldest.</p>
<p>Knowing this allows us to overcome the problem of performing a yank and then a delete and losing the text we yanked (a common hazard when using vim). We can always recall the latest yank by referencing register 0.</p>
<p>To see the current contents of the registers we can use the command:</p>
<pre><code>:reg</code></pre>
<p><strong>Help topics:</strong> <code>&quot; :registers</code></p>
<h2 id="insert-sub-modes">Insert Sub-Modes</h2>
<p>While it's not obvious, vim has a set of commands inside of insert mode. Most of these commands invoke some form of automatic completion to make our typing faster. They're a little clumsy, but might be worth a try.</p>
<h3 id="automatically-complete-word-ctrl-n">Automatically Complete Word Ctrl-n</h3>
<p>Let's go to the bottom of our script file and enter insert mode to add a new line at the bottom. We want the line to read:</p>
<pre><code>afunction &amp;&amp; echo &quot;It worked.&quot;</code></pre>
<p>We start to type the first few characters (&quot;afun&quot;) and press <code>Ctrl-n</code>. Vim should automatically complete the function name &quot;afunction&quot; after we press it. In those cases where vim presents us with more than one choice, use <code>Ctrl-n</code> and <code>Ctrl-p</code> to move up and down the list. Typing any another character, such as a space, to continue our typing will accept our selection and end the automatic completion. <code>Ctrl-e</code> can be use to exit the sub-mode immediately.</p>
<h3 id="insert-register-contents---ctrl-r">Insert Register Contents - Ctrl-r</h3>
<p>Typing <code>Ctrl-r</code> followed by a single character register name will insert the contents of that register. Unlike doing an ordinary paste using <code>p</code> or <code>P</code>, a register insert honors text formatting and indentation settings such as <code>textwidth</code> and <code>autoindent</code>.</p>
<h3 id="automatically-complete-line---ctrl-x-ctrl-l">Automatically Complete Line - Ctrl-x Ctrl-l</h3>
<p>Typing <code>Ctrl-x</code> while in insert mode launches a sub-mode of automatic completion features. A small menu will appear at the bottom of the display with a list of keys we can type to perform different completions.</p>
<p>If we have typed the first few letters of a line found in this or any other file that vim has open, typing <code>Ctrl-x</code> <code>Ctrl-l</code> will attempt to automatically complete the line, copying the line to the current location.</p>
<h3 id="automatically-complete-filename-ctrl-x-ctrl-f">Automatically Complete Filename Ctrl-x Ctrl-f</h3>
<p>This will perform filename completion. If we start the name of an existing path/file, we can type <code>Ctrl-x</code> <code>Ctrl-f</code> and vim will attempt to complete the name.</p>
<h3 id="dictionary-lookup---ctrl-x-ctrl-k">Dictionary Lookup - Ctrl-x Ctrl-k</h3>
<p>If we define a dictionary (i.e., a sorted list of words), by adding this line to our configuration file:</p>
<pre><code>setlocal dictionary=/usr/share/dict/words</code></pre>
<p>which is the default dictionary on most Linux systems, we can begin typing a word, type <code>Ctrl-x</code> <code>Ctrl-k</code>, and vim will attempt to automatically complete the word using the dictionary. We will be presented with a list of words from which we can choose the desired entry.</p>
<p><strong>Help topics:</strong> <code>i_^n i_^p i_^x^l i_^x^r i_^x^f i_^x^k 'dictionary'</code></p>
<h2 id="mapping">Mapping</h2>
<p>Like many interactive command line programs, vim allows users to remap keys to customize vim's behavior. It has a specific command for this, <code>map</code>, that allows a key to be assigned the function of another key or a sequence of keys. Further, vim allows us to say that a key is to be remapped only in a certain mode, for example only in normal mode but not in insert nor command modes.</p>
<p>Before we go on, we should point out that use of the <code>map</code> command is discouraged. It can create nasty side effects in some situations. Vim provides another set of mapping commands that are safer to use.</p>
<p>Earlier, we looked at the paragraph reformatting command sequence <code>gqip</code>, which means &quot;format in paragraph.&quot; To demonstrate a useful remapping, we will map the <code>Q</code> key to generate this sequence. We can do this by entering:</p>
<pre><code>:nnoremap Q gqip</code></pre>
<p>After executing this command, pressing the <code>Q</code> key in normal mode will cause the normal mode sequence <code>gqip</code> to be performed.</p>
<p>The <code>nnoremap</code> command is one of the <code>noremap</code> commands, the safe version of <code>map</code> command. The members of this family include:</p>
<pre><code>noremap     Map key regardless of mode
nnoremap    Map normal mode key
inoremap    Map insert mode key
cnoremap    Map command mode key</code></pre>
<p>Most of the time we will be remapping normal mode keys, so the <code>nnoremap</code> command will be the used most often. Here is another example:</p>
<pre><code>:nnoremap S :split&lt;Return&gt;</code></pre>
<p>This command maps the <code>S</code> key to enter command mode, type the <code>split</code> command and a carriage return. The &quot;&lt;Return&gt;&quot; is called a <em>key notation</em>. For non-printable characters, vim has a representation that can be used to indicate the key when we specifying mapping. To see the entire list of possible codes, enter:</p>
<pre><code>:h key-notation</code></pre>
<p>So how do we know which keys are available for remapping assignment? As vim uses almost every key for something, we have to make a judgment call as to what native functionality we are willing to give up to get the mapping we want. In the case of the Q key, which we used in our first example, it is normally used to invoke ex mode, a very rarely used feature. There are many such cases in vim; we just have to be selective. It is best to check the key first by doing something like:</p>
<pre><code>:h Q</code></pre>
<p>to see how a key is being used before we apply our own mapping.</p>
<p>To make mappings permanent, we can add these mapping commands to our <code>.vimrc</code> file:</p>
<pre><code>nnoremap Q gqip
nnoremap S :split&lt;Return&gt;</code></pre>
<p><strong>Help topics:</strong> <code>:map key-notation</code></p>
<h2 id="snippets">Snippets</h2>
<p>Mapping is not restricted to single characters. We can use sequences too. This is often helpful when we want to create a number of easily remembered, related commands of our own design. Take for example, inserting boilerplate text into a document. If we had a collection of these snippets, we might want to uniquely name them but have a common structure to the name for easily recollection.</p>
<p>We added the GPL notice to the comment block at the beginning of our script. As this is rather tedious to type, and we might to use it again, it makes a good candidate for being a snippet.</p>
<p>To do this, we'll first go out to the shell and create a directory to store our snippet text files. It doesn't matter where we put the snippet files, but in the interest of keeping all the vim stuff together, we'll put them with our other vim-related files.</p>
<pre><code>:sh
[me@linuxbox ~]$ mkdir ~/.vim/snippets
[me@linuxbox ~]$ exit</code></pre>
<p>Next, we'll copy the license by highlighting the text in visual mode and yanking it. To create the snippet file, we'll open a new buffer:</p>
<pre><code>:e ~/.vim/snippets/gpl.sh</code></pre>
<p>Thus creating a new file called gpl.sh. Finally, we'll paste the copied text into our new file and save it:</p>
<pre><code>p
:w</code></pre>
<p>Now that we have our snippet file in place, we are ready to define our mapping:</p>
<pre><code>:nnoremap ,GPL :r ~/.vim/snippets/gpl.sh&lt;Return&gt;</code></pre>
<p>We map &quot;,GPL&quot; to a command that will cause vim to read the snippet file into the current buffer. The leading comma is used as a <em>leader character</em>. The comma is a rarely used command that is usually safe to remap. Using a leader character will reduce the number of actual vim commands we have to remap if we create a lot of snippets.</p>
<p>As we add mappings, it's useful to know what they all are. To display a list of mappings, we use the <code>:map</code> command followed by no arguments:</p>
<pre><code>:map</code></pre>
<p>Once we are satisfied with our remapping, we can add it to one of our vim configuration files. If we want it to be global (that is, it applies to all types of files), we could put it in our <code>.vimrc</code> file like this:</p>
<pre><code>nnoremap ,GPL :r ~/.vim/snippets/gpl.sh&lt;Return&gt;</code></pre>
<p>If, on the other hand, we want it to be specific to a particular file type, we would put it in the appropriate file such as <code>~/.vim/ftplugin/sh.vim</code> like this:</p>
<pre><code>nnoremap &lt;buffer&gt; ,GPL :r ~/.vim/snippets/gpl.sh&lt;Return&gt;</code></pre>
<p>In this case, we add the special argument &lt;buffer&gt; to make the mapping local to the current buffer containing the particular file type.</p>
<p><strong>Help topics:</strong> <code>:map &lt;buffer&gt;</code></p>
<h2 id="finishing-our-script">Finishing Our Script</h2>
<p>With all that we have learned so far, it should be pretty easy to go ahead and finish our script:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#! /bin/bash</span>

<span class="co"># ---------------------------------------------------------------</span>
<span class="co"># This is a shell script to demonstrate features in vim. It</span>
<span class="co"># doesn&#39;t really do anything, it just shows what we can do.</span>
<span class="co"># </span>
<span class="co"># This program is free software: you can redistribute it an/or</span>
<span class="co"># modify it under the terms of the GNU General Public License as</span>
<span class="co"># published by the Free Software Foundation, either version 3 of</span>
<span class="co"># the license, or (at your option) any later version.</span>
<span class="co"># </span>
<span class="co"># This program is distributed in the hope that it will be useful,</span>
<span class="co"># but WITHOUT ANY WARRANTY; without even the implied warranty of</span>
<span class="co"># MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the GNU</span>
<span class="co"># General Public License at &lt;http://www.gnu.org/licenses/&gt; for</span>
<span class="co"># more details.</span>
<span class="co"># ---------------------------------------------------------------</span>

<span class="co"># ---------------------------------------------------------------</span>
<span class="co"># Constants</span>
<span class="co"># ---------------------------------------------------------------</span>

<span class="ot">A=</span>1
<span class="ot">B=</span>2

<span class="co"># ---------------------------------------------------------------</span>
<span class="co"># Functions</span>
<span class="co"># ---------------------------------------------------------------</span>

<span class="fu">afunction()</span> <span class="kw">{</span>
  cmd1
  cmd2
<span class="kw">}</span>

<span class="co"># ---------------------------------------------------------------</span>
<span class="co"># Main Logic</span>
<span class="co"># ---------------------------------------------------------------</span>

<span class="kw">if </span>[[ <span class="ot">$A</span> == <span class="ot">$B</span> ]]; <span class="kw">then</span>
  <span class="kw">echo</span> <span class="st">&quot;This shows how smartindent works.&quot;</span>
  <span class="kw">echo</span> <span class="st">&quot;This shows how autoindent works.&quot;</span>
  <span class="kw">echo</span> <span class="st">&quot;A and B match.&quot;</span>
<span class="kw">else</span>
  <span class="kw">echo</span> <span class="st">&quot;A and B do not match.&quot;</span>
<span class="kw">fi</span>

<span class="kw">if </span>[[ -e <span class="kw">file</span> ]]; <span class="kw">then</span>
  cmd1
  cmd2
<span class="kw">fi</span></code></pre>
<h2 id="using-external-commands">Using External Commands</h2>
<p>Vim is able to execute external commands and add the result to the current buffer or to filter a text selection using an external command.</p>
<h3 id="loading-output-from-a-command-into-the-buffer">Loading Output From a Command Into the Buffer</h3>
<p>Let's edit an old friend. If we don't have a copy to edit, we can make one. First we'll open a buffer:</p>
<pre><code>:e dir-list.txt</code></pre>
<p>Next, we'll load the buffer with some appropriate text:</p>
<pre><code>:r ! ls -l /usr/bin</code></pre>
<p>This will read the results of the specified external command into our buffer.</p>
<h3 id="running-an-external-command-on-the-current-file">Running an External Command on the Current File</h3>
<p>Let's save our file and then run an external command on it:</p>
<pre><code>:w
:! wc -l %</code></pre>
<p>Here we tell vim to execute the <code>wc</code> command on the current file <code>dir-list.txt</code>. This does not affect the current buffer, just the file when we specify it with the % symbol.</p>
<h3 id="using-an-external-command-to-filter-the-current-buffer">Using an External Command to Filter the Current Buffer</h3>
<p>Let's apply a filter to the text. To do this, we need to select some text. The easiest way to do this is with visual mode:</p>
<pre><code>ggVG</code></pre>
<p>This will move the cursor to the beginning of the file and enter visual mode then move to the end of the file, thus selecting the entire buffer.</p>
<p>We'll filter the selection to remove everything except lines containing the string &quot;zip&quot;. When we start entering a command after performing a visual selection, the presence of the selection will be indicated this way:</p>
<pre><code>:&#39;&lt;,&#39;&gt;</code></pre>
<p>This actually signifies a range. We could just as easily specify a pair of line numbers such as 1, 100 instead. To complete our command, we add our filter:</p>
<pre><code>:&#39;&lt;,&#39;&gt; ! grep zip</code></pre>
<p>Notice that we are not limited to a single command. We can also specify pipelines, for example:</p>
<pre><code>:&#39;&lt;,&#39;&gt; ! grep zip | sort</code></pre>
<p>After running this command, our buffer contains a small selection of files, each containing the letters &quot;zip&quot; in the name.</p>
<p><strong>Help topics:</strong> : <code>! filter</code></p>
<h2 id="file-system-management-and-navigation">File System Management and Navigation</h2>
<p>We know that we can load files into vim by specifying them on the command line when we initially invoke vim, and that we can load files from within vim with the <code>:edit</code> and <code>:read</code> commands. But vim also provides more advanced ways of working with the file system.</p>
<h3 id="netrw">netrw</h3>
<p>When we load the filetype plugin (as we have set up our <code>.vimrc</code> file to do), vim also loads another plugin called <em>netrw</em>. This plugin can, as its name suggests, read and write files from the local file system and from remote systems over the network. In this adventure, we're going concern ourselves with using netrw as a local file browser.</p>
<p>To start the browser in the current window, we use the <code>:Ex</code> (short for <code>:Explore</code>) command. To start the browser in a split window, we use the amusingly named <code>:Sex</code> (short for <code>:Sexplore</code>) command. The browser looks like this:</p>
<div class="figure">
<img src="images/adventure_vimvigor_netrw.png" alt="File browser" ><p class="caption">File browser</p>
</div>
<p>At the top, we have the banner which provides some clues to the browser's operation, followed by a vertical list of directories and files. We can toggle the banner on and off with <code>Shift-i</code> and cycle through available listing views by pressing the <code>i</code> key. The sort order (name, time, size) may be changed with <code>s</code> key.</p>
<p>Using the browser is easy. To select a file or directory, we can use the up and down arrows (or <code>Ctrl-p</code> and <code>Ctrl-n</code>) to move the cursor. Pressing Enter will open the selected file or directory.</p>
<h3 id="find">:find</h3>
<p>The <code>:find</code> command loads a file by searching a path variable maintained by vim. With <code>:find</code> we can specify a partial file name, and vim will attempt to locate the file and automatically complete the name when Tab key is pressed.</p>
<p>The action of the <code>:find</code> command can be enhanced if the characters &quot;**&quot; are appended to the end of the path. The best way to do this is:</p>
<pre><code>:set path+=**</code></pre>
<p>Adding this to the path allows <code>:find</code> to search directories recursively. For example, we could change the current working directory to the top of a project's source file tree and use <code>:find</code> to load any file in the entire tree.</p>
<h3 id="wildmenu">wildmenu</h3>
<p>Another cool enhancement we can apply is the <em>wildmenu</em>. This is a highlighted bar that will appear above the command line when we are entering file names. The word &quot;wild&quot; in the name refers to use of the &quot;wild&quot; key, by default the Tab key. When the wild key is pressed, automatic completion is attempted with the list of possible matches displayed in the wildmenu. Using the left and right arrow keys (or <code>Ctrl-p</code> and <code>Ctrl-n</code>) allows us to choose one of the displayed items.</p>
<div class="figure">
<img src="images/adventure_vimvigor_wildmenu.png" alt="The wildmenu" ><p class="caption">The wildmenu</p>
</div>
<p>We can turn on the wildmenu with this command:</p>
<pre><code>:set wildmenu</code></pre>
<h3 id="opening-files-named-in-a-document">Opening Files Named in a Document</h3>
<p>If the document we are editing contains a file name, we can open that file by placing the cursor on the file name and typing either of these commands:</p>
<pre><code>gf      Open file name under cursor
^w^f    Open file name under cursor in new window</code></pre>
<p><strong>Help topics:</strong> <code>netrw :find 'path' 'wildmenu' gf ^w^f</code></p>
<h2 id="one-does-not-live-by-code-alone">One Does Not Live by Code Alone</h2>
<p>While vim is most often associated with writing code of all sorts, it's good at writing ordinary prose as well. Need proof? All of these adventures were written using vim running on a Raspberry Pi!</p>
<p>We can configure vim to work well with text by creating a file for the text file type in the <code>~/.vim/ftplugin</code> directory:</p>
<pre><code>&quot;### ~/.vim/ftplugin/text.vim
setlocal textwidth=75
setlocal tabstop=4
setlocal shiftwidth=4
setlocal expandtab</code></pre>
<p>This configuration will automatically wrap lines at word boundaries once the line length exceeds 75 characters, and will set tabs to 4 spaces wide. Remember that when <code>textwidth</code> is non-zero, vim will automatically constrain line length, and we can use the <code>gqip</code> command to reformat paragraphs to the specified width.</p>
<h3 id="spell-checking">Spell Checking</h3>
<p>When we write text, it's handy to perform spell checking while we type. Fortunately, vim can do this, too. If we add the following lines to our <code>text.vim file</code>, vim will help fix those pesky spelling mistakes:</p>
<pre><code>setlocal spelllang=en_us
setlocal dictionary=/usr/share/dict/words
setlocal spell</code></pre>
<p>The first line defines the language for spell checking, in this case US English. Next, we specify the dictionary file to use. Most Linux distributions include this list of words, but other dictionary files can be used. The final line turns on the spell checker. When active, the spell checker highlights misspelled words (that is, any word not found in the dictionary) as we type.</p>
<div class="figure">
<img src="images/adventure_vimvigor_spelling.png" alt="Highlighted misspellings" ><p class="caption">Highlighted misspellings</p>
</div>
<p>Correcting misspelled words is pretty easy. Vim provides the following commands:</p>
<pre><code>]s                      Next misspelled word
[s                      Previous misspelled word
z=                      Display suggested corrections
zg                      Add word to personal dictionary</code></pre>
<p>To correct a misspelling, we place the cursor on the highlighted word and type:</p>
<pre><code>z=</code></pre>
<p>Vim will display a list of suggested corrections and we choose from the list. It is also possible to maintain a personal dictionary of words not found in the main dictionary, for example specialized technical terms. Vim creates the personal dictionary automatically (in <code>~/.vim/spell</code>) and words are added to it when we place the cursor on the highlighted word and type:</p>
<pre><code>zg</code></pre>
<p>Once the word is added to our personal dictionary it will no longer be marked as misspelled by the spelling checker.</p>
<div class="figure">
<img src="images/adventure_vimvigor_spelling2.png" alt="Suggested corrections" ><p class="caption">Suggested corrections</p>
</div>
<p><strong>Help topics:</strong> <code>'spelllang' 'spell'</code></p>
<h2 id="more-.vimrc-tricks">More .vimrc Tricks</h2>
<p>Before we go, there are a few more features we can add to our <code>.vimrc</code> file to juice things up a bit. The first one:</p>
<pre><code>set laststatus=2</code></pre>
<p>This will cause vim to display a status bar near the bottom of the display. It will normally appear when more than one window is open (<code>lastatatus=1</code>), but changing this value to 2 causes it to always be displayed regardless of the number of windows. Next, we have:</p>
<pre><code>set ruler</code></pre>
<p>will display the cursor position (row, column, relative %) in the window status bar. Handy for knowing where we are within a file.</p>
<p>Finally, we'll add mouse support (not that we should ever use a mouse ;-):</p>
<pre><code>if has(&#39;mouse&#39;)
  set mouse=a
endif</code></pre>
<p>This will activate mouse support if vim detects a mouse. Mouse support allows us to position the cursor, switching windows if needed. It works in visual mode too.</p>
<p><strong>Help topics:</strong> <code>'laststatus' 'ruler' 'mouse'</code></p>
<h2 id="summing-up">Summing Up</h2>
<p>We can sometimes think of vim as being a metaphor for the command line itself. Both are arcane, vast, and capable of many amazing feats. Despite its ancient ancestry, vim remains a vital and popular tool for developers and administrators.</p>
<p>Here are the final versions of our 3 configuration files:</p>
<pre><code>&quot;### ~/.vimrc
set nocompatible
filetype plugin on
nnoremap Q gqip
nnoremap S :split&lt;Return&gt;
set path+=**
set wildmenu
set spelllang=en_us
if has(&#39;mouse&#39;)
  set mouse=a
endif
set laststatus=2
set ruler

&quot;### ~/.vim/ftplugin/sh.vim
setlocal number
colorscheme desert
syntax off
setlocal tabstop=2
setlocal shiftwidth=2
setlocal expandtab
setlocal softtabstop=2
setlocal autoindent
setlocal smartindent

&quot;### ~/.vim/ftplugin/text.vim
colorscheme desert
setlocal textwidth=75
setlocal tabstop=4
setlocal shiftwidth=4
setlocal expandtab
setlocal complete=.,w,b,u,t,i
setlocal dictionary=/usr/share/dict/words
setlocal spell</code></pre>
<p>We covered a lot of ground in this adventure and it will take some time for it to all sink in. The best advice was given back in TLCL. The only way to become a master is to &quot;practice, practice, practice!&quot;</p>
<h2 id="further-reading">Further Reading</h2>
<p>Vim has a large and enthusiastic user community. As a result, there are many online help and training resources. Here are some that I found useful during my research for this adventure.</p>
<ul>
<li><p>The eternal struggle between tabs and spaces in indentation: <a href="https://www.jwz.org/doc/tabs-vs-spaces.html">https://www.jwz.org/doc/tabs-vs-spaces.html</a></p></li>
<li><p>List of key notations used when remapping keys: <a href="http://vimdoc.sourceforge.net/htmldoc/intro.html#key-notation">http://vimdoc.sourceforge.net/htmldoc/intro.html#key-notation</a></p></li>
<li><p>A concise tutorial on vim registers: <a href="https://www.brianstorti.com/vim-registers/">https://www.brianstorti.com/vim-registers/</a></p></li>
<li><p>Learn Vimscript the Hard Way is a detailed tutorial of the vim scripting language useful for customizing vim and even writing your own plugins: <a href="http://learnvimscriptthehardway.stevelosh.com/">http://learnvimscriptthehardway.stevelosh.com/</a></p></li>
<li><p>From the same source, a discussion of the leader key: <a href="http://learnvimscriptthehardway.stevelosh.com/chapters/06.html">http://learnvimscriptthehardway.stevelosh.com/chapters/06.html</a></p></li>
<li><p>Using external commands and the shell while inside vim: <a href="https://www.linux.com/learn/vim-tips-working-external-commands">https://www.linux.com/learn/vim-tips-working-external-commands</a></p></li>
<li><p>Vim: you don't need NERDtree or (maybe) netrw <a href="https://shapeshed.com/vim-netrw/#removing-the-banner">https://shapeshed.com/vim-netrw/#removing-the-banner</a></p></li>
<li><p>A tutorial on using the vim spell checker: <a href="https://www.linux.com/learn/using-spell-checking-vim">https://www.linux.com/learn/using-spell-checking-vim</a></p></li>
</ul>
<h3 id="videos">Videos</h3>
<p>There are also a lot of video tutorials for vim. Here are a few:</p>
<ul>
<li><p>How to Do 90% of What Plugins Do (With Just Vim): <a href="https://youtu.be/XA2WjJbmmoM">https://youtu.be/XA2WjJbmmoM</a></p></li>
<li><p>Let Vim do the Typing: <a href="https://youtu.be/3TX3kV3TICU">https://youtu.be/3TX3kV3TICU</a></p></li>
<li><p>Damian Conway, &quot;More Instantly Better Vim&quot; - OSCON 2013: <a href="https://youtu.be/aHm36-na4-4">https://youtu.be/aHm36-na4-4</a></p></li>
<li><p>vim + tmux - OMG!Code: <a href="https://youtu.be/5r6yzFEXajQ">https://youtu.be/5r6yzFEXajQ</a></p></li>
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