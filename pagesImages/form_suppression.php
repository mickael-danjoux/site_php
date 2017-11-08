<?php
	//On inclut les fichiers utilisés
	require_once('../connexionbd.php');

	//On créée la variable '$id' pour sauvegarder l'id de l'image dans une variable
	$id = $_POST['valeurIdImage'];

	//On va chercher l'image correspondant à l'id posté
	$resultat = $BDD->select("*","image","id ='".$id."'");
	$resultat = $resultat->fetch();
	
	//On supprime l'image réelle, le copyright et la miniature ainsi que la page de l'image
	try {
		unlink("../".$resultat[6]);
		unlink("../".$resultat[7]);
		unlink("../".$resultat[8]);
		unlink("../".$resultat[9]);
	} catch (Exception $e) {
		echo $e;
	}
	//On supprime l'image de la base de données
	$BDD->deleteImage($id);

	//On supprimer aussi l'achat que les utilisateurs ont faient pour ne pas qu'il y ait de conflits
	$BDD->deleteAchat($id);

	//On retourne à la page d'accueil
	header('Location: ../index.php');
?>