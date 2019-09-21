<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>PHP Variable Dump</title>
		<link rel="stylesheet" href="assets/css/main.css">
	</head>
	<body>
		<?php
			require 'functions.php';
			if (array_key_exists('test', $_REQUEST)) {
				include 'test.php';
			}
		?>
	</body>
</html>