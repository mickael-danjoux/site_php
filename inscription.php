<?php
require_once "connexionbd.php";

session_start();
$_SESSION['form'] = $_POST;



?>
<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="wrapper">
		<h1>Inscription</h1>

		<?php


//incription utilisateur
		
	// test de la validitée de l'adresse mail entrée
		function testMail ($mail){

			if( !filter_var($mail, FILTER_VALIDATE_EMAIL) ){
				
				// impossible d'afficher un message d'erreur ici a cause de la valeur de retour par défaut de cette fonction
				return 0;
				
			} 

			return 1;
		}

		// affichage d'un message d'erreur si l'adresse n'est pas correct
		function erreurMail($mail){
			if(testMail($mail)==1){
				return 1;

			}
			else
				echo "l'adresse mail saisi n'est pas correct <br>";
			return 0;
		}

	//test des champs du formulaire
		function testValue($id,$mdp,$confirm_password){

			$completed=1;

			if(empty($id)){
				echo"Le champ 'login' n'est pas remplis<br>";
				$completed=0;
			}
			if(empty($mdp)){
				echo"Veuillez entrer un mot de passe<br>";
				$completed=0;
			}
			if(empty($confirm_password)){
				echo"Veuillez confirmer votre mot de passe<br>";
				$completed=0;
			}
			if($confirm_password!=$mdp){
				echo"Le mot de passe confirmé doit être identique au mot de passe entré <br>";
				$completed=0;
			}
			if($completed==1){
				return 1;
			}

			return 0;

		}
		
		
		if (!empty($_POST)){
			
		
			$_mail = htmlspecialchars($_POST['mail']);
			$_login = htmlspecialchars($_POST['login']);
		    $_password = htmlspecialchars($_POST['password']);
		    $_conpass = htmlspecialchars($_POST['confirm_password']);


	//On effectue la requête SQL pour vérifier si l'utilisateur n'existe pas déjà
		$resultat = $BDD->select("*","utilisateur","login = '" . $_login . "'");


		$resultat = $resultat->fetch();

		//On regarde si notre résultat est vide, si il est vide celà veut dire que l'utilisateur n'existe pas
		if(empty($resultat)){
			
		

 			// on test les champs et affiche les messages d'erreur si necessaire
			$no_erreur_mail=erreurMail($_mail);
			
            // on verifie que le formulaire à été validé
			$test=testValue($_login,$_password,$_conpass);
			
			// testLogin($_login);
	
			// on créer et enregistre le nouvel utilisateur
			if (($no_erreur_mail==1)&&($test==1)) {

				$hash=$BDD->hash_password($_password);
				// on créer un utilisateur
				$utilisateur=new Utilisateur ($_mail,$_login,$hash,0);
				// on l'ajoute dans la BD
				$BDD->insertUtilisateur($utilisateur);
                
			//renvoie a la page de connexion
				header("Location: index.php?message=Bienvenue ".$_POST['login']);
			}
			}
			else 
				{
					echo "Ce login existe déjà <br>";
			}

		}
		

		?>
		
		<form name="Inscription" method="post">

			<input type="text" name ="mail" placeholder="Mail" value="<?php if (isset($_POST['mail'])&&testMail($_POST['mail'])==1){echo$_POST['mail']; }?>"/><br>

			<input type="text" name="login" placeholder="Login"   value="<?php if (isset($_POST['login'])){echo$_POST['login']; }?>"/><br>
			<input type="password" name="password" placeholder="Mot de passe"/><br>
			<input type="password" name="confirm_password" placeholder="Confirmer mot de passe"/>
			
			<input type="submit">
			<input type="reset"><br>
		</form>
	</div>
</body>
</html>