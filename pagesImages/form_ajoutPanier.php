<?php
	//On démarre la session
	session_start();

	//On créée la variable '$id' pour sauvegarder l'id de l'image dans une variable
	$id = $_POST['valeurIdImage'];

	//On vérifie si le panier comporte déjà quelque chose et s'il est créée
	//Si oui 
	if(!isset($_SESSION['panier']) && !is_array($_SESSION['panier'])){
		//On créer le panier 
		$_SESSION['panier'] = array();
	}
	//On vérifie si l'image est déjà dans le panier ou pas
	//Si non
	if(!in_array($id,$_SESSION['panier'])){
		//On ajoute l'image avec son id
		$_SESSION['panier'][] = $id; 
	}
	
	//On retourne dans le catalogue
	header("Location: ../index.php");
?>