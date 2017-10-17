<?php
	require "bd.php";
	session_start();
	$_SESSION = $_POST;
	require 'basedonnee.php'; // J'inclus la classe.
	
	
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
	
	// test de la validitée de l'adresse mail entrée
	 function testMail ($_mail){

		if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
			
  		  echo "'{$email}' n'est pas une adresse email valide.";
  		  return 0;
		} 

		return 1;
	}

	//test des cmaps du formulaire
	 function testValue($id,$mdp,$confirm_password){

		$completed=1;

		if(empty($id)){
			echo"Le champ 'login' n'est pas remplis";
			$completed=0;
		}
		if(empty($mdp)){
			echo"Veuillez entrer un mot de passe";
			$completed=0;
		}
		if($confirm_password==$mdp){
			echo"Les mot de passe doivent être identiques";
			$completed=0;
		}
		if($completed=1){
			return 1;
		}

		return 0;

	}

	if (!empty($_POST)){


		if (testValue($_POST['id'],$_POST['mdp'],$_POST['confirm_password'])==1&&testMail($_POST['mail'])==1) {
			//enregistrement dans la table

			basedonnee::insertUtilisateur($_POST['mail']),$_POST['id'],$_POST['mdp'],"0");

			//renvoie a la page de connexion
			header("Location: main.php?message=Bienvenue ".$_POST['id']);
		}
	}
		
$nom = !empty($_POST['mail']) ? $_POST['mail'] : '';
		?>
	
	<form name="Inscription" method="post">

	<input type="text" name ="mail" placeholder="Mail" value="'.$nom.'"/><br>
	
		<input type="text" name="id" placeholder="Login"   value="<?php if (isset($_POST['id'])){echo$_POST['id']; }?>"/><br>
		<input type="password" name="mdp" placeholder="Mot de passe"/><br>
		<input type="password" name="confirm_password" placeholder="Confirmer mot de passe"/>
			
		<input type="submit">
		<input type="reset"><br>
	</form>
	</div>
</body>
</html>