<?php 
	session_start();
	include "form.php";
	require_once "bd.php";
?>

<!DOCTYPE html>
<html>
		<meta charset="utf-8">

	<head>
		<title>Site test</title>
		<link rel="stylesheet" type="text/css" href="theme.css">
	</head>
	<body>	
		<div class="wrapper">
		<?php
			if(isset($_GET['message'])){
				echo $_GET['message'];
			}
		
			//création du formulaire
			$form_connexion = new FormBuilder("form_connexion.php","Valider");
			//ajout de l'input login
			$form_connexion->addInput("id","text","Login",null,true);
			//ajout de l'input password
			$form_connexion->addInput("mdp","password","Mot de passe",null,true);
			//ajout de l'input reset
			$form_connexion->addInput("reset","reset",null,"Reset",false);
			//on construit le formulaire
			$form_connexion->build();
		?>
		
		<a href="inscription.php">Inscription</a>
		</div>
		<div id="photos">
			<?php
				$res = $BDD->select("*","image","");

				foreach ($res as $row) {
					echo "<div class=\"ph\">";
					echo "<img src=\"".$row[6]."\"><br>";
					echo $row[1];
					echo $row[2];
					echo $row[3];
					echo "</div>";
				}
			?>
		</div>
	</body>
</html>