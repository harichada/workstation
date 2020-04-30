



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: AWK</title>
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
<h1 id="awk">AWK</h1>
<p>One of the great things we can do in the shell is embed other programming languages within the body of our scripts. We have seen hints of this with the stream editor <code>sed</code>, and the arbitrary precision calculator program <code>bc</code>. By using the shell's single quoting mechanism to isolate text from shell expansion, we can freely express other programming languages, provided we have a suitable language interpreter to execute them.</p>
<p>In this adventure, we are going to look at one such program, <code>awk</code>.</p>
<h2 id="history">History</h2>
<p>The AWK programming language is truly one of the classic tools used in Unix. It dates back to the very earliest days of the Unix tradition. It was originally developed in the late 1970's at Bell Telephone Laboratories by Alfred Aho, Peter Weinberger, and Brian Kernighan. The name &quot;AWK&quot; comes from the last names of the three authors. It underwent major improvements in 1985 with the release of <code>nawk</code> or &quot;new awk.&quot; It is that version that we still use today, though it is usually just called <code>awk</code>.</p>
<h2 id="availability">Availability</h2>
<p><code>awk</code> is a standard program found in most every Linux distribution. Two free/open source versions of the program are in common use. One is called <code>mawk</code> (short for Mike's awk, named for its original author, Mike Brennan) and <code>gawk</code> (GNU awk). Both versions fully implement the 1985 <code>nawk</code> standard as well as add a variety of extensions. For our purposes, either version is fine, since we will be focusing on the traditional <code>nawk</code> features. In most distributions, the name <code>awk</code> is symbolically linked to either <code>mawk</code> or <code>gawk</code>.</p>
<h2 id="so-whats-it-good-for">So, What's It Good For?</h2>
<p>Though AWK is fairly general purpose, it is really designed to create <em>filters</em>, that is, programs that accept standard input, transform data, and send it to standard output. In particular, AWK is very good at processing <em>columnar data</em>. This makes it a good choice for developing report generators, and tools that are used to re-format data. Since it has strong regular expression support, it's good for very small text extraction and reformatting problems, too. Like <code>sed</code>, many AWK programs are just one line long.</p>
<p>In recent years, AWK has fallen out of fashion, being supplanted by other, newer, interpreted languages such as <em>Perl</em> and <em>python</em>, but AWK still has some advantages:</p>
<ul>
<li><p>It's easy to learn. The language is not overly complex and has a syntax much like the C programming language, so learning it will be useful in the future when we study other languages and tools.</p></li>
<li><p>It really excels at a solving certain types of problems.</p></li>
</ul>
<h2 id="how-it-works">How It Works</h2>
<p>The structure of an AWK program is somewhat unique among programming languages. Programs consist of a series of one or more <em>pattern</em> and <em>action</em> pairs. Before we get into that though, let's look at what the typical AWK program does.</p>
<p>We already know that the typical AWK program acts as a filter. It reads data from standard input, and outputs filtered data on standard output. It reads data one <em>record</em> at a time. By default, a record is a line of text terminated by a newline character. Each time a record is read, AWK automatically separates the record into <em>fields</em>. Fields are, again by default, separated by whitespace. Each field is assigned to a variable, which is given a numeric name. Variable $1 is the first field, $2 is the second field, and so on. $0 signifies the entire record. In addition, a variable named NF is set containing the number of fields detected in the record.</p>
<p>Pattern/action pairs are tests and corresponding actions to be performed on each record. If the pattern is true, then the action is performed. When the list of patterns is exhausted, the AWK program reads the next record and the process is repeated.</p>
<p>Let's try a really simple case. We'll filter the output of an <code>ls</code> command:</p>
<p><code>me@linuxbox ~ $ ls -l /usr/bin | awk '{print $0}'</code></p>
<p>The AWK program is contained within the single quotes following the <code>awk</code> command. Single quotes are important because we do not want the the shell to attempt any expansion on the AWK program, since its syntax has nothing to do with the shell. For example, <code>$0</code> represents the value of the entire record the AWK program read on standard input. In AWK, the <code>$</code> means &quot;field&quot; and is not a trigger for parameter expansion as it is in the shell.</p>
<p>Our example program consists of a single action with no pattern present. This is allowed and it means that every record matches the pattern. When we run this command, it simply outputs every line of input much like the <code>cat</code> command.</p>
<p>If we look at a typical line of output from <code>ls -l</code>, we see that it consists of 9 fields, each separated from its neighbor by one or more whitespace characters:</p>
<p><code>-rwxr-xr-x 1 root root         265 Apr 17  2012 zxpdf</code></p>
<p>Let's add a pattern to our program so it will only print lines with more than 9 fields:</p>
<p><code>me@linuxbox ~ $ ls -l /usr/bin | awk 'NF &gt; 9 {print $0}'</code></p>
<p>We now see a list of symbolic links in <code>/usr/bin</code> since those directory listings contain more than 9 fields. This pattern will also match entries with file names containing embedded spaces, since they too will have more than 9 fields.</p>
<h3 id="special-patterns">Special Patterns</h3>
<p>Patterns in AWK can have many forms. There are conditional expressions like we have just seen. There are also regular expressions, as we would expect. There are two special patterns called BEGIN and END. The BEGIN pattern carries out its corresponding action before the first record is read. This is useful for initializing variables, or printing headers at the beginning of output. Likewise, the END pattern performs its corresponding action after the last record is read from the input file. This is good for outputting summaries once the input has been processed.</p>
<p>Let's try a more elaborate example. We'll assume for the moment that the directory does not contain any file names with embedded spaces (though this is <em>never</em> a safe assumption). We could use the following script to list symbolic links:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>

<span class="co"># Print a directory report</span>

<span class="kw">ls</span> -l /usr/bin <span class="kw">|</span> <span class="kw">awk</span> <span class="st">&#39;</span>
<span class="st">    BEGIN {</span>
<span class="st">        print &quot;Directory Report&quot;</span>
<span class="st">        print &quot;================&quot;</span>
<span class="st">    }</span>

<span class="st">    NF &gt; 9 {</span>
<span class="st">        print $9, &quot;is a symbolic link to&quot;, $NF</span>
<span class="st">    }</span>

<span class="st">    END {</span>
<span class="st">        print &quot;=============&quot;</span>
<span class="st">        print &quot;End Of Report&quot;</span>
<span class="st">    }</span>

<span class="st">&#39;</span></code></pre>
<p>In this example, we have 3 pattern/action pairs in our AWK program. The first is a BEGIN pattern and its action that prints the report header. We can spread the action over several lines, though the opening brace &quot;{&quot; of the action must appear on the same line as the pattern.</p>
<p>The second pattern tests the current record to see if it contains more than 9 fields and, if true, the 9th field is printed, followed by some text and the final field in the record. Notice how this was done. The NF variable is preceded by a &quot;$&quot;, thus it refers to the NFth field rather than the value of NF itself.</p>
<p>Lastly, we have an END pattern. Its corresponding action prints the &quot;End Of Report&quot; message once all of the lines of input have been read.</p>
<h2 id="invocation">Invocation</h2>
<p>There are three ways we can run an AWK program. We have already seen how to embed a program in a shell script by enclosing it inside single quotes. The second way is to place the awk script in its own file and call it from the the <code>awk</code> program like so:</p>
<p><code>awk -f program_file</code></p>
<p>Lastly, we can use the <em>shebang</em> mechanism to make the AWK script a standalone program like a shell script:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="co">#!/usr/bin/awk -f</span>

<span class="co"># Print a directory report</span>

<span class="st">BEGIN</span> <span class="kw">{</span>
    <span class="kw">print</span> <span class="st">&quot;Directory Report&quot;</span>
    <span class="kw">print</span> <span class="st">&quot;================&quot;</span>
<span class="kw">}</span>

<span class="dt">NF</span> &gt; <span class="dv">9</span> <span class="kw">{</span>
    <span class="kw">print</span> <span class="ot">$9</span>, <span class="st">&quot;is a symbolic link to&quot;</span>, <span class="ot">$NF</span>
<span class="kw">}</span>

<span class="st">END</span> <span class="kw">{</span>
    <span class="kw">print</span> <span class="st">&quot;=============&quot;</span>
    <span class="kw">print</span> <span class="st">&quot;End Of Report&quot;</span>
<span class="kw">}</span></code></pre>
<h2 id="the-language">The Language</h2>
<p>Let's take a look at the features and syntax of AWK programs.</p>
<h3 id="program-format">Program Format</h3>
<p>The formatting rules for AWK programs are pretty simple. Actions consist of one or more statements surrounded by braces ({}) with the starting brace appearing on the same line as the pattern. Blank lines are ignored. Comments begin with a pound sign (#) and may appear at the end of any line. Long statements may be broken into multiple lines using line continuation characters (a backslash followed immediately by a newline). Lists of parameters separated by commas may be broken after any comma. Here is an example:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="st">BEGIN</span> <span class="kw">{</span> <span class="co"># The action&#39;s opening brace must be on same line as the pattern</span>

  <span class="co"># Blank lines are ignored</span>

  <span class="co"># Line continuation characters can be used to break long lines</span>
  <span class="kw">print</span> \
    <span class="ot">$1</span>, <span class="co"># Parameter lists may be broken by commas</span>
    <span class="ot">$2</span>, <span class="co"># Comments can appear at the end of any line</span>
    <span class="ot">$3</span>

  <span class="co"># Multiple statements can appear on one line if separated by</span>
  <span class="co"># a semicolon</span>
  <span class="kw">print</span> <span class="st">&quot;String 1&quot;</span>; <span class="kw">print</span> <span class="st">&quot;String 2&quot;</span>

<span class="kw">}</span> <span class="co"># Closing brace for action</span></code></pre>
<h3 id="patterns">Patterns</h3>
<p>Here are the most common types of patterns used in AWK:</p>
<h4 id="begin-and-end">BEGIN and END</h4>
<p>As we saw earlier, the BEGIN and END patterns perform actions before the first record is read and after the last record is read, respectively.</p>
<h4 id="relational-expression">relational-expression</h4>
<p>Relational expressions are used to test values. For example, we can test for equivalence:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="ot">$1</span> == <span class="st">&quot;Fedora&quot;</span></code></pre>
<p>or for relations such as:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="ot">$3</span> &gt;= <span class="dv">50</span></code></pre>
<p>It is also possible to perform calculations like:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="ot">$1</span> * <span class="ot">$2</span> &lt; <span class="dv">100</span></code></pre>
<h4 id="regular-expression">/regular-expression/</h4>
<p>AWK supports extended regular expressions like those supported by <code>egrep</code>. Patterns using regular expression can be expressed in two ways. First, we can enclose a regular expression in slashes and a match is attempted on the entire record. If a finer level of control is needed, we can provide an expression containing the string to be matched using the following syntax:</p>
<p>expression ~ /regexp/</p>
<p>For example, if we only wanted to attempt a match on the third field in a record, we could to this:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="ot">$3</span> ~ /^[<span class="dv">567</span>]/</code></pre>
<p>From this, we can think of the &quot;~&quot; as meaning &quot;matches&quot; or &quot;contains&quot;, thus we can read the pattern above as &quot;field 3 matches the regular expression <code>^[567]</code>&quot;.</p>
<h4 id="pattern-logical-operator-pattern">pattern logical-operator pattern</h4>
<p>It is possible to combine patterns together using the logical operators || and &amp;&amp;, meaning OR and AND, respectively. For example, if we want to test a record to see if the first field is a number greater than 100 and the last field is the word &quot;Debit&quot;, we can do this:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="ot">$1</span> &gt; <span class="dv">100</span> &amp;&amp; <span class="ot">$NF</span> == <span class="st">&quot;Debit&quot;</span></code></pre>
<h4 id="pattern">! pattern</h4>
<p>It is also possible to negate a pattern, so that only records that do not match a specified pattern are selected.</p>
<h4 id="pattern-pattern">pattern, pattern</h4>
<p>Two patterns separated by a comma is called a <em>range pattern</em>. With it, once the first pattern is matched, every subsequent record matches until the second pattern is matched. Thus, this type of pattern will select a range of records. Let's imagine that we have a list of records and that the first field in each record contains a sequential record number:</p>
<pre><code>0001    field   field   field
0002    field   field   field
0003    field   field   field</code></pre>
<p>and so on. And let's say that we want to extract records 0050 through 0100, inclusive. To do so, we could use a range pattern like this:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="ot">$1</span> == <span class="st">&quot;0050&quot;</span>, <span class="ot">$1</span> == <span class="st">&quot;0100&quot;</span></code></pre>
<h3 id="fields-and-records">Fields And Records</h3>
<p>The AWK language is so useful because of its ability to automatically separate fields and records. While the default is to separate records by newlines and fields by whitespace, this can be adjusted. The <code>/etc/passwrd</code> file, for example, does not separate its fields with whitespace; rather, it uses colons (:). AWK has a built in variable named FS (field separator) that defines the delimiter separating fields in a record. Here is an AWK program that will list the user ID and the user's name from the file:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="st">BEGIN</span> <span class="kw">{</span> <span class="dt">FS</span> = <span class="st">&quot;:&quot;</span> <span class="kw">}</span>
<span class="kw">{</span> <span class="kw">print</span> <span class="ot">$1</span>, <span class="ot">$5</span> <span class="kw">}</span></code></pre>
<p>This program has two pattern/action pairs. The first action is performed before the first record is read and sets the input field separator to be the colon character.</p>
<p>The second pair contains only an action and no pattern. This will match every record. The action prints the first and fifth fields from each record.</p>
<p>The FS variable may contain a regular expression, so really powerful methods can be used to separate fields.</p>
<p>Records are normally separated by newlines, but this can be adjusted too. The built-in variable RS (record separator) defines how records are delimited. A common type of record consists of multiple lines of data separated by one or more blank lines. AWK has a shortcut for specifying the record separator in this case. We just define RS to be an empty string:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="dt">RS</span> = <span class="st">&quot;&quot;</span></code></pre>
<p>Note that when this is done, newlines, in addition to any other specified characters, will always be treated as field separators regardless of how the FS variable is set. When we process multi-line records, we will often want to treat each line as a separate field, so doing this is often desirable:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="st">BEGIN</span> <span class="kw">{</span> <span class="dt">FS</span> = <span class="st">&quot;\n&quot;</span>; <span class="dt">RS</span> = <span class="st">&quot;&quot;</span> <span class="kw">}</span></code></pre>
<h3 id="variables-and-data-types">Variables and Data Types</h3>
<p>AWK treats data as either a string or a number, depending on its context. This can sometimes become an issue with numbers. AWK will often treat numbers as strings unless something specifically &quot;numeric&quot; is done with them.</p>
<p>We can force AWK to treat a string of digits as a number by performing some arithmetic on it. This is most easily done by adding zero to the number:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">n = <span class="dv">105</span> + <span class="dv">0</span></code></pre>
<p>Likewise, we can get AWK to treat a string of digits as a string by concatenating an empty string:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">s = <span class="dv">105</span> <span class="st">&quot;&quot;</span></code></pre>
<p>String concatenation in AWK is performed using a space character as an operator - an unusual feature of the language.</p>
<p>Variables are created as they are encountered (no prior declaration is required), just like the shell. Variable names in AWK follow the same rules as the shell. Names may consist of letters, numbers, and underscore characters. Like the shell, the first character of a variable name must not be a number. Variable names are case sensitive.</p>
<h3 id="built-in-variables">Built-in Variables</h3>
<p>We have already looked at a few of AWK's built-in variables. Here is a list of the most useful ones:</p>
<h4 id="fs---field-separator">FS - Field separator</h4>
<p>This variable contains a regular expression that is used to separate a record into fields. Its initial value separates fields with whitespace. AWK supports a shortcut to return this variable to its original value:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="dt">FS</span> = <span class="st">&quot; &quot;</span></code></pre>
<p>The value of FS can also be set using the -F option on the command line. For example, we can quickly extract the user name and UID fields from the <code>/etc/passwd</code> file like this:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">awk -F: &#39;<span class="kw">{print</span> <span class="ot">$1</span>, <span class="ot">$3</span><span class="kw">}</span>&#39; /etc/passwd</code></pre>
<h4 id="nf---number-of-fields">NF - Number of fields</h4>
<p>This variable updates each time a record is read. We can easily access the last field in the record by referring to $NF.</p>
<h4 id="nr---record-number">NR - Record number</h4>
<p>This variable increments each time a record is read, thus it contains the total number of records read from the input stream. Using this variable, we could easily simulate a <code>wc -l</code> command with:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">awk &#39;<span class="st">END</span> <span class="kw">{print</span> <span class="dt">NR</span><span class="kw">}</span>&#39;</code></pre>
<p>or number the lines in a file with:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">awk &#39;<span class="kw">{print</span> <span class="dt">NR</span>, <span class="ot">$0</span><span class="kw">}</span>&#39;</code></pre>
<h4 id="ofs---output-field-separator">OFS - Output field separator</h4>
<p>This string is used to separate fields when printing output. The default is a single space. Setting this can be handy when reformatting data. For example, we could easily change a table of values to a CSV (comma separated values) file by setting OFS to equal &quot;,&quot;. To demonstrate, here is a program that reads our directory listing and outputs a CSV stream:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l | awk &#39;<span class="st">BEGIN</span> <span class="kw">{</span><span class="dt">OFS</span> = <span class="st">&quot;,&quot;</span><span class="kw">}</span>
<span class="dt">NF</span> == <span class="dv">9</span> <span class="kw">{print</span> <span class="ot">$1</span>,<span class="ot">$2</span>,<span class="ot">$3</span>,<span class="ot">$4</span>,<span class="ot">$5</span>,<span class="ot">$6</span>,<span class="ot">$7</span>,<span class="ot">$8</span>,<span class="ot">$9</span><span class="kw">}</span>&#39;</code></pre>
<p>We set the pattern to only match input lines containing 9 fields. This eliminates symbolic links and other weird file names from the data to be processed.</p>
<p>Each line of the resulting output would resemble this:</p>
<p><code>-rwxr-xr-x,1,root,root,100984,Jan,11,2015,a2p</code></p>
<p>If we had omitted setting OFS, the print statement would use the default value (a single space):</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l | awk &#39;NF == <span class="dv">9</span> <span class="kw">{print</span> <span class="ot">$1</span>,<span class="ot">$2</span>,<span class="ot">$3</span>,<span class="ot">$4</span>,<span class="ot">$5</span>,<span class="ot">$6</span>,<span class="ot">$7</span>,<span class="ot">$8</span>,<span class="ot">$9</span><span class="kw">}</span>&#39;</code></pre>
<p>Which would result in each line of output resembling this:</p>
<p><code>-rwxr-xr-x 1 root root 100984 Jan 11 2015 a2p</code></p>
<h4 id="ors---output-record-separator">ORS - Output record separator</h4>
<p>This is the string used to separate records when printing output. The default is a newline character. We could use this variable to easily double-space a file by setting ORS to equal two newlines:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l | awk &#39;<span class="st">BEGIN</span> <span class="kw">{</span><span class="dt">ORS</span> = <span class="st">&quot;\n\n&quot;</span><span class="kw">}</span> <span class="kw">{print}</span>&#39;</code></pre>
<h4 id="rs---record-separator">RS - Record separator</h4>
<p>When reading input, AWK interprets this string as the end of record marker. The default value is a newline.</p>
<h4 id="filename">FILENAME</h4>
<p>If AWK is reading its input from a file specified on the command line, then this variable contains the name of the file.</p>
<h4 id="fnr---file-record-number">FNR - File record number</h4>
<p>When reading input from a file specified on the command line, AWK sets this variable to the number of the record read from that file.</p>
<h3 id="arrays">Arrays</h3>
<p>Single-dimensional arrays are supported in AWK. Data contained in array elements may be either numbers or strings. Array indexes may also be either strings (for <em>associative arrays</em>) or numbers.</p>
<p>Assigning values to array elements is done like this:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">a[<span class="dv">1</span>] = <span class="dv">5</span>        <span class="co"># Numeric index</span>
a[<span class="st">&quot;five&quot;</span>] = <span class="dv">5</span>   <span class="co"># String index</span></code></pre>
<p>Though AWK only supports single dimension arrays (like bash), it also provides a mechanism to simulate multi-dimensional arrays. When assigning an array index, it is possible to use this form to represent more than one dimension:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">a[j,k] = <span class="st">&quot;foo&quot;</span></code></pre>
<p>When AWK sees this construct, it builds an index consisting of the strings <code>j</code> and <code>k</code> separated by the contents of the built-in variable SUBSEP. By default, SUBSEP is set to &quot;\034&quot; (character 34 octal, 28 decimal). This ASCII control code is fairly obscure and thus unlikely to appear in ordinary text, so it's pretty safe for AWK to use.</p>
<p>Note that both <code>mawk</code> and <code>gawk</code> implement language extensions to support multi-dimensional arrays in a more formal way. Consult their respective documentation for details. If a portable method is needed, use the method above rather than the implementation-specific way.</p>
<p>We can delete arrays and array elements this way:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">delete a[i]     <span class="co"># delete a single element</span>
delete a        <span class="co"># delete array</span></code></pre>
<h3 id="arithmetic-and-logical-expressions">Arithmetic and Logical Expressions</h3>
<p>AWK supports a pretty complete set of arithmetic and logical operators:</p>
<table>
<thead>
<tr class="header">
<th align="left">Operators</th>
<th align="left"></th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left">Assignment</td>
<td align="left"><code>=  +=  -=  *=  /=  %=  ^=  ++  --</code></td>
</tr>
<tr class="even">
<td align="left">Relational</td>
<td align="left"><code>&lt;  &gt;   &lt;=  &gt;=  ==  !=</code></td>
</tr>
<tr class="odd">
<td align="left">Arithmetic</td>
<td align="left"><code>+  -   *   /   %   ^</code></td>
</tr>
<tr class="even">
<td align="left">Matching</td>
<td align="left"><code>~  !~</code></td>
</tr>
<tr class="odd">
<td align="left">Array</td>
<td align="left"><code>in</code></td>
</tr>
<tr class="even">
<td align="left">Logical</td>
<td align="left"><code>||  &amp;&amp;</code></td>
</tr>
</tbody>
</table>
<p>These operators behave like those in the shell; however, unlike the shell, which is limited to integer arithmetic, AWK arithmetic is floating point. This makes AWK a good way to do more complex arithmatic than the shell alone.</p>
<p>Arithmetic and logical expressions can be used in both patterns and actions. Here's an example that counts the number of lines containing exactly 9 fields:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l /usr/bin | awk &#39;NF == <span class="dv">9</span> <span class="kw">{</span>count++<span class="kw">}</span> <span class="st">END</span> <span class="kw">{print</span> count<span class="kw">}</span>&#39;</code></pre>
<p>This AWK program consists of 2 pattern/action pairs. The first one matches lines where the number of fields is equal to 9. The action creates and increments a variable named <code>count</code>. Each time a line with exactly 9 fields is encountered in the input stream, <code>count</code> is incremented by 1.</p>
<p>The second pair matches when the end of the input stream is reached and the resulting action prints the final value of <code>count</code>.</p>
<p>Using this basic form, let's try something a little more useful; a program that calculates the total size of the files in the list:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l /usr/bin | awk &#39;NF &gt;=<span class="dv">9</span> <span class="kw">{</span>total += <span class="ot">$5</span><span class="kw">}</span> <span class="st">END</span> <span class="kw">{print</span> total<span class="kw">}</span>&#39;</code></pre>
<p>Here is a slight variation (with shortened variable names to make it a little more concise) that calculates the average size of the files:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l /usr/bin | awk &#39;NF &gt;=<span class="dv">9</span> <span class="kw">{</span>c++; t += <span class="ot">$5</span><span class="kw">}</span> <span class="st">END</span> <span class="kw">{print</span> t / c<span class="kw">}</span>&#39;</code></pre>
<h3 id="flow-control">Flow Control</h3>
<p>AWK has many of the same flow control statements that we've seen previously in the shell (with the notable exception of case, though we can think of an AWK program as one big case statement inside a loop) but the syntax more closely resembles that of the C programming language. Actions in AWK often contain complex logic consisting of various statements and flow control instructions. A statement in this context can be a simple statement like:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">a = a + <span class="dv">1</span></code></pre>
<p>Or a compound statement enclosed in braces such as:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="kw">{</span>a = a + <span class="dv">1</span>; b = b * a<span class="kw">}</span></code></pre>
<h4 id="if-expression-statement-if-expression-statement-else-statement">if ( <em>expression</em> ) <em>statement</em><br >if ( <em>expression</em> ) <em>statement</em> else <em>statement</em></h4>
<p>The <em>if/then/else</em> construct in AWK behaves the way we would expect. AWK evaluates an expression in parenthesis and if the result is non-zero, the statement is carried out. We can see this behavior by executing the following commands:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">awk &#39;<span class="st">BEGIN</span> <span class="kw">{if</span> (<span class="dv">1</span>) <span class="kw">print</span> <span class="st">&quot;true&quot;</span>; <span class="kw">else</span> <span class="kw">print</span> <span class="st">&quot;false&quot;</span><span class="kw">}</span>&#39;
awk &#39;<span class="st">BEGIN</span> <span class="kw">{if</span> (<span class="dv">0</span>) <span class="kw">print</span> <span class="st">&quot;true&quot;</span>; <span class="kw">else</span> <span class="kw">print</span> <span class="st">&quot;false&quot;</span><span class="kw">}</span>&#39;</code></pre>
<p>Relational expressions such as <code>(a &lt; b</code>) will also evaluate to 0 or 1.</p>
<p>In the example below, we construct a primitive report generator that counts the number of lines that have been output and, if the number exceeds the length of a page, a formfeed character is output and the line counter is reset:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l /usr/bin | awk &#39;
<span class="st">BEGIN</span> <span class="kw">{</span>
    line_count = <span class="dv">0</span>
    page_length = <span class="dv">60</span>
<span class="kw">}</span>

<span class="kw">{</span>
    line_count++
    <span class="kw">if</span> (line_count &lt; page_length)
        <span class="kw">print</span>
    <span class="kw">else</span> <span class="kw">{</span>
        <span class="kw">print</span> <span class="st">&quot;\f&quot;</span> <span class="ot">$0</span>
        line_count = <span class="dv">0</span>
    <span class="kw">}</span>
<span class="kw">}</span>
&#39;</code></pre>
<p>While the above might be the most obvious way to code this, our knowledge of how evaluations are actually performed, allows us to code this example in a slightly more concise way by using some arithmetic:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l /usr/bin | awk &#39;
<span class="st">BEGIN</span> <span class="kw">{</span>
    page_length = <span class="dv">60</span>
<span class="kw">}</span>

<span class="kw">{</span>
    <span class="kw">if</span> (<span class="dt">NR</span> % page_length)
        <span class="kw">print</span>
    <span class="kw">else</span>
        <span class="kw">print</span> <span class="st">&quot;\f&quot;</span> <span class="ot">$0</span>
<span class="kw">}</span>
&#39;</code></pre>
<p>Here we exploit the fact that the page boundaries will always fall on even multiples of the page length. If <code>page_length</code> equals 60 then the page boundaries will fall on lines 60, 120, 180, 240, and so on. All we have to do is calculate the remainder (modulo) on the number of lines processed in the input stream (<code>NR</code>) divided by the page length and see if the result is zero, and thus an even multiple.</p>
<p>AWK supports an expression that's useful for testing membership in an array:</p>
<p><code>(var in array)</code></p>
<p>where <em>var</em> is an index value and <em>array</em> is an array variable. Using this expression tests if the index <em>var</em> exists in the specified array. This method of testing for array membership avoids the problem of inadvertently creating the index by testing it with methods such as:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="kw">if</span> (array[var] != <span class="st">&quot;&quot;</span>)</code></pre>
<p>When the test is attempted this way, the array element <code>var</code> is created, since AWK creates variables simply by their use. When the <code>(var in array)</code> form is used, no variable is created.</p>
<p>To test for array membership in a multi-dimensional array, the following syntax is used:</p>
<p><code>((var1,var2) in array)</code></p>
<h4 id="for-expression-expression-expression-statement">for ( <em>expression</em> ; <em>expression</em> ; <em>expression</em> ) <em>statement</em></h4>
<p>The <em>for</em> loop in AWK closely resembles the corresponding one in the C programming language. It is comprised of 3 expressions. The first expression is usually used to initialize a counter variable, the second defines when the loop is completed, and the third defines how the loop is incremented or advanced at each iteration. Here is a demonstration using a for loop to print fields in reverse order:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l | awk &#39;<span class="kw">{</span>s = <span class="st">&quot;&quot;</span>; <span class="kw">for</span> (i = <span class="dt">NF</span>; i &gt; <span class="dv">0</span>; i--) s = s <span class="ot">$i</span> <span class="dt">OFS</span>; <span class="kw">print</span> s<span class="kw">}</span>&#39;</code></pre>
<p>In this example we create an empty string named <code>s</code>, then begin a loop that starts with the number of fields in the current input line (<code>i = NF</code>) and counts down (<code>i--</code>) until we reach the first field (<code>i &gt; 0</code>). Each iteration of the loop causes the current field and the output field separator to be concatenated to the string <code>s</code> (<code>s  = s $i OFS</code>). After the loop concludes, we print the resulting value of string <code>s</code>.</p>
<h4 id="for-var-in-array-statement">for ( <em>var</em> in <em>array</em> ) <em>statement</em></h4>
<p>AWK has a special flow control statement for traversing the indexes of an array. Here is an example of what it does:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">awk &#39;<span class="st">BEGIN</span> <span class="kw">{for</span> (i=<span class="dv">0</span>; i&lt;<span class="dv">10</span>; i++) a[i]=<span class="st">&quot;foo&quot;</span>; <span class="kw">for</span> (i <span class="kw">in</span> a) <span class="kw">print</span> i<span class="kw">}</span>&#39;</code></pre>
<p>In this program, we have a single BEGIN pattern/action that performs the entire exercise without the need for an input stream. We first create an array <code>a</code> and add 10 elements, each containing the string &quot;foo&quot;. Next, we use <code>for (i in a)</code> to loop through all the indexes in the array and print each index. It is important to note that the order of the arrays in memory is <em>implementation dependent</em>, meaning that it could be anything, so we cannot rely on the results being in any particular order. We'll look at how to address this problem a little later.</p>
<p>Even without sorted order, this type of loop is useful if we need to process every element in an array. For example, we could delete every element of an array like this:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="kw">for</span> (i <span class="kw">in</span> a) delete a[i]</code></pre>
<h4 id="while-expression-statement-do-statement-while-expression">while ( <em>expression</em> ) <em>statement</em><br >do <em>statement</em> while ( <em>expression</em> )</h4>
<p>The <em>while</em> and <em>do</em> loops in AWK are pretty straightforward. We determine a condition that must be maintained for the loop to continue. We can demonstrate this using our field reversal program (we'll type it out in multiple lines to make the logic easier to follow):</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l | awk &#39;<span class="kw">{</span>
    s = <span class="st">&quot;&quot;</span>
    i = <span class="dt">NF</span>
    <span class="kw">while</span> (i &gt; <span class="dv">0</span>) <span class="kw">{</span>
        s = s <span class="ot">$i</span> <span class="dt">OFS</span>
        i--
    <span class="kw">}</span>
    <span class="kw">print</span> s
<span class="kw">}</span>&#39;</code></pre>
<p>The do loop is similar to the while loop; however the do loop will always execute its statement at least once, whereas the while loop will only execute its statement if the initial condition is met.</p>
<h4 id="break-continue-next">break<br >continue<br >next</h4>
<p>The <code>break</code>, <code>continue</code>, and <code>next</code> keywords are used to &quot;escape&quot; from loops. <code>break</code> and <code>continue</code> behave like their corresponding commands in the shell. <code>continue</code> tells AWK to stop and continue with the next iteration of the current loop. <code>brea</code>k tells AWK to exit the current loop entirely. The <code>next</code> keyword tells AWK to skip the remainder of the current program and begin processing the next record of input.</p>
<h4 id="exit-expression">exit <em>expression</em></h4>
<p>As with the shell, we can tell AWK to exit and provide an optional expression that sets AWK's exit status.</p>
<h3 id="regular-expressions">Regular Expressions</h3>
<p>Regular expressions in AWK work like those in <code>egrep</code>, a topic we covered in chapter 19 of TLCL. It is important to note that back references are not supported and that some versions of AWK (most notably mawk versions prior to 1.3.4) do not support POSIX character classes.</p>
<p>Regular expressions are most often used in patterns, but they are also used in some of the built-in variables such as FS and RS, and they have various roles in the string functions which we will discuss shortly.</p>
<p>Let's try using some simple regular expressions to tally the different file types in our directory listing (we'll make clever use of an associative array too).</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l /usr/bin | awk &#39;
<span class="ot">$1</span> ~ /^-/ <span class="kw">{</span>t[<span class="st">&quot;Regular Files&quot;</span>]++<span class="kw">}</span>
<span class="ot">$1</span> ~ /^d/ <span class="kw">{</span>t[<span class="st">&quot;Directories&quot;</span>]++<span class="kw">}</span>
<span class="ot">$1</span> ~ /^l/ <span class="kw">{</span>t[<span class="st">&quot;Symbolic Links&quot;</span>]++<span class="kw">}</span>
<span class="st">END</span> <span class="kw">{for</span> (i <span class="kw">in</span> t) <span class="kw">print</span> i <span class="st">&quot;:\t&quot;</span> t[i]<span class="kw">}</span>
&#39;</code></pre>
<p>In this program, we use regular expressions to identify the first character of the first field and increment the corresponding element in array <code>t</code>. Since we can use strings as array indexes in AWK, we spell out the file type as the index. This makes printing the results in the END action easy, as we only have to traverse the array with <code>for (i in t)</code> to obtain both the name and the accumulated total for each type.</p>
<h3 id="output-functions">Output Functions</h3>
<h4 id="print-expr1-expr2-expr3...">print <em>expr1, expr2, expr3,...</em></h4>
<p>As we have seen, <code>print</code> accepts a comma-separated list of arguments. An argument can be any valid expression; however, if an expression contains a relational operator, the entire argument list must be enclosed in parentheses.</p>
<p>The commas are important, because they tell AWK to separate output items with the output field separator (OFS). If omitted, AWK will interpret the members of the argument list as a single expression of string concatenation.</p>
<h4 id="printfformat-expr1-expr2-expr3...">printf(<em>format, expr1, expr2, expr3,...</em>)</h4>
<p>In AWK, <code>printf</code> is like the corresponding shell built-in (see TLCL chapter 21 for details). It formats its list of arguments based the contents of a <em>format string</em>. Here is an example where we output a list of files and their sizes in kilobytes:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l /usr/bin | awk &#39;<span class="kw">{printf</span>(<span class="st">&quot;%-30s%8.2fK\n&quot;</span>, <span class="ot">$9</span>, <span class="ot">$5</span> / <span class="dv">1024</span>)<span class="kw">}</span>&#39;</code></pre>
<h3 id="writing-to-files-and-pipelines">Writing to Files and Pipelines</h3>
<p>In addition to sending output to stdout, we can also send output to files and pipelines.</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l /usr/bin | awk &#39;
<span class="ot">$1</span> ~ /^-/ <span class="kw">{print</span> <span class="ot">$0</span> &gt; <span class="st">&quot;regfiles.txt&quot;</span><span class="kw">}</span>
<span class="ot">$1</span> ~ /^d/ <span class="kw">{print</span> <span class="ot">$0</span> &gt; <span class="st">&quot;directories.txt&quot;</span><span class="kw">}</span>
<span class="ot">$1</span> ~ /^l/ <span class="kw">{print</span> <span class="ot">$0</span> &gt; <span class="st">&quot;symlinks.txt&quot;</span><span class="kw">}</span>
&#39;</code></pre>
<p>Here we see a program that writes separate lists of regular files, directories, and symbolic links.</p>
<p>AWK also provides a <code>&gt;&gt;</code> operator for appending to files, but since AWK only opens a file once per program execution, the <code>&gt;</code> causes AWK to open the file at the beginning of execution and truncate the file to zero length much like we see with the shell. However, once the file is open, it stays open and each subsequent write appends contents to the file. The <code>&gt;&gt;</code> operator behaves in the same manner, but when the file is initially opened it is not truncated and all content is appended (i.e., it preserves the contents of an existing file).</p>
<p>AWK also allows output to be sent to pipelines. Consider this program, where we read our directory into an array and then output the entire array:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l /usr/bin | awk &#39;
<span class="ot">$1</span> ~ /^-/ <span class="kw">{</span>a[<span class="ot">$9</span>] = <span class="ot">$5</span><span class="kw">}</span>
<span class="st">END</span> <span class="kw">{for</span> (i <span class="kw">in</span> a)
    <span class="kw">{print</span> a[i] <span class="st">&quot;\t&quot;</span> i<span class="kw">}</span>
<span class="kw">}</span>
&#39;</code></pre>
<p>If we run this program, we notice that the array is output in a seemingly random &quot;implementation dependent&quot; order. To correct this, we can pipe the output through <code>sort</code>:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">ls -l /usr/bin | awk &#39;
<span class="ot">$1</span> ~ /^-/ <span class="kw">{</span>a[<span class="ot">$9</span>] = <span class="ot">$5</span><span class="kw">}</span>
<span class="st">END</span> <span class="kw">{for</span> (i <span class="kw">in</span> a)
    <span class="kw">{print</span> a[i] <span class="st">&quot;\t&quot;</span> i | <span class="st">&quot;sort -nr&quot;</span><span class="kw">}</span>
<span class="kw">}</span>
&#39;</code></pre>
<h3 id="reading-data">Reading Data</h3>
<p>As we have seen, AWK programs most often process data supplied from standard input. However, we can also specify input files on the command line:</p>
<p><code>awk 'program' file...</code></p>
<p>Knowing this, we can, for example, create an AWK program that simulates the <code>cat</code> command:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">awk &#39;<span class="kw">{print</span> <span class="ot">$0</span><span class="kw">}</span>&#39; file1 file2 file3</code></pre>
<p>or <code>wc</code>:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">awk &#39;<span class="kw">{</span>chars += <span class="fu">length</span>(<span class="ot">$0</span>); words += <span class="dt">NF</span><span class="kw">}</span>
    <span class="st">END</span> <span class="kw">{print</span> <span class="dt">NR</span>, words, chars + <span class="dt">NR</span><span class="kw">}</span>&#39; file1</code></pre>
<p>This program has a couple of interesting features. First, it uses the AWK string function <code>length</code> to obtain the number of characters in a string. This is one of many string functions that AWK provides, and we will talk more about them in a bit. The second feature is the <code>chars + NR</code> expression at the end. This is done because <code>length($0)</code> does not count the newline character at the end of each line, so we have to add them to make the character count come out the same as real <code>wc</code>.</p>
<p>Even if we don't include filenames on the command line for AWK to input, we can tell AWK to read data from a file specified from within a program. Normally we don't need to do this, but there are some cases where this might be handy. For example, if we wanted to insert one file inside of another, we could use the <code>getline</code> function in AWK. Here's an example that adds a header and footer to an existing body text file:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">awk &#39;
    <span class="st">BEGIN</span> <span class="kw">{</span>
        <span class="kw">while</span> (<span class="kw">getline</span> &lt;<span class="st">&quot;header.txt&quot;</span> &gt; <span class="dv">0</span>) <span class="kw">{</span>
            <span class="kw">print</span> <span class="ot">$0</span>
        <span class="kw">}</span>
    <span class="kw">}</span>
    <span class="kw">{print}</span>
    <span class="st">END</span> <span class="kw">{</span>
        <span class="kw">while</span> (<span class="kw">getline</span> &lt;<span class="st">&quot;footer.txt&quot;</span> &gt; <span class="dv">0</span>) <span class="kw">{</span>
            <span class="kw">print</span> <span class="ot">$0</span>
        <span class="kw">}</span>
    <span class="kw">}</span> 
&#39; &lt; body.txt &gt; finished_file.txt</code></pre>
<p><code>getline</code> is quite flexible and can be used in a variety of ways:</p>
<h4 id="getline">getline</h4>
<p>In its most basic form, <code>getline</code> reads the next record from the current input stream. <code>$0</code>, <code>NF</code>, <code>NR</code>, and <code>FNR</code> are set.</p>
<h4 id="getline-var">getline <em>var</em></h4>
<p>Reads the next record from the current input stream and assigns its contents to the variable <em>var</em>. <em>var</em>, <code>NR</code>, and <code>FNR</code> are set.</p>
<h4 id="getline-file">getline &lt;<em>file</em></h4>
<p>Reads a record from <em>file</em>. <code>$0</code> and <code>NF</code> are set. It's important to check for errors when reading from files. In the earlier example above, we specified a while loop as follows:</p>
<p><code>while (getline &lt;&quot;header.txt&quot; &gt; 0)</code></p>
<p>As we can see, <code>getline</code> is reading from the file <code>header.txt</code>, but what does the &quot;&gt; 0&quot; mean? The answer is that, like most functions, <code>getline</code> returns a value. A positive value means success, zero means EOF (end of file), and a negative value means some other file-related problem, such as file not found has occurred. If we did not check the return value, we might end up with an infinite loop.</p>
<h4 id="getline-var-file">getline <em>var</em> &lt;<em>file</em></h4>
<p>Reads the next record from <em>file</em> and assigns its contents to the variable <em>var</em>. Only <em>var</em> is set.</p>
<h4 id="command-getline"><em>command</em> | getline</h4>
<p>Reads the next record from the output of <em>command</em>. <code>$0</code> and <code>NF</code> are set. Here is an example where we use AWK to parse the output of the <code>date</code> command:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">awk &#39;
    <span class="st">BEGIN</span> <span class="kw">{</span>
        <span class="st">&quot;date&quot;</span> | <span class="kw">getline</span>
        <span class="kw">print</span> <span class="ot">$4</span>
    <span class="kw">}</span>
&#39;</code></pre>
<h4 id="command-getline-var"><em>command</em> | getline <em>var</em></h4>
<p>Reads the next record from the output of <em>command</em> and assigns its contents to the variable <em>var</em>. Only <em>var</em> is set.</p>
<h3 id="string-functions">String Functions</h3>
<p>As one would expect, AWK has many functions used to manipulate strings and what's more, many of them support regular expressions. This makes AWK's string handling very powerful.</p>
<h4 id="gsubr-s-t">gsub(<em>r</em>, <em>s</em>, <em>t</em>)</h4>
<p>Globally replaces any substring matching regular expression <em>r</em> contained within the target string <em>t</em> with the string <em>s</em>. The target string is optional. If omitted, <code>$0</code> is used as the target string. The function returns the number of substitutions made.</p>
<h4 id="indexs1-s2">index(<em>s1</em>, <em>s2</em>)</h4>
<p>Returns the leftmost position of string <em>s2</em> within string <em>s1</em>. If <em>s2</em> does not appear within <em>s1</em>, the function returns 0.</p>
<h4 id="lengths">length(<em>s</em>)</h4>
<p>Returns the number of characters in string <em>s</em>.</p>
<h4 id="matchs-r">match(<em>s</em>, <em>r</em>)</h4>
<p>Returns the leftmost position of a substring matching regular expression <em>r</em> within string <em>s</em>. Returns 0 if no match is found. This function also sets the internal variables <code>RSTART</code> and <code>RLENGTH</code>.</p>
<h4 id="splits-a-fs">split(<em>s</em>, <em>a</em>, <em>fs</em>)</h4>
<p>Splits string <em>s</em> into fields and stores each field in an element of array <em>a</em>. Fields are split according to field separator <em>fs</em>. For example, if we wanted to break a phone number such as 800-555-1212 into 3 fields separated by the &quot;-&quot; character, we could do this:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">phone=<span class="st">&quot;800-555-1212&quot;</span>
<span class="fu">split</span>(phone, fields, <span class="st">&quot;-&quot;</span>)</code></pre>
<p>After doing so, the array <code>fields</code> will contain the following elements:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">fields[<span class="dv">1</span>] = <span class="st">&quot;800&quot;</span>
fields[<span class="dv">2</span>] = <span class="st">&quot;555&quot;</span>
fields[<span class="dv">3</span>] = <span class="st">&quot;1212&quot;</span></code></pre>
<h4 id="sprintffmt-exprs">sprintf(<em>fmt</em>, <em>exprs</em>)</h4>
<p>This function behaves like <code>printf</code>, except instead of outputting a formatted string, it returns a formatted string containing the list of expressions to the caller. Use this function to assign a formatted string to a variable:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">area_code = <span class="st">&quot;800&quot;</span>
exchange = <span class="st">&quot;555&quot;</span>
number = <span class="st">&quot;1212&quot;</span>
phone_number = <span class="fu">sprintf</span>(<span class="st">&quot;(%s) %s-%s&quot;</span>, area_code, exchange, number)</code></pre>
<h4 id="subr-s-t">sub(<em>r</em>, <em>s</em>, <em>t</em>)</h4>
<p>Behaves like <code>gsub</code>, except only the first leftmost replacement is made. Like <code>gsub</code>, the target string <em>t</em> is optional. If omitted, <code>$0</code> is used as the target string.</p>
<h4 id="substrs-p-l">substr(<em>s</em>, <em>p</em>, <em>l</em>)</h4>
<p>Returns the substring contained within string <em>s</em> starting at position <em>p</em> with length <em>l</em>.</p>
<h3 id="arithmetic-functions">Arithmetic Functions</h3>
<p>AWK has the usual set of arithmetic functions. A word of caution about math in AWK: it has limitations in terms of both number size and precision of floating point operations. This is particularly true of <code>mawk</code>. For tasks involving extensive calculation, <code>gawk</code> would be preferred. The <code>gawk</code> documentation provides a good discussion of the issues involved.</p>
<h4 id="atan2y-x">atan2(<em>y</em>, <em>x</em>)</h4>
<p>Returns the arctangent of <em>y/x</em> in radians.</p>
<h4 id="cosx">cos(<em>x</em>)</h4>
<p>Returns the cosine of <em>x</em>, with <em>x</em> in radians.</p>
<h4 id="expx">exp(<em>x</em>)</h4>
<p>Returns the exponential of <em>x</em>, that is e^<em>x</em>.</p>
<h4 id="intx">int(<em>x</em>)</h4>
<p>Returns the integer portion of <em>x</em>. For example if <em>x</em> = 1.9, 1 is returned.</p>
<h4 id="logx">log(<em>x</em>)</h4>
<p>Returns the natural logarithm of <em>x</em>. <em>x</em> must be positive.</p>
<h4 id="rand">rand()</h4>
<p>Returns a random floating point value <em>n</em> such that 0 &lt;= <em>n</em> &lt; 1. This is a value between 0 and 1 where a value of 0 is possible but not 1. In AWK, random numbers always follow the same sequence of values unless the seed for the random number generator is first set using the <code>srand()</code> function (see below).</p>
<h4 id="sinx">sin(<em>x</em>)</h4>
<p>Returns the sine of <em>x</em>, with <em>x</em> in radians.</p>
<h4 id="sqrtx">sqrt(<em>x</em>)</h4>
<p>Returns the square root of <em>x</em>.</p>
<h4 id="srandx">srand(<em>x</em>)</h4>
<p>Sets the seed for the random number generator to <em>x</em>. If <em>x</em> is omitted, then the time of day is used as the seed. To generate a random integer in the range of 1 to <em>n</em>, we can use code like this:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="fu">srand</span>()
<span class="co"># Generate a random integer between 1 and 6 inclusive</span>
dice_roll = <span class="fu">int</span>(<span class="dv">6</span> * <span class="fu">rand</span>()) + <span class="dv">1</span></code></pre>
<h3 id="user-defined-functions">User Defined Functions</h3>
<p>In addition to the built-in string and arithmetic functions, AWK supports user-defined functions much like the shell. The mechanism for passing parameters is different, and more like traditional languages such as C.</p>
<h4 id="defining-a-function">Defining a function</h4>
<p>A typical function definition looks like this:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="kw">function</span> name(parameter-list) <span class="kw">{</span>
    statements
    <span class="kw">return</span> expression
<span class="kw">}</span></code></pre>
<p>We use the keyword <code>function</code> followed by the name of the function to be defined. The name must be immediately followed by the opening left parenthesis of the parameter list. The parameter list may contain zero or more comma-separated parameters. A brace delimited code block follows with one or more statements. To specify what is returned by the function, the <code>return</code> statement is used, followed by an expression containing the value to be returned. If we were to convert our previous dice rolling example into a function, it would look like this:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="kw">function</span> dice_roll() <span class="kw">{</span>
    <span class="kw">return</span> <span class="fu">int</span>(<span class="dv">6</span> * <span class="fu">rand</span>()) + <span class="dv">1</span>
<span class="kw">}</span></code></pre>
<p>Further, if we wanted to generalize our function to support different possible maximum values, we could code this:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="kw">function</span> rand_integer(max) <span class="kw">{</span>
    <span class="kw">return</span> <span class="fu">int</span>(max * <span class="fu">rand</span>()) + <span class="dv">1</span>
<span class="kw">}</span></code></pre>
<p>and then change <code>dice_roll</code> to make use of our generalized function:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="kw">function</span> dice_roll() <span class="kw">{</span>
    <span class="kw">return</span> rand_integer(<span class="dv">6</span>)
<span class="kw">}</span></code></pre>
<h4 id="passing-parameters-to-functions">Passing parameters to functions</h4>
<p>As we saw in the example above, we pass parameters to the function, and they are operated upon within the body of the function. Parameters fall into two general classes. First, there are the <em>scalar variables</em>, such as strings and numbers. Second are the arrays. This distinction is important in AWK because of the way that parameters are passed to functions. Scalar variables are <em>passed by value</em>, meaning that a copy of the variable is created and given to the function. This means that scalar variables act as local variables within the function and are destroyed once the function exits. Array variables, on the other hand, are <em>passed by reference</em> meaning that a pointer to the array's starting position in memory is passed to the function. This means that the array is not treated as a local variable and that any change made to the array persists once the program exits the function. This concept of passed by value versus passed by reference shows up in a lot of programming languages so it's important to understand it.</p>
<h4 id="local-variables">Local variables</h4>
<p>One interesting limitation of AWK is that we cannot declare local variables within the body of a function. There is a workaround for this problem. We can add variables to the parameter list. Since all scalar variables in the parameter list are passed by value, they will be treated as if they are local variables. This does not apply to arrays, since they are always passed by reference. Unlike many other languages, AWK does not enforce the parameter list, thus we can add parameters that are not used by the caller of the function. In most other languages, the number and type of parameters passed during a function call must match the parameter list specified by the function's declaration.</p>
<p>By convention, additional parameters used as local variables in the function are preceded by additional spaces in the parameter list like so:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="kw">function</span> my_funct(param1, param2, param3,    local1, local2)</code></pre>
<p>These additional spaces have no meaning to the language, they are there for the benefit of the human reading the code.</p>
<p>Let's try some short AWK programs on some numbers. First we need some data. Here's a little AWK program that produces a table of random integers:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="co"># random_table.awk - generate table of random numbers</span>

<span class="kw">function</span> rand_integer(max) <span class="kw">{</span>
    <span class="kw">return</span> <span class="fu">int</span>(max * <span class="fu">rand</span>()) + <span class="dv">1</span>
<span class="kw">}</span>

<span class="st">BEGIN</span> <span class="kw">{</span>
    <span class="fu">srand</span>()
    <span class="kw">for</span> (i = <span class="dv">0</span>; i &lt; <span class="dv">100</span>; i++) <span class="kw">{</span>
        <span class="kw">for</span> (j = <span class="dv">0</span>; j &lt; <span class="dv">5</span>; j++) <span class="kw">{</span>
            <span class="kw">printf</span>(<span class="st">&quot;    %5d&quot;</span>, rand_integer(<span class="dv">99999</span>))
        <span class="kw">}</span>
        <span class="kw">printf</span>(<span class="st">&quot;\n&quot;</span>, <span class="st">&quot;&quot;</span>)
    <span class="kw">}</span>
<span class="kw">}</span></code></pre>
<p>If we store this in a file, we can run it like so:</p>
<p><code>me@linuxbox ~ $ awk -f random_table.awk &gt; random_table.dat</code></p>
<p>And it should produce a file containing 100 rows of 5 columns of random integers.</p>
<h4 id="convert-file-into-csv-format">Convert file into CSV format</h4>
<p>One of AWK's many strengths is file format conversion. Here we will convert our neatly arranged columns of numbers into a CSV (comma separated values) file.</p>
<p><code>awk 'BEGIN {OFS=&quot;,&quot;} {print $1,$2,$3,$4,$5}' random_table.dat</code></p>
<p>This is a very easy conversion. All we need to do is change the output field separator (<code>OFS</code>) and then print all of the individual fields. While it is very easy to write a CSV file, reading one can be tricky. In some cases, applications that write CSV files (including many popular spreadsheet programs) will create lines like this:</p>
<p><code>word1, &quot;word2a, word2b&quot;, word3</code></p>
<p>Notice the embedded comma in the second field. This throws the simple AWK solution (<code>FS=&quot;,&quot;</code>) out the window. Parsing this kind of file can be done (<code>gawk</code>, in fact has a language extension for this problem), but it's not pretty. It is best to avoid trying to read this type of file.</p>
<h4 id="convert-file-into-tsv-format">Convert file into TSV format</h4>
<p>A frequently available alternative to the CSV file is the TSV (tab separated value) file. This file format uses tab charachers as the field separators:</p>
<p><code>awk 'BEGIN {OFS=&quot;\t&quot;} {print $1,$2,$3,$4,$5}' random_table.dat</code></p>
<p>Again, writing these files is easy to do. We just set the output field separator to a tab character. In regards to reading, most applications that write CSV files can also write TSV files. Using TSV files avoids the embedded comma problem we often see when attempting to read CSV files.</p>
<h4 id="print-the-total-for-each-row">Print the total for each row</h4>
<p>If all we need to do is some simple addition, this is easily done:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">awk &#39;
    <span class="kw">{</span>
        t = <span class="ot">$1</span> + <span class="ot">$2</span> + <span class="ot">$3</span> + <span class="ot">$4</span> + <span class="ot">$5</span>
        <span class="kw">printf</span>(<span class="st">&quot;%s = %6d\n&quot;</span>, <span class="ot">$0</span>, t)
    <span class="kw">}</span>
&#39; random_table.dat</code></pre>
<h4 id="print-the-total-for-each-column">Print the total for each column</h4>
<p>Adding up the column is pretty easy, too. In this example, we use a loop and array to maintain running totals for each of the five columns in our data file:</p>
<pre class="sourceCode awk"><code class="sourceCode awk">awk &#39;
    <span class="kw">{</span>
        <span class="kw">for</span> (i = <span class="dv">1</span>; i &lt;= <span class="dv">5</span>; i++) <span class="kw">{</span>
            t[i] += <span class="ot">$i</span>
        <span class="kw">}</span>
        <span class="kw">print</span>
    <span class="kw">}</span>
    <span class="st">END</span> <span class="kw">{</span>
        <span class="kw">print</span> <span class="st">&quot;  ===&quot;</span>
        <span class="kw">for</span> (i = <span class="dv">1</span>; i &lt;= <span class="dv">5</span>; i++) <span class="kw">{</span>
            <span class="kw">printf</span>(<span class="st">&quot;  %7d&quot;</span>, t[i])
        <span class="kw">}</span>
        <span class="kw">printf</span>(<span class="st">&quot;\n&quot;</span>, <span class="st">&quot;&quot;</span>)
     <span class="kw">}</span>
&#39; random_table.dat</code></pre>
<h4 id="print-the-minimum-and-maximum-value-in-column-1">Print the minimum and maximum value in column 1</h4>
<pre class="sourceCode awk"><code class="sourceCode awk">awk &#39;
    <span class="st">BEGIN</span> <span class="kw">{</span>min = <span class="dv">99999</span><span class="kw">}</span>
    <span class="ot">$1</span> &gt; max <span class="kw">{</span>max = <span class="ot">$1</span><span class="kw">}</span>
    <span class="ot">$1</span> &lt; min <span class="kw">{</span>min = <span class="ot">$1</span><span class="kw">}</span>
    <span class="st">END</span> <span class="kw">{print</span> <span class="st">&quot;Max =&quot;</span>, max, <span class="st">&quot;Min =&quot;</span>, min<span class="kw">}</span>
&#39; random_table.dat</code></pre>
<h3 id="one-last-example">One Last Example</h3>
<p>For our last example, we'll create a program that processes a list of pathnames and extracts the extension from each file name to keep a tally of how many files have that extension:</p>
<pre class="sourceCode awk"><code class="sourceCode awk"><span class="co"># file_types.awk - sorted list of file name extensions and counts</span>

<span class="st">BEGIN</span> <span class="kw">{</span><span class="dt">FS</span> = <span class="st">&quot;.&quot;</span><span class="kw">}</span>

<span class="kw">{</span>types[<span class="ot">$NF</span>]++<span class="kw">}</span>

<span class="st">END</span> <span class="kw">{</span>
    <span class="kw">for</span> (i <span class="kw">in</span> types) <span class="kw">{</span>
        <span class="kw">printf</span>(<span class="st">&quot;%6d %s\n&quot;</span>, types[i], i) | <span class="st">&quot;sort -nr&quot;</span>
    <span class="kw">}</span>
<span class="kw">}</span></code></pre>
<p>To find the 10 most popular file extensions in our home directory, we can use the program like this:</p>
<p><code>find ~ -name &quot;*.*&quot; | awk -f file_types.awk | head</code></p>
<h2 id="summing-up">Summing Up</h2>
<p>We really have to admire what an elegant and useful tool the authors of AWK created during the early days of Unix. So useful that its utility continues to this day. We have given AWK a brief examination in this adventure. Feel free to explore further by delving deeper into the documentation of the various AWK implementations. Also, searching the web for &quot;AWK one-liners&quot; will reveal many useful and clever tricks possible with AWK.</p>
<h2 id="further-reading">Further Reading</h2>
<ul>
<li><p>The <code>nawk</code> man page provides a good reference for the baseline version of AWK. An online version is available at <a href="http://linux.die.net/man/1/nawk"><code class="url">http://linux.die.net/man/1/nawk</code></a></p></li>
<li><p>Another <code>nawk</code> manual derived from the original <code>gawk</code> manual (see below) can be found at <a href="http://www.staff.science.uu.nl/~oostr102/docs/nawk/nawk_toc.html"><code class="url">http://www.staff.science.uu.nl/~oostr102/docs/nawk/nawk_toc.html</code></a></p></li>
<li><p>Many useful AWK programs are just one line long. Eric Pement has compiled an extensive list: <a href="http://www.pement.org/awk/awk1line.txt"><code class="url">http://www.pement.org/awk/awk1line.txt</code></a></p></li>
<li><p>In addition to its man page, <code>gawk</code> has its own book titled Gawk: Effective AWK Programming available at: <a href="https://www.gnu.org/software/gawk/manual/"><code class="url">https://www.gnu.org/software/gawk/manual/</code></a></p></li>
<li><p>Peteris Krumins has a nice blog post listing a variety of helpful tips for AWK users: <a href="http://www.catonmat.net/blog/ten-awk-tips-tricks-and-pitfalls/"><code class="url">http://www.catonmat.net/blog/ten-awk-tips-tricks-and-pitfalls/</code></a></p></li>
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