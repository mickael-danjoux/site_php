<?php
	//On démarre la session
	session_start();

	//On inclut les fichiers utilisés
	require_once("connexionbd.php");
	require_once("classes/form.php");
	require_once("classes/image.php");

	//On vérifie si l'utilisateur est connecté
	if(!isset($_SESSION['mail'],$_SESSION['id'],$_SESSION['mdp'],$_SESSION['admin'])){
		//Si non, on le renvoie à la page d'accueil
		header('Location: index.php');
	}

	//On vérifie si l'utilisateur est administrateur ou pas
	if($_SESSION['admin'] == 1){
		//Si oui, on le renvoie à la page d'administrateur
		header('Location: administrateurSuppr.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Galerie-Card || Mon espace</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="bandeau">
		<?php
			//On regarde si on a un message d'erreur
			if(isset($_GET['message'])){
				echo $_GET['message'];
			}

			//lien pour changer de mot de passe
			echo "<a id='changer_Mdp' href='changer_mdp.php'>Changer de mot de passe</a>";

			//lien pour le panier
			echo "<a id='lienPanier' href='panier.php'>Panier</a>";

			//lien pour le catalogue photo
			echo "<a id='catalogue' href='index.php'>Catalogue photo</a>";

			//Formulaire de déconnexion
			$form_deconnexion = new form("deconnexion","deconnexion.php","post","");
			$form_deconnexion->setsubmit("validerdeconnexion","Deconnexion");
			$form_deconnexion->getform();

			?>
		</div>
		<div id="contenu">
			<?php
				//On va chercher les photos que l'utilisateur a acheté dans la table 'achat' de la base de données
				$resultatPhoto = $BDD->select("id_image","achat","login = '".$_SESSION['id']."'");
				$resultatPhoto = $resultatPhoto->fetchAll();

				echo "Vous possèdez : <br>";
				
				foreach ($resultatPhoto as $key) {
					//On affiche les images possédées
					$resultat = $BDD->select("*","image"," id ='".$key[0]."'");
					$resultat = $resultat->fetch();

					echo "<div class='lientelechargement'>";
					echo "<div class='idtelechargement'>".$resultat[0]." : </div>";
					echo "<div class='nomtelechargement'>".$resultat[1]."</div>";
					//On ajoute le bouton pour télécharger les images
					$form_download = new form("download","download.php","post","");
					$form_download->setHidden("lienImage",$resultat[6]);
					$form_download->setsubmit("telechargerfichier","Télécharger");
					$form_download->getform();

					echo "</div>";
				}

			?>
		</div>
</body>
</html>