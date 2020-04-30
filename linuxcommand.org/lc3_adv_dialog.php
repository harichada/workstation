



	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

	<html lang="en">
	<head>
		<link rel="SHORTCUT ICON" href="http://linuxcommand.org/favicon.png">

		<title>LinuxCommand.org: Dialog</title>
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
<h1 id="dialog">dialog</h1>
<p>If we look at contemporary software, we might be surprised to learn that the majority of code in most programs today has very little to do with the real work for which the program was intended. Rather, the majority of code is used to create the user interface. Modern graphical programs need large amounts of CPU time and memory for their sophisticated eye candy. This helps explain why command line programs usually use so little memory and CPU compared to their GUI counterparts.</p>
<p>Still, the command line interface is often inconvenient. If only there were some way to emulate common graphical user interface features on a text display.</p>
<p>In this adventure, we're going to look at <code>dialog</code>, a program that does just that. It displays various kinds of <em>dialog boxes</em> that we can incorporate into our shell scripts to give them a much friendlier face. <code>dialog</code> dates back a number of years and is now just one member of a family of programs that attempt to solve the user interface problem for command line users.</p>
<h2 id="features">Features</h2>
<p><code>dialog</code> is a fairly large and complex program (it has almost 100 command line options), but compared to the typical graphical user interface, it's a real lightweight. Still, it is capable of many user interface tricks. With <code>dialog</code>, we can generate the following types of dialog boxes (version 1.2 shown):</p>
<table>
<col width="22%" >
<col width="22%" >
<col width="51%" >
<thead>
<tr class="header">
<th align="left">Dialog</th>
<th align="left">Option</th>
<th align="left">Description</th>
</tr>
</thead>
<tbody>
<tr class="odd">
<td align="left">Build List</td>
<td align="left"><code>--buildlist</code></td>
<td align="left">Displays two lists, side-by-side. The list on the left contains unselected items, the list on the right selected items. The user can move items from one list to the other.</td>
</tr>
<tr class="even">
<td align="left">Calendar</td>
<td align="left"><code>--calendar</code></td>
<td align="left">Displays a calendar and allow the user to select a date.</td>
</tr>
<tr class="odd">
<td align="left">Checklist</td>
<td align="left"><code>--checklist</code></td>
<td align="left">Presents a list of choices and allow the user to select one or more items.</td>
</tr>
<tr class="even">
<td align="left">Directory Select</td>
<td align="left"><code>--dselect</code></td>
<td align="left">Displays a directory selection dialog.</td>
</tr>
<tr class="odd">
<td align="left">Edit Box</td>
<td align="left"><code>--editbox</code></td>
<td align="left">Displays a rudimentary text file editor.</td>
</tr>
<tr class="even">
<td align="left">Form</td>
<td align="left"><code>--form</code></td>
<td align="left">Allows the user to enter text into multiple fields.</td>
</tr>
<tr class="odd">
<td align="left">File Select</td>
<td align="left"><code>--fselect</code></td>
<td align="left">A file selection dialog.</td>
</tr>
<tr class="even">
<td align="left">Gauge</td>
<td align="left"><code>--gauge</code></td>
<td align="left">Displays a progress indicator showing the percentage of completion.</td>
</tr>
<tr class="odd">
<td align="left">Info Box</td>
<td align="left"><code>--infobox</code></td>
<td align="left">Displays a message (with an optional timed pause) and terminates.</td>
</tr>
<tr class="even">
<td align="left">Input Box</td>
<td align="left"><code>--inputbox</code></td>
<td align="left">Prompts the user to enter/edit a text field.</td>
</tr>
<tr class="odd">
<td align="left">Menu Box</td>
<td align="left"><code>--menubox</code></td>
<td align="left">Displays a list of choices.</td>
</tr>
<tr class="even">
<td align="left">Message Box</td>
<td align="left"><code>--msgbox</code></td>
<td align="left">Displays a text message and waits for the user to respond.</td>
</tr>
<tr class="odd">
<td align="left">Password Box</td>
<td align="left"><code>--passwordbox</code></td>
<td align="left">Similar to an input box, but hides the user's entry.</td>
</tr>
<tr class="even">
<td align="left">Pause</td>
<td align="left"><code>--pause</code></td>
<td align="left">Displays a text message and a countdown timer. The dialog terminates when the timer runs out or when the user presses either the OK or Cancel button.</td>
</tr>
<tr class="odd">
<td align="left">Program Box</td>
<td align="left"><code>--programbox</code></td>
<td align="left">Displays the output of a piped command. When the command completes, the dialog waits for the user to press an OK button.</td>
</tr>
<tr class="even">
<td align="left">Progress Box</td>
<td align="left"><code>--progressbox</code></td>
<td align="left">Similar to the program box except the dialog terminates when the piped command completes, rather than waiting for the user to press OK.</td>
</tr>
<tr class="odd">
<td align="left">Radio List</td>
<td align="left"><code>--radiolist</code></td>
<td align="left">Displays a list of choices and allows the user to select a single item. Any previously selected item becomes unselected.</td>
</tr>
<tr class="even">
<td align="left">Range Box</td>
<td align="left"><code>--rangebox</code></td>
<td align="left">Allows the user to select a numerical value from within a specified range using a keyboard-based slider.</td>
</tr>
<tr class="odd">
<td align="left">Tail Box</td>
<td align="left"><code>--tailbox</code></td>
<td align="left">Displays a text file with real-time updates. Works like the command <code>tail -f</code>.</td>
</tr>
<tr class="even">
<td align="left">Text Box</td>
<td align="left"><code>--textbox</code></td>
<td align="left">A simple text file viewer. Supports many of the same keyboard commands as <code>less</code>.</td>
</tr>
<tr class="odd">
<td align="left">Time Box</td>
<td align="left"><code>--timebox</code></td>
<td align="left">A dialog for entering a time of day.</td>
</tr>
<tr class="even">
<td align="left">Tree View</td>
<td align="left"><code>--treeview</code></td>
<td align="left">Displays a list of items in a tree-shaped hierarchy.</td>
</tr>
<tr class="odd">
<td align="left">Yes/No Box</td>
<td align="left"><code>--yesno</code></td>
<td align="left">Displays a text message and gives the user a chance to respond with either &quot;Yes&quot; or &quot;No.&quot;</td>
</tr>
</tbody>
</table>
<p>Here are some examples:</p>
<div class="figure">
<img src="images/adventure_dialog-yesno.png" alt="Screen shot of the yesno dialog" ><p class="caption">Screen shot of the yesno dialog</p>
</div>
<div class="figure">
<img src="images/adventure_dialog-radiolist.png" alt="Screen shot of the radiolist dialog" ><p class="caption">Screen shot of the radiolist dialog</p>
</div>
<div class="figure">
<img src="images/adventure_dialog-fselect.png" alt="Screen shot of the fselect dialog" ><p class="caption">Screen shot of the fselect dialog</p>
</div>
<h2 id="availability">Availability</h2>
<p><code>dialog</code> is available from most distribution repositories as the package &quot;dialog&quot;. Besides the program itself, the <code>dialog</code> package includes a fairly comprehensive man page and a large set of sample programs that demonstrate the various dialog boxes it can display. After installation on a Debian-based system, these sample programs can be found in the <code>/usr/share/doc/dialog/examples</code> directory. Other distributions are similar.</p>
<p>By the way, using <a href="lc3_adv_mc.php">Midnight Commander</a> to browse the examples directory is a great way to run the example programs and to study the scripts themselves:</p>
<div class="figure">
<img src="images/adventure_dialog-mc.png" alt="Browsing the examples with Midnight Commander" ><p class="caption">Browsing the examples with Midnight Commander</p>
</div>
<h2 id="how-it-works">How It Works</h2>
<p>On the surface, <code>dialog</code> appears straightforward. We launch <code>dialog</code> followed by one or more common options (options that apply regardless of the desired dialog box) and then the box option and its associated parameters. The tricky part of using <code>dialog</code> is getting data out of it.</p>
<p>The data that <code>dialog</code> takes in (such as a string entered into a input box) is normally returned on standard error. This is because <code>dialog</code> uses standard output to display text on the terminal when it is drawing the dialog box itself. There are a couple of techniques we can use to handle the returned data. Let's take a look at them.</p>
<h3 id="method-1-store-the-results-in-a-temporary-file">Method 1: Store The Results In A Temporary File</h3>
<p>The first method is to use a temporary file. The sample programs supplied with <code>dialog</code> provide some examples (this script has been modified from the original for clarity):</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>

<span class="co"># inputbox - demonstrate the input dialog box with a temporary file</span>

<span class="co"># Define the dialog exit status codes</span>
<span class="kw">:</span> <span class="ot">${DIALOG_OK=</span>0<span class="ot">}</span>
<span class="kw">:</span> <span class="ot">${DIALOG_CANCEL=</span>1<span class="ot">}</span>
<span class="kw">:</span> <span class="ot">${DIALOG_HELP=</span>2<span class="ot">}</span>
<span class="kw">:</span> <span class="ot">${DIALOG_EXTRA=</span>3<span class="ot">}</span>
<span class="kw">:</span> <span class="ot">${DIALOG_ITEM_HELP=</span>4<span class="ot">}</span>
<span class="kw">:</span> <span class="ot">${DIALOG_ESC=</span>255<span class="ot">}</span>

<span class="co"># Create a temporary file and make sure it goes away when we&#39;re dome</span>
<span class="ot">tmp_file=$(</span><span class="kw">tempfile</span> <span class="kw">2&gt;</span>/dev/null<span class="ot">)</span> <span class="kw">||</span> <span class="ot">tmp_file=</span>/tmp/test<span class="ot">$$</span>
<span class="kw">trap</span> <span class="st">&quot;rm -f </span><span class="ot">$tmp_file</span><span class="st">&quot;</span> 0 1 2 5 15

<span class="co"># Generate the dialog box</span>
dialog --title <span class="st">&quot;INPUT BOX&quot;</span> <span class="kw">\</span>
  --clear  <span class="kw">\</span>
  --inputbox <span class="st">&quot;Hi, this is an input dialog box. You can use \n</span>
<span class="st">this to ask questions that require the user \n</span>
<span class="st">to input a string as the answer. You can \n</span>
<span class="st">input strings of length longer than the \n</span>
<span class="st">width of the input box, in that case, the \n</span>
<span class="st">input field will be automatically scrolled. \n</span>
<span class="st">You can use BACKSPACE to correct errors. \n\n</span>
<span class="st">Try entering your name below:&quot;</span> 16 51 <span class="kw">2&gt;</span> <span class="ot">$tmp_file</span>

<span class="co"># Get the exit status</span>
<span class="ot">return_value=$?</span>

<span class="co"># Act on it</span>
<span class="kw">case</span> <span class="ot">$return_value</span><span class="kw"> in</span>
  <span class="ot">$DIALOG_OK</span><span class="kw">)</span>
    <span class="kw">echo</span> <span class="st">&quot;Result: </span><span class="kw">`cat</span> <span class="ot">$tmp_file</span><span class="kw">`</span><span class="st">&quot;</span><span class="kw">;;</span>
  <span class="ot">$DIALOG_CANCEL</span><span class="kw">)</span>
    <span class="kw">echo</span> <span class="st">&quot;Cancel pressed.&quot;</span><span class="kw">;;</span>
  <span class="ot">$DIALOG_HELP</span><span class="kw">)</span>
    <span class="kw">echo</span> <span class="st">&quot;Help pressed.&quot;</span><span class="kw">;;</span>
  <span class="ot">$DIALOG_EXTRA</span><span class="kw">)</span>
    <span class="kw">echo</span> <span class="st">&quot;Extra button pressed.&quot;</span><span class="kw">;;</span>
  <span class="ot">$DIALOG_ITEM_HELP</span><span class="kw">)</span>
    <span class="kw">echo</span> <span class="st">&quot;Item-help button pressed.&quot;</span><span class="kw">;;</span>
  <span class="ot">$DIALOG_ESC</span><span class="kw">)</span>
    if <span class="kw">test</span> -s <span class="ot">$tmp_file</span> ; <span class="kw">then</span>
      <span class="kw">cat</span> <span class="ot">$tmp_file</span>
    <span class="kw">else</span>
      <span class="kw">echo</span> <span class="st">&quot;ESC pressed.&quot;</span>
    <span class="kw">fi</span>
    <span class="kw">;;</span>
<span class="kw">esac</span></code></pre>
<p>The first part of the script defines some constants that are used to represent the six possible exit status values supported by <code>dialog</code>. They are used to tell the calling script which button on the dialog box (or alternately, the Esc key) was used to terminate the dialog. The construct used to do this is somewhat interesting. First, each line begins with the null command &quot;:&quot; which is a command that does nothing. Yes, really. It intentionally does nothing, because sometimes we need a command (for syntax reasons) but don't actually want to do anything. Following the null command is a parameter expansion. The expansion is similar in form to one we covered in chapter 34 of TLCL:</p>
<p><code>${</code><em>parameter</em><code>:=</code><em>value</em><code>}</code></p>
<p>which sets a default value for a parameter (variable) that is either unset (it does not exist at all), or is set, but empty. The author of the example code is being very cautious here and has removed the colon from the expansion. This changes the meaning of the expansion to mean that a default value is set only if the parameter is unset rather than unset or empty.</p>
<p>The next part of the example creates a temporary file named <code>tmp_file</code> by using the <code>tempfile</code> command, which is a program used to create a temporary file in a secure manner. Next, we set a trap to make sure that the temporary file is deleted if the program is somehow terminated. Neatness counts!</p>
<p>At last, we get to the <code>dialog</code> command itself. We start off setting a title for the input box and specify the <code>--clear</code> option to tell <code>dialog</code> that we want to erase any previous dialog box from the screen. Next, we indicate the type of dialog box we want and its required arguments. These include the text to be displayed above the input field, and the desired height and width of the box. Though the example specifies exact dimensions for the box, we could also specify zero for both values and <code>dialog</code> will attempt to automatically determine the correct size.</p>
<p>Since <code>dialog</code> normally outputs its results to standard error, we redirect its file descriptor to our temporary file for storage.</p>
<p>The last thing we have to do is collect the exit status of the command in a variable (<code>return_value</code>) so that we can figure out which button the user pressed to terminate the dialog box. At the end of the script, we look at this value and act accordingly.</p>
<h3 id="method-2-use-command-substitution-and-redirection">Method 2: Use Command Substitution and Redirection</h3>
<p>The second method of receiving data from <code>dialog</code> involves redirection. In the script that follows, we pass the results from <code>dialog</code> to a variable rather than a file. To do this, we need to first perform some redirection.</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>

<span class="co"># inputbox - demonstrate the input dialog box with redirection</span>

<span class="co"># Define the dialog exit status codes</span>
<span class="kw">:</span> <span class="ot">${DIALOG_OK=</span>0<span class="ot">}</span>
<span class="kw">:</span> <span class="ot">${DIALOG_CANCEL=</span>1<span class="ot">}</span>
<span class="kw">:</span> <span class="ot">${DIALOG_HELP=</span>2<span class="ot">}</span>
<span class="kw">:</span> <span class="ot">${DIALOG_EXTRA=</span>3<span class="ot">}</span>
<span class="kw">:</span> <span class="ot">${DIALOG_ITEM_HELP=</span>4<span class="ot">}</span>
<span class="kw">:</span> <span class="ot">${DIALOG_ESC=</span>255<span class="ot">}</span>

<span class="co"># Duplicate file descriptor 1 on descriptor 3</span>
<span class="kw">exec</span> <span class="kw">3&gt;&amp;1</span>
 
<span class="co"># Generate the dialog box</span>
<span class="ot">result=$(</span>dialog --title <span class="st">&quot;INPUT BOX&quot;</span> <span class="kw">\</span>
  --clear  <span class="kw">\</span>
  --inputbox <span class="st">&quot;Hi, this is an input dialog box. You can use \n</span>
<span class="st">this to ask questions that require the user \n</span>
<span class="st">to input a string as the answer. You can \n</span>
<span class="st">input strings of length longer than the \n</span>
<span class="st">width of the input box, in that case, the \n</span>
<span class="st">input field will be automatically scrolled. \n</span>
<span class="st">You can use BACKSPACE to correct errors. \n\n</span>
<span class="st">Try entering your name below:&quot;</span> 16 51 <span class="kw">2&gt;&amp;1</span> <span class="kw">1&gt;&amp;3</span><span class="ot">)</span>

<span class="co"># Get dialog&#39;s exit status</span>
<span class="ot">return_value=$?</span>

<span class="co"># Close file descriptor 3</span>
<span class="kw">exec</span> <span class="kw">3&gt;&amp;</span>-

<span class="co"># Act on the exit status</span>
<span class="kw">case</span> <span class="ot">$return_value</span><span class="kw"> in</span>
  <span class="ot">$DIALOG_OK</span><span class="kw">)</span>
    <span class="kw">echo</span> <span class="st">&quot;Result: </span><span class="ot">$result</span><span class="st">&quot;</span><span class="kw">;;</span>
  <span class="ot">$DIALOG_CANCEL</span><span class="kw">)</span>
    <span class="kw">echo</span> <span class="st">&quot;Cancel pressed.&quot;</span><span class="kw">;;</span>
  <span class="ot">$DIALOG_HELP</span><span class="kw">)</span>
    <span class="kw">echo</span> <span class="st">&quot;Help pressed.&quot;</span><span class="kw">;;</span>
  <span class="ot">$DIALOG_EXTRA</span><span class="kw">)</span>
    <span class="kw">echo</span> <span class="st">&quot;Extra button pressed.&quot;</span><span class="kw">;;</span>
  <span class="ot">$DIALOG_ITEM_HELP</span><span class="kw">)</span>
    <span class="kw">echo</span> <span class="st">&quot;Item-help button pressed.&quot;</span><span class="kw">;;</span>
  <span class="ot">$DIALOG_ESC</span><span class="kw">)</span>
    if <span class="kw">test</span> -n <span class="st">&quot;</span><span class="ot">$result</span><span class="st">&quot;</span> ; <span class="kw">then</span>
      <span class="kw">echo</span> <span class="st">&quot;</span><span class="ot">$result</span><span class="st">&quot;</span>
    <span class="kw">else</span>
      <span class="kw">echo</span> <span class="st">&quot;ESC pressed.&quot;</span>
    <span class="kw">fi</span>
    <span class="kw">;;</span>
<span class="kw">esac</span></code></pre>
<p>At first glance, the redirection may seem nonsensical. First, we duplicate file descriptor 1 (stdout) to descriptor 3 using <code>exec</code> (this was covered in <a href="lc3_adv_redirection.php">More Redirection</a>) to create a backup copy of descriptor 1.</p>
<p>The next step is to perform a command substitution and assign the output of a the <code>dialog</code> command to the variable <code>result</code>. The command includes redirections of descriptor 2 (stderr) to be the duplicate of descriptor 1 and lastly, descriptor 1 is restored to its original value by duplicating descriptor 3 which contains the backup copy. What might not be immediately apparent is why the last redirection is needed. Inside the subshell, standard output (descriptor 1) does not point to the controlling terminal. Rather, it is pointing to a pipe that will deliver its contents to the variable <code>result</code>. Since <code>dialog</code> needs standard output to point to the terminal so that it can display the input box, we have to redirect standard error to standard output (so that the output from <code>dialog</code> ends up in the <code>result</code> variable), then redirect standard output back to the controlling terminal.</p>
<p>So, which method is better, temporary file or command substitution? Probably command substitution, since it avoids file creation.</p>
<h2 id="before-and-after">Before And After</h2>
<p>Now that we have a basic grip on how to use <code>dialog</code>, let's apply it to a practical example.</p>
<p>Here we have an &quot;ordinary&quot; script. It's a menu-driven system information program similar to one discussed in chapter 29 of TLCL:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>

<span class="co"># while-menu: a menu-driven system information program</span>

<span class="ot">DELAY=</span>3 <span class="co"># Number of seconds to display results</span>

<span class="kw">while</span> <span class="kw">true</span>; <span class="kw">do</span>
  <span class="kw">clear</span>
  <span class="kw">cat</span> <span class="kw">&lt;&lt;</span> _EOF_
Please Select:

1<span class="kw">.</span> Display System Information
2<span class="kw">.</span> Display Disk Space
3<span class="kw">.</span> Display Home Space Utilization
0<span class="kw">.</span> Quit

_EOF_

  <span class="kw">read</span> -p <span class="st">&quot;Enter selection [0-3] &gt; &quot;</span>

  <span class="kw">if </span>[[ <span class="ot">$REPLY</span> =~ ^[0-3]$ ]]; <span class="kw">then</span>
    <span class="kw">case</span> <span class="ot">$REPLY</span><span class="kw"> in</span>
      1<span class="kw">)</span>
        <span class="kw">echo</span> <span class="st">&quot;Hostname: </span><span class="ot">$HOSTNAME</span><span class="st">&quot;</span>
        <span class="kw">uptime</span>
        <span class="kw">sleep</span> <span class="ot">$DELAY</span>
        <span class="kw">continue</span>
        <span class="kw">;;</span>
      2<span class="kw">)</span>
        <span class="kw">df</span> -h
        <span class="kw">sleep</span> <span class="ot">$DELAY</span>
        <span class="kw">continue</span>
        <span class="kw">;;</span>
      3<span class="kw">)</span>
        <span class="kw">if </span>[[ <span class="ot">$(</span><span class="kw">id</span> -u<span class="ot">)</span> -eq 0 ]]; <span class="kw">then</span>
          <span class="kw">echo</span> <span class="st">&quot;Home Space Utilization (All Users)&quot;</span>
          <span class="kw">du</span> -sh /home/* <span class="kw">2&gt;</span> /dev/null
        <span class="kw">else</span>
          <span class="kw">echo</span> <span class="st">&quot;Home Space Utilization (</span><span class="ot">$USER</span><span class="st">)&quot;</span>
          <span class="kw">du</span> -sh <span class="ot">$HOME</span> <span class="kw">2&gt;</span> /dev/null
        <span class="kw">fi</span>
        <span class="kw">sleep</span> <span class="ot">$DELAY</span>
        <span class="kw">continue</span>
        <span class="kw">;;</span>
      0<span class="kw">)</span>
        <span class="kw">break</span>
        <span class="kw">;;</span>
    <span class="kw">esac</span>
  <span class="kw">else</span>
    <span class="kw">echo</span> <span class="st">&quot;Invalid entry.&quot;</span>
    <span class="kw">sleep</span> <span class="ot">$DELAY</span>
  <span class="kw">fi</span>
<span class="kw">done</span>
<span class="kw">echo</span> <span class="st">&quot;Program terminated.&quot;</span></code></pre>
<div class="figure">
<img src="images/adventure_dialog-while-menu.png" alt="A script displaying a text menu" ><p class="caption">A script displaying a text menu</p>
</div>
<p>The script displays a simple menu of choices. After the user enters a selection, the selection is validated to make sure it is one of the permitted choices (the numerals 0-3) and if successfully validated, a <code>case</code> statement is used to carry out the selected action. The results are displayed for the number of seconds defined by the <code>DELAY</code> constant, after which the whole process is repeated until the user selects the menu choice to exit the program.</p>
<p>Here is the script modified to use <code>dialog</code> to provide a new user interface:</p>
<pre class="sourceCode bash"><code class="sourceCode bash"><span class="co">#!/bin/bash</span>

<span class="co"># while-menu-dialog: a menu driven system information program</span>

<span class="ot">DIALOG_CANCEL=</span>1
<span class="ot">DIALOG_ESC=</span>255
<span class="ot">HEIGHT=</span>0
<span class="ot">WIDTH=</span>0

<span class="fu">display_result()</span> <span class="kw">{</span>
  dialog --title <span class="st">&quot;</span><span class="ot">$1</span><span class="st">&quot;</span> <span class="kw">\</span>
    --no-collapse <span class="kw">\</span>
    --msgbox <span class="st">&quot;</span><span class="ot">$result</span><span class="st">&quot;</span> 0 0
<span class="kw">}</span>

<span class="kw">while</span> <span class="kw">true</span>; <span class="kw">do</span>
  <span class="kw">exec</span> <span class="kw">3&gt;&amp;1</span>
  <span class="ot">selection=$(</span>dialog <span class="kw">\</span>
    --backtitle <span class="st">&quot;System Information&quot;</span> <span class="kw">\</span>
    --title <span class="st">&quot;Menu&quot;</span> <span class="kw">\</span>
    --clear <span class="kw">\</span>
    --cancel-label <span class="st">&quot;Exit&quot;</span> <span class="kw">\</span>
    --menu <span class="st">&quot;Please select:&quot;</span> <span class="ot">$HEIGHT</span> <span class="ot">$WIDTH</span> 4 <span class="kw">\</span>
    <span class="st">&quot;1&quot;</span> <span class="st">&quot;Display System Information&quot;</span> <span class="kw">\</span>
    <span class="st">&quot;2&quot;</span> <span class="st">&quot;Display Disk Space&quot;</span> <span class="kw">\</span>
    <span class="st">&quot;3&quot;</span> <span class="st">&quot;Display Home Space Utilization&quot;</span> <span class="kw">\</span>
    <span class="kw">2&gt;&amp;1</span> <span class="kw">1&gt;&amp;3</span><span class="ot">)</span>
  <span class="ot">exit_status=$?</span>
  <span class="kw">exec</span> <span class="kw">3&gt;&amp;</span>-
  <span class="kw">case</span> <span class="ot">$exit_status</span><span class="kw"> in</span>
    <span class="ot">$DIALOG_CANCEL</span><span class="kw">)</span>
      <span class="kw">clear</span>
      <span class="kw">echo</span> <span class="st">&quot;Program terminated.&quot;</span>
      <span class="kw">exit</span>
      <span class="kw">;;</span>
    <span class="ot">$DIALOG_ESC</span><span class="kw">)</span>
      <span class="kw">clear</span>
      <span class="kw">echo</span> <span class="st">&quot;Program aborted.&quot;</span> <span class="kw">&gt;&amp;2</span>
      <span class="kw">exit</span> 1
      <span class="kw">;;</span>
  <span class="kw">esac</span>
  <span class="kw">case</span> <span class="ot">$selection</span><span class="kw"> in</span>
    0 <span class="kw">)</span>
      <span class="kw">clear</span>
      <span class="kw">echo</span> <span class="st">&quot;Program terminated.&quot;</span>
      <span class="kw">;;</span>
    1 <span class="kw">)</span>
      <span class="ot">result=$(</span><span class="kw">echo</span> <span class="st">&quot;Hostname: </span><span class="ot">$HOSTNAME</span><span class="st">&quot;</span>; <span class="kw">uptime</span><span class="ot">)</span>
      display_result <span class="st">&quot;System Information&quot;</span>
      <span class="kw">;;</span>
    2 <span class="kw">)</span>
      <span class="ot">result=$(</span><span class="kw">df</span> -h<span class="ot">)</span>
      display_result <span class="st">&quot;Disk Space&quot;</span>
      <span class="kw">;;</span>
    3 <span class="kw">)</span>
      <span class="kw">if </span>[[ <span class="ot">$(</span><span class="kw">id</span> -u<span class="ot">)</span> -eq 0 ]]; <span class="kw">then</span>
        <span class="ot">result=$(</span><span class="kw">du</span> -sh /home/* <span class="kw">2&gt;</span> /dev/null<span class="ot">)</span>
        display_result <span class="st">&quot;Home Space Utilization (All Users)&quot;</span>
      <span class="kw">else</span>
        <span class="ot">result=$(</span><span class="kw">du</span> -sh <span class="ot">$HOME</span> <span class="kw">2&gt;</span> /dev/null<span class="ot">)</span>
        display_result <span class="st">&quot;Home Space Utilization (</span><span class="ot">$USER</span><span class="st">)&quot;</span>
      <span class="kw">fi</span>
      <span class="kw">;;</span>
  <span class="kw">esac</span>
<span class="kw">done</span></code></pre>
<div class="figure">
<img src="images/adventure_dialog-while-menu-dialog1.png" alt="Script displaying a dialog menu" ><p class="caption">Script displaying a dialog menu</p>
</div>
<div class="figure">
<img src="images/adventure_dialog-while-menu-dialog2.png" alt="Displaying results with a msgbox" ><p class="caption">Displaying results with a msgbox</p>
</div>
<p>As we can see, the script has some structural changes. First, we no longer have to validate the user's selection. The menu box only allows valid choices. Second, there is a function defined near the beginning to display the output of each selection.</p>
<p>We also notice that several of <code>dialog</code>'s common options have been used:</p>
<ul>
<li><p><strong><code>--no-collapse</code></strong> prevents <code>dialog</code> from reformatting message text. Use this when the exact presentation of the text is needed.</p></li>
<li><p><strong><code>--backtitle</code></strong> sets the title of the background under the dialog box.</p></li>
<li><p><strong><code>--clear</code></strong> clears the background of any previous dialog box.</p></li>
<li><p><strong><code>--cancel-label</code></strong> sets the string displayed on the &quot;cancel&quot; button. In this script, it is set to &quot;Exit&quot; since that is a better description of the action taken when it is selected.</p></li>
</ul>
<h2 id="limitations">Limitations</h2>
<p>While it's true that <code>dialog</code> can produce many kinds ofdialog boxes, care must be taken to remember that <code>dialog</code> has significant limitations. Some of the dialog boxes have rather odd behaviors compared to their traditional GUI counterparts. For example, the edit box used to edit text files cannot perform cut and paste and files to be edited cannot contain tab characters. The behavior of the file box is more akin to the shell's tab completion feature than to a GUI file selector.</p>
<h2 id="summing-up">Summing Up</h2>
<p>The shell is not really intended for large, interactive programs, but using <code>dialog</code> can make small to moderate interactive programs possible. It provides a useful variety of dialog boxes, allowing many types of user interactions which would be very difficult to implement with the shell alone. If we keep our expectations modest, <code>dialog</code> can be a great tool.</p>
<h2 id="further-reading">Further Reading</h2>
<ul>
<li><p>The <code>dialog</code> man page is well-written and contains a complete listing of its numerous options.</p></li>
<li><p><code>dialog</code> normally includes a large set of example programs which can be found in the <code>/usr/share/doc/dialog</code> directory.</p></li>
<li><p>The <code>dialog</code> project home page can be found at <a href="http://invisible-island.net/dialog/"><code class="url">http://invisible-island.net/dialog/</code></a></p></li>
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