<?php
	session_start();

	//On inclut les fichiers utilisés
	require_once('form.php');
	require_once('connexionbd.php');

	//Vérification que l'utilisateur n'est pas admin, car il a une page spéciale pour le catalogue
	if(isset($_SESSION['admin'])){
		if($_SESSION['admin']){
			header('Location: administrateurSuppr.php');
		}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Site</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
</head>
<body>
	<div id="bandeau">
		<?php
			//On regarde si on a un message d'erreur
			if(isset($_GET['message'])){
				echo $_GET['message'];
			}

			//On ajoute une barre de recherche pour chercher les mots clé
			echo "<div id=\"form_recherche\">";
			$form_recherche = new form("recherche","form_recherche.php","post","");
			$form_recherche->setinput("text","motcle","Recherche par mot-clé",0);
			$form_recherche->setsubmit("validerrecherche","Go");
			$form_recherche->getform();
			echo "</div>";

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
						$image = new Image($row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]);
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
					$image = new Image($row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]);
					$afficheM = $image->afficheMiniature();
					echo $afficheM;
				}
			}
		?>
	</div>
	<div id="piedpage">

	</div>
</body>
</html>