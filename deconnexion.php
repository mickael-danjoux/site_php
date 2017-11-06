<?php
session_start();

	//On détruit toutes les variables de session 
session_destroy();

	//On retourne sur la page d'accueil
header('Location: index.php');
?>