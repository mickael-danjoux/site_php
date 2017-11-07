<?php
	session_start();

	require_once('form.php');
	require_once('connexionbd.php');

	if(!isset($_SESSION['admin']) || $_SESSION['admin'] == 0){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
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
				<ul id="menu_admin">
					<li><a href="administrateurAjout.php">Ajout photo</a></li>
					<li><a href="administrateurSuppr.php">Catalogue photo</a></li>
				</ul>

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
			if(isset($_SESSION['motcle'])){
				//On va chercher les images dans la base de données pour les afficher avec le mot clé
				$resultat = $BDD->select("*","image","mot_cle like '%".$_SESSION['motcle']."%'");
			
				//Si le resultat est vide on affiche qu'il n'y a pas de photo avec ce mot clé
				if($resultat == null){
					echo "Aucune image ne correspond avec ce mot clé";
				}
				else{
					//On les affiche
					foreach ($resultat as $row) {
						$image = new Image($row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10]);
						$afficheM = $image->afficheMiniature();
						echo $afficheM;
					}
				}
			}
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