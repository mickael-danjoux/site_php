<?php
	session_start();
	require_once("connexionbd.php");
	require_once("form.php");
	require_once("image.php");

	if(!isset($_SESSION['mail'],$_SESSION['id'],$_SESSION['mdp'],$_SESSION['admin'])){
		header('Location: index.php');
	}

	if($_SESSION['admin'] == 1){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Site</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="bandeau">
		<?php
			//On regarde si on a un message d'erreur
			if(isset($_GET['message'])){
				echo $_GET['message'];
			}


			//On regarde si on est déjà connecté ou non et on affiche le formulaire correspondant
			if(isset($_SESSION['id'],$_SESSION['mdp'],$_SESSION['mail'],$_SESSION['admin'])){

				//lien changer mot de passe
				echo "<a id='changer_Mdp' href='changer_mdp.php'>Changer de mot de passe</a>";

				//lien panier
				echo "<a id='lienPanier' href='panier.php'>Panier</a>";


			}
			else{
				//Formulaire de connexion
				$form_connexion = new form("connexion","form_connexion.php","post","");
				$form_connexion->setinput("text","id","Login",1);
				$form_connexion->setinput("password","mdp","Mot de passe",1);
				$form_connexion->setsubmit("validerconnexion","Connexion");
				$form_connexion->getform();

				//lien mot de passe oublié

				echo "<a id='oubli_Mdp' href='oubli_Mdp.php'>Mot de passe oublié</a>";

				//Lien d'inscription
				echo "<a id='inscription' href='inscription.php'>Inscription</a>";
			}
			?>
		</div>
		<div id="contenu">
			<?php
				//On va chercher les photos que l'utilisateur a acheté 
				$resultatPhoto = $BDD->select("id_image","achat","login = '".$_SESSION['id']."'");
				$resultatPhoto = $resultatPhoto->fetchAll();
				echo "Vous possèdez : <br>";
				foreach ($resultatPhoto as $key) {
					echo "Image n° : ".$key[0]."<br>";

					//$resultat = $BDD->select("*","image","id='".$key[0]."'");
					//$resultat = $resultat->fetch();
					//foreach ($resultat as $key) {
						//$image = new Image($key[1],$key[2],$key[3],$key[4],$key[5],$key[6],$key[7],$key[8],$key[9]);
						//$image->afficheMiniature();
					//}
					
				}

			?>
		</div>
</body>
</html>