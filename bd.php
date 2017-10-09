<?php
	$user="root";
	$password="";
	$host="localhost";
	$bdname="site_php";

	//connexion à la BD
	try{
		$dsn = 'mysql:host='.$host.';port=3306;dbname='.$bdname.'';
		$pdo = new PDO($dsn, $user, $password);
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}
?>