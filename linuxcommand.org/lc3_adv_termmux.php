



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: Terminal Multiplexers</title>
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
<h1 id="terminal-multiplexers">Terminal Multiplexers</h1>
<p>It's easy to take the terminal for granted. After all, modern terminal emulators like gnome-terminal, konsole, and the others included with Linux desktop environments are feature-rich applications that satisfy most of our needs. But sometimes we need more. We need to have multiple shell sessions running in a single terminal. We need to display more than one application in a single terminal. We need to move a running terminal session from one computer to another. In short, we need a <em>terminal multiplexer</em>.</p>
<p>Terminal multiplexers are programs that can perform these amazing feats. In this adventure, we will look at three examples: GNU screen, tmux, and byobu.</p>
<h2 id="some-historical-context">Some Historical Context</h2>
<p>If we were to go back in time to say, the mid-1980s, we might find ourselves staring at a computer terminal; a box with an 80-column wide, 24-line high display and a keyboard connected to a shared, central Unix computer via an RS-232 serial connection and, possibly, an acoustic-coupler modem and a telephone handset. On the display screen there might be a shell prompt not unlike the prompt we see today during a Linux terminal session. However, unlike today, the computer terminal of the 1980s did not have multiple windows or tabs to display multiple applications or shell sessions. We only had one screen and that was it. Terminal multiplexers were originally developed to help solve this problem. A terminal multiplexer allows multiple sessions and applications to be displayed and managed on a single screen. While modern desktop environments and terminal emulator programs support multiple windows and tabbed terminal sessions, which mitigate the need of terminal multiplexers for some purposes, terminal multiplexers still offer some features that will greatly enhance our command-line experience.</p>
<h2 id="gnu-screen">GNU Screen</h2>
<p>GNU screen goes way back. First developed in 1987, screen appears to be the first program of its type and it defined the basic feature set found in all subsequent terminal multiplexers.</p>
<h3 id="availability">Availability</h3>
<p>As its name implies, GNU screen is part of the GNU Project. Though it is rarely installed by default, it is available in most distribution repositories as the package &quot;screen&quot;.</p>
<h3 id="invocation">Invocation</h3>
<p>We can start using GNU screen by simply entering the <code>screen</code> command at the shell prompt. Once the command is launched, we will be presented with a shell prompt.</p>
<h3 id="multiple-windows">Multiple Windows</h3>
<p>At this point, <code>screen</code> is running and has created its first <em>window</em> . The terminology used by screen is a little confusing. It is best to think of it this way: screen manages a <em>session</em> consisting of one or more <em>windows</em> each containing a shell or other program. Furthermore, <code>screen</code> can divide a terminal display into multiple <em>regions</em>, each displaying the contents of a window.</p>
<p>Whew! This will start to make sense as we move forward.</p>
<p>In any case, we have screen running now, and it's displaying its first window. Let's enter a command in the current window:</p>
<pre><code>me@linuxbox: ~ $ top</code></pre>
<div class="figure">
<img src="images/adventure_termmux_screen_initial.png" alt="Initial screen window" ><p class="caption">Initial screen window</p>
</div>
<p>So far, so good. Now, let's create another window. To do this, we type <code>Ctrl-a</code> followed by the character &quot;c&quot;. Our terminal screen should clear and we should see a new shell prompt. So what just happened to our first window with <code>top</code> running in it? It's still there, running in the background. We can return to the first window by typing <code>Ctrl-a p</code> (think &quot;p&quot; for &quot;previous&quot;).</p>
<p>Before we go any further, let's talk about the keyboard. Controlling screen is pretty simple. Every command consists of <code>Ctrl-a</code> (called the &quot;command prefix&quot; or &quot;escape sequence&quot;) followed by another character. We have already seen two such commands: <code>Ctrl-a c</code> to create a new window, and <code>Ctrl-a p</code> to switch from the current window to the previous one. Typing the command <code>Ctrl-a ?</code> will display a list of all the commands.</p>
<p>GNU screen has several commands for switching from one window to another. Like the &quot;previous&quot; command, there is a &quot;next&quot; command <code>Ctrl-a n</code>. Windows are numbered, starting with 0, and may be chosen directly by typing <code>Ctrl-a</code> followed by a numeral from 0 to 9. It is also possible list all the windows by typing <code>Ctrl-a &quot;</code>. This command will display a list of windows, where we can choose a window.</p>
<div class="figure">
<img src="images/adventure_termmux_screen_window_list.png" alt="Screen window list" ><p class="caption">Screen window list</p>
</div>
<p>As we can see, windows have names. The default name for a window is the name of the program the window was running at the time of its creation, hence both of our windows are named &quot;bash&quot;. Let's change that. Since we are running <code>top</code> in our first window, let's make its name reflect that. Switch to the first window using any of the methods we have discussed, and type the command <code>Ctrl-a A</code> and we will be prompted for a window name. Simple.</p>
<p>Okay, so we have created some windows, how do we destroy them? A window is destroyed whenever we terminate the program running in it. After all windows are destroyed, <code>screen</code> itself will terminate. Since both of our windows are running <code>bash</code>, we need only exit each respective shell to end our <code>screen</code> session. In the case of a program that refuses to terminate gracefully, <code>Ctrl-a k</code> will do the trick.</p>
<p>Let's terminate the shell running <code>top</code> by typing <code>q</code> to exit <code>top</code> and then enter <code>exit</code> to terminate <code>bash</code>, thereby destroying the first window. We are now taken to the remaining window still running its own copy of <code>bash</code>. We can confirm this by typing <code>Ctrl-a &quot;</code> to view the window list again.</p>
<p>It's possible to create windows and run programs without an underlying shell. To do this, we enter <code>screen</code> followed by the name of the program we wish to run, for example:</p>
<pre><code>me@linuxbox: ~ $ screen vim ~/.bashrc</code></pre>
<p>We can even do this in a <code>screen</code> window. Issuing a <code>screen</code> command in a <code>screen</code> window does not invoke a new copy of <code>screen</code>. It tells the existing instance of <code>screen</code> to carry out an operation like creating a new window.</p>
<h3 id="copy-and-paste">Copy and Paste</h3>
<p>Given that GNU screen was developed for systems that have neither a graphical user interface nor a mouse, it makes sense that screen would provide a way of copying text from one <code>screen</code> window to another. It does this by entering what is called <em>scrollback mode</em>. In this mode, screen allows the text cursor to move freely throughout the current window and through the contents of the <em>scrollback buffer</em>, which contains previous contents of the window.</p>
<p>We start scrollback mode by typing <code>Ctrl-a [</code>. In scrollback mode we can use the arrow keys and the <code>Page Up</code> and <code>Page Down</code> keys to navigate the scrollback buffer. To copy text, we first need to mark the beginning and end of the text we want to copy. This is done by moving the text cursor to the beginning of the desired text and pressing the space bar. Next, we move the cursor to the end of the desired text (which is highlighted as we move the cursor) and press the space bar again to mark the end of the text to be copied. Marking text exits scrollback mode and copies the marked text into screen's internal buffer. We can now paste the text into any <code>screen</code> window. To do this, we go to the desired window and type <code>Ctrl-a ]</code>.</p>
<div class="figure">
<img src="images/adventure_termmux_screen_marked_text.png" alt="Text marked for copying" ><p class="caption">Text marked for copying</p>
</div>
<h3 id="multiple-regions">Multiple Regions</h3>
<p>GNU screen can also divide the terminal display into separate regions, each providing a view of a screen window. This allows us to view 2 or more windows at the same time. To split the terminal horizontally, type the command <code>Ctrl-a S</code>, to split it vertically, type <code>Ctrl-a |</code>. Newly created regions are empty (i.e., they are not associated with a window). To display a window in a region, first move the focus to the new region by typing <code>Ctrl-a Tab</code> and then either create a new window, or chose an existing window to display using any of the window selection commands we have already discussed. Regions may be further subdivided to smaller regions and we can even display the same window in more than one region.</p>
<div class="figure">
<img src="images/adventure_termmux_screen_regions.png" alt="Regions" ><p class="caption">Regions</p>
</div>
<p>Using multiple regions is very convenient when working with large terminal displays. For example, if we split the display into two horizontal regions, we can edit a script in one region and perform testing of the script in the other. Or we could read a man page in one region and try out a command in the other.</p>
<p>There are two commands for deleting regions: <code>Ctrl-a Q</code> removes all regions except the current one, and <code>Ctrl-a X</code> removes the current region. Note that removing a region does not remove its associated window. Windows continue to exist until they are destroyed.</p>
<h3 id="detaching-sessions">Detaching Sessions</h3>
<p>Perhaps the most interesting feature of <code>screen</code> is its ability to detach a session from the terminal itself. Just as it is able to display its windows on any region of the terminal, screen can also display its windows on any terminal or no terminal at all.</p>
<p>For example, we could start a screen session on one computer, say at the office, detach the session from the local terminal, go home and log into our office computer remotely, and reattach the screen session to our home computer's terminal. During the intervening time, all jobs on our office computer have continued to execute.</p>
<p>There are a number of commands used to manage this process.</p>
<ul>
<li><p><code>screen -list</code> lists the screen sessions running on a system. If there is more than one session running, the <code>pid.tty.host</code> string shown in the listing can be appended to the <code>-d/-D</code> and <code>-r/-R</code> options below to specify a particular session.</p></li>
<li><p><code>screen -d -r</code> detaches a screen session from the previous terminal and reattaches it to the current terminal.</p></li>
<li><p><code>screen -D -R</code> detaches a screen session from the previous terminal, logs the user off the old terminal and attaches the session to the new terminal creating a new session if no session existed. According to the <code>screen</code> documentation, this is the author's favorite.</p></li>
</ul>
<p>The <code>-d/-D</code> and <code>-r/-R</code> options can be used independently, but they are most often used together to detach and reattach an existing screen session in a single step.</p>
<p>We can demonstrate this process by opening two terminals. Launch <code>screen</code> on the first terminal and create a few windows. Now, go to the second terminal and enter the command <code>screen -D -R</code>. This will the cause the first terminal to vanish (the user is logged off) and the <code>screen</code> session to move to the second terminal fully intact.</p>
<h3 id="customizing-screen">Customizing Screen</h3>
<p>Like many of the interactive GNU utilities, screen is very customizable. During invocation, screen reads the <code>/etc/screenrc</code> and <code>~/.screenrc</code> files if they exist. While the list of customizable features is extensive (many having to do with terminal display control on a variety of Unix and Unix-like platforms), we will concern ourselves with key bindings and startup session configuration since these are the most commonly used.</p>
<p>First, let's look a sample screenrc file:</p>
<pre><code># This is a comment

# Set some key bindings

bind k              # Un-bind the &quot;k&quot; key (set it to do nothing)
bind K kill         # Make `Ctrl-a K` destroy the current window
bind } history      # Make `Ctrl-a }` copy and paste the current
                    # command line

# Define windows 7, 8, and 9 at startup

screen -t &quot;mdnght cmdr&quot; 7 mc
screen -t htop 8 htop
screen -t syslog 9 tailf /var/log/syslog</code></pre>
<p>As we can see, the format is pretty simple. The <code>bind</code> directive is followed by the key and the <code>screen</code> command it is to be bound to. A complete list of the <code>screen</code> commands can found in the <code>screen</code> man page. All of the <code>screen</code> commands we have discussed so far are simply key bindings like those in the example above. We can redefine them at will.</p>
<p>The three lines at the end of our example screenrc file create windows at startup. The commands set the window title (the <code>-t</code> option), a window number, and a command for the window to contain. This way, we can set up a <code>screen</code> session to be automatically built when we start screen which contains a complete multi-window, command-line environment running all of our favorite programs.</p>
<h2 id="tmux">tmux</h2>
<p>Despite its continuing popularity, GNU screen has been criticized for its code complexity (to the point of being called &quot;unmaintainable&quot;) and its resource consumption. In addition, it is reported that screen is no longer actively developed. In response to these concerns, a new program, <code>tmux</code>, has attracted widespread attention.</p>
<p><code>tmux</code> is modern, friendlier, more efficient, and generally superior to <code>screen</code> in most ways. Conceptually, <code>tmux</code> is very similar to <code>screen</code> in that it also supports the concept of sessions, windows and regions (called <em>panes</em> in tmux). In fact, it even shares a few keyboard commands with <code>screen</code>.</p>
<h3 id="availability-1">Availability</h3>
<p><code>tmux</code> is widely available, though not as widely as <code>screen</code>. It's available in most distribution repositories but, curiously, it's not present in Red Hat/CentOS (as of version 6). The package name is &quot;tmux&quot;.</p>
<h3 id="invocation-1">Invocation</h3>
<p>The program is invoked with the command <code>tmux new</code> to create a new session. We can optionally add <code>-s &lt;session_name&gt;</code> to assign a name to the new session and <code>-n &lt;window_name&gt;</code> to assign a name to the first window. If no option to the <code>new</code> command is supplied, the <code>new</code> itself may be omitted; it will be assumed. Here is an example:</p>
<pre><code>me@linuxbox: ~ $ tmux new -s &quot;my session&quot; -n &quot;window 1&quot;</code></pre>
<p>Once the program starts, we are presented with a shell prompt and a pretty status bar at the bottom of the window.</p>
<div class="figure">
<img src="images/adventure_termmux_tmux_initial.png" alt="Initial tmux window" ><p class="caption">Initial tmux window</p>
</div>
<h3 id="multiple-windows-1">Multiple Windows</h3>
<p><code>tmux</code> uses the keyboard in a similar fashion to <code>screen</code>, but rather than using <code>Ctrl-a</code> as the command prefix, <code>tmux</code> uses <code>Ctrl-b</code>. This is good since <code>Ctrl-a</code> is used when editing the command line in <code>bash</code> to move the cursor to the beginning of the line.</p>
<p>Here are the basic commands for creating windows and navigating them:</p>
<table>
<thead>
<tr class="header">
<th align="left">Command</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>Ctrl-b ?</code></td>
<td align="left">Show the list of key bindings (i.e., help)</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-b c</code></td>
<td align="left">Create a new window</td>
</tr>
<tr class="odd">
<td align="left"><code>Ctrl-b n</code></td>
<td align="left">Go to next window</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-b p</code></td>
<td align="left">Go to previous window</td>
</tr>
<tr class="odd">
<td align="left"><code>Ctrl-b 0</code></td>
<td align="left">Go to window 0. Numbers 1-9 are similar.</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-b w</code></td>
<td align="left">Show window list. The status bar lists windows, too.</td>
</tr>
<tr class="odd">
<td align="left"><code>Ctrl-b ,</code></td>
<td align="left">Rename the current window</td>
</tr>
</tbody>
</table>
<h3 id="multiple-panes">Multiple Panes</h3>
<p>Like <code>screen</code>, <code>tmux</code> can divide the terminal display into sections called panes. However, unlike the implementation of regions in <code>screen</code> , panes in <code>tmux</code> do not merely provide viewports to various windows. In <code>tmux</code> they are complete pseudo-terminals associated with the window. Thus a single <code>tmux</code> window can contain multiple terminals.</p>
<table>
<thead>
<tr class="header">
<th align="left">Command</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>Ctrl-b &quot;</code></td>
<td align="left">Split pane horizontally</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-b %</code></td>
<td align="left">Split pane vertically</td>
</tr>
<tr class="odd">
<td align="left"><code>Ctrl-b arrow</code></td>
<td align="left">Move to adjoining pane</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-b Ctrl-arrow</code></td>
<td align="left">Resize pane by 1 character</td>
</tr>
<tr class="odd">
<td align="left"><code>Ctrl-b Alt-arrow</code></td>
<td align="left">Resize pane by 5 characters</td>
</tr>
<tr class="even">
<td align="left"><code>Ctrl-b x</code></td>
<td align="left">Destroy current pane</td>
</tr>
</tbody>
</table>
<p>We can demonstrate the behavior of panes by creating a session and a couple of windows. First, we will create a session, name it, and name the initial window:</p>
<pre><code>me@linuxbox: ~ $ tmux new -s PaneDemo -n Window0</code></pre>
<p>Next, we will create a second window and give it a name:</p>
<pre><code>me@linuxbox: ~ $ tmux neww -n Window1</code></pre>
<p>We could have done this second step with <code>Ctrl-b</code> commands, but seeing the command-line method prepares us for something coming up a little later.</p>
<p>Assuming that all has gone well, we now find ourselves in a <code>tmux</code> session named &quot;PaneDemo&quot; and a window named &quot;Window1&quot;. Now we will split the window in two horizontally by typing <code>Ctrl-b &quot;</code>. We still have only two windows (Window0 and Window1), but now have two shell prompts on Window1. We can switch back and forth between the two panes by typing <code>Ctrl-b</code> followed by up arrow or down arrow.</p>
<p>Just for fun, let's type <code>Ctrl-b t</code> and a digital clock appears in the current pane. It's just a cute thing that <code>tmux</code> can do.</p>
<div class="figure">
<img src="images/adventure_termmux_tmux_clock.png" alt="Multiple panes" ><p class="caption">Multiple panes</p>
</div>
<p>We can terminate the clock display by typing <code>q</code>. If we move to the first window by typing <code>Ctrl-b 0</code> we see that the panes remain associated with Window1 and have no effect on Window0.</p>
<p>Returning to Window1, let's adjust the size of the panes. We do this by typing <code>Ctrl-b Alt-arrow</code> to move the boundary up or down by 5 lines. Typing <code>Ctrl-b Ctrl-arrow</code> will move the boundary by 1 line.</p>
<p>It's possible to break a pane out into a new window of its own. This is done by typing <code>Ctrl-b !</code>.</p>
<p><code>Ctrl-b x</code> is used to destroy a pane. Note that, unlike <code>screen</code>, destroying a pane in <code>tmux</code> also destroys the pseudo-terminal running within it, along with any associated programs.</p>
<h3 id="copy-mode">Copy Mode</h3>
<p>Like <code>screen</code>, <code>tmux</code> has a copy mode. It is invoked by typing <code>Ctrl-b [</code>. In copy mode, we can move the cursor freely within the scrollback buffer. To mark text for copying, we first type <code>Ctrl-space</code> to begin selection, then move the cursor to make our selection. Finally, we type <code>Alt-w</code> to copy the selected text.</p>
<div class="figure">
<img src="images/adventure_termmux_tmux_marked_text.png" alt="Text marked for copying" ><p class="caption">Text marked for copying</p>
</div>
<p>As with the digital clock, we return to normal mode by typing &quot;q&quot;. Now we can paste our copied text by typing <code>Ctrl-b ]</code>.</p>
<h3 id="detaching-sessions-1">Detaching Sessions</h3>
<p>With <code>tmux</code> it's easier to manage multiple sessions than with <code>screen</code>. First, we can give sessions descriptive names, either during creation, as we saw with our &quot;PaneDemo&quot; example above, or by renaming an existing session with <code>Ctrl-b $</code>. Second, it's easy to switch sessions on-the-fly by typing <code>Ctrl-b s</code> and choosing a session from the presented list.</p>
<p>While we are in a session, we can type <code>Ctrl-b d</code> to detach it and, in essence, put <code>tmux</code> into the background. This is useful if we want to create new a session by entering the <code>tmux new</code> command.</p>
<p>If we start a new terminal (or log in from a remote terminal) and wish to attach an existing session to it, we can issue the command <code>tmux ls</code> to display a list of available sessions. To attach a session, we enter the command <code>tmux attach -d -t &lt;session_name&gt;</code>. The &quot;-d&quot; option causes the session to be detached from its previous terminal. Without this option, the session will be attached to both its previous terminal and the new terminal.</p>
<h3 id="customizing-tmux">Customizing tmux</h3>
<p>As we would expect, <code>tmux</code> is <em>extremely</em> configurable. When <code>tmux</code> starts, it reads the files <code>/etc/tmux.conf</code> and <code>~./.tmux.conf</code> if they exist. It is also possible to start <code>tmux</code> with the <code>-f</code> option and specify an alternate configuration file. This way, we can have any number of custom configurations.</p>
<p>The number of configuration commands is extensive, just as it is with <code>screen</code>. Refer to the <code>tmux</code> man page for the full list.</p>
<p>As an example, here is a sample configuration file that changes the command prefix key from <code>Ctrl-b</code> to <code>Ctrl-a</code> and creates a new session with 4 windows:</p>
<pre><code># Sample tmux.conf file

# Change the command prefix from Ctrl-b to Ctrl-a
unbind-key C-b
set-option -g prefix C-a
bind-key C-a send-prefix

#####
# Create session with 4 windows
#####

# Create session and first window
new-session -d -s MySession

# Create second window and vertically split it
new-window
split-window -d -h

# Create third window (and name it) running Midnight Commander
new-window -d -n MdnghtCmdr mc

# Create fourth window (and name it) running htop
new-window -d -n htop htop

# Give focus to the first window in the session
select-window -t 0</code></pre>
<p>Since this configuration creates a new session, we should launch <code>tmux</code> by entering the command <code>tmux attach</code> to avoid the default behavior of automatically creating a new session. Otherwise, we end up with an additional and unwanted session.</p>
<h2 id="byobu">byobu</h2>
<p><code>byobu</code> (pronounced &quot;BEE-oh-boo&quot;) from the Japanese word for &quot;a folding, decorative, multi-panel screen&quot; is not a terminal multiplexer <em>per se</em>, but rather, it is a wrapper around either GNU screen or tmux (the default is <code>tmux</code>). It aims to create a simplified user interface with an emphasis on presenting useful system information on the status bar.</p>
<h3 id="availability-2">Availability</h3>
<p><code>byobu</code> was originally developed by Canonical employee Dustin Kirkland, and as such is usually found in Ubuntu and other Debian-based distributions. Recent versions are more portable than the initial release, and it is beginning to appear in a wider range of distributions. It is distributed as the package &quot;byobu&quot;.</p>
<h3 id="invocation-2">Invocation</h3>
<p><code>byobu</code> can be launched simply by entering the command <code>byobu</code> followed optionally by any options and commands to be passed to the backend terminal multiplexer (i.e., <code>tmux</code> or <code>screen</code>). For this adventure, we will confine our discussion to the <code>tmux</code> backend as it supports a larger feature set.</p>
<div class="figure">
<img src="images/adventure_termmux_byobu_initial.png" alt="Initial byobu window" ><p class="caption">Initial byobu window</p>
</div>
<h3 id="usage">Usage</h3>
<p>Unlike <code>screen</code> and <code>tmux</code>, <code>byobu</code> doesn't use a command prefix such as <code>Ctrl-a</code> to start a command. <code>byobu</code> relies extensively on function keys instead. This makes <code>byobu</code> somewhat easier to learn, but in exchange, it gives up some of the power and flexibility of the underlying terminal multiplexer. That said, <code>byobu</code> still provides an easy-to-use interface for the most useful features and it also provides a key (<code>F12</code>) which acts as command prefix for <code>tmux</code> commands. Below is an excerpt from the help file supplied with <code>byobu</code> when using <code>tmux</code> as the backend:</p>
<pre><code>  F1                            * Used by X11 *
    Shift-F1                    Display this help
  F2                            Create a new window
    Shift-F2                    Create a horizontal split
    Ctrl-F2                     Create a vertical split
    Ctrl-Shift-F2               Create a new session
  F3/F4                         Move focus among windows
    Shift-F3/F4                 Move focus among splits
    Ctrl-F3/F4                  Move a split
    Ctrl-Shift-F3/F4            Move a window
    Alt-Up/Down                 Move focus among sessions
    Shift-Left/Right/Up/Down    Move focus among splits
    Ctrl-Shift-Left/Right       Move focus among windows
    Ctrl-Left/Right/Up/Down     Resize a split
  F5                            Reload profile, refresh status
    Shift-F5                    Toggle through status lines
    Ctrl-F5                     Reconnect ssh/gpg/dbus sockets
    Ctrl-Shift-F5               Change status bar&#39;s color randomly
  F6                            Detach session and then logout
    Shift-F6                    Detach session and do not logout
    Ctrl-F6                     Kill split in focus
  F7                            Enter scrollback history
    Alt-PageUp/PageDown         Enter and move through scrollback
  F8                            Change the current window&#39;s name
    Shift-F8                    Toggle through split arrangements
    Ctrl-F8                     Restore a split-pane layout
    Ctrl-Shift-F8               Save the current split-pane layout
  F9                            Launch byobu-config window
  F10                           * Used by X11 *
  F11                           * Used by X11 *
    Alt-F11                     Expand split to a full window
    Shift-F11                   Join window into a horizontal split
    Ctrl-F11                    Join window into a vertical split
  F12                           Escape sequence
    Shift-F12                   Toggle on/off Byobu&#39;s keybindings
    Ctrl-Shift-F12              Modrian squares</code></pre>
<p>As we can see, most of the commands here correspond to features we have already seen in <code>tmux</code>. There are, however, a couple of interesting additions.</p>
<p>First is the <code>F9</code> key, which brings up a menu screen:</p>
<div class="figure">
<img src="images/adventure_termmux_byobu_menu.png" alt="byobu menu" ><p class="caption">byobu menu</p>
</div>
<p>The choices are pretty self-explanatory, though the &quot;Change escape sequence&quot; item is only relevant when using <code>screen</code> as the backend. If we choose &quot;Toggle status notifications&quot; we get to a really useful feature in <code>byobu</code>; the rich and easily configured status bar.</p>
<div class="figure">
<img src="images/adventure_termmux_byobu_status_toggle.png" alt="Status notifications" ><p class="caption">Status notifications</p>
</div>
<p>Here we can choose from a wide variety of system status information to be displayed. Very useful if we are monitoring remote servers.</p>
<p>The second is the <code>Shift-F12</code> key, which disables <code>byobu</code> from interpreting the functions keys as commands. This is needed in cases where a text-based application (such as Midnight Commander) needs the function keys. Pressing <code>Shift-F12</code> a second time re-enables the function keys for <code>byobu</code>. Unfortunately, <code>byobu</code> gives no visual indication of the state of the function keys, making this feature rather confusing to use in actual practice.</p>
<h3 id="copy-mode-1">Copy Mode</h3>
<p><code>byobu</code> provides an interface to the copy mode of its backend terminal multiplexer. For <code>tmux</code>, it's slightly simplified from normal <code>tmux</code>, but works about the same. Here are the key commands:</p>
<table>
<thead>
<tr class="header">
<th align="left">Command</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left"><code>Alt-PgUp</code></td>
<td align="left">Enter copy mode</td>
</tr>
<tr class="even">
<td align="left"><code>Space</code></td>
<td align="left">Start text selection</td>
</tr>
<tr class="odd">
<td align="left"><code>Enter</code></td>
<td align="left">End text selection, copy text, and exit copy mode</td>
</tr>
<tr class="even">
<td align="left"><code>Alt-Insert</code></td>
<td align="left">Paste selected text</td>
</tr>
</tbody>
</table>
<h3 id="detaching-sessions-2">Detaching Sessions</h3>
<p>To detach a session and log off, press the <code>F6</code> key. To detach without logging off, type <code>Shift-F6</code>. To attach, simply enter the <code>byobu</code> command and the previous session will be reattached. If more than one session is running, we are prompted to select a session. While we are in a session, we can type <code>Alt-Up</code> and <code>Alt-Down</code> to move from session to session.</p>
<h3 id="customizing-byobu">Customizing byobu</h3>
<p>The local configuration file for <code>byobu</code> is located in either <code>~/.byobu/.tmux.conf</code> or <code>~/.config/byobu/.tmux.conf</code>, depending on the distribution. If one doesn't work, try the other. The configuration details are the same as for <code>tmux</code>.</p>
<h2 id="summing-up">Summing Up</h2>
<p>We have seen how a terminal multiplexer can enhance our command-line experience by providing multiple windows and sessions, as well as multiple regions on a single terminal display. So, which one to choose? GNU screen has the benefit of being almost universally available, but is now considered by many as obsolete. <code>tmux</code> is modern and well supported by active development. <code>byobu</code> builds on the success of <code>tmux</code> with a simplified user interface, but if we rely on applications that need access to the keyboard function keys, <code>byobu</code> becomes quite tedious. Fortunately, many Linux distributions make all three available, so it's easy to try them all and see which one satisfies the needs at hand.</p>
<h2 id="further-reading">Further Reading</h2>
<p>The man pages for <code>screen</code> and <code>tmux</code> are richly detailed. Well worth reading. At the time of this writing however, the man page for <code>byobu</code> appears out of date and does not cover using <code>tmux</code> as the backend terminal multiplexer.</p>
<h3 id="gnu-screen-1">GNU Screen</h3>
<ul>
<li>Official site: <a href="https://www.gnu.org/software/screen/"><code class="url">https://www.gnu.org/software/screen/</code></a></li>
<li>A helpful entry in the Arch Wiki: <a href="https://wiki.archlinux.org/index.php/GNU_Screen"><code class="url">https://wiki.archlinux.org/index.php/GNU_Screen</code></a></li>
<li>A Google search for &quot;screenrc&quot; yields many sample <code>.screenrc</code> files</li>
<li>Also look for sample files in <code>/usr/share/doc/screen/examples</code></li>
</ul>
<h3 id="tmux-1">tmux</h3>
<ul>
<li>Official site: <a href="http://tmux.sourceforge.net/"><code class="url">http://tmux.sourceforge.net/</code></a></li>
<li>The tmux FAQ: <a href="http://sourceforge.net/p/tmux/tmux-code/ci/master/tree/FAQ"><code class="url">http://sourceforge.net/p/tmux/tmux-code/ci/master/tree/FAQ</code></a></li>
<li>A helpful entry in the Arch Wiki: <a href="https://wiki.archlinux.org/index.php/tmux"><code class="url">https://wiki.archlinux.org/index.php/tmux</code></a></li>
<li>A Google search for &quot;tmux.conf&quot; yields many sample <code>.tmux.conf</code> files</li>
<li>Also look for sample files in <code>/usr/share/doc/tmux/examples</code></li>
</ul>
<h3 id="byobu-1">byobu</h3>
<ul>
<li>Official site: <a href="http://byobu.co/"><code class="url">http://byobu.co/</code></a></li>
<li>Answers to many common questions: <a href="http://askubuntu.com/tags/byobu/hot"><code class="url">http://askubuntu.com/tags/byobu/hot</code></a></li>
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