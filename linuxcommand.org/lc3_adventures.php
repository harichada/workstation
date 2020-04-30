



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: Adventures</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Fun and interesting Linux command line tools">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="index.php">
		<link rel="next" href="lc3_adv_mc.php">
		<link rel="contents" href="lc3_adventures.php#contents">
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
					<img src="images/Adventures.png" alt="Title graphic">
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
			href="index.php">Previous</a> | <a
			href="lc3_adventures.php#contents">Contents</a> | <a
			href="lc3_adv_mc.php">Next</a></p>
		</div>
<h1><em>Amaze Your Friends! Baffle Your Enemies!</em></h1>

<p>A long time ago (the spring of 1978) I got my first computer, a TRS-80
model 1.  In the early days of personal computing, many computer
peripherals, such as printers and floppy disk drives, were very expensive.
In response, my dad (an electrical engineer) and I would cruise surplus
electronics stores looking for deals on devices we could hook to our new
computer.</p>

<p>One day, as we were searching a large warehouse near the University of
Maryland, I came across a display featuring a small, clear, plastic box
containing a battery, a couple of integrated circuits, and several randomly
blinking LEDs. At the time, this was pretty neat since, while it served no
useful purpose, it was self-contained and it had blinking lights.  Above it
was a handwritten sign that read:</p>

<center>Amaze Your Friends! Baffle Your Enemies!</center>

<p>The pervasive excitement in the early days of personal computing is hard
to explain to people today. The computers of that period seem so laughably
primitive by today's standards, but it was a revolution and there were many
explorers mapping a new, uncharted frontier of personal empowerment and
technical discovery.</p>
 
<p>People entering the computer field today are at a disadvantage compared
to those of us who came up in the 1970s and 1980s. Back then, computers
were very simple and slow with tiny memories; the attributes you need if
you really want to understand how computers work. Today, computers are so
fast, and software so large and complex that you can't really see the
computer anymore and that's a shame. You can't see the beauty of what they
do.</p>

<p>Today however, we are in the midst of another revolution: extremely
low-cost computing. Devices like the Raspberry Pi offer the opportunity to
work on systems that are much more pure in form compared to most
contemporary mobile and desktop devices. But make no mistake, these
low-cost devices are powerful. In fact, a $35 Raspberry Pi compares
favorably to the $30,000 Unix workstations I used in the early 1990s.</p>

<p>This collection is a supplement to my first book, <em><a
href="tlcl.php">The Linux Command Line </a></em> (TLCL) and as such, we
will be referring back that book frequently, so if you don't already have a
copy, please download one or, if you prefer, pick up a printed copy from
your favorite bookseller or library. This time around we are going to build
on our experience with the command line and add some more tools and
techniques to our repertoire. Like TLCL, this collection is not about Linux
system administration; rather it is a collection of topics that I consider
both fun and interesting. We will cover many tools that will be of interest
to budding system administrators, but the tools were chosen for other
reasons.  Sometimes they were chosen because they are &quot;classic&quot;
Unix, others because they are just &quot;something you should know,&quot;
but mostly topics were chosen because I find them fun and interesting.
Personal computing, after all, should be about doing things that are fun
and interesting just as it was in the early days.</p>

<ul>
	<li>
		<h2><a href="lc3_adv_mc.php" name="contents">Midnight Commander</a></h2>
       
        <p>At the beginning of chapter 4 in TLCL there is a discussion of
        GUI-based file managers versus the traditional command line tools
        for file manipulation such as <code>cp</code>, <code>mv</code>, and
        <code>rm</code>. While many common file manipulations are
        easily done with a graphical file manager, the command line
        tools provide additional power and flexibility.</p>

        <p>In this adventure we will look at Midnight Commander, a
        character-based directory browser and file manager that bridges
        the two worlds of the familiar graphical file manager and the
        common command line tools.</p>

        <p>The design of Midnight Commander is based on a common concept in
        file managers: dual directory panes where the listings of two
        directories are shown at the same time. The idea is that files are
        moved or copied from the directory shown in one pane to the
        directory shown in the other. Midnight Commander can do this, and
        much, much more.</p>
	
    </li>
	<li>
		<h2><a href="lc3_adv_termmux.php">Terminal Multiplexers</a></h2>

        <p>It's easy to take the terminal for granted. After all, modern
        terminal emulators like gnome-terminal, konsole, and the others
        included with Linux desktop environments are feature-rich
        applications that satisfy most of our needs. But sometimes we need
        more. We need to have multiple shell sessions running in a single
        terminal. We need to display more than one application in a single
        terminal. We need to move a running terminal session from one
        computer to another. In short, we need a <em>terminal
        multiplexer</em>.</p>

        <p>Terminal multiplexers are programs that can perform these
        amazing feats. In this adventure, we will look at three examples:
        GNU screen, tmux, and byobu.</p>

	</li>
	<li>
		<h2><a href="lc3_adv_lesstype.php">Less Typing</a></h2>

        <p>Since the beginning of time, Man has had an uneasy relationship
        with his keyboard. Sure, keyboards make it possible to express our
        precise wishes to the computer, but in our fat-fingered excitement
        to get stuff done, we often suffer from typos and digital
        fatigue.</p>

        <p>In this adventure, we will travel down the carpal tunnel to the
        land of less typing. We covered some of this in TLCL, but here we
        will look a little deeper.</p>

	</li>
	<li>
		<h2><a href="lc3_adv_redirection.php">More Redirection</a></h2>
	
        <p>As we learned in chapter 6 of TLCL, I/O redirection is one of
        the most useful and powerful features of the shell. With
        redirection, our commands can send and receive streams of data to
        and from files and devices, as well as allow us to connect
        different programs together into pipelines.</p>

        <p>In this adventure, we will look at redirection in a little more
        depth to see how it works and to discover some additional features
        and useful redirection techniques.</p>
    
    </li>
	<li>
		<h2><a href="lc3_adv_tput.php">tput</a></h2>

        <p>While our command line environment is certainly powerful, it can
        be be somewhat lacking when it comes to visual appeal. Our
        terminals cannot create the rich environment of the graphical user
        interface, but it doesn't mean we are doomed to always look at
        plain characters on a plain background.</p>

        <p>In this adventure, we will look at <code>tput</code>, a command
        used to manipulate our terminal. With it, we can change the color
        of text, apply effects, and generally brighten things up. More
        importantly, we can use <code>tput</code> to improve the human
        factors of our scripts. For example, we can use color and text
        effects to better present information to our users.</p>

	</li>
	<li>
		<h2><a href="lc3_adv_dialog.php">dialog</a></h2>

        <p>If we look at contemporary software, we might be surprised to
        learn that the majority of code in most programs today has very
        little to do with the real work for which the program was intended.
        Rather, the majority of code is used to create the user interface.
        Modern graphical programs need large amounts of CPU time and memory
        for their sophisticated eye candy. This helps explain why command
        line programs usually use so little memory and CPU compared to
        their GUI counterparts.</p>

        <p>Still, the command line interface is often inconvenient. If only
        there were some way to emulate common graphical user interface
        features on a text display.</p>

        <p>In this adventure, we're going to look at <code>dialog</code>, a
        program that does just that. It displays various kinds of
        <em>dialog boxes</em> that we can incorporate into our shell
        scripts to give them a much friendlier face. <code>dialog</code>
        dates back a number of years and is now just one member of a family
        of programs that attempt to solve the user interface problem for
        command line users.</p>

	</li>
	<li>
		<h2><a href="lc3_adv_awk.php">AWK</a></h2>

        <p>One of the great things we can do in the shell is embed other
        programming languages within the body of our scripts. We have seen
        hints of this with the stream editor <code>sed</code>, and the
        arbitrary precision calculator program <code>bc</code>. By using
        the shell's single quoting mechanism to isolate text from shell
        expansion, we can freely express other programming languages,
        provided we have a suitable language interpreter to execute
        them.</p>

        <p>In this adventure, we are going to look at one such program,
        <code>awk</code>, a classic pattern matching and text processing
        language.</p>

	</li>
	<li>
		<h2><a href="lc3_adv_othershells.php">Other Shells</a></h2>

        <p>While we have spent a great deal of time learning the bash
        shell, it's not the only game in town. Unix has had
        several popular shells and almost all are available for Linux, too.
        In this adventure, we will look at some of these, mostly for their
        historical significance. With a couple of possible exceptions,
        there is very little reason to switch, as <code>bash</code> is a
        pretty good shell. Some of these alternate shells are still popular
        on other Unix and Unix-like systems, but are rarely used in Linux
        except when compatibility with other systems is required.</p>

	</li>
	<li>
		<h2><a href="lc3_adv_powerterm.php">Power Terminals</a></h2>

        <p>Over the course of our many lessons and adventures, we have
        learned a lot about the shell, and explored many of the common
        command line utilities found on Linux systems. There is, however,
        one program we have overlooked, and it may be among the most
        important and most frequently used of them all-- our terminal
        emulator.</p>

        <p>In this adventure, we are going to dig into these essential
        tools and look at a few of the different terminal programs and the
        many interesting things we can do with them.</p>

	</li>
	<li>
		<h2><a href="lc3_adv_vimvigor.php">Vim, with Vigor</a></h2>

        <p>TLCL Chapter 12 taught us the basic skills necessary to use the
        vim text editor. However, we barely scratched the surface of its
        capabilities. Vim is a very powerful program. In fact, it's safe to
        say that vim can do anything. It's just a question of figuring out
        how. In this adventure, we will acquire an intermediate level of
        skill in this popular tool. In particular, we will look at ways to
        improve our productivity writing shell programs, configuration
        files, and documentation. Even better, after we get the hang of
        some of these additional features, using vim actually becomes
        fun.</p>

	</li>
</ul>


		<div class="pagenav">
			<p class="right"><a
			href="index.php">Previous</a> | <a
			href="lc3_adventures.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_adv_mc.php">Next</a></p>
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
