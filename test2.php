<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Test 2</title>
	</head>
	<style type="text/css">
		body { font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size:12px; }
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.3/mootools-yui-compressed.js"></script>
	<script>
		window.addEvent('domready', function(){
			var original = $('update_original');
			var parser = $('update_parser');
			var testform = $('testform');
			original.addEvent('click', function(e){
				testform.set('action', 'test2frame1.php');
				testform.set('target', 'original');
				testform.submit();
			});
			parser.addEvent('click', function(e){
				testform.set('action', 'test2frame2.php');
				testform.set('target', 'parser');
				testform.submit();
			});
		});
	</script>
	<body>


		<h1>Mach dich nützlich!</h1>
		<ol>
			<li>Gib in das erste Textfeld HTML* und in das zweite CSS ein</li>
			<li>Button anklicken, Output vergleichen</li>
			<li>Falls der Output Schrott ist, <a href="http://github.com/SirPepe/CSS-Parser/issues">Bescheid geben</a></li>
		</ol>
		<table cellpadding="16">
			<tr>
				<td valign="top">
					<h2>Originalversion</h2>
					<iframe width="500" height="240" src="" name="original" id="original"></iframe>
				</td>
				<td valign="top">
					<h2>Parserversion</h2>
					<iframe width="500" height="240" src="" name="parser" id="parser"></iframe>
				</td>
			</tr>
		</table>
		<form id="testform" method="post" action="test2frame1.php" target="original">
			<h2>HTML*</h2>
			<textarea rows="8" cols="80" name="html"><p class="foo">foobar</p></textarea>
			<h2>CSS</h2>
			<textarea rows="8" cols="80" name="css">p { color:red !important; }
.foo { color:green; }</textarea>
			<br>
			<input id="update_original" type="button" value="Originalversion updaten">
			<input id="update_parser" type="button" value="Parserversion updaten">
		</form>
		<p>
			<small>* Kein komplettes Dokument, nur Body-Inhalt</small>
		</p>


	</body>
</html>