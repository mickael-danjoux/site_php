<?php
	require_once('../connexionbd.php');

	$id = $_POST['valeurIdImage'];

	$resultat = $BDD->select("*","image","id ='".$id."'");
	$resultat = $resultat->fetch();
	
	//On ouvre le premier dossier où se situe l'image réelle, puis on la supprime
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

	//On supprimer aussi l'achat que les utilisateurs ont faient pour ne pas qu'il est de conflits
	$BDD->deleteAchat($id);

	//On retourne à la page d'accueil
	header('Location: ../index.php');
?>