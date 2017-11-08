<?php
	session_start();
	require_once('../classes/form.php');
	require_once('../connexionbd.php');
	
	$id = 3;                                                                                                           

	//On va chercher la photo dans la bd
	$resultat = $BDD->select("*","image","id = '".$id."'");
	$resultat = $resultat->fetch();
	$image = new Image($resultat[1],$resultat[2],$resultat[3],$resultat[4],$resultat[5],$resultat[6],$resultat[7],$resultat[8],$resultat[9],$resultat[10]);

	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Galerie-Card || Image</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<div id="bandeau">
		<?php
			//On regarde si on a un message d'erreur
			if(isset($_GET['message'])){
				echo $_GET['message'];
			}

			if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
				//lien catalogue admin
				echo "<a id='lienPanier' href='../administrateurSuppr.php'>Catalogue photo</a>";
			}
			else{
				//Lien accueil
				echo "<a id='accueil' href='../index.php'>Accueil</a>";

				//lien panier
				echo "<a id='lienPanier' href='../panier.php'>Panier</a>";
			}
			

			//On regarde si on est déjà connecté ou non et on affiche le formulaire correspondant
			if(isset($_SESSION['id'],$_SESSION['mdp'],$_SESSION['mail'],$_SESSION['admin'])){
				//Formulaire de déconnexion
				$form_deconnexion = new form("deconnexion","deconnexion.php","post","");
				$form_deconnexion->setsubmit("validerdeconnexion","Deconnexion");
				$form_deconnexion->getform();

				
			}
			else{
				//Formulaire de connexion
				$form_connexion = new form("connexion","form_connexion.php","post","");
				$form_connexion->setinput("text","id","Login",1);
				$form_connexion->setinput("password","mdp","Mot de passe",1);
				$form_connexion->setsubmit("validerconnexion","Connexion");
				$form_connexion->getform();

				//Lien d'inscription
				echo "<a id='inscription' href='inscription.php'>Inscription</a>";
			}
		?>
	</div>
	<div id="contenu">
		<?php
				if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
					$admin = 1;
				}
				else{
					$admin = 0;
				}
			
			echo $image->afficheReelle($admin);
		
			if(isset($_SESSION['id'],$_SESSION['mdp'],$_SESSION['mail'],$_SESSION['admin']) && $_SESSION['admin'] == 1){
				$form_suppr = new form("suppression","form_suppression.php","post","");
				$form_suppr->setHidden("valeurIdImage", $id);
				$form_suppr->setsubmit("validersuppession","Supprimer");
				$form_suppr->getform();
			}
			else{
				$form_ajouterpanier = new form("ajouterpanier","form_ajoutPanier.php","post","");
				$form_ajouterpanier->setHidden("valeurIdImage",$id);
				$form_ajouterpanier->setsubmit("ajouteraupanier","Ajouter au panier");
				$form_ajouterpanier->getform();
			}
		?>		
	</div>
</body>
</html>