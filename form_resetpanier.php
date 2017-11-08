<?php
	//On démarre la session
	session_start();

	//On supprime la variable panier
	unset($_SESSION['panier']);

	//On retourne au panier
	header('Location: panier.php');
?>