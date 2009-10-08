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

		<?php
			include('parser.php');
			$parser = new CssParser();
			if(!empty($_POST['css'])){
				$parser->load_string(stripslashes($_POST['css']));
				$parser->parse();
			}
		?>
		<h1>Mach dich nützlich!</h1>
		<ol>
			<li>Gib in das Textfeld (einigermaßen sauberes) CSS ein</li>
			<li>Button anklicken, Output checken</li>
			<li>Falls der Output Schrott ist, <a href="http://github.com/SirPepe/CSS-Parser/issues">Bescheid geben</a></li>
		</ol>
		<small>Fortgeschrittene dürfen sich auch gerne an einigermaßen unsauberem CSS versuchen</small>
		<table cellpadding="16">
			<tr>
				<td valign="top">
					<h2>Zerlegt</h2>
					<pre><?php print_r($parser->parsed); ?></pre>
				</td>
				<td valign="top">
					<h2>Zusammengesetzt</h2>
					<pre><?php echo $parser->glue(); ?></pre>
				</td>
				<td valign="top">
					<h2>Original</h2>
					<pre><?php echo htmlentities($parser->css); ?></pre>
				</td>
			</tr>
		</table>
		<form method="post" action="test.php">
			<textarea rows="26" cols="80" name="css"><?php if(!empty($parser->css)){
echo $parser->css;
} else {
echo '/* CSS comment */
body { color:#000; background:#FFF; }
#content strong, #content em { font-style:italic; }

@media print {
	em { color:red; }
}

/* CSS comment */
<!-- .pansensalat {visibility: hidden;} -->

p { content:"{"} 

strong { content:\'\"\'}
<!-- .toschoistdoof {content:\'-->\'} -->

<!-- .scheppistdoof {content:\'-\\\'->\'} -->
strong { content:\'\"\'}

a{content:\'}\'}

<!-- .wurstfinger {color:pink;} -->

span {color:green!important;}
span {color:blue;}

span[attr=""]{content:\'\'}

<!--*[attr="-->"]{content:\'\'}

<!--*[attr="-->"]{content:\'\'}

'; } ?></textarea>
<br>
<input type="submit" value="Klickst du hier">
		</form>


	</body>
</html>