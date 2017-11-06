<?php
	session_start();

	$id = $_POST['valeurIdImage'];

	//On vérifie si le panier comporte déjà quelque chose
	if(!isset($_SESSION['panier']) && !is_array($_SESSION['panier'])){
		//On créer le panier 
		$_SESSION['panier'] = array();
	}
	if(!in_array($id,$_SESSION['panier'])){
		//On ajoute l'image avec son id
		$_SESSION['panier'][] = $id; 
	}
	
	//On retourne dans le catalogue
	header("Location: ../index.php");
?>