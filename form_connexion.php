<?php
	session_start();

	//on vérifie si les champs sont bien remplis
	if(empty($_POST['id']) || empty($_POST['mdp'])){
		header("Location: main.php?erreur=Login ou mot de passe vide ");
	}
	else{
		//Sécurité pour réduire le spam de connexion
		sleep(1);

		//On se connecte à la base de données
		require_once('connexionbd.php');

		//on enregistre les données postées dans le formulaire et on les sécurise des caractères spéciaux
		$id = htmlspecialchars($_POST['id']);
		$mdp = htmlspecialchars($_POST['mdp']);

		//On effectue la requête SQL pour vérifier si l'utilisateur est inscrit et si il a le bon mot de passe
		$resultat = $BDD->select("*","utilisateur","login = '" . $id . "'");

		//On hash le mot de passe poster pour le comparer à celui de la base de données
		$hash = PREFIXE.hash("sha256",$mdp).SUFFIXE;

		$resultat = $resultat->fetch();

		//On regarde si notre résultat est vide, si il est vide cela veut dire que l'utilisateur n'existe pas, sinon on vérifie le mot de passe
		if(!empty($resultat)){
			if($resultat[2] != $hash){
				header("Location: index.php?erreur=Mauvaise identification");
			}
			else{
				//Si on a une bonne connexion, on peut sauvegarder les champs de session
				$_SESSION['mail'] = $resultat[0];
				$_SESSION['id'] = $resultat[1];
				$_SESSION['mdp'] = $resultat[2];
				$_SESSION['admin'] = $resultat[3];

				//Vérification si l'utilisateur est administrateur ou pas 
				if($_SESSION['admin']){
					header("Location: administrateurAjout.php");
				}
				else{
					header("Location: index.php");
				}
			}
		}
		else{
			header("Location: index.php?erreur=Mauvaise identification");
		}
	}
?>