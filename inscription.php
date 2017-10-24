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

		// on verifie que le formulaire à été validé
		if (!empty($_POST)){

 			// on test les champs et affiche les messages d'erreur si necessaire
			$erreur_mail=erreurMail($_POST['mail']);

			$test=testValue($_POST['id'],$_POST['mdp'],$_POST['confirm_password']);

	
			// on créer et enregistre le nouvel utilisateur
			if ($erreur_mail==0&&$test==1) {

				$hash = PREFIXE.hash("sha256",$_mdp).SUFFIXE;

				$requete = $pdo->prepare("INSERT INTO client VALUES (default,?,?,?,0)");
				$requete->execute(array($_login,$hash,$_couleur));

			
				

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