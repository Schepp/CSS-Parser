<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Test</title>
	</head>
	<style type="text/css">
		body { font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size:12px; }
	</style>
	<body>

		<?php include('parser.php'); ?>
		<h1>Mach dich nützlich!</h1>
		<ol>
			<li>Gib in das Textfeld (einigermaßen sauberes) CSS ein</li>
			<li>Button anklicken, Output checken</li>
			<li>Falls der Output Schrott (<a href="#bugs">bekannte Bugs beachten!</a>) ist, <a href="http://twitter.com/sir_pepe">@sir_pepe</a> Bescheid geben</li>
		</ol>
		<small>Fortgeschrittene dürfen sich auch gerne an einigermaßen unsauberem CSS versuchen</small>
		<table cellpadding="16">
			<tr>
				<td valign="top">
					<h2>Zerlegt</h2>
					<pre><?php if(!empty($_POST['css'])){ print_r(parse(stripslashes($_POST['css']))); } ?></pre>
				</td>
				<td valign="top">
					<h2>Zusammengesetzt</h2>
					<pre><?php if(!empty($_POST['css'])){ echo glue(parse(stripslashes($_POST['css']))); } ?></pre>
				</td>
				<td valign="top">
					<h2>Original</h2>
					<pre><?php if(!empty($_POST['css'])){ echo $_POST['css']; } ?></pre>
				</td>
			</tr>
		</table>
		<form method="post" action="test.php">
			<textarea rows="10" cols="80" name="css"><?php if(!empty($_POST['css'])){
echo stripslashes($_POST['css']);
} else {
echo 'body { color:#000; background:#FFF; }
#content strong, #content em { font-style:italic; }

@media print {
	em { color:red; }
}'; } ?></textarea>
<br>
<input type="submit" value="Klickst du hier">
		</form>


<h1 id="bugs">Todo-Liste / bekannte Bugs:</h1>
<ul>
	<li><code>{</code> und <code>}</code> innerhalb von Strings machen alles kaputt. Bisher keine Ahnung wie sich das fixen lässt...</li>
	<li><code>!important</code> wird beim zusammenführen/überschreiben von Eigenschaften nicht beachtet</li>
</ul>

	</body>
</html>