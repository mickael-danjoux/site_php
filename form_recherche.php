<?php
	//On démarre la session
	session_start();

	//On regarde si la variable de session 'motcle' existe et si l'utilisateur à écrit quelque chose dans la barre de recherche
	//S'il n'écrit rien et qu'il lance la recherche, cela affiche toutes les photos, sans choix de mot clé
	if((!isset($_POST['motcle']) || $_POST['motcle'] == "") && isset($_SESSION['motcle'])){

		//Suppression de la variable de session 'motcle'
		unset($_SESSION['motcle']);
	}
	else{
		//Sécurité sur la chaine entrée par l'utilisateur
		$recherche = htmlspecialchars($_POST['motcle']);

		//On assigne la variable de session à la recherche de l'utilisateur
		$_SESSION['motcle'] = $recherche;
	}

	//On renvoie sur la page principale
	header('Location: index.php');
?>