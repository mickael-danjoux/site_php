<?php
	//On démarre la session
	session_start();

	//On inclut les fichiers utilisés
	require_once("connexionbd.php");
	require_once("classes/form.php");

	//On regarde si on est connecté
	//Si non, on renvoie l'utilisateur sur la page d'accueil avec le message qu'il faut se connecter 
	if (!isset($_SESSION['mail'],$_SESSION['id'],$_SESSION['mdp'],$_SESSION['admin'])){
		header("Location: index.php?erreur=Veuillez-vous connecter");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Site</title>
	<link rel="stylesheet" href="style.css"/>
</head>
<body>
	<div id="bandeau">
		<?php
			//On regarde si on a un message d'erreur
			if(isset($_GET['message'])){
				echo $_GET['message'];
			}

			//Formulaire de déconnexion
			$form_deconnexion = new form("deconnexion","deconnexion.php","post","");
			$form_deconnexion->setsubmit("validerdeconnexion","Deconnexion");
			$form_deconnexion->getform();

			//lien changer mot de passe
			echo "<a id='changer_Mdp' href='changer_mdp.php'>Changer de mot de passe</a>";

			//lien pour le catalogue
			echo "<a id='catalogue' href='index.php'>Catalogue</a>";
		?>
	</div>
	<div id="contenu">
		<table id="panier">
			<tr><th>ID</th><th>Nom Image</th><th>Prix</th></tr>
			<?php
			//On créée la variable prix total a payer
			$prixTotal = 0;
			//On vérifie si le panier existe ou contient quelque chose
			if(isset($_SESSION['panier'])  && is_array($_SESSION['panier'])){
				//On affiche tout ce qu'il y a dans le panier
				foreach ($_SESSION['panier'] as $key) {
					$resultat = $BDD->select("*","image","id = '".$key."'");
					$resultat = $resultat->fetch();
					echo "<tr><td>".$resultat[0]."</td><td>".$resultat[1]."</td><td>".$resultat[10]." €</td></tr>";
					$prixTotal += $resultat[10];
				}
				//On affiche le prix total
				echo "<tr><td></td><td>Prix Total :</td><td>".$prixTotal." €</td></tr>";
			}
			?>
		</table>
		<?php
			//On vérifie si le panier est créée
			//Si oui
			if(isset($_SESSION['panier'])){
				//On affiche le formulaire pour valider le panier
				$form_validerpanier = new form("validerpanier","form_validerpanier.php","post","");
				$form_validerpanier->setsubmit("validationpanier","Acheter");
				$form_validerpanier->getform();

				//On affiche le formulaire pour vider le panier
				$form_validerpanier = new form("resetpanier","form_resetpanier.php","post","");
				$form_validerpanier->setsubmit("reinitialisationpanier","Vider");
				$form_validerpanier->getform();
			}
		?>
	</div>
</body>
</html>