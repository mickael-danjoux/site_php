<?php
	//On démarre la session
	session_start();

	//On inclut les fichiers utilisés
	require_once('../classes/form.php');
	require_once('../connexionbd.php');
	
	//On créée la variable 'id' qui va être remplie grâce à la fonction creationPage() quand on ajoute une image
	$id =                                                                                                              

	//On va chercher la photo dans la bd qui correspond à l'id de la variable $id
	$resultat = $BDD->select("*","image","id = '".$id."'");
	$resultat = $resultat->fetch();

	//On crée une nouvelle image
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

			//On vérifie si l'utilisateur est admin ou pas
			//Si oui
			if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
				//lien catalogue admin
				echo "<a id='lienPanier' href='../administrateurSuppr.php'>Catalogue photo</a>";
			}
			//Si non
			else{
				//Lien accueil
				echo "<a id='accueil' href='../index.php'>Accueil</a>";

				//lien panier
				echo "<a id='lienPanier' href='../panier.php'>Panier</a>";
			}
			

			//On regarde si on est déjà connecté ou non et on affiche le formulaire correspondant
			if(isset($_SESSION['id'],$_SESSION['mdp'],$_SESSION['mail'],$_SESSION['admin'])){
				//Formulaire de déconnexion
				$form_deconnexion = new form("deconnexion","../deconnexion.php","post","");
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
			//On vérifie si on est admin ou pas
			//Si oui
			if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
				//On créée et on passe la variable $admin à 1
				$admin = 1;
			}
			//Si non
			else{
				//On créée et on passe la variable $admin à 0
				$admin = 0;
			}
			//On affiche l'image en taille réelle
			echo $image->afficheReelle($admin);

			//On vérifie qu'on est connecté et qu'on est admin 
			//Si oui
			if(isset($_SESSION['id'],$_SESSION['mdp'],$_SESSION['mail'],$_SESSION['admin']) && $_SESSION['admin'] == 1){
				//On affiche le bouton pour supprimer la photo
				$form_suppr = new form("suppression","form_suppression.php","post","");
				$form_suppr->setHidden("valeurIdImage", $id);
				$form_suppr->setsubmit("validersuppession","Supprimer");
				$form_suppr->getform();
			}
			//Si non
			else{
				//On affiche le bouton pour ajouter au panier la photo
				$form_ajouterpanier = new form("ajouterpanier","form_ajoutPanier.php","post","");
				$form_ajouterpanier->setHidden("valeurIdImage",$id);
				$form_ajouterpanier->setsubmit("ajouteraupanier","Ajouter au panier");
				$form_ajouterpanier->getform();
			}
		?>		
	</div>
</body>
</html>