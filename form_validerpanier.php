<?php
	session_start();
	require_once("connexionbd.php");

	foreach ($_SESSION['panier'] as $key) {
		$BDD->insertAchat($_SESSION['id'],$key);
	}

	unset($_SESSION['panier']);
	header('Location: paiement.php');
?>