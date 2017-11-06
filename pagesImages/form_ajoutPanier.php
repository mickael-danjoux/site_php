<?php
	session_start();

	$id = $_POST['valeurIdImage'];

	//On vérifie si le panier comporte déjà quelque chose
	if(!isset($_SESSION['panier'])){
		//On créer le panier puis on ajoute l'image avec son id
		$_SESSION['panier'] = array($id);
	}
	else{
		//On ajoute l'image avec son id
		$_SESSION['panier'][] = $id; 
	}

	//On retourne dans le catalogue
	header("Location: index.php");
?>