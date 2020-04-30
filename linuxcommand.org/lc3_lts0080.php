



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>Learning the shell - Lesson 8: Expansion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Linux bash shell programming tutorials">
		<meta name="description" content="Learn the Linux command line">
		<meta name="author" content="William Shotts, Jr.">
		<meta name="copyright" content="Copyright 2000-2020, William Shotts, Jr.">
		<link rel="stylesheet" type="text/css" href="linuxcommand3.css">
		<link rel="prev" href="lc3_lts0070.php">
		<link rel="next" href="lc3_lts0090.php">
		<link rel="contents" href="lc3_learning_the_shell.php#contents">
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
			href="lc3_lts0070.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="lc3_lts0090.php">Next</a></p>
		</div>
<h1>Expansion</h1>

<p>Each time you type a command line and press the enter key, bash performs several
processes upon the text before it carries out your command. We have seen a couple of
cases of how a simple character sequence, for example “*”, can have a lot of meaning to
the shell. The process that makes this happen is called <i>expansion</i>. With expansion, you
type something and it is expanded into something else before the shell acts upon it. To
demonstrate what we mean by this, let's take a look at the
<tt class="user"><a href="lc3_man_pages/echoh.html">echo</a></tt> command.
<tt class="user">echo</tt> is a
shell builtin that performs a very simple task. It prints out its text arguments on standard
output:
</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo this is a test</tt><br>
<tt class="prompt">this is a test</tt></p>
</div>

<p>That's pretty straightforward. Any argument passed to <tt class="user">echo</tt> gets displayed. Let's try
another example:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo *</tt><br>
<tt class="prompt">Desktop Documents ls-output.txt Music Pictures Public Templates
Videos</tt></p>
</div>

<p>So what just happened? Why didn't <tt class="user">echo</tt> print “*”? As you recall from our work with
wildcards, the “*” character means match any characters in a filename, but what we didn't
see in our original discussion was how the shell does that. The simple answer is that the
shell expands the “*” into something else (in this instance, the names of the files in the
current working directory) before the <tt class="user">echo</tt> command is executed. When the enter key is
pressed, the shell automatically expands any qualifying characters on the command line
before the command is carried out, so the <tt class="user">echo</tt> command never saw the “*”, only its
expanded result. Knowing this, we can see that <tt class="user">echo</tt> behaved as expected.
</p> 

<h2>Pathname Expansion</h2>

<p>The mechanism by which wildcards work is called <i>pathname expansion</i>. If we try some
of the techniques that we employed in our earlier lessons, we will see that they are really
expansions. Given a home directory that looks like this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">ls</tt><br>
<tt class="prompt"><pre>Desktop
ls-output.txt
Documents Music
Pictures
Public
Templates
Videos</pre></tt></p>
</div>

<p>we could carry out the following expansions:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo D*</tt><br>
<tt class="prompt">Desktop Documents</tt></p>
</div>

<p>and:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo *s</tt><br>
<tt class="prompt">Documents Pictures Templates Videos</tt></p>
</div>

<p>or even:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo [[:upper:]]*</tt><br>
<tt class="prompt">Desktop Documents Music Pictures Public Templates Videos</tt></p>
</div>

<p>and looking beyond our home directory:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo /usr/*/share</tt><br>
<tt class="prompt">/usr/kerberos/share /usr/local/share</tt></p>
</div>

<h2>Tilde Expansion</h2>

<p>As you may recall from our introduction to the <tt class="user">cd</tt> command, the tilde character (“~”) has
a special meaning. When used at the beginning of a word, it expands into the name of the
home directory of the named user, or if no user is named, the home directory of the
current user:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo ~</tt><br>
<tt class="prompt">/home/me</tt></p>
</div>

<p>If user “foo” has an account, then:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo ~foo</tt><br>
<tt class="prompt">/home/foo</tt></p>
</div>


<h2>Arithmetic Expansion</h2>

<p>The shell allows arithmetic to be performed by expansion. This allow us to use the shell
prompt as a calculator:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo $((2 + 2))</tt><br>
<tt class="prompt">4</tt></p>
</div>

<p>Arithmetic expansion uses the form:</p>

<pre>
	$((expression))</pre>

<p>where expression is an arithmetic expression consisting of values and arithmetic
operators.</p>

<p>Arithmetic expansion only supports integers (whole numbers, no decimals), but can
perform quite a number of different operations.</p>

<p>Spaces are not significant in arithmetic expressions and expressions may be nested. For
example, to multiply five squared by three:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo $(($((5**2)) * 3))</tt><br>
<tt class="prompt">75</tt></p>
</div>

<p>Single parentheses may be used to group multiple subexpressions. With this technique,
we can rewrite the example above and get the same result using a single expansion
instead of two:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo $(((5**2) * 3))</tt><br>
<tt class="prompt">75</tt></p>
</div>

<p>Here is an example using the division and remainder operators. Notice the effect of
integer division:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo Five divided by two equals $((5/2))</tt><br>
<tt class="prompt">Five divided by two equals 2</tt><br>
<tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo with $((5%2)) left over.</tt><br>
<tt class="prompt">with 1 left over.</tt></p>
</div>

<h2>Brace Expansion</h2>

<p>Perhaps the strangest expansion is called <i>brace expansion</i>. With it, you can create
multiple text strings from a pattern containing braces. Here's an example:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo Front-{A,B,C}-Back</tt><br>
<tt class="prompt">Front-A-Back Front-B-Back Front-C-Back</tt></p>
</div>

<p>Patterns to be brace expanded may contain a leading portion called a <i>preamble</i> and a
trailing portion called a <i>postscript</i>. The brace expression itself may contain either a
comma-separated list of strings, or a range of integers or single characters. The pattern
may not contain embedded whitespace. Here is an example using a range of integers:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo Number_{1..5}</tt><br>
<tt class="prompt">Number_1 Number_2 Number_3 Number_4 Number_5</tt></p>
</div>

<p>A range of letters in reverse order:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo {Z..A}</tt><br>
<tt class="prompt">Z Y X W V U T S R Q P O N M L K J I H G F E D C B A</tt></p>
</div>

<p>Brace expansions may be nested:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo a{A{1,2},B{3,4}}b</tt><br>
<tt class="prompt">aA1b aA2b aB3b aB4b</tt></p>
</div>

<p>So what is this good for? The most common application is to make lists of files or
directories to be created. For example, if you were a photographer and had a large
collection of images you wanted to organize into years and months, the first thing you
might do is create a series of directories named in numeric “Year-Month” format. This
way, the directory names will sort in chronological order. You could type out a complete
list of directories, but that's a lot of work and it's error-prone too. Instead, you could do
this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">mkdir Photos</tt><br>
<tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">cd Photos</tt><br>
<tt class="prompt">[me@linuxbox Photos]$</tt> <tt class="cmd">mkdir {2007..2009}-0{1..9} {2007..2009}-{10..12}</tt><br>
<tt class="prompt">[me@linuxbox Photos]$</tt> <tt class="cmd">ls</tt><br>
<tt class="prompt"><pre>2007-01 2007-07 2008-01 2008-07 2009-01 2009-07
2007-02 2007-08 2008-02 2008-08 2009-02 2009-08
2007-03 2007-09 2008-03 2008-09 2009-03 2009-09
2007-04 2007-10 2008-04 2008-10 2009-04 2009-10
2007-05 2007-11 2008-05 2008-11 2009-05 2009-11
2007-06 2007-12 2008-06 2008-12 2009-06 2009-12</pre></tt></p>
</div>

<p>Pretty slick!</p>

<h2>Parameter Expansion</h2>

<p>We're only going to touch briefly on <i>parameter expansion</i> in this lesson, but we'll be
covering it more later. It's a feature that is more useful in shell scripts than directly
on the command line. Many of its capabilities have to do with the system's ability to
store small chunks of data and to give each chunk a name. Many such chunks, more
properly called <i>variables</i>, are available for your examination. For example, the variable
named “USER” contains your user name. To invoke parameter expansion and reveal the
contents of USER you would do this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo $USER</tt><br>
<tt class="prompt">me</tt></p>
</div>

<p>To see a list of available variables, try this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">printenv | less</tt></p>
</div>

<p>You may have noticed that with other types of expansion, if you mistype a pattern, the
expansion will not take place and the echo command will simply display the mistyped
pattern. With parameter expansion, if you misspell the name of a variable, the expansion
will still take place, but will result in an empty string:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo $SUER</tt><br>
<tt class="prompt">[me@linuxbox ~]$</tt></p>
</div>

<h2>Command Substitution</h2>

<p><i>Command substitution</i> allows us to use the output of a command as an expansion:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo $(ls)</tt><br>
<tt class="prompt">Desktop Documents ls-output.txt Music Pictures Public Templates
Videos</tt></p>
</div>

<p>One of my favorites goes something like this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">ls -l $(which cp)</tt><br>
<tt class="prompt">-rwxr-xr-x 1 root root 71516 2007-12-05 08:58 /bin/cp</tt></p>
</div>

<p>Here we passed the results of which <tt class="user">cp</tt> as an argument to
the <tt class="user">ls</tt> command, thereby
getting the listing of of the <tt class="user">cp</tt> program without having to know its full pathname. We are
not limited to just simple commands. Entire pipelines can be used (only partial output
shown):</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">file $(ls /usr/bin/* | grep bin/zip)</tt><br>
<tt class="prompt"><pre>/usr/bin/bunzip2:
/usr/bin/zip:      ELF 32-bit LSB executable, Intel 80386, version 1 
(SYSV), dynamically linked (uses shared libs), for GNU/Linux 2.6.15, stripped
/usr/bin/zipcloak: ELF 32-bit LSB executable, Intel 80386, version 1
(SYSV), dynamically linked (uses shared libs), for GNU/Linux 2.6.15, stripped
/usr/bin/zipgrep:  POSIX shell script text executable
/usr/bin/zipinfo:  ELF 32-bit LSB executable, Intel 80386, version 1
(SYSV), dynamically linked (uses shared libs), for GNU/Linux 2.6.15, stripped
/usr/bin/zipnote:  ELF 32-bit LSB executable, Intel 80386, version 1
(SYSV), dynamically linked (uses shared libs), for GNU/Linux 2.6.15, stripped
/usr/bin/zipsplit: ELF 32-bit LSB executable, Intel 80386, version 1
(SYSV), dynamically linked (uses shared libs), for GNU/Linux 2.6.15, stripped</pre></tt></p>
</div>

<p>In this example, the results of the pipeline became the argument list of the file
command.
There is an alternate syntax for command substitution in older shell programs which is
also supported in <tt class="user">bash</tt>. It uses back-quotes instead of the dollar sign and parentheses:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">ls -l `which cp`</tt><br>
<tt class="prompt">-rwxr-xr-x 1 root root 71516 2007-12-05 08:58 /bin/cp</tt></p>
</div>

<h2>Quoting</h2>

<p>Now that we've seen how many ways the shell can perform expansions, it's time to learn
how we can control it. Take for example:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo this is a&nbsp;&nbsp;&nbsp;&nbsp; test</tt><br>
<tt class="prompt">this is a test</tt></p>
</div>

<p>or:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">[me@linuxbox ~]$ echo The total is $100.00</tt><br>
<tt class="prompt">The total is 00.00</tt></p>
</div>

<p>In the first example, word-splitting by the shell removed extra whitespace from the echo
command's list of arguments. In the second example, parameter expansion substituted an
empty string for the value of “$1” because it was an undefined variable. The shell
provides a mechanism called quoting to selectively suppress unwanted expansions.</p>

<h2>Double Quotes</h2>

<p>The first type of quoting we will look at is double quotes. If you place text inside double
quotes, all the special characters used by the shell lose their special meaning and are
treated as ordinary characters. The exceptions are “$”, “\” (backslash), and “`” (back-
quote). This means that word-splitting, pathname expansion, tilde expansion, and brace
expansion are suppressed, but parameter expansion, arithmetic expansion, and command
substitution are still carried out. Using double quotes, we can cope with filenames
containing embedded spaces. Say you were the unfortunate victim of a file called
two words.txt. If you tried to use this on the command line, word-splitting would
cause this to be treated as two separate arguments rather than the desired single argument:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">ls -l two words.txt</tt><br>
<tt class="prompt"><pre>ls: cannot access two: No such file or directory
ls: cannot access words.txt: No such file or directory</pre></tt></p>
</div>

<p>By using double quotes, you can stop the word-splitting and get the desired result; further, you
can even repair the damage:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">ls -l "two words.txt"</tt><br>
<tt class="prompt">-rw-rw-r-- 1 me me 18 2008-02-20 13:03 two words.txt</tt><br>
<tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">mv "two words.txt" two_words.txt</tt></p>
</div>

<p>There! Now we don't have to keep typing those pesky double quotes.
Remember, parameter expansion, arithmetic expansion, and command substitution still
take place within double quotes:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo "$USER $((2+2)) $(cal)"</tt><br>
<tt class="prompt"><pre>me 4
February 2008
Su Mo Tu We Th Fr Sa
                1  2
 3  4  5  6  7  8  9
10 11 12 13 14 15 16
17 18 19 20 21 22 23
24 25 26 27 28 29</pre></tt></p>
</div>

<p>We should take a moment to look at the effect of double quotes on command substitution.
First let's look a little deeper at how word splitting works. In our earlier example, we saw
how word-splitting appears to remove extra spaces in our text:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo this is a &nbsp;&nbsp;&nbsp;&nbsp;test</tt><br>
<tt class="prompt">this is a test</tt></p>
</div>

<p>By default, word-splitting looks for the presence of spaces, tabs, and newlines (linefeed
characters) and treats them as delimiters between words. This means that unquoted
spaces, tabs, and newlines are not considered to be part of the text. They only serve as
separators. Since they separate the words into different arguments, our example
command line contains a command followed by four distinct arguments. If we add
double quotes:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo "this is a &nbsp;&nbsp;&nbsp;&nbsp;test"</tt><br>
<tt class="prompt">this is a &nbsp;&nbsp;&nbsp;&nbsp;test</tt></p>
</div>

<p>word-splitting is suppressed and the embedded spaces are not treated as delimiters, rather
they become part of the argument. Once the double quotes are added, our command line
contains a command followed by a single argument.
The fact that newlines are considered delimiters by the word-splitting mechanism causes
an interesting, albeit subtle, effect on command substitution. Consider the following:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo $(cal)</tt><br>
<tt class="prompt">February 2008 Su Mo Tu We Th Fr Sa 1 2 3 4 5 6 7 8 9 10 11 12 13 14
15 16 17 18 19 20 21 22 23 24 25 26 27 28 29</tt><br>
<tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd"> echo "$(cal)"</tt><br>
<tt class="prompt"><pre>February 2008
Su Mo Tu We Th Fr Sa
                1  2
 3  4  5  6  7  8  9
10 11 12 13 14 15 16
17 18 19 20 21 22 23
24 25 26 27 28 29
</pre></tt></p>
</div>

<p>In the first instance, the unquoted command substitution resulted in a command line
containing thirty-eight arguments. In the second, a command line with one argument that
includes the embedded spaces and newlines.</p>

<h2>Single Quotes</h2>

<p>If you need to suppress all expansions, you use single quotes. Here is a comparison of
unquoted, double quotes, and single quotes:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo text ~/*.txt {a,b} $(echo foo) $((2+2)) $USER</tt><br>
<tt class="prompt">text /home/me/ls-output.txt a b foo 4 me</tt><br>
<tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo "text ~/*.txt {a,b} $(echo foo) $((2+2)) $USER"</tt><br>
<tt class="prompt">text ~/*.txt {a,b} foo 4 me</tt><br>
<tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo 'text ~/*.txt {a,b} $(echo foo) $((2+2)) $USER'</tt><br>
<tt class="prompt">text ~/*.txt {a,b} $(echo foo) $((2+2)) $USER</tt></p>
</div>

<p>As you can see, with each succeeding level of quoting, more and more of the expansions
are suppressed.</p>

<h2>Escaping Characters</h2>

<p>Sometimes you only want to quote a single character. To do this, you can precede a
character with a backslash, which in this context is called the <i>escape character</i>. Often
this is done inside double quotes to selectively prevent an expansion:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">echo "The balance for user $USER is: \$5.00"</tt><br>
<tt class="prompt">The balance for user me is: $5.00</tt></p>
</div>

<p>It is also common to use escaping to eliminate the special meaning of a character in a
filename. For example, it is possible to use characters in filenames that normally have
special meaning to the shell. These would include “$”, “!”, “&”, “ “, and others. To
include a special character in a filename you can to this:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt class="cmd">mv bad\&filename good_filename</tt></p>
</div>

<p>To allow a backslash character to appear, escape it by typing “\\”. Note that within single
quotes, the backslash loses its special meaning and is treated as an ordinary character.</p>

<h2>More Backslash Tricks</h2>

<p>If you look at the <tt class="user">man</tt>
pages for any program written by the <a href=
"http://www.gnu.org">GNU project</a>, you will
notice that in addition to command line options
consisting of a dash and a single letter, there are
also long option names that begin with two dashes.
For example, the following are equivalent:</p>

<div class="codeexample">
<pre>
<tt>ls -r
ls --reverse
       </tt>
</pre>
</div>

<p>Why do they support both? The short form is for
lazy typists on the command line and the long form
is mostly for scripts though some options may only be long form.
I sometimes use obscure options, and
I find the long form useful if I have to review a
script again months after I wrote it. Seeing the
long form helps me understand what the option does,
saving me a trip to the <tt class="user">man</tt>
page. A little more typing now, a lot less work
later. Laziness is maintained.</p>

<p>As you might suspect, using the long form
options can make a single command line very long.
To combat this problem, you can use a backslash to
get the shell to ignore a newline character like
this:</p>

<div class="codeexample">
<pre>
<tt>ls -l \
   --reverse \
   --human-readable \
   --full-time
       </tt>
</pre>
</div>

<p>Using the backslash in this way allows us to
embed newlines in our command. Note that for this
trick to work, the newline must be typed
immediately after the backslash. If you put a space
after the backslash, the space will be ignored, not
the newline. Backslashes are also used to insert
special characters into our text. These are called
<i>backslash escape characters</i>. Here are the
common ones:<br>
<br>
</p>

<table cellpadding="8" border>
	<tr>
		<td valign="top">
		<p><strong>Escape Character</strong></p>
		</td>

		<td valign="top">
		<p><strong>Name</strong></p>
		</td>

		<td valign="top">
		<p><strong>Possible Uses</strong></p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>\n</p>
		</td>

		<td valign="top">
		<p>newline</p>
		</td>

		<td valign="top">
		<p>Adding blank lines to text</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>\t</p>
		</td>

		<td valign="top">
		<p>tab</p>
		</td>

		<td valign="top">
		<p>Inserting horizontal tabs to text</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>\a</p>
		</td>

		<td valign="top">
		<p>alert</p>
		</td>

		<td valign="top">
		<p>Makes your terminal beep</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>\\</p>
		</td>

		<td valign="top">
		<p>backslash</p>
		</td>

		<td valign="top">
		<p>Inserts a backslash</p>
		</td>
	</tr>

	<tr>
		<td valign="top">
		<p>\f</p>
		</td>

		<td valign="top">
		<p>formfeed</p>
		</td>

		<td valign="top">
		<p>Sending this to your printer ejects the
		page</p>
		</td>
	</tr>
</table>

<p>The use of the backslash escape characters is
very common. This idea first appeared in the C
programming language. Today, the shell, C++, perl,
python, awk, tcl, and many other programming
languages use this concept. Using the <tt class=
"user">echo</tt> command with the -e option will
allow us to demonstrate:</p>

<div class="display">
<p><tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">echo -e "Inserting several blank
lines\n\n\n"</tt><br>
<tt class="prompt">Inserting several blank lines</tt><br>
<br>
<br>
<br>
<tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">echo -e
"Words\tseparated\tby\thorizontal\ttabs."</tt><br>
</p>
<pre>
<tt class="prompt">Words separated   by  horizontal  tabs</tt>
</pre>
<tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">echo -e "\aMy computer went
\"beep\"."</tt><br>
<br>
<tt class="prompt">My computer went
"beep".</tt><br>
<br>
<tt class="prompt">[me@linuxbox me]$</tt> <tt
class="cmd">echo -e "DEL
C:\\WIN2K\\LEGACY_OS.EXE"</tt><br>
<br>
<tt class="prompt">DEL C:\WIN2K\LEGACY_OS.EXE</tt>
</div>


		<div class="pagenav">
			<p class="right"><a
			href="lc3_lts0070.php">Previous</a> | <a
			href="lc3_learning_the_shell.php#contents">Contents</a> | <a
			href="#top">Top</a> | <a
			href="lc3_lts0090.php">Next</a></p>
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