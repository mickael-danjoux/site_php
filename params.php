<?php
	require "bd.php";

	session_start();
	$_SESSION = $_POST;

	//vérification si les champs sont remplis
	if(empty($_POST['id']) || empty($_POST['mdp'])){
		header("Location: main.php?message=Login ou mot de passe vide");
	}
	else{

		$requete = "SELECT password FROM utilisateur WHERE login LIKE '" . $_POST['id'] . "'";
		$stmt = $pdo->query($requete);
		$res = $stmt->fetch();
		

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
		}
		

		$requete = "SELECT admin FROM utilisateur WHERE login LIKE '" . $_POST['id'] . "'";
		$stmt = $pdo->query($requete);
		$res = $stmt->fetch();

		

		if($res['admin'] == 0){
			echo '<h1> Connecté en utilisateur </h1>';
		}
		elseif ($res['admin'] == 1) {
			echo '<h1> Connecté en admin </h1>';
		}
		

	}

?>