



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 10: Keyboard Input and Arithmetic</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0090.php">
		<link rel="next" href="lc3_wss0110.php">
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
			href="lc3_wss0090.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0110.php">Next</a></p>
		</div>
<h1>Keyboard Input and Arithmetic</h1>

<p>Up to now, our scripts have not been interactive.
That is, they did not require any input from the
user. In this lesson, we will see how your scripts
can ask questions, and get and use responses.</p>

<h2>read</h2>

<p>To get input from the keyboard, you use the <tt
class="user"><a href="lc3_man_pages/readh.html">read</a></tt> command. The <tt class=
"user">read</tt> command takes input from the
keyboard and assigns it to a variable. Here is an
example:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

<tt class="user">echo</tt> -n "Enter some text &gt; "
<tt class="user">read</tt> text
<tt class="user">echo</tt> "You entered: $text"
       </tt>
</pre>
</div>

<p>As you can see, we displayed a prompt on line 3.
Note that "<tt>-n</tt>" given to the <tt class=
"user">echo</tt> command causes it to keep the
cursor on the same line; i.e., it does not output a
linefeed at the end of the prompt.</p>

<p>Next, we invoke the <tt class="user">read</tt>
command with "<tt>text</tt>" as its argument. What
this does is wait for the user to type something
followed by a carriage return (the Enter key) and
then assign whatever was typed to the variable
<tt>text</tt>.</p>

<p>Here is the script in action:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">read_demo.bash</tt><br>
<tt class="prompt">Enter some text &gt;</tt> <tt
class="cmd">this is some text</tt><br>
<tt class="prompt">You entered: this is some
text</tt></p>
</div>

<p>If you don't give the <tt class="user">read</tt>
command the name of a variable to assign its input,
it will use the environment variable
<tt>REPLY</tt>.</p>

<p>The <tt class="user">read</tt> command also
takes some command line options. The two most
interesting ones are <tt>-t</tt> and <tt>-s</tt>.
The <tt>-t</tt> option followed by a number of
seconds provides an automatic timeout for the <tt
class="user">read</tt> command. This means that the
<tt class="user">read</tt> command will give up
after the specified number of seconds if no
response has been received from the user. This
option could be used in the case of a script that
must continue (perhaps resorting to a default
response) even if the user does not answer the
prompts. Here is the <tt>-t</tt> option in
action:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

<tt class="user">echo</tt> -n "Hurry up and type something! &gt; "
<tt class="user">if</tt> <tt class=
"user">read</tt> -t 3 response; <tt class="user">then</tt>
    <tt class="user">echo</tt> "Great, you made it in time!"
<tt class="user">else</tt>
    <tt class="user">echo</tt> "Sorry, you are too slow!"
<tt class="user">fi</tt>
       </tt>
</pre>
</div>

<p>The <tt>-s</tt> option causes the user's typing
not to be displayed. This is useful when you are
asking the user to type in a password or other
confidential information.</p>

<h2>Arithmetic</h2>

<p>Since we are working on a computer, it is
natural to expect that it can perform some simple
arithmetic. The shell provides features for
<i>integer arithmetic</i>.</p>

<p>What's an integer? That means whole numbers like
1, 2, 458, -2859. It does not mean fractional
numbers like 0.5, .333, or 3.1415. If you must deal
with fractional numbers, there is a separate
program called <tt class="user"><a href=
"lc3_man_pages/bc1.html">bc</a></tt> which provides an
arbitrary precision calculator language. It can be
used in shell scripts, but is beyond the scope of
this tutorial.</p>

<p>Let's say you want to use the command line as a
primitive calculator. You can do it like this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">echo $((2+2))</tt></p>
</div>

<p>As you can see, when you surround an arithmetic
expression with the double parentheses, the shell
will perform arithmetic expansion.</p>

<p>Notice that whitespace is ignored:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">echo $((2+2))</tt><br>
<tt class="prompt">4</tt><br>
<tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">echo $(( 2+2 ))</tt><br>
<tt class="prompt">4</tt><br>
<tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">echo $(( 2 + 2 ))</tt><br>
<tt class="prompt">4</tt></p>
</div>

<p>The shell can perform a variety of common (and
not so common) arithmetic operations. Here is an
example:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

first_num=0
second_num=0

<tt class="user">echo</tt> -n "Enter the first number --&gt; "
<tt class="user">read</tt> first_num
<tt class="user">echo</tt> -n "Enter the second number -&gt; "
<tt class="user">read</tt> second_num

<tt class=
"user">echo</tt> "first number + second number = $((first_num + second_num))"
<tt class=
"user">echo</tt> "first number - second number = $((first_num - second_num))"
<tt class=
"user">echo</tt> "first number * second number = $((first_num * second_num))"
<tt class=
"user">echo</tt> "first number / second number = $((first_num / second_num))"
<tt class=
"user">echo</tt> "first number % second number = $((first_num % second_num))"
<tt class="user">echo</tt> "first number raised to the"
<tt class=
"user">echo</tt> "power of the second number   = $((first_num ** second_num))"
       </tt>
</pre>
</div>

<p>Notice how the leading "<tt>$</tt>" is not
needed to reference variables inside the arithmetic
expression such as "<tt>first_num +
second_num</tt>".</p>

<p>Try this program out and watch how it handles
division (remember, this is integer division) and
how it handles large numbers. Numbers that get too
large <i>overflow</i> like the odometer in a car
when you exceed the number of miles it was designed
to count. It starts over but first it goes through
all the negative numbers because of how integers
are represented in memory. Division by zero (which
is mathematically invalid) does cause an error.</p>

<p>I'm sure that you recognize the first four
operations as addition, subtraction, multiplication
and division, but that the fifth one may be
unfamiliar. The "<tt>%</tt>" symbol represents
remainder (also known as <i>modulo</i>). This
operation performs division but instead of
returning a quotient like division, it returns the
remainder. While this might not seem very useful,
it does, in fact, provide great utility when
writing programs. For example, when a remainder
operation returns zero, it indicates that the first
number is an exact multiple of the second. This can
be very handy:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

number=0

<tt class="user">echo</tt> -n "Enter a number &gt; "
<tt class="user">read</tt> number

<tt class="user">echo</tt> "Number is $number"
<tt class="user">if</tt> <tt class=
"user">[</tt> $((number % 2)) -eq 0 <tt class="user">];</tt> <tt
class="user">then</tt>
    <tt class="user">echo</tt> "Number is even"
<tt class="user">else</tt>
    <tt class="user">echo</tt> "Number is odd"
<tt class="user">fi</tt>
       </tt>
</pre>
</div>

<p>Or, in this program that formats an arbitrary
number of seconds into hours and minutes:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

seconds=0

<tt class="user">echo</tt> -n "Enter number of seconds &gt; "
<tt class="user">read</tt> seconds

hours=$((seconds / 3600))
seconds=$((seconds % 3600))
minutes=$((seconds / 60))
seconds=$((seconds % 60))

<tt class=
"user">echo</tt> "$hours hour(s) $minutes minute(s) $seconds second(s)"
       </tt>
</pre>
</div>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0090.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0110.php">Next</a></p>
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