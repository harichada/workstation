



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 11: Flow Control - Part 2</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0100.php">
		<link rel="next" href="lc3_wss0120.php">
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
			href="lc3_wss0100.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0120.php">Next</a></p>
		</div>
<h1>Flow Control - Part 2</h1>

<p>Hold on to your hats. This lesson is going to be
a big one!</p>

<h2>More Branching</h2>

<p>In the <a href="lc3_wss0080.php">previous lesson on
flow control</a> we learned about the <tt class=
"user">if</tt> command and how it is used to alter
program flow based on a command's exit status. In programming
terms, this type of program flow is called
<i>branching</i> because it is like traversing a
tree. You come to a fork in the tree and the
evaluation of a condition determines which branch
you take.</p>

<p>There is a second and more complex kind of
branching called a <i>case</i>. A case is
multiple-choice branch. Unlike the simple branch,
where you take one of two possible paths, a case
supports several possible outcomes based on the
evaluation of a value.</p>

<p>You can construct this type of branch with
multiple <tt class="user">if</tt> statements. In
the example below, we evaluate some input from the
user:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

<tt class="user">echo</tt> -n "Enter a number between 1 and 3 inclusive &gt; "
<tt class="user">read</tt> character
<tt class="user">if</tt> <tt class=
"user">[</tt> "$character" = "1" <tt class="user">];</tt> <tt
class="user">then</tt>
    <tt class="user">echo</tt> "You entered one."
<tt class="user">elif</tt> <tt class="user">[</tt> "$character" = "2" <tt class="user">];</tt> <tt class="user">then</tt>
    <tt class="user">echo</tt> "You entered two."
<tt class="user">elif</tt> <tt class="user">[</tt> "$character" = "3" <tt class="user">];</tt> <tt class="user">then</tt>
    <tt class="user">echo</tt> "You entered three."
<tt class="user">else</tt>
    <tt class="user">echo</tt> "You did not enter a number between 1 and 3."
<tt class="user">fi</tt>
</tt>
</pre>
</div>

<p>Not very pretty.</p>

<p>Fortunately, the shell provides a more elegant
solution to this problem. It provides a built-in
command called <tt class="user"><a href="lc3_man_pages/caseh.html">case</a></tt>, which can
be used to construct an equivalent program:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

<tt class=
"user">echo</tt> -n "Enter a number between 1 and 3 inclusive &gt; "
<tt class="user">read</tt> character
<tt class="user">case</tt> $character <tt class="user">in</tt>
    1 ) <tt class="user">echo</tt> "You entered one."
        ;;
    2 ) <tt class="user">echo</tt> "You entered two."
        ;;
    3 ) <tt class="user">echo</tt> "You entered three."
        ;;
    * ) <tt class="user">echo</tt> "You did not enter a number between 1 and 3."
<tt class="user">esac</tt>
       </tt>
</pre>
</div>

<p>The <tt class="user">case</tt> command has the
following form:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">case</tt> word <tt class="user">in</tt>
    patterns <tt class="user">)</tt> commands <tt class=
"user">;;</tt>
<tt class="user">esac</tt>
       </tt>
</pre>
</div>

<p><tt class="user">case</tt> selectively executes
statements if word matches a pattern. You can have
any number of patterns and statements. Patterns can
be literal text or wildcards. You can have multiple
patterns separated by the "<tt>|</tt>" character.
Here is a more advanced example to show what I
mean:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

<tt class="user">echo</tt> -n "Type a digit or a letter &gt; "
<tt class="user">read</tt> character
<tt class="user">case</tt> $character <tt class="user">in</tt>
                                # Check for letters
    [[:lower:]] | [[:upper:]] ) <tt class="user">echo</tt> "You typed the letter $character"
                                ;;

                                # Check for digits
    [0-9] )                     <tt class="user">echo</tt> "You typed the digit $character"
                                ;;

                                # Check for anything else
    * )                         <tt class="user">echo</tt> "You did not type a letter or a digit"
<tt class="user">esac</tt>
</tt>
</pre>
</div>

<p>Notice the special pattern "<tt>*</tt>". This
pattern will match anything, so it is used to catch
cases that did not match previous patterns.
Inclusion of this pattern at the end is wise, as it
can be used to detect invalid input.</p>

<h2>Loops</h2>

<p>The final type of program flow control we will
discuss is called <i>looping</i>. Looping is
repeatedly executing a section of your program
based on the exit status of a command. The shell provides three
commands for looping: <tt class="user">while</tt>,
<tt class="user">until</tt> and <tt class=
"user">for</tt>. We are going to cover <tt class=
"user">while</tt> and <tt class="user">until</tt>
in this lesson and <tt class="user">for</tt> in a
upcoming lesson.</p>

<p>The <tt class="user">while</tt> command causes a
block of code to be executed over and over, as long
as the exit status of a specified command is true. Here is a simple example of
a program that counts from zero to nine:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

number=0
<tt class="user">while</tt> <tt class=
"user">[</tt> "$number" -lt 10 <tt class="user">];</tt> <tt class=
"user">do</tt>
    <tt class="user">echo</tt> "Number = $number"
    number=$((number + 1))
<tt class="user">done</tt>
       </tt>
</pre>
</div>

<p>On line 3, we create a variable called
<tt>number</tt> and initialize its value to 0.
Next, we start the <tt class="user">while</tt>
loop. As you can see, we have specified a command
that tests the value of <tt>number</tt>. In our
example, we test to see if <tt>number</tt> has a
value less than 10.</p>

<p>Notice the word <tt>do</tt> on line 4 and the
word <tt>done</tt> on line 7. These enclose the
block of code that will be repeated as long as the
exit status remains zero.</p>

<p>In most cases, the block of code that repeats
must do something that will eventually change the
exit status, otherwise you will have
what is called an <i>endless loop</i>; that is, a
loop that never ends.</p>

<p>In the example, the repeating block of code
outputs the value of <tt>number</tt> (the <tt
class="user">echo</tt> command on line 5) and
increments <tt>number</tt> by one on line 6. Each
time the block of code is completed, the test command's exit status
is evaluated again. After the tenth iteration of the
loop, <tt>number</tt> has been incremented ten
times and the <tt class="user">test</tt> command will terminate with a non-zero exit status. At that
point, the program flow resumes with the statement
following the word <tt>done</tt>. Since
<tt>done</tt> is the last line of our example, the
program ends.</p>

<p>The <tt class="user">until</tt> command works
exactly the same way, except the block of code is
repeated as long as the specified command's exit status is false. In the
example below, notice how the expression given to the <tt class="user">test</tt> command has been
changed from the <tt class="user">while</tt>
example to achieve the same result:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

number=0
<tt class="user">until</tt> <tt class=
"user">[</tt> "$number" -ge 10 <tt class="user">];</tt> <tt class=
"user">do</tt>
    <tt class="user">echo</tt> "Number = $number"
    number=$((number + 1))
<tt class="user">done</tt>
       </tt>
</pre>
</div>

<h2>Building a Menu</h2>

<p>One common way of presenting a user interface
for a text based program is by using a <i>menu</i>.
A menu is a list of choices from which the user can pick.</p>

<p>In the example below, we use our new knowledge
of loops and cases to build a simple menu driven
application:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

selection=
<tt class="user">until</tt> <tt class=
"user">[</tt> "$selection" = "0" <tt class="user">];</tt> <tt
class="user">do</tt>
    <tt class="user">echo</tt> "
    PROGRAM MENU
    1 - Display free disk space
    2 - Display free memory

    0 - exit program
"
    <tt class="user">echo</tt> -n "Enter selection: "
    <tt class="user">read</tt> selection
    <tt class="user">echo</tt> ""
    <tt class="user">case</tt> $selection <tt class="user">in</tt>
        1 ) df ;;
        2 ) free ;;
        0 ) <tt class="user">exit</tt> ;;
        * ) <tt class="user">echo</tt> "Please enter 1, 2, or 0"
    <tt class="user">esac</tt>
<tt class="user">done</tt>
       </tt>
</pre>
</div>

<p>The purpose of the <tt class="user">until</tt>
loop in this program is to re-display the menu each
time a selection has been completed. The loop will
continue until selection is equal to "0," the
"exit" choice. Notice how we defend against entries
from the user that are not valid choices.</p>

<p>To make this program better looking when it
runs, we can enhance it by adding a function that
asks the user to press the Enter key after each
selection has been completed, and clears the screen
before the menu is displayed again. Here is the
enhanced example:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

press_enter()
{
    <tt class="user">echo</tt> -en "\nPress Enter to continue"
    <tt class="user">read</tt>
    clear
}

selection=
<tt class="user">until</tt> <tt class=
"user">[</tt> "$selection" = "0" <tt class="user">];</tt> <tt
class="user">do</tt>
    <tt class="user">echo</tt> "
    PROGRAM MENU
    1 - display free disk space
    2 - display free memory

    0 - exit program
"
    <tt class="user">echo</tt> -n "Enter selection: "
    <tt class="user">read</tt> selection
    <tt class="user">echo</tt> ""
    <tt class="user">case</tt> $selection <tt class="user">in</tt>
        1 ) df <tt class="user">;</tt> press_enter ;;
        2 ) free <tt class="user">;</tt> press_enter ;;
        0 ) <tt class="user">exit</tt> ;;
        * ) <tt class=
"user">echo</tt> "Please enter 1, 2, or 0"; press_enter
    <tt class="user">esac</tt>
<tt class="user">done</tt>
</tt>
</pre>
</div>
<br>

<div class="sidebar">
<h2>When your computer hangs...</h2>

<p>We have all had the experience of an application
<i>hanging</i>. Hanging is when a program
suddenly seems to stop and become unresponsive.
While you might think that the program has stopped,
in most cases, the program is still running but its
program logic is stuck in an endless loop.</p>

<p>Imagine this situation: you have an external
device attached to your computer, such as a USB
disk drive but you forgot to turn it on. You try
and use the device but the application hangs
instead. When this happens, you could picture the
following dialog going on between the application
and the interface for the device:</p>
<pre>
<tt>Application:    Are you ready?
Interface:  Device not ready.

Application:    Are you ready?
Interface:  Device not ready.

Application:    Are you ready?
Interface:  Device not ready.

Application:    Are you ready?
Interface:  Device not ready.
</tt>
</pre>

<p>and so on, forever.</p>

<p>Well-written software tries to avoid this
situation by instituting a <i>timeout</i>. This
means that the loop is also counting the number of
attempts or calculating the amount of time it has
waited for something to happen. If the number of
tries or the amount of time allowed is exceeded,
the loop exits and the program generates an error
and exits.</p>
</div>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0100.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0120.php">Next</a></p>
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