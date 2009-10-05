<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Test 2</title>
	</head>
	<style type="text/css">
		<?php if($_POST['css']) { echo stripslashes($_POST['css']); } ?>
	</style>
	<body>

		<?php if($_POST['html']) { echo stripslashes($_POST['html']); } ?>

	</body>
</html>