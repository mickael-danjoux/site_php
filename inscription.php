<?php
	require "bd.php";
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

	//incription utilisateur
	if (!empty($_POST)){
		// on test les champs
		if(!empty($_POST['id']) && !empty($_POST['mdp'])&&$_POST['confirm_password']==$_POST['mdp']){
			$requete = "INSERT INTO utilisateur (login,password,admin) values (?,?,?)";
			//echo $requete; die();
			
			$stmt = $pdo->prepare($requete);
			
			$stmt->execute(array($_POST['id'],$_POST['mdp'],0));
			header("Location: main.php?message=Bienvenue ".$_POST['id']);
		}
		// on affiche un message d'erreur si les champs sont incorrect
		elseif ($_POST['confirm_password']!=$_POST['mdp']) 
		{ 
			?>  <script language='javascript'>
      			alert('Le mot de passe confirmé n\'est pas identique');
   			 </script>
  		 <?php
		}
	}
		?>
	
	<form name="Inscription" method="post">
		<input type="login" name="id" placeholder="Login"><br>
			
		<input type="password" name="mdp" placeholder="Mot de passe"><br>
		<input type="password" name="confirm_password" placeholder="Confirmer mot de passe">
			
		<input type="submit">
		<input type="reset"><br>
	</form>
	</div>
</body>
</html>

