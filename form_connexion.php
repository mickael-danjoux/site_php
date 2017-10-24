<?php
	session_start();
	$_SESSION = $_POST;
	require_once "bd.php";

	//vérification si les champs sont remplis
	if(empty($_POST['id']) || empty($_POST['mdp'])){
		header("Location: main.php?message=Login ou mot de passe vide");
	}
	else{
		//Sécurité pour le spam de connexion
		sleep(1);

		//Requete select
		$res = $BDD->select("password","utilisateur","login LIKE '" . $_POST['id'] . "'");
		
		if(empty($res)){
			header("Location: main.php?message=Mauvais identifiant");
		}
		else{
			$exist = false;
			foreach ($res as $inscrit) {
				if($inscrit == $_POST['mdp'] ){
					$exist = true;
					break;
				}
			}
			if(!$exist){
				header("Location: main.php?message=Mauvais mot de passe");
			}
			else{

				//requete select
				$res = $BDD->select("admin","utilisateur","login LIKE '" . $_POST['id'] . "'");

				if($res['admin'] == 0){
					echo '<h1> Connecté en utilisateur </h1>';
				}
				elseif ($res['admin'] == 1) {
					header("Location: ajout_photo.php");
				}
			}
		}
	}
	

?>