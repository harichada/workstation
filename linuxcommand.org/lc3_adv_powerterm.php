



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: Power Terminals</title>
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
<h1 id="power-terminals">Power Terminals</h1>
<p>Over the course of our many lessons and adventures, we have learned a lot about the shell, and explored many of the common command line utilities found on Linux systems. There is, however, one program we have overlooked, and it may be among the most important and most frequently used of them all-- our terminal emulator.</p>
<p>In this adventure, we are going to dig into these essential tools and look at a few of the different terminal programs and the many interesting things we can do with them.</p>
<h2 id="a-typical-modern-terminal">A Typical Modern Terminal</h2>
<p>Graphical desktop environments like GNOME, KDE, LXDE, Unity, etc. all include terminal emulators as standard equipment. We can think of this as a safety feature because, if the desktop environment suffers from some lack of functionality (and they all do), we can still access the shell and actually get stuff done.</p>
<p>Modern terminal emulators are quite flexible and can be configured in many ways:</p>
<div class="figure">
<img src="images/adventure_powerterm_gnome_terminal_prefs_dialog.png" alt="gnome-terminal preferences dialog" ><p class="caption">gnome-terminal preferences dialog</p>
</div>
<h3 id="size">Size</h3>
<p>Terminal emulators display a window that can be adjusted to any size from the sublime to the ridiculous. Many terminals allow configuration of a default size.</p>
<p>The &quot;normal&quot; size for a terminal is 80 columns by 24 rows. These dimensions were inherited from the size of common hardware terminals, which, in turn, were influenced by the format of IBM punch cards (80 columns by 12 rows). Some applications expect 80 by 24 to be the minimum size, and will not display properly when the size is smaller. Making the terminal larger, on the other hand, is preferable in most situations, particularly when it comes to terminal height. 80 columns is a good width for reading text, but having additional height provides us with more context when working at the command line.</p>
<p>Another common width is 132 columns, derived from the width of wide fan-fold computer paper. Though this is too wide for comfortable reading of straight text (for example, a man page), it's fine for other purposes, such as viewing log files.</p>
<p>The 80-column default width has implications for the shell scripts and other text-based programs we write. We should format our printed output to fit within the limits of an 80-character line for best effect.</p>
<h3 id="tabs">Tabs</h3>
<p>A single terminal window with the ability to contain several different shell sessions is a valuable feature found in most modern terminal emulators. This is accomplished through the use of <em>tabs</em>.</p>
<div class="figure">
<img src="images/adventure_powerterm_gnome_terminal_with_tabs.png" alt="gnome-terminal with tabs" ><p class="caption">gnome-terminal with tabs</p>
</div>
<p>Tabs are a fairly recent addition to terminal emulators, first appearing around 2003 in both GNOME's <code>gnome-terminal</code> and KDE's <code>konsole</code>.</p>
<h3 id="profiles">Profiles</h3>
<p>Another feature found in several modern terminals is multiple configuration profiles. With this feature, we can have separate configurations for different tasks. For example, if we are responsible for maintaining a remote server, we might have a separate profile for the terminal that we use to manage it.</p>
<h3 id="fonts-colors-backgrounds">Fonts, Colors, Backgrounds</h3>
<p>Most terminal emulators allow us to select fonts, colors, and backgrounds for our terminal sessions. The three most important criteria for selecting fonts, colors, and backgrounds are: 1. legibility, 2. legibility, and 3. legibility. Many people post screen shots of their Linux desktops online, and there is a great fascination with &quot;stylish&quot; fonts, faint colors, and pseudo-transparent terminal windows, but we use our terminals for very serious things, so we should treat our terminals very seriously, too. No one wants to make a mistake while administering a system because they mis-read something on the screen. Choose wisely.</p>
<h2 id="past-favorites">Past Favorites</h2>
<p>When the first graphical environments began appearing for Unix in the mid-1980s, terminal emulators were among the first applications that were developed. After all, the GUIs of the time had very little functionality and people still needed to do their work. Besides, the graphical desktop allowed users to display multiple terminal windows- a powerful advantage at the time.</p>
<h3 id="xterm">xterm</h3>
<p>The granddaddy of all graphical terminals is <code>xterm</code>, the standard terminal emulator for the X Window System. Originally released in 1984, it's still under active maintenance. Since it is a standard part of X, it is included in many Linux distributions. <code>xterm</code> was very influential, and most modern terminal programs emulate its behavior in one way or another.</p>
<div class="figure">
<img src="images/adventure_powerterm_xterm_default.png" alt="xterm with default configuration" ><p class="caption">xterm with default configuration</p>
</div>
<p>In its default configuration, <code>xterm</code> looks rather small and pathetic, but almost everything about <code>xterm</code> is configurable. When we say &quot;configurable,&quot; we don't mean there is a pretty &quot;Preferences&quot; dialog. This is Unix! Like many early X applications, it relies on an Xresources file for its configuration. This file can be either global (<code>/etc/X11/Xresources</code>) or local to the user (<code>~/.Xresources</code>). Each item in this file consists of an application class and a setting. If we create the file ~/.Xresources with the following content:</p>
<pre><code>XTerm.vt100.geometry: 80x35
XTerm.vt100.faceName: Liberation Mono:size=11
XTerm.vt100.cursorBlink: true</code></pre>
<p>then we get a terminal like this:</p>
<div class="figure">
<img src="images/adventure_powerterm_xterm_configured.png" alt="Configured xterm" ><p class="caption">Configured xterm</p>
</div>
<p>A complete list of the Xresources configuration values for <code>xterm</code> appears in its man page.</p>
<p>While <code>xterm</code> does not appear to have menus, it actually has 3 different ones, which are made visible by holding the <code>Ctrl</code> key and pressing a mouse button. Different menus appear according to which button is pressed. The scroll bar on the side of the terminal has a behavior like ancient X applications. Hint: after enabling the scroll bar with the menu, use the middle mouse button to drag the slider.</p>
<p>Though <code>xterm</code> offers neither tabs nor profiles, it does have one strange extra feature: it can display a Tektronix 4014 graphics terminal emulator window. The Tektronix 4014 was an early and very expensive storage tube graphics display that was popular with computer aided design systems in the 1970s. It's extremely obscure today. The normal xterm text window is called the VT window. The name comes from the DEC VT220, a popular computer terminal of the same period. <code>xterm</code>, and most terminals today, emulate this terminal to a certain extent. <code>xterm</code> is not quite the same as the VT terminal, and it has its own specific <code>terminfo</code> entry (see the tput adventure for some background on <code>terminfo</code>). Terminals set an environment variable named <code>TERM</code> that is used by X and <code>terminfo</code> to identify the terminal type, and thus send it the correct control codes. To see the current value of the <code>TERM</code> variable, we can do this:</p>
<pre><code>me@linuxbox ~ $ echo $TERM</code></pre>
<p>Even if we are using a modern terminal, such as <code>gnome-terminal</code>, we will notice that the <code>TERM</code> variable is often set to &quot;xterm&quot; or &quot;xterm-color&quot;. That's how much influence <code>xterm</code> had. We still use it as the standard.</p>
<h3 id="rxvt">rxvt</h3>
<p>By the standards of the time, <code>xterm</code> was a heavyweight program but, as time went by, some of its features were rarely used such as the Tektronix emulation. Around 1990, in an attempt to create a simpler, lighter terminal emulator, Robert Nation wrote <code>rxvt</code> as part of the FVWM window manager, an early desktop environment for Unix-like systems.</p>
<p><code>rxvt</code> has a smaller feature set than <code>xterm</code> and emulates the DEC VT 102 terminal rather than the more advanced VT 220. <code>rxvt</code> sets the <code>TERM</code> variable to &quot;rxvt&quot;, which is widely supported. Like <code>xterm</code>, <code>rxvt</code> has menus that are displayed by holding the <code>Ctrl</code> key and pressing different mouse buttons.</p>
<p><code>rxvt</code> is still under active maintenance, and there is a popular modern implementation forked from the original called <code>urxvt</code> (rxvt-Unicode) by Mark Lehmann, which supports Unicode (multi-byte characters used to express a wider range of written languages than ASCII). One interesting feature in <code>urxvt</code> is a daemon mode that allows launching multiple terminal windows all sharing the same instance of the program- a potential memory saver.</p>
<div class="figure">
<img src="images/adventure_powerterm_rxvt_default.png" alt="urxvt with default configuration" ><p class="caption">urxvt with default configuration</p>
</div>
<p>Like <code>xterm</code>, <code>rxvt</code> uses Xresources to control its configuration. The default <code>rxvt</code> configuration is very spare. Adding the following settings to our Xresources file will make it more palatable (<code>urxvt</code> shown):</p>
<pre><code>URxvt.geometry: 80x35
URxvt.saveLines: 10000
URxvt.scrollBar: false
URxvt.foreground: white
URxvt.background: black
URxvt.secondaryScroll: true
URxvt.font: xft:liberation mono:size=11
URxvt.cursorBlink: true</code></pre>
<h2 id="modern-power-terminals">Modern Power Terminals</h2>
<p>Most modern graphical desktop environments include a terminal emulator program. Some are more feature-rich than others. Let's look at some of the most powerful and popular ones.</p>
<h3 id="gnome-terminal">gnome-terminal</h3>
<p>The default terminal application for GNOME and its derivatives such as Ubuntu's Unity is <code>gnome-terminal</code>. Possibly the world's most popular terminal app, it's a good, full-featured program. It has many features we expect in modern terminals, like multiple tabs and profile support. It also allows many kinds of customization.</p>
<h4 id="tabs-1">Tabs</h4>
<p>Busy terminal users will often find themselves working in multiple terminal sessions at once. It may be to perform operations on several machines at the same time, or to manage a complex set of tasks on a single system. This problem can be addressed either by opening multiple terminal windows, or by having multiple tabs in a single window.</p>
<p>The File menu in <code>gnome-terminal</code> offers both choices (well, in older versions anyway). In newer versions, use the keyboard shortcut <code>Ctrl-Shift-T</code> to open a tab. Tabs can be rearranged with the mouse, or can be dragged out of the window to create a new window. With <code>gnome-terminal</code>, we can even drag a tab from one terminal window to another.</p>
<h4 id="keyboard-shortcuts">Keyboard shortcuts</h4>
<p>Since, in an ideal universe, we never lift our fingers from the keyboard, we need ways of controlling our terminal without resorting to a mouse. Fortunately, <code>gnome-terminal</code> offers a large set of keyboard shortcuts for common operations. Here are some of the most useful ones, defined by default:</p>
<table>
<thead>
<tr class="header">
<th align="left">Shortcut</th>
<th align="left">Action</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left">Ctrl-Shift-N</td>
<td align="left">New Window</td>
</tr>
<tr class="even">
<td align="left">Ctrl-Shift-W</td>
<td align="left">Close Window</td>
</tr>
<tr class="odd">
<td align="left">F11</td>
<td align="left">View terminal full screen</td>
</tr>
<tr class="even">
<td align="left">Shift-PgUp</td>
<td align="left">Scroll up</td>
</tr>
<tr class="odd">
<td align="left">Shift-PgDn</td>
<td align="left">Scroll down</td>
</tr>
<tr class="even">
<td align="left">Shift-Home</td>
<td align="left">Scroll to the beginning</td>
</tr>
<tr class="odd">
<td align="left">Shift-End</td>
<td align="left">Scroll to the end</td>
</tr>
<tr class="even">
<td align="left">Ctrl-Shift-T</td>
<td align="left">New Tab</td>
</tr>
<tr class="odd">
<td align="left">Ctrl-Shift-Q</td>
<td align="left">Close Tab</td>
</tr>
<tr class="even">
<td align="left">Ctrl-PgUp</td>
<td align="left">Next Tab</td>
</tr>
<tr class="odd">
<td align="left">Ctrl-PgDn</td>
<td align="left">Previous Tab</td>
</tr>
<tr class="even">
<td align="left">Alt-n</td>
<td align="left">Where n is a number in the range of 1 to 9, go to</td>
</tr>
<tr class="odd">
<td align="left"></td>
<td align="left">tab n</td>
</tr>
</tbody>
</table>
<p>Keyboard shortcuts are also user configurable.</p>
<p>While it is well known that <code>Ctrl-c</code> and <code>Ctrl-v</code> cannot be used in the terminal window to perform copy and paste, <code>Ctrl-Shift-C</code> and <code>Ctrl-Shift-V</code> will work in their place with <code>gnome-terminal</code>.</p>
<h4 id="profiles-1">Profiles</h4>
<p>Profiles are one of the great, unsung features of many terminal programs. This may be because their advantages are perhaps not intuitively obvious. Profiles are particularly useful when we want to visually distinguish one terminal session from another. This is especially true when managing multiple machines. In this case, having a different background color for the remote system's session may help us avoid typing a command into the wrong session. We can even incorporate a default command (like <code>ssh</code>) into a profile to facilitate the connection to the remote system.</p>
<p>Let's make a profile for a root shell. First, we'll go to the File menu and select &quot;New Profile...&quot; and when the dialog appears enter the name &quot;root&quot; as our new profile:</p>
<div class="figure">
<img src="images/adventure_powerterm_gnome_terminal_new_profile_1.png" alt="gnome-terminal new profile dialog" ><p class="caption">gnome-terminal new profile dialog</p>
</div>
<p>Next, we'll configure our new profile and choose the font and default size of the terminal window. Then we will choose a command for the terminal window when it is opened. To create a root shell, we can use the command <code>sudo -i</code>. We will also make sure to specify that the terminal should exit when the command exits.</p>
<div class="figure">
<img src="images/adventure_powerterm_gnome_terminal_new_profile_2.png" alt="Setting the command in the configuration dialog" ><p class="caption">Setting the command in the configuration dialog</p>
</div>
<p>Finally, we'll select some colors. How about white text on a dark red background? That should convey an appropriate sense of gravity when we use a root shell.</p>
<div class="figure">
<img src="images/adventure_powerterm_gnome_terminal_new_profile_3.png" alt="Setting the colors in configuration dialog" ><p class="caption">Setting the colors in configuration dialog</p>
</div>
<p>Once we finish our configuration, we can test our shell:</p>
<div class="figure">
<img src="images/adventure_powerterm_gnome_terminal_root_profile.png" alt="Root profile gnome-terminal" ><p class="caption">Root profile gnome-terminal</p>
</div>
<p>We can configure terminal profiles for any command line program we want: Midnight Commander, <code>tmux</code>, whatever.</p>
<p>Here is another example. We will create a simple man page viewer. With this terminal profile, we can have a dedicated terminal window to only display man pages. To do this, we first need to write a short script to prompt the user for the name of which command to look up, and display the man page in a (nearly) endless loop:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>

<span class="co"># man_view - simple man page viewer</span>

<span class="kw">while</span> <span class="kw">true</span>; <span class="kw">do</span>
  <span class="kw">echo</span> -en <span class="st">&quot;\nPlease enter a command name (q to quit) -&gt; &quot;</span>
  <span class="kw">read</span>
 <span class="kw"> [[</span> <span class="st">&quot;</span><span class="ot">$REPLY</span><span class="st">&quot;</span> <span class="ot">==</span> <span class="st">&quot;q&quot;</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="kw">break</span>
 <span class="kw"> [[</span> <span class="ot">-n</span> <span class="st">&quot;</span><span class="ot">$REPLY</span><span class="st">&quot;</span><span class="kw"> ]]</span> <span class="kw">&amp;&amp;</span> <span class="kw">{</span> <span class="kw">man</span> <span class="ot">$REPLY</span> <span class="kw">||</span> <span class="kw">sleep</span> 3; <span class="kw">}</span>
  <span class="kw">clear</span>
<span class="kw">done</span></code></pre>
<p>We'll save this file in our <code>~/bin</code> directory and use it as our custom command for our terminal profile.</p>
<p>Next, we create a new terminal profile and name it &quot;man page&quot;. Since we are designing a window for man pages, we can play with the window size and color. We'll set the window tall and a little narrow (for easier reading) and set the colors to green text on a black background for that retro terminal feeling:</p>
<div class="figure">
<img src="images/adventure_powerterm_gnome_terminal_man_page_profile.png" alt="Man page gnome-terminal window" ><p class="caption">Man page gnome-terminal window</p>
</div>
<h4 id="opening-hyperlinks-and-email-addresses">Opening hyperlinks and email addresses</h4>
<p>One of the neat tricks <code>gnome-terminal</code> can do is copy and/or open URLs. When it detects a URL in the stream of displayed text, it displays it with an underline. Right-clicking on the link displays a menu of operations:</p>
<div class="figure">
<img src="images/adventure_powerterm_gnome_terminal_link_context.png" alt="gnome-terminal URL context menu" ><p class="caption">gnome-terminal URL context menu</p>
</div>
<h4 id="resetting-the-terminal">Resetting the terminal</h4>
<p>Sometimes, despite our best efforts, we do something dumb at the terminal, like attempting to display a non-text file. When this happens, the terminal emulator will dutifully interpret the random bytes as control codes and we'll notice that the terminal screen fills with garbage and nothing works anymore. To escape this situation, we must reset the terminal. <code>gnome-terminal</code> provides a function for this located in its Terminal menu.</p>
<h3 id="konsole">konsole</h3>
<p><code>konsole</code>, the default terminal application for the KDE desktop, has a feature set similar to that of <code>gnome-terminal</code>. This, of course, makes sense since <code>konsole</code> directly &quot;competes&quot; with <code>gnome-terminal</code>. For instance, both <code>gnome-terminal</code> and <code>konsole</code> support tabs and profiles in a similar fashion.</p>
<p><code>konsole</code> does have a couple of unique features not found in <code>gnome-terminal</code>. <code>konsole</code> has bookmarks, and <code>konsole</code> can split the screen into regions allowing more than one view of the same terminal session to be displayed at the same time.</p>
<h4 id="bookmarks">Bookmarks</h4>
<p><code>konsole</code> allows us to store the location of directories as bookmarks. Locations may also include remote locations accessible via <code>ssh</code>. For example, we can define a bookmark such as <code>ssh:me@remotehost</code>, and it will attempt to connect with the remote system when the bookmark is used.</p>
<div class="figure">
<img src="images/adventure_powerterm_konsole_bookmarks.png" alt="konsole bookmarks menu" ><p class="caption">konsole bookmarks menu</p>
</div>
<h4 id="split-view">Split View</h4>
<div class="figure">
<img src="images/adventure_powerterm_konsole_splitview_1.png" alt="konsole&#39;s split view feature" ><p class="caption">konsole's split view feature</p>
</div>
<p><code>konsole</code>'s unique split view feature allows us to have two views of a single terminal session. This seems odd at first glance, but is useful when examining long streams of output. For example, if we needed to copy text from one portion of a long output stream to the command line at the bottom, this could be handy. Further, we can get views of different terminal sessions, by using using tabs in conjunction with split views, since while the tabs will appear in all of the split views, they can be switched independently in each view:</p>
<div class="figure">
<img src="images/adventure_powerterm_konsole_splitview_2.png" alt="konsole with tabs and split view" ><p class="caption">konsole with tabs and split view</p>
</div>
<h3 id="guake">guake</h3>
<p><code>gnome-terminal</code> has spawned a couple of programs that reuse many of its internal parts to create different terminal applications. The first is <code>guake</code>, a terminal that borrows a design feature from a popular first-person shooter game. When running, <code>guake</code> normally hides in the background, but when the F12 key is pressed, the terminal window &quot;rolls down&quot; from the top of the screen to reveal itself. This can be handy if terminal use is intermittent, or if screen real estate is at a premium.</p>
<p><code>guake</code> shares many of the configuration options with <code>gnome-terminal</code>, as well as the ability to configure what key activates it, which side of the screen it rolls from, and its size.</p>
<p>Though <code>guake</code> supports tabs, it does not (as of this writing) support profiles. However, we can approximate profiles with a little clever scripting:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>

<span class="co"># gtab - create pseudo-profiles for guake</span>

<span class="kw">if </span>[[ <span class="ot">$1</span> == <span class="st">&quot;&quot;</span> ]]; <span class="kw">then</span>
  guake --new-tab=<span class="kw">.</span> --show
  <span class="kw">exit</span>
<span class="kw">fi</span>

<span class="kw">case</span> <span class="ot">$1</span><span class="kw"> in</span>
  root<span class="kw">)</span> <span class="co"># Create a root shell tab</span>
    guake --new-tab=<span class="kw">.</span> --fgcolor=\#ffffff --bgcolor=\#5e0000
    guake --show    <span class="co"># Switch to new fg/bg colors</span>
    guake --rename-current-tab=root
    guake --execute-command=<span class="st">&#39;sudo -i; exit&#39;</span>
    <span class="kw">;;</span>
  man<span class="kw">)</span> <span class="co"># Create a manual page viewer tab</span>
    guake --new-tab=<span class="kw">.</span> --fgcolor=\#00ef00 --bgcolor=\#000000
    guake --show    <span class="co"># Switch to new fg/bg colors</span>
    guake --rename-current-tab=<span class="st">&quot;man viewer&quot;</span>
    guake --execute-command=<span class="st">&#39;man_view; exit&#39;</span>
    <span class="kw">;;</span>
  *<span class="kw">)</span>
    <span class="kw">echo</span> <span class="st">&quot;No such tab. Try either &#39;root&#39; or &#39;man&#39;&quot;</span> <span class="kw">&gt;&amp;2</span>
    <span class="kw">exit</span> 1
    <span class="kw">;;</span>
<span class="kw">esac</span></code></pre>
<p>After saving this script, we can open new tabs in <code>guake</code> by entering the command <code>gtab</code> followed by an optional profile, either &quot;root&quot; or &quot;man&quot; to duplicate what we did with the <code>gnome-terminal</code> profiles above. Entering <code>gtab</code> without an option simply opens a new tab in the current working directory.</p>
<p>As we can see, <code>guake</code> has a number of interesting command line options that allow us to program its behavior.</p>
<p>For KDE users, there is a similar program called <code>yakuake</code>.</p>
<h3 id="terminator">terminator</h3>
<p>Like <code>guake</code>, <code>terminator</code> builds on the <code>gnome-terminal</code> code to create a very popular alternative terminal. The main feature addition is split window support.</p>
<div class="figure">
<img src="images/adventure_powerterm_terminator_split.png" alt="terminator with split screens" ><p class="caption">terminator with split screens</p>
</div>
<p>By right-clicking in the <code>terminator</code> window, <code>terminator</code> displays its menu where we can see the options for splitting the current terminal either vertically or horizontally.</p>
<div class="figure">
<img src="images/adventure_powerterm_terminator_menu.png" alt="The terminator menu" ><p class="caption">The terminator menu</p>
</div>
<p>Once split, each terminal pane can dragged and dropped. Panes can also be resized with either the mouse or a keyboard shortcut. Another nice feature of <code>terminator</code> is the ability to set the focus policy to &quot;focus follows mouse&quot; so that we can change the active pane by simply hovering the mouse over the desired pane without have to perform an extra click to make the pane active.</p>
<p>The preferences dialog supports many of the same configuration features as that of <code>gnome-terminal</code>, including profiles with custom commands:</p>
<div class="figure">
<img src="images/adventure_powerterm_terminator_prefs.png" alt="The terminator preferences dialog" ><p class="caption">The terminator preferences dialog</p>
</div>
<p>A good way to use <code>terminator</code> is to expand its window to full screen and then split it into multiple panes:</p>
<div class="figure">
<img src="images/adventure_powerterm_terminator_fullscreen-C.png" alt="Full screen terminator window with multiple panes" ><p class="caption">Full screen terminator window with multiple panes</p>
</div>
<p>We can even automate this by going into Preferences/Layouts and storing our full screen layout (let's call it &quot;2x2&quot;) then, by invoking terminator this way:</p>
<pre><code>terminator --maximise --layout=2x2</code></pre>
<p>to get our layout instantly.</p>
<h2 id="terminals-for-other-platforms">Terminals for other platforms</h2>
<h3 id="android">Android</h3>
<p>While we might not think of an Android phone or tablet as a Linux computer, it actually is, and we can get terminal apps for it which are useful for administering remote systems.</p>
<h4 id="connectbot">Connectbot</h4>
<p>Connectbot is a secure shell client for Android. With it, we can log into any system running an SSH server. To the remote system, Connectbot looks like a terminal using the GNU Screen terminal type.</p>
<p>One problem with using a terminal emulator on Android is the limitations of the native Google keyboard. It does not have all the keys required to make full use of a terminal session. Fortunately, there are alternate keyboards that we can use on Android. A really good one is Hacker's Keyboard by Klaus Weidner. It supports all the normal keys, <code>Ctrl</code>, <code>Alt</code>, <code>F1-F10</code>, arrows, <code>PgUp</code>, <code>PgDn</code>, etc. Very handy when working with <code>vi</code> on a phone.</p>
<div class="figure">
<img src="images/adventure_powerterm_connectbot-C.png" alt="Connectbot with Hacker&#39;s Keyboard on Android" ><p class="caption">Connectbot with Hacker's Keyboard on Android</p>
</div>
<h4 id="termux">Termux</h4>
<p>The Termux app for Android is unexpectedly amazing. It goes beyond being merely an SSH client; it provides a full shell environment on Android without having to root the device.</p>
<p>After installation, there is a minimal base system with a shell (<code>bash</code>) and many of the most common utilities. Initially, these utilities are the ones built into <code>busybox</code> (a compact set of utilities joined into a single program that is often used in embedded systems to save space), but the <code>apt</code> package management program (like on Debian/Ubuntu) is provided to allow installation of a wide variety of Linux programs.</p>
<div class="figure">
<img src="images/adventure_powerterm_termux-C.png" alt="Termux displaying builtin shell commands" ><p class="caption">Termux displaying builtin shell commands</p>
</div>
<p>We can have dot files (like <code>.bashrc</code>) and even write shell scripts and compile and debug programs in Termux. Pretty neat.</p>
<p>When executing <code>ssh</code>, Termux looks like an &quot;xterm-256color&quot; terminal to remote systems.</p>
<h3 id="chromechrome-os">Chrome/Chrome OS</h3>
<p>Google makes a decent SSH client for Chrome and Chrome OS (which is Linux, too, after all) that allows logging on to remote systems. Called Secure Shell, it uses hterm (HTML Terminal, a terminal emulator written in JavaScript) combined with an SSH client. To remote systems, it looks like a &quot;xterm-256color&quot; terminal. It works pretty well, but lacks some features that advanced SSH users may need.</p>
<p>Secure Shell is available at the Chrome Web Store.</p>
<div class="figure">
<img src="images/adventure_powerterm_chromeos_ssh-C.png" alt="Secure Shell running on Chrome OS" ><p class="caption">Secure Shell running on Chrome OS</p>
</div>
<h2 id="summing-up">Summing Up</h2>
<p>Given that our terminal emulators are among our most vital tools, they should command more of our attention. There are many different terminal programs with potentially interesting and helpful features, many of which, most users rarely, if ever, use. This is a shame since many of these features are truly <em>useful</em> to the busy command line user. We have looked at a few of the ways these features can be applied to our daily routine, but there are certainly many more.</p>
<h2 id="further-reading">Further Reading</h2>
<ul>
<li>&quot;The Grumpy Editor's guide to terminal emulators&quot; by Jonathan Corbet: <a href="https://lwn.net/Articles/88161/"><code class="url">https://lwn.net/Articles/88161/</code></a></li>
</ul>
<h3 id="xterm-1">xterm:</h3>
<ul>
<li><p>xterm on Wikipedia: <a href="https://en.wikipedia.org/wiki/Xterm"><code class="url">https://en.wikipedia.org/wiki/Xterm</code></a></p></li>
<li><p>Homepage for the current maintainer of xterm, Thomas Dickey: <a href="http://invisible-island.net/xterm/"><code class="url">http://invisible-island.net/xterm/</code></a></p></li>
</ul>
<h3 id="tektronix-4014">Tektronix 4014:</h3>
<ul>
<li><p>Tektronix 4014 on Wikipedia: <a href="https://en.wikipedia.org/wiki/Tektronix_4010"><code class="url">https://en.wikipedia.org/wiki/Tektronix_4010</code></a></p></li>
<li><p>Some background on the 4014 at Chilton Computing: <a href="http://www.chilton-computing.org.uk/acd/icf/terminals/p005.htm"><code class="url">http://www.chilton-computing.org.uk/acd/icf/terminals/p005.htm</code></a></p></li>
</ul>
<h3 id="rxvt-1">rxvt:</h3>
<ul>
<li>Home page for rxvt: <a href="http://rxvt.sourceforge.net/"><code class="url">http://rxvt.sourceforge.net/</code></a></li>
</ul>
<h3 id="urxvt-rxvt-unicode">urxvt (rxvt-Unicode):</h3>
<ul>
<li>Home page for the rxvt-Unicode project: <a href="http://software.schmorp.de/pkg/rxvt-unicode.html"><code class="url">http://software.schmorp.de/pkg/rxvt-unicode.html</code></a></li>
</ul>
<h3 id="gnome-terminal-1">gnome-terminal:</h3>
<ul>
<li>Help pages for gnome-terminal: <a href="https://help.gnome.org/users/gnome-terminal/stable/"><code class="url">https://help.gnome.org/users/gnome-terminal/stable/</code></a></li>
</ul>
<h3 id="konsole-1">konsole:</h3>
<ul>
<li>The Konsole Manual at the KDE Project: <a href="https://docs.kde.org/stable5/en/applications/konsole/index.html"><code class="url">https://docs.kde.org/stable5/en/applications/konsole/index.html</code></a></li>
</ul>
<h3 id="guake-1">guake:</h3>
<ul>
<li><p>The home page for the guake project: <a href="http://guake-project.org/"><code class="url">http://guake-project.org/</code></a></p></li>
<li><p>The Arch Wiki entry for guake (contains a lot of useful information but some is Arch Linux specific): <a href="https://wiki.archlinux.org/index.php/Guake"><code class="url">https://wiki.archlinux.org/index.php/Guake</code></a></p></li>
</ul>
<h3 id="terminator-1">terminator:</h3>
<ul>
<li>The home page for the terminator project: <a href="http://gnometerminator.blogspot.com/p/introduction.html"><code class="url">http://gnometerminator.blogspot.com/p/introduction.html</code></a></li>
</ul>
<h3 id="connectbot-1">Connectbot:</h3>
<ul>
<li>Connectbot at the Google Play Store: <a href="https://play.google.com/store/apps/details?id=org.connectbot&amp;hl=en"><code class="url">https://play.google.com/store/apps/details?id=org.connectbot&amp;hl=en</code></a></li>
</ul>
<h3 id="hackers-keyboard">Hacker's Keyboard:</h3>
<ul>
<li>Hacker's Keyboard at the Google Play Store: <a href="https://play.google.com/store/apps/details?id=org.pocketworkstation.pckeyboard&amp;hl=en"><code class="url">https://play.google.com/store/apps/details?id=org.pocketworkstation.pckeyboard&amp;hl=en</code></a></li>
</ul>
<h3 id="termux-1">Termux:</h3>
<ul>
<li>Termux at the Google Play Store: <a href="https://play.google.com/store/apps/details?id=com.termux&amp;hl=en"><code class="url">https://play.google.com/store/apps/details?id=com.termux&amp;hl=en</code></a></li>
</ul>
<h3 id="secure-shell">Secure Shell</h3>
<ul>
<li><p>Secure Shell at the Chrome Web Store: <a href="https://chrome.google.com/webstore/detail/secure-shell/pnhechapfaindjhompbnflcldabbghjo"><code class="url">https://chrome.google.com/webstore/detail/secure-shell/pnhechapfaindjhompbnflcldabbghjo</code></a></p></li>
<li><p>Secure Shell FAQ: <a href="https://chromium.googlesource.com/apps/libapps/+/master/nassh/doc/FAQ.md"><code class="url">https://chromium.googlesource.com/apps/libapps/+/master/nassh/doc/FAQ.md</code></a></p></li>
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