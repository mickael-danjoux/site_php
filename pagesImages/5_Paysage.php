<?php
	session_start();
	require_once('../form.php');
	require_once('../connexionbd.php');
	
	$id = 5;                                                                                                           

	//On va chercher la photo dans la bd
	$resultat = $BDD->select("*","image","id = '".$id."'");
	$resultat = $resultat->fetch();
	$image = new Image($resultat[1],$resultat[2],$resultat[3],$resultat[4],$resultat[5],$resultat[6],$resultat[7],$resultat[8],$resultat[9]);

	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Site</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<div id="bandeau">
		<?php
			//On regarde si on a un message d'erreur
			if(isset($_GET['message'])){
				echo $_GET['message'];
			}

			if($_SESSION['admin'] != 1){
			//Lien accueil
				echo "<a id='accueil' href='../index.php'>Accueil</a>";
			}


			//On regarde si on est déjà connecté ou non et on affiche le formulaire correspondant
			if(isset($_SESSION['id'],$_SESSION['mdp'],$_SESSION['mail'],$_SESSION['admin'])){
				//Formulaire de déconnexion
				$form_deconnexion = new form("deconnexion","deconnexion.php","post","");
				$form_deconnexion->setsubmit("validerdeconnexion","Deconnexion");
				$form_deconnexion->getform();

				//lien changer mot de passe
				echo "<a id='lienPanier' href='../panier.php'>Panier</a>";
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
			echo "<div class='imagepage'>";
				//On regarde si l'utilisateur est administrateur ou pas, si non, on affiche les photos avec un copyright
				if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
					echo "<img src='../".$image->getUrl()."'>";
				}
				else{
					echo "<img src='../".$image->getUrlCopy()."'>";
				}
			echo "</div>
				<div class='nompage'>";
					echo $image->getNom();
			echo "</div>
			<div class='lieupage'>";
					echo $image->getLieu();
			echo "</div>
			<div class='datepage'>";
					echo $image->getDate();
			echo "</div>
			<div class='evenementpage'>";
					echo $image->getEvenement();
			echo "</div>
			<div class='motclepage'>";
					echo $image->getMot_cle();
			echo "</div>";
		
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