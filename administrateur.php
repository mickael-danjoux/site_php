<?php
	session_start();

	if(!isset($_SESSION['admin']) || $_SESSION['admin'] == 0){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

</body>
</html>