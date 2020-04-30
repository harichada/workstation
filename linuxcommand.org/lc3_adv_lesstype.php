



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: Less Typing</title>
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
<h1 id="less-typing">Less Typing</h1>
<p>Since the beginning of time, Man has had an uneasy relationship with his keyboard. Sure, keyboards make it possible to express our precise wishes to the computer, but in our fat-fingered excitement to get stuff done, we often suffer from typos and digital fatigue.</p>
<p>In this adventure, we will travel down the carpal tunnel to the land of less typing. We covered some of this in TLCL, but here we will look a little deeper.</p>
<h2 id="aliases-and-shell-functions">Aliases and Shell Functions</h2>
<p>The first thing we can do to reduce the number of characters we type is to make full use of <em>aliases</em> and <em>shell functions</em>. Aliases were created for this very purpose and are often a very effective solution. Shell functions perform in many ways like aliases but allow a full range of shell script-like capabilities such as programmatic logic, and option and argument processing.</p>
<p>Most Linux distributions provide some set of default alias definitions and it's easy to add more. To see the aliases we already have, we enter the <code>alias</code> command without arguments:</p>
<pre><code>me@linuxbox: ~ $ alias
alias egrep=&#39;egrep --color=auto&#39;
alias fgrep=&#39;fgrep --color=auto&#39;
alias grep=&#39;grep --color=auto&#39;
alias ls=&#39;ls --color=auto    </code></pre>
<p>On this example system, we see <code>alias</code> is used to activate color output for some commonly used commands. It is also common to create aliases for various forms of the <code>ls</code> command:</p>
<pre><code>alias ll=&#39;ls -l&#39;
alias la=&#39;ls -A&#39;
alias l=&#39;ls -CF&#39;
alias l.=&#39;ls -d .*&#39;
alias lm=&#39;ls -l | less&#39;</code></pre>
<p>Aliases are good for lots of things, for example, here's one that's useful for Debian-style systems:</p>
<pre><code>alias update=&#39;sudo apt-get update &amp;&amp; sudo apt-get upgrade&#39;</code></pre>
<p>Aliases are easy to create. It's usually just a matter of appending them to our <code>.bashrc</code> file. Before creating a new alias, it's a good idea to first test the proposed name of the alias with the <code>type</code> command to check if the name is already being used by another program or alias.</p>
<p>While being easy, aliases are somewhat limited. In particular, aliases are not good at handling complex logic or accepting positional parameters. For that we need to use shell functions.</p>
<p>As we recall from TLCL, shell functions are miniature shell scripts that we can add to our <code>.bashrc</code> file to perform anything that we may otherwise do with a shell script. Here is an example function that displays a quick snapshot of a system's health:</p>
<pre class="sourceCode bash" id="status"><code class="sourceCode bash">    <span class="fu">status()</span> <span class="kw">{</span>
      <span class="kw">{</span> <span class="kw">echo</span> -e <span class="st">&quot;\nuptime:&quot;</span>
        <span class="kw">uptime</span>
        <span class="kw">echo</span> -e <span class="st">&quot;\ndisk space:&quot;</span>
        <span class="kw">df</span> -h <span class="kw">2&gt;</span> /dev/null
        <span class="kw">echo</span> -e <span class="st">&quot;\ninodes:&quot;</span>
        <span class="kw">df</span> -i <span class="kw">2&gt;</span> /dev/null
        <span class="kw">echo</span> -e <span class="st">&quot;\nblock devices:&quot;</span>
        blkid
        <span class="kw">echo</span> -e <span class="st">&quot;\nmemory:&quot;</span>
        <span class="kw">free</span> -m
        <span class="kw">if </span>[[ -r /var/log/syslog ]]; <span class="kw">then</span>
          <span class="kw">echo</span> -e <span class="st">&quot;\nsyslog:&quot;</span>
          <span class="kw">tail</span> /var/log/syslog
        <span class="kw">fi</span>
        <span class="kw">if </span>[[ -r /var/log/messages ]]; <span class="kw">then</span>
          <span class="kw">echo</span> -e <span class="st">&quot;\nmessages:&quot;</span>
          <span class="kw">tail</span> /var/log/messages
        <span class="kw">fi</span>
      <span class="kw">}</span> <span class="kw">|</span> <span class="kw">less</span>
    <span class="kw">}</span></code></pre>
<p>Unlike aliases, shell functions can accept positional parameters:</p>
<pre class="sourceCode bash" id="params"><code class="sourceCode bash">    <span class="fu">params()</span> <span class="kw">{</span>
        <span class="kw">local</span> <span class="ot">argc=</span>0
        <span class="kw">while [[</span> <span class="ot">-n</span> <span class="ot">$1</span><span class="kw"> ]]</span>; <span class="kw">do</span>
            <span class="ot">argc=$((</span>++argc<span class="ot">))</span>
            <span class="kw">echo</span> <span class="st">&quot;Argument </span><span class="ot">$argc</span><span class="st"> = </span><span class="ot">$1</span><span class="st">&quot;</span>
            <span class="kw">shift</span>
        <span class="kw">done</span>
    <span class="kw">}</span></code></pre>
<h2 id="command-line-editing">Command Line Editing</h2>
<p>Aliases and shell functions are all well and good, provided we know in advance the operations we wish to perform, but what about the rest of the time? Most command line operations we perform are on-the-fly, so other techniques are needed.</p>
<p>As we saw in Chapter 8 of TLCL, the bash shell includes a library called <em>readline</em> to handle keyboard input during interactive shell sessions. This includes text typed at the shell prompt and keyboard input using the <code>read</code> builtin when the <code>-e</code> option is specified. The readline library supports a large number of commands that can be used to edit what we type at the command line. Many of the commands are taken from the <code>emacs</code> text editor (the subject of a future <em>Adventure</em>).</p>
<h3 id="control-commands">Control Commands</h3>
<p>Before we get to the actual editing commands, let's look at some commands that are used to control the editing process.</p>
<table>
<col width="21%" >
<col width="78%" >
<thead>
<tr class="header">
<th align="left">Command</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>Enter</code></td>
<td align="left">Pressing the enter key causes the current command line to be accepted. Note that the cursor location within the line does not matter (i.e., it doesn't have to be at the end). If the line is not empty, it is added to the command history.</td>
</tr>
<tr class="even">
<td align="left"><code>Esc</code></td>
<td align="left">Meta-prefix. If the <code>Alt</code> key is unavailable, the <code>Esc</code> key can be used in its place. For example, if a command calls for <code>Alt-r</code> but another program intercepts that command, press and release the <code>Esc</code> key followed by the <code>r</code> key.</td>
</tr>
<tr class="odd">
<td align="left"><code>Ctrl-g</code></td>
<td align="left">Abort the current editing command.</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-_</code></td>
<td align="left">Incrementally undo changes to the line.</td>
</tr>
<tr class="odd">
<td align="left"><code>Alt-r</code></td>
<td align="left">Revert all changes to the line (i.e., complete undo).</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-l</code></td>
<td align="left">Clear the screen.</td>
</tr>
<tr class="odd">
<td align="left"><code>Alt-num</code></td>
<td align="left">Where <code>num</code> is a number. Some commands accept a numeric argument. For those commands that accept it, type this first followed by the command.</td>
</tr>
</tbody>
</table>
<h3 id="moving-around">Moving Around</h3>
<p>Here are some commands to move the cursor around the current command line. In the readline documentation, the current cursor location is referred to as the <em>point</em>.</p>
<table>
<col width="21%" >
<col width="78%" >
<thead>
<tr class="header">
<th align="left">Command</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>Right</code></td>
<td align="left">Move forward one character.</td>
</tr>
<tr class="even">
<td align="left"><code>Left</code></td>
<td align="left">Move backward one character.</td>
</tr>
<tr class="odd">
<td align="left"><code>Alt-f</code></td>
<td align="left">Move forward one word.</td>
</tr>
<tr class="even">
<td align="left"><code>Alt-b</code></td>
<td align="left">Move backward one word.</td>
</tr>
<tr class="odd">
<td align="left"><code>Ctrl-a</code></td>
<td align="left">Move to the beginning of the line.</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-e</code></td>
<td align="left">Move to the end of the line.</td>
</tr>
</tbody>
</table>
<h3 id="using-command-history">Using Command History</h3>
<p>In order to save typing, we frequently reuse previously typed commands stored in the command history. We can move up and down the history list and the history list can be searched.</p>
<table>
<col width="21%" >
<col width="78%" >
<thead>
<tr class="header">
<th align="left">Command</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>Up</code></td>
<td align="left">Move to previous history list entry.</td>
</tr>
<tr class="even">
<td align="left"><code>Down</code></td>
<td align="left">Move to next history list entry.</td>
</tr>
<tr class="odd">
<td align="left"><code>Alt-&lt;</code></td>
<td align="left">Move to the beginning of the history list.</td>
</tr>
<tr class="even">
<td align="left"><code>Alt-&gt;</code></td>
<td align="left">Move to the end of the history list.</td>
</tr>
<tr class="odd">
<td align="left"><code>Ctrl-r</code></td>
<td align="left">Perform an incremental history search starting at the current position and moving up the history list. After a command is typed, a prompt appears and with each succeeding character typed, the position within the list moves to the next matching line. This is probably the most useful of the history search commands.</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-s</code></td>
<td align="left">Like <code>Ctrl-r</code> except the search is performed moving down the history list.</td>
</tr>
<tr class="odd">
<td align="left"><code>Alt-p</code></td>
<td align="left">Perform a non-incremental search moving up the history list.</td>
</tr>
<tr class="even">
<td align="left"><code>Alt-n</code></td>
<td align="left">Perform a non-incremental search moving down the history list.</td>
</tr>
<tr class="odd">
<td align="left"><code>Alt-Ctrl-y</code></td>
<td align="left">Insert the first argument from the previous history entry. This command can take a numeric argument. When a numeric argument is given, the nth argument from the previous history entry is inserted.</td>
</tr>
<tr class="even">
<td align="left"><code>Alt-.</code></td>
<td align="left">Insert the last argument from the previous history entry. When a numeric argument is given, behavior is the same as <code>Alt-Ctrl-y</code> above.</td>
</tr>
</tbody>
</table>
<h3 id="changing-text">Changing Text</h3>
<table>
<col width="21%" >
<col width="78%" >
<thead>
<tr class="header">
<th align="left">Command</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>Ctrl-d</code></td>
<td align="left">Delete the character at the point.</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-t</code></td>
<td align="left">Transpose characters. Exchange the character at the point with the character preceding it.</td>
</tr>
<tr class="odd">
<td align="left"><code>Alt-t</code></td>
<td align="left">Transpose words. Exchange the word at the point with the word preceding it.</td>
</tr>
<tr class="even">
<td align="left"><code>Alt-u</code></td>
<td align="left">Change the current word to uppercase.</td>
</tr>
<tr class="odd">
<td align="left"><code>Alt-l</code></td>
<td align="left">Change the current word to lowercase.</td>
</tr>
<tr class="even">
<td align="left"><code>Alt-c</code></td>
<td align="left">Capitalize the current word.</td>
</tr>
</tbody>
</table>
<h3 id="cutting-and-pasting">Cutting and Pasting</h3>
<p>As with <code>vim</code>, cutting and pasting in readline are referred to as &quot;killing&quot; and &quot;yanking.&quot; The clipboard is called the <em>kill-ring</em> and is implemented as a <em>circular buffer</em>. This means that it contains multiple entries (i.e., each kill adds a new entry). The latest entry is referred to as the &quot;top&quot; entry. It is possible to &quot;rotate&quot; the kill-ring to bring the previous entry to the top and delete the latest entry. However, this feature is rarely used.</p>
<p>Mostly, the kill commands are used to simply delete text rather than save it for later yanking.</p>
<table>
<col width="21%" >
<col width="78%" >
<thead>
<tr class="header">
<th align="left">Command</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>Alt-d</code></td>
<td align="left">Kill from the point to the end of the current word. If the point is located in whitespace, kill to the end of the next word.</td>
</tr>
<tr class="even">
<td align="left"><code>Alt-Backspace</code></td>
<td align="left">Kill the word before the point.</td>
</tr>
<tr class="odd">
<td align="left"><code>Ctrl-k</code></td>
<td align="left">Kill from the point to end of line.</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-u</code></td>
<td align="left">Kill from the point to the beginning of the line.</td>
</tr>
<tr class="odd">
<td align="left"><code>Ctrl-y</code></td>
<td align="left">Yank the &quot;top&quot; entry from the kill-ring.</td>
</tr>
<tr class="even">
<td align="left"><code>Alt-y</code></td>
<td align="left">Rotate the kill-ring and yank the new &quot;top&quot; entry.</td>
</tr>
</tbody>
</table>
<h3 id="editing-in-action">Editing in Action</h3>
<p>In Chapter 4 of TLCL, we considered the danger of using a wildcard with the <code>rm</code> command. It was suggested that we first test the wildcard with the <code>ls</code> command to see the result of the expansion. We then recall the command from the history and edit the line to replace the &quot;ls&quot; with &quot;rm&quot;. So, how do we perform this simple edit?</p>
<p>First, the beginner's way: We recall the command with the up arrow, use the left arrow repeatedly to move the cursor to the space between the &quot;ls&quot; and the wildcard, backspace twice, then type &quot;rm&quot; and <code>Enter</code>.</p>
<p>That's a lot of keystrokes.</p>
<p>Next, the tough-guy's way: We recall the command with the up arrow, type <code>Ctrl-a</code> to jump to the beginning of the line, type <code>Alt-d</code> to kill the current word (the &quot;ls&quot;), type &quot;rm&quot; and <code>Enter</code>.</p>
<p>That's better.</p>
<p>Finally, the super-tough-guy's way: Type &quot;rm &quot; then <code>Alt-.</code> to recall the last argument (the wildcard) from the previous command, then <code>Enter</code>.</p>
<p>Wow.</p>
<h2 id="completion">Completion</h2>
<p>Another trick that readline can perform is called <em>completion</em>. This is where readline will attempt to automatically complete something we type.</p>
<p>For example, let's imagine that our current working directory contains a single file named &quot;foo.txt&quot; and we want to view it with <code>less</code>. So we begin to type the command &quot;less foo.txt&quot; but instead of typing it all out, we just type &quot;less f&quot; and then press the <code>Tab</code> key. Pressing <code>Tab</code> tells readline to attempt completion on the file name and remainder of the command is completed automatically.</p>
<p>This will work as long as the &quot;clue&quot; given to readline is not ambiguous. If we had two files in our imaginary directory named &quot;foo.txt&quot; and &quot;foo1.txt&quot;, a successful completion would not take place since &quot;less f&quot; could refer to either file. What happens instead is readline makes the next best guess by completing as far as &quot;less foo&quot; since both possible answers contain those characters. To make a full completion, we need to type either &quot;less foo.&quot; for <code>foo.txt</code> or &quot;less foo1&quot; for <code>foo1.txt</code>.</p>
<p>If we have typed an ambiguous clue, we can view a list of all possible completions to get guidance as what to type next. In the case of our imaginary directory, pressing <code>Tab</code> a second time will display all of the file names beginning with &quot;foo&quot; so that we can see what more needs to be typed to remove the ambiguity.</p>
<p>Besides file name completion, readline can complete command names, environment variable names, user home directory names, and network host names:</p>
<table>
<col width="27%" >
<col width="72%" >
<thead>
<tr class="header">
<th align="left">Completion</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left">Command names</td>
<td align="left">Completion on the first word of a line will complete the name of an available command. For example, typing &quot;lsu&quot; followed by <code>Tab</code> will complete as <code>lsusb</code>.</td>
</tr>
<tr class="even">
<td align="left">Variables</td>
<td align="left">If completion is attempted on a word beginning with &quot;$&quot;, environment variable names will be used. For example, typing &quot;echo $TE&quot; will complete as <code>echo $TERM</code>.</td>
</tr>
<tr class="odd">
<td align="left">User names</td>
<td align="left">To complete the name of a user's home directory, precede the user's name with a &quot;~&quot; and press 'Tab'. For example: <code>ls ~ro</code> followed by <code>Tab</code> will complete to <code>ls ~root/</code>. It is also possible to force completion of a user name without the leading <code>~</code> by typing <code>Alt-~</code>. For example &quot;who ro&quot; followed by <code>Alt-~</code> will complete to <code>who root</code>.</td>
</tr>
<tr class="even">
<td align="left">Host names</td>
<td align="left">Completion on a word starting with &quot;@&quot; causes host name completion, however this feature rarely works on modern systems since they tend to use DHCP rather than listing host names in the <code>/etc/hosts</code> file.</td>
</tr>
<tr class="odd">
<td align="left">File names</td>
<td align="left">In all other cases, completion is attempted on file and path names.</td>
</tr>
</tbody>
</table>
<h2 id="programmable-completion">Programmable Completion</h2>
<p>Bash includes some builtin commands that permit the completion facility to be programmed on a command-by-command basis. This means it's possible to set up a custom completion scheme for individual commands; however, doing this is beyond the scope of this adventure. We will instead talk about an optional package that uses these builtins to greatly extend the native completion facility. Called <em>bash-completion</em>, this package is installed automatically for some distributions (for example, Ubuntu) and is generally available for others. To check for the package, examine the <code>/etc/bash-completion.d</code> directory. If it exists, the package is installed.</p>
<p>The bash-completion package adds support for many command line programs, allowing us to perform completion on both command options and arguments. The <code>ls</code> command is a good example. If we type &quot;ls --&quot; then the <code>Tab</code> key a couple of times, we will see a list of possible options to the command:</p>
<pre><code>me@linuxbox: ~ $ ls --
--all                                      --ignore=
--almost-all                               --ignore-backups
--author                                   --indicator-style=
--block-size=                              --inode
--classify                                 --literal
--color                                    --no-group
--color=                                   --numeric-uid-gid
--context                                  --quote-name
--dereference                              --quoting-style=
--dereference-command-line                 --recursive
--dereference-command-line-symlink-to-dir  --reverse
--directory                                --show-control-chars
--dired                                    --si
--escape                                   --size
--file-type                                --sort
--format=                                  --sort=
--group-directories-first                  --tabsize=
--help                                     --time=
--hide=                                    --time-style=
--hide-control-chars                       --version
--human-readable                           --width=</code></pre>
<p>An option can be completed by typing a partial option followed by <code>Tab</code>. For example, typing &quot;ls --ver&quot; then <code>Tab</code> will complete to &quot;ls --version&quot;.</p>
<p>The bash-completion system is interesting in its own right as it is implemented by a series of shell scripts that make use of the <code>complete</code> and <code>compgen</code> bash builtins. The main body of the work is done by the <code>/etc/bash_completion</code> (or <code>/usr/share/bash-completion/bash_completion</code> in newer versions) script along with additional scripts for individual programs in either the <code>/etc/bash-completion.d</code> directory or the <code>/usr/share/bash-completion/completions</code> directory. These scripts are good examples of advanced scripting technique and are worthy of study.</p>
<h2 id="summing-up">Summing Up</h2>
<p>This adventure is a lot to take in and it might not seem all that useful at first, but as we continue to gain experience and practice with the command line, learning these labor-saving tricks will save us a lot of time and effort.</p>
<h2 id="further-reading">Further Reading</h2>
<ul>
<li><p>&quot;The beginning of time&quot; actually has meaning in Unix-like operating systems such as Linux. It's January 1, 1970. See: <a href="http://http://en.wikipedia.org/wiki/Unix_time"><code class="url">http://http://en.wikipedia.org/wiki/Unix_time</code></a> for details.</p></li>
<li><p>Aliases and shell functions are discussed in chapters 5 and 26, respectively, of <em>The Linux Command Line</em>: <a href="http://linuxcommand.org/tlcl.php"><code class="url">http://linuxcommand.org/tlcl.php</code></a>.</p></li>
<li><p>The READLINE section of the bash man page describes the many keyboard shortcuts available on the command line.</p></li>
<li><p>The HISTORY section of the bash man page covers the command line history features of <code>bash</code>.</p></li>
<li><p>The official home page of the bash-completion project: <a href="http://bash-completion.alioth.debian.org/"><code class="url">http://bash-completion.alioth.debian.org/</code></a></p></li>
<li><p>For those readers interested in learning how to write their own bash completion scripts, see this tutorial at the Linux Documentation Project: <a href="http://www.tldp.org/LDP/abs/html/tabexpansion.html"><code class="url">http://www.tldp.org/LDP/abs/html/tabexpansion.html</code></a>.</p></li>
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