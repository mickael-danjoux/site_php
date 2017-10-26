<?php
	session_start();

	require_once('form.php');

	if(!isset($_SESSION['admin']) || $_SESSION['admin'] == 0){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="bandeau">
			<?php
				//On regarde si on a un message d'erreur
				if(isset($_GET['message'])){
					echo $_GET['message'];
				}
			?>
				<ul id="menu_admin">
					<li><a href="administrateurAjout.php">Ajout photo</a></li>
					<li><a href="administrateurSuppr.php">Supprimer photo</a></li>
				</ul>

			<?php	
				//Formulaire de déconnexion
					$form_deconnexion = new form("deconnexion","deconnexion.php","post","");
					$form_deconnexion->setsubmit("validerdeconnexion","Deconnexion");
					$form_deconnexion->getform();
			?>
		</div>
	</body>
</html>