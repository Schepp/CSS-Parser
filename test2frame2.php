<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Test 2</title>
	</head>
	<?php
		include('parser.php');
		$parser = new CssParser();
		if(!empty($_POST['css'])){
			$parser->load_string(stripslashes($_POST['css']));
			$parser->parse();
		}
	?>
	<style type="text/css">
		<?php if($_POST['css']) { echo $parser->glue(); } ?>
	</style>
	<body>

		<?php if($_POST['html']) { echo stripslashes($_POST['html']); } ?>

	</body>
</html>