<?php
	//On démarre la session
	session_start();

	//On inclut les fichiers utilisés
	require_once('classes/form.php');
	require_once('connexionbd.php');

	//On regarde si on est connecté en tant qu'administrateur
	if(!isset($_SESSION['admin']) || $_SESSION['admin'] == 0){
		//Si non, on retourne à la page d'accueil
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Galerie-Card || Administrateur</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="bandeau">
			<?php
				//On regarde si on a un message d'erreur
				if(isset($_GET['message'])){
					echo $_GET['message'];
				}
			?>
				
				<a id="ajoutPhoto" href="administrateurAjout.php">Ajout photo</a>
				<a class="cataloguePhoto" href="administrateurSuppr.php">Catalogue photo</a>
				

			<?php	
				//Formulaire de déconnexion
				$form_deconnexion = new form("deconnexion","deconnexion.php","post","");
				$form_deconnexion->setsubmit("validerdeconnexion","Deconnexion");
				$form_deconnexion->getform();
			?>
		</div>
		<div id="contenu">
			<?php

				//On ajoute la recherche par mot clé
				//S'il y a un mot clé
				if(isset($_SESSION['motcle'])){
					//On va chercher les images qui comporte le mot clé dans la base de données pour les afficher
					$resultat = $BDD->select("*","image","mot_cle like '%".$_SESSION['motcle']."%'");
				
					//Si le resultat est vide on affiche qu'il n'y a pas de photo avec ce mot clé
					if($resultat == null){
						echo "Aucune image ne correspond avec ce mot clé";
					}
					else{
						//Sinon on les affiche
						foreach ($resultat as $row) {
							$image = new Image($row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10]);
							$afficheM = $image->afficheMiniature();
							echo $afficheM;
						}
					}
				}
				//Sinon
				else{
					//On va chercher les images dans la base de données pour les afficher
					$resultat = $BDD->select("*","image","");
				
					//On les affiche
					foreach ($resultat as $row) {
						$image = new Image($row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10]);
						$afficheM = $image->afficheMiniature();
						echo $afficheM;
					}
				}
			?>
		</div>
	</body>
</html>