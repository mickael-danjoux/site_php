<?php
	require_once "bd.php";
	session_start();
	$_SESSION['form'] = $_POST;
	

	
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
	 function testMail ($mail){

		if( !filter_var($mail, FILTER_VALIDATE_EMAIL) ){
			
  		 
  		  return 0;
		} 

		return 1;
	}

	//test des cmaps du formulaire
	 function testValue($mail,$id,$mdp,$confirm_password){

		$completed=1;

		if(empty($id)){
			echo"Le champ 'login' n'est pas remplis<br>";
			$completed=0;
		}
		if(empty($mdp)){
			echo"Veuillez entrer un mot de passe<br>";
			$completed=0;
		}
		if($confirm_password==$mdp){
			echo"Les mot de passe doivent être identiques<br>";
			$completed=0;
		}
		if($completed=1){
			return 1;
		}

		return 0;

	}

	if (!empty($_POST)){


		if (testMail($_POST['mail'])==1&&testValue($_POST['id'],$_POST['mdp'],$_POST['confirm_password'])==1) {
			//enregistrement dans la table

		$utilisateur=new Utilisateur ($_POST['mail'],$_POST['id'],$_POST['mdp'],0);

			//renvoie a la page de connexion
			header("Location: main.php?message=Bienvenue ".$_POST['id']);
		}
	}
		

		?>
	
	<form name="Inscription" method="post">

	<input type="text" name ="mail" placeholder="Mail" value="<?php if (isset($_POST['mail'])&&testMail($_POST['mail'])==1){echo$_POST['mail']; }?>"/><br>

		<input type="text" name="id" placeholder="Login"   value="<?php if (isset($_POST['id'])){echo$_POST['id']; }?>"/><br>
		<input type="password" name="mdp" placeholder="Mot de passe"/><br>
		<input type="password" name="confirm_password" placeholder="Confirmer mot de passe"/>
			
		<input type="submit">
		<input type="reset"><br>
	</form>
	</div>
</body>
</html>