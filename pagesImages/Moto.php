<?php
	session_start();
	require_once('../form.php');

	$id = ;
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

			//On ajoute une barre de recherche pour chercher les mots clé
			echo "<div id='form_recherche'>";
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
		<div class="imagepage">
			<img src=''>
		</div>
		<div class="nompage">

		</div>
		<div class="lieupage">

		</div>
		<div class="datepage">

		</div>
		<div class="evenementpage">
			
		</div>
		<div class="motclepage">
			
		</div>
		
		<?php
			if(isset($_SESSION['id'],$_SESSION['mdp'],$_SESSION['mail'],$_SESSION['admin']) && $_SESSION['admin'] == 1){
				$form_suppr = new form("suppression","form_suppression.php","post","");
				$form_deconnexion->setsubmit("validersuppession","Supprimer");
				$form_deconnexion->getform();
			}
			else{
				$form_suppr = new form("ajouterpanier","form_ajouterpanier.php","post","");
				$form_deconnexion->setsubmit("ajouteraupanier","Ajouter au panier");
				$form_deconnexion->getform();
			}
		?>		
	</div>
</body>
</html><?php
	session_start();
	require_once('../form.php');

	$id = ;
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

			//On ajoute une barre de recherche pour chercher les mots clé
			echo "<div id='form_recherche'>";
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
		<div class="imagepage">
			<img src=''>
		</div>
		<div class="nompage">

		</div>
		<div class="lieupage">

		</div>
		<div class="datepage">

		</div>
		<div class="evenementpage">
			
		</div>
		<div class="motclepage">
			
		</div>
		
		<?php
			if(isset($_SESSION['id'],$_SESSION['mdp'],$_SESSION['mail'],$_SESSION['admin']) && $_SESSION['admin'] == 1){
				$form_suppr = new form("suppression","form_suppression.php","post","");
				$form_deconnexion->setsubmit("validersuppession","Supprimer");
				$form_deconnexion->getform();
			}
			else{
				$form_suppr = new form("ajouterpanier","form_ajouterpanier.php","post","");
				$form_deconnexion->setsubmit("ajouteraupanier","Ajouter au panier");
				$form_deconnexion->getform();
			}
		?>		
	</div>
</body>
</html>