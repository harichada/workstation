



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Writing shell scripts - Lesson 9: Stay Out Of Trouble</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_wss0080.php">
		<link rel="next" href="lc3_wss0100.php">
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
			href="lc3_wss0080.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="lc3_wss0100.php">Next</a></p>
		</div>
<h1>Stay Out of Trouble</h1>

<p>Now that our scripts are getting a little more
complicated, I want to point out some common
mistakes that you might run into. To do this,
create the following script called <tt class=
"user">trouble.bash</tt>. Be sure to enter it
exactly as written.</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

number=1

<tt class="user">if</tt> <tt class="user">[</tt> $number = "1" <tt
class="user">];</tt> <tt class="user">then</tt>
    <tt class="user">echo</tt> "Number equals 1"
<tt class="user">else</tt>
    <tt class="user">echo</tt> "Number does not equal 1"
<tt class="user">fi</tt>
       </tt>
</pre>
</div>

<p>When you run this script, it should output the
line "Number equals 1" because, well, <tt class="user">number</tt> equals
1. If you don't get the expected output, check your
typing; you made a mistake.</p>

<h2>Empty Variables</h2>

<p>Edit the script to change line 3 from:</p>

<div class="codeexample">
<pre>
<tt>number=1
       </tt>
</pre>
</div>

<p>to:</p>

<div class="codeexample">
<pre>
<tt>number=
       </tt>
</pre>
</div>

<p>and run the script again. This time you should
get the following:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">./trouble.bash</tt><br>
<tt class="prompt">/trouble.bash: [: =: unary
operator expected.<br>
Number does not equal 1</tt></p>
</div>

<p>As you can see, <tt class="user">bash</tt>
displayed an error message when we ran the script.
You probably think that by removing the "1" on line
3 it created a syntax error on line 3, but it
didn't. Let's look at the error message again:</p>

<div class="display">
<p><tt class="prompt">./trouble.bash: [: =: unary
operator expected</tt></p>
</div>

<p>We can see that <tt class=
"user">./trouble.bash</tt> is reporting the error
and the error has to do with "<tt class=
"user">[</tt>". Remember that "<tt class=
"user">[</tt>" is an abbreviation for the <tt
class="user">test</tt> shell builtin. From this we
can determine that the error is occurring on line 5
not line 3.</p>

<p>First, let me say there is nothing wrong with
line 3. <tt class="user">number=</tt> is perfectly
good syntax. You will sometimes want to set a
variable's value to nothing. You can confirm the
validity of this by trying it on the command
line:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">number=</tt><br>
<tt class="prompt">[me@linuxbox me]$</tt></p>
</div>

<p>See, no error message. So what's wrong with line
5? It worked before.</p>

<p>To understand this error, we have to see what
the shell sees. Remember that the shell spends a
lot of its life expanding text. In line 5, the
shell expands the value of <tt class=
"user">number</tt> where it sees <tt class=
"user">$number</tt>. In our first try (when <tt
class="user">number=1</tt>), the shell substituted
1 for <tt class="user">$number</tt> like so:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">if</tt> <tt class="user">[</tt> 1 = "1" <tt
class="user">];</tt> <tt class="user">then</tt>
       </tt>
</pre>
</div>

<p>However, when we set number to nothing (<tt
class="user">number=</tt>), the shell saw this
after the expansion:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">if</tt> <tt class="user">[</tt> = "1" <tt
class="user">];</tt> <tt class="user">then</tt>
       </tt>
</pre>
</div>

<p>which is an error. It also explains the rest of
the error message we received. The "<tt class=
"user">=</tt>" is a binary operator; that is, it
expects two items to operate upon - one on each
side. What the shell is trying to tell us is that
there is only one item and there should be
a unary operator (like "<tt class="user">!</tt>")
that only operates on a single item.</p>

<p>To fix this problem, change line 5 to read:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">if</tt> <tt class=
"user">[</tt> "$number" = "1" <tt class="user">];</tt> <tt class=
"user">then</tt>
       </tt>
</pre>
</div>

<p>Now when the shell performs the expansion it
will see:</p>

<div class="codeexample">
<pre>
<tt><tt class="user">if</tt> <tt class="user">[</tt> "" = "1" <tt
class="user">];</tt> <tt class="user">then</tt>
       </tt>
</pre>
</div>

<p>which correctly expresses our intent.</p>

<p>This brings up an important thing to remember
when you are writing your scripts. Consider what
happens if a variable is set to equal nothing.</p>

<h2>Missing Quotes</h2>

<p>Edit line 6 to remove the trailing quote from
the end of the line:</p>

<div class="codeexample">
<pre>
<tt>   <tt class="user">echo</tt> "Number equals 1
       </tt>
</pre>
</div>

<p>and run the script again. You should get
this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">./trouble.bash</tt><br>
<tt class="prompt">./trouble.bash: line 8:
unexpected EOF while looking for matching "<br>
./trouble.bash: line 10 syntax error: unexpected
end of file</tt></p>
</div>

<p>Here we have another case of a mistake in one
line causing a problem later in the script. What
happens is the shell keeps looking for the closing
quotation mark to tell it where the end of the
string is, but runs into the end of the file before
it finds it.</p>

<p>These errors can be a real pain to find in a
long script. This is one reason you should test
your scripts frequently when you are writing them
so there is less new code to test. I also find that
text editors with syntax highlighting make these kinds of bugs easier to
find.</p>

<h2>Isolating Problems</a></h2>

<p>Finding bugs in your programs can sometimes be
very difficult and frustrating. Here are a couple
of techniques that you will find useful:</p>

<p><b>Isolate blocks of code by "commenting them
out."</b> This trick involves putting comment
characters at the beginning of lines of code to
stop the shell from reading them. Frequently, you
will do this to a block of code to see if a
particular problem goes away. By doing this, you
can isolate which part of a program is causing (or
not causing) a problem.</p>

<p>For example, when we were looking for our missing
quotation we could have done this:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

number=1

<tt class="user">if</tt> <tt class="user">[</tt> $number = "1" <tt
class="user">];</tt> <tt class="user">then</tt>
    <tt class="user">echo</tt> "Number equals 1
#else
#   echo "Number does not equal 1"
<tt class="user">fi</tt>
       </tt>
</pre>
</div>

<p>By commenting out the <tt class="user">else</tt>
clause and running the script, we could show that
the problem was not in the <tt class=
"user">else</tt> clause even though the error
message suggested that it was.</p>

<p><b>Use echo commands to verify your
assumptions.</b> As you gain experience tracking
down bugs, you will discover that bugs are often
not where you first expect to find them. A common
problem will be that you will make a false
assumption about the performance of your program.
You will see a problem develop at a certain point
in your program and assume that the problem is
there. This is often incorrect, as we have seen. To
combat this, you should place <tt class=
"user">echo</tt> commands in your code while you
are debugging, to produce messages that confirm the
program is doing what is expected. There are two
kinds of messages that you should insert.</p>

<p>The first type simply announces that you have
reached a certain point in the program. We saw this
in our earlier discussion on stubbing. It is useful
to know that program flow is happening the way we
expect.</p>

<p>The second type displays the value of a variable
(or variables) used in a calculation or test. You
will often find that a portion of your program will
fail because something that you assumed was correct
earlier in your program is, in fact, incorrect and
is causing your program to fail later on.</p>

<h2>Watching Your Script Run</h2>

<p>It is possible to have <tt class=
"user">bash</tt> show you what it is doing when you
run your script. To do this, add a "<tt class=
"user">-x</tt>" to the first line of your script,
like this:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash -x
       </tt>
</pre>
</div>

<p>Now, when you run your script, bash will display
each line (with expansions performed) as it
executes it. This technique is called
<i>tracing</i>. Here is what it looks like:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">./trouble.bash</tt><br>
<tt class="prompt">+ number=1<br>
+ '[' 1 = 1 ']'<br>
+ echo 'Number equals 1'<br>
Number equals 1</tt></p>
</div>

<p>Alternately, you can use the <tt class=
"user">set</tt> command within your script to turn
tracing on and off. Use <tt class="user">set
-x</tt> to turn tracing on and <tt class="user">set
+x</tt> to turn tracing off. For example.:</p>

<div class="codeexample">
<pre>
<tt>#!/bin/bash

number=1

<tt class="user">set</tt> -x
<tt class="user">if</tt> <tt class="user">[</tt> $number = "1" <tt
class="user">];</tt> <tt class="user">then</tt>
    <tt class="user">echo</tt> "Number equals 1"
<tt class="user">else</tt>
    <tt class="user">echo</tt> "Number does not equal 1"
<tt class="user">fi</tt>
<tt class="user">set</tt> +x
       </tt>
</pre>
</div>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_wss0080.php">Previous</a> | <a
			href="lc3_writing_shell_scripts.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_wss0100.php">Next</a></p>
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