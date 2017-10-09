<?php
	require "bdd.php";
	session_start();
	$_SESSION = $_POST;
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>
	<div class="wrapper">
	<h1>Inscription</h1>
	<?php
		if(!empty($_POST['id']) && !empty($_POST['mdp'])){
			$requete = "INSERT INTO inscrit (identifiant,password) values (?,?)";
			//echo $requete; die();
			
			$stmt = $pdo->prepare($requete);
			
			$stmt->execute(array($_POST['id'],$_POST['mdp']));
			header("Location: main.php?message=Bienvenue ".$_POST['id']);
		}
	?>
	<form name="Inscription" method="post">
		<input type="login" name="id" placeholder="Login"><br>
			
		<input type="password" name="mdp" placeholder="Mot de passe"><br>
			
		<input type="submit">
		<input type="reset"><br>
	</form>
	</div>
</body>
</html>

