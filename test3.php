<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Test 3</title>
	</head>
	<style type="text/css">
		body { font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size:12px; }
	</style>
	<body>

		<?php
			include('parser.php');
			$parser = new CssParser();
			if(!empty($_POST['file'])){
				$parser->load_files($_POST['file']);
				$parser->parse();
			}
		?>
		<h1>Mach dich nützlich!</h1>
		<ol>
			<li>Gib in das Textfeld Urls zu CSS-Dateien ein, mehrere durch ; getrennt</li>
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
					<pre><?php echo $parser->css; ?></pre>
				</td>
			</tr>
		</table>
		<form method="post" action="test3.php">
			<input type="text" name="file" value="<?php if(!empty($_POST['file'])){ echo $_POST['file']; } else { echo 'test.css;test2.css;http://abmahnr.de/style.css'; } ?>">
			<br>
			<input type="submit" value="Klickst du hier">
		</form>


	</body>
</html>