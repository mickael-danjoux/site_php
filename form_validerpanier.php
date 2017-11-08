<?php
	//On démarre la session
	session_start();
	//On inclut les fichiers utilisés
	require_once("connexionbd.php");

	//On ajoute dans la table 'achat' toutes les photos achetées par l'utilisateur
	foreach ($_SESSION['panier'] as $key) {
		$BDD->insertAchat($_SESSION['id'],$key);
	}

	//On supprime la variable panier pour remettre celui-ci à zéro
	unset($_SESSION['panier']);
	//On envoie l'utilisateur à la page de payement
	header('Location: paiement.php');
?>