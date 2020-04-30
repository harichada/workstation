



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 2: Editing the scripts you already have</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0010.php">
		<link rel="next" href="lc3_wss0030.php">
		<link rel="contents" href="lc3_writing_shell_scripts.php#contents">
	</head>

	<body>
	<a name="top"></a>
		<table class="page" summary="This table is used for graphic layout.">
			<tr>
				<td>
					<div class="colorblock"></div>
				</td>
				<td>
					<div class="body">
					<img src="images/blank_title.jpg" alt="Title graphic">
					</div>
				</td>
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
		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0010.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0030.php">Next</a></p>
		</div>
<h1>Editing the Scripts You Already Have</h1>

<p>Before we get to writing new scripts, I want to
point out that you have some scripts of your own
already. These scripts were put into your home
directory when your account was created, and are
used to configure the behavior of your sessions on
the computer. You can edit these scripts to change
things.</p>

<p>In this lesson, we will look at a couple of
these scripts and learn a few important new
concepts about the shell.</p>

<p>During your session, the
system is holding a number of facts about the world
in its memory. This information is called the
<i>environment</i>. The environment contains such
things as your path, your user name, the name of
the file where your mail is delivered, and much
more. You can see a complete list of what is in
your environment with the <tt class="user"><a href="lc3_man_pages/seth.html">set</a></tt>
command.</p>

<p>Two types of commands are often contained in the
environment. They are <i>aliases</i> and <i>shell
functions</i>.</p>


<h2>How is the Environment Established?</h2>

<p>When you log on to the system, the bash program starts, and reads a series of
configuration scripts called <i>startup files</i>. These define the default environment shared by
all users. This is followed by more startup files in your home directory that define your
personal environment. The exact sequence depends on the type of shell session being
started. There are two kinds: a <i>login shell session</i> and a <i>non-login shell session</i>.
A login shell session is one in which we are prompted for our user name and password;
when we start a virtual console session, for example. A non-login shell session typically
occurs when we launch a terminal session in the GUI.</p>

<p>Login shells read one or more startup files as shown below:</p>

<table cellpadding="8" summary="Startup Files For Login Shell Sessions" border>
	<tr>
		<td valign="top">
		<p><strong>File</strong></p>
		</td>

		<td valign="top">
		<p><strong>Contents</strong></p>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<tt class="user">/etc/profile</tt>	
		</td>
		<td valign="top">
			A global configuration script that applies to all users.
		</td>
	</tr>
	<tr>
		<td valign="top">
			<tt class="user">~/.bash_profile</tt>
		</td>
		<td valign="top">
			A user's personal startup file. Can be used to extend or
         override settings in the global configuration script.
      </td>
	</tr>
	<tr>
		<td valign="top">
			<tt class="user">~/.bash_login</tt>
		</td>
		<td valign="top">
			If <tt>~/.bash_profile</tt> is not found, bash attempts to
         read this script.		
		</td>
	</tr>
	<tr>
		<td valign="top">
			<tt class="user">~/.profile</tt>
		</td>
		<td valign="top">
			If neither <tt>~/.bash_profile</tt> nor <tt>~/.bash_login</tt>
         is found, bash attempts to read this file. This is the
         default in Debian-based distributions, such as Ubuntu.		
		</td>
	</tr>
</table>

<p>Non-login shell sessions read the following startup files:</p>

<table cellpadding="8" summary="Startup Files For Non-Login Shell Sessions" border>
	<tr>
		<td valign="top">
		<p><strong>File</strong></p>
		</td>

		<td valign="top">
		<p><strong>Contents</strong></p>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<tt class="user">/etc/bash.bashrc</tt>	
		</td>
		<td valign="top">
			A global configuration script that applies to all users.
		</td>
	</tr>
	<tr>
		<td valign="top">
			<tt class="user">~/.bashrc</tt>
		</td>
		<td valign="top">
			A user's personal startup file. Can be used to extend or
         override settings in the global configuration script.
      </td>
	</tr>
</table>


<p>In addition to reading the startup files above, non-login shells also inherit the
environment from their parent process, usually a login shell.</p>

<p>Take a look at your system and see which of these startup files you have. Remember— 
 since most of the file names listed above start with a period (meaning that they are
hidden), you will need to use the “-a” option when using ls.</p>

<p>The <tt>~/.bashrc</tt> file is probably the most important startup file from the ordinary user’s
point of view, since it is almost always read. Non-login shells read it by default and most
startup files for login shells are written in such a way as to read the <tt>~/.bashrc</tt> file as
well.</p>

<p>If we take a look inside a typical <tt>.bash_profile</tt> (this one taken from a CentOS 4 system), it
looks something like this:</p>

<tt><pre>
# .bash_profile
# Get the aliases and functions
if [ -f ~/.bashrc ]; then
	. ~/.bashrc
fi

# User specific environment and startup programs
PATH=$PATH:$HOME/bin
export PATH
</pre></tt>

<p>Lines that begin with a “#” are comments and are not read by the shell. These are there
for human readability. The first interesting thing occurs on the fourth line, with the
following code:</p>

<tt><pre>
if [ -f ~/.bashrc ]; then
	. ~/.bashrc
fi
</pre></tt>

<p>This is called an <i>if compound command</i>, which we will cover
fully in a later lesson, but for now I will translate:</p>

<p>If the file "~/.bashrc" exists, then
read the "~/.bashrc" file.</p>

<p>We can see that this bit of code is how a login shell gets the contents of <tt>.bashrc</tt>. The
next thing in our startup file does is set set PATH variable to add the <tt>~/bin</tt> directory
to the path.</p>


<p>Lastly, we have:</p>

<tt>export PATH</tt>

<p>The <tt class="user"><a href="lc3_man_pages/exporth.html">export</a></tt> command tells the shell to make the contents of PATH available to child
processes of this shell.</p>

<h2>Aliases</h2>

<p>An alias is an easy way to create a new command which acts as an 
abbreviation for a longer one. It has the following syntax:</p>

<tt>alias <i>name</i>=<i>value</i></tt>

<p>where <i>name</i> is the name of the new command and <i>value</i> 
is the text to be executed whenever <i>name</i> is entered on the 
command line.</p>

<p>Let's create an alias called "l" and make it an abbreviation for 
the command "ls -l". Make sure you are in your home directory. Using 
your favorite text editor, open the file <tt>.bashrc</tt> and add 
this line to the end of the file:</p>

<pre>
<tt>
alias l='ls -l'
</tt>
</pre>

<p>By adding the <tt class="user"><a href="lc3_man_pages/aliash.html"
>alias</a></tt> command to the file, we have created a new command 
called "l" which will perform "ls -l". To try out your new command, 
close your terminal session and start a new one. This will reload 
the <tt>.bashrc</tt> file. Using this technique, you can create any 
number of custom commands for yourself. Here is another one for you 
to try:</p>

<pre>
<tt>
alias today='date +"%A, %B %-d, %Y"'
</tt>
</pre>

<p>This alias creates a new command called "today" that will display 
today's date with nice formatting.</p>

<p>By the way, the <tt class="user">alias</tt> command is just 
another shell builtin. You can create your aliases directly at the 
command prompt; however they will only remain in effect during your 
current shell session. For example:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">alias l='ls -l'</tt></p>
</div>

<h2>Shell Functions</h2>

<p>Aliases are good for very simple commands, but if you want to 
create something more complex, you should try <i>shell functions</i>
. Shell functions can be thought of as "scripts within scripts" or 
little sub-scripts. Let's try one. Open <tt>.bashrc</tt> with your 
text editor again and replace the alias for "today" with the 
following:</p>

<pre>
<tt>
today() {
    echo -n "Today's date is: "
    date +"%A, %B %-d, %Y"
}
</tt>
</pre>

<p>Believe it or not, <tt class=
"user"><a href="lc3_man_pages/functionh.html">()</a></tt> is a shell builtin too, and as
with <tt class="user">alias</tt>, you can enter shell functions directly
at the command prompt.</p>

<div class="display">
<pre>
<tt class="prompt">[me@linuxbox me]$</tt> <tt class=
"cmd">today() {</tt>
<tt class="prompt">&gt;</tt> <tt class=
"cmd">echo -n "Today's date is: "</tt>
<tt class="prompt">&gt;</tt> <tt class=
"cmd">date +"%A, %B %-d, %Y"</tt>
<tt class="prompt">&gt;</tt> <tt class="cmd">}</tt>
<tt class="prompt">[me@linuxbox me]$</tt>
</pre>
</div>

<p>However, again like <tt class="user">alias</tt>, shell functions defined directly on the
command line only last as long as the current shell session.</p>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0010.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0030.php">Next</a></p>
		</div>
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