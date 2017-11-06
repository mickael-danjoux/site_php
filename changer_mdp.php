<?php
session_start();
require_once "connexionbd.php";
require_once "form.php";


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
		$_login = $_SESSION['id'];
		$password=$_POST["password"];
		$newPassword=$_POST["newPassword"];
		

		//On effectue la requête SQL pour vérifier si l'utilisateur est inscrit 
		$resultat = $BDD->select("*","utilisateur","login = '" . $_login . "'");
		$resultat = $resultat->fetch();

		$hash = $BDD->hash_password($password);
		
		if(!empty($resultat)){
			if($resultat[2] != $hash){
				echo" Mot de passe incorrect.\n";
				
			}
			else{
				if((!empty($_POST["password"]))&&($newPassword==$_POST["confirmPassword"])){
					$pass=$BDD->hash_password($newPassword);
					$BDD->modifierMdpUtilisateur($pass,$_login);
					echo "Le mot de passe à bien été changé.\n";
					sleep(2);
					header("Location: index.php?message=mot de passe changé");
				}
				else{

					echo " Le mot de passe confirmé n'est pas identique\n";
				}


			}

			


		}
		else{
			echo "Une erreur est survenu, veuillez vous reconnecté en clicant <a href='index.php'> ici </a>\n";
		}

	}

	$form_changer_mdp=new form("changer_mdp","changer_mdp.php","post","");
	$form_changer_mdp->setinput("password","password","mot de passe",1);
	$form_changer_mdp->setinput("password","newPassword","nouveau mot de passe",1);
	$form_changer_mdp->setinput("password","confirmPassword","confirmez mot de passe",1);
	$form_changer_mdp->setsubmit("valider_changer_mdp","valider");
	$form_changer_mdp->setinput("reset","resset_changer_mdp","",0);
	$form_changer_mdp->getform();


	?>

	
</div>
</body>
</html>