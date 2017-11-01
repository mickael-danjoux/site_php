<?php
require_once "connexionbd.php";

session_start();
$_SESSION['form'] = $_POST;



?>


<!DOCTYPE html>
<html>
<head>
	<title>Mot de passe oublié</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<h1> Changer de mot de passe </h1>
	

	<?php  
	if (!empty($_POST)){


	}


	?>

	<form name="changer_mdp" method="post">
		
		<input type="password" name="password" placeholder="mot de passe" /><br>
		<input type="password" name="newPassword" placeholder="nouveau mot de passe" /><br>
		<input type="password" name="confirmPassword" placeholder="confirmez mot de passe" /><br>

		<input type="submit"/>
			<input type="reset"/><br>
	</form>
</div>
</body>
</html>