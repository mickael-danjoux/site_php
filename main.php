<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
	<meta charset="utf-8">

<head>
	<title>Site test</title>
	<link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>
	<div class="wrapper">
	<?php
		if(isset($_GET['message'])){
			echo $_GET['message'];
		}
	?>
	<h1>Connexion</h1>
	<form name="connexion" action="params.php" method="post">
		<input type="text" name="id" placeholder="Login" required
			<?php if(!empty($_SESSION['id'])){
				echo 'value="'.$_SESSION['id'].'"';
			} ?>> <br>
		<input type="password" name="mdp" placeholder="Mot de passe" required
			<?php if(!empty($_SESSION['mdp'])){
				echo 'value="'.$_SESSION['mdp'].'"';
			} ?>> <br>
		<input type="submit">
		<input type="reset"><br>
	</form>
	<a href="inscription.php">Inscription</a>
	</div>
</body>
</html>