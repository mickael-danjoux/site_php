<?php
	//On démarre la session
	session_start();

	//On inclut les fichiers utilisés
	require_once "connexionbd.php";
	require_once "classes/form.php";

	//On vérifie qu'on soit bien connecté
	if(!isset($_SESSION['id'],$_SESSION['mdp'],$_SESSION['mail'],$_SESSION['admin'])){
		//Si non, on retourne à la page d'accueil
		header('Location: index.php');
	}

	//On déclare la variable 'form' dans la session
	$_SESSION['form'] = $_POST;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Galerie-Card || Changer mot de passe</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="bandeau">	
			<?php
				//On regarde si on a un message d'erreur
				if(isset($_GET['message'])){
					echo $_GET['message'];
				}

				//lien pour la page panier
				echo "<a id='lienPanier' href='panier.php'>Panier</a>";

				//lien pour la page utilisateur
				echo "<a id='pageUtilisateur' href='pageUtilisateur.php'>Mon espace</a>";
				
				//lien pour le catalogue
				echo "<a id='catalogue' href='index.php'>Catalogue photo</a>";

				//Formulaire de déconnexion
				$form_deconnexion = new form("deconnexion","deconnexion.php","post","");
				$form_deconnexion->setsubmit("validerdeconnexion","Déconnexion");
				$form_deconnexion->getform();

			?>
		</div>
	<div class="contenu">
		<h1> Changer de mot de passe </h1>
		<?php 
			//On regarde que les champs sont bien remplis (ceux du formulaire à la fin de cette page) 
			if (!empty($_POST)){
				$_login = $_SESSION['id'];
				$password=$_POST["password"];
				$newPassword=$_POST["newPassword"];
				
				//On effectue la requête SQL pour vérifier si l'utilisateur est inscrit 
				$resultat = $BDD->select("*","utilisateur","login = '" . $_login . "'");
				$resultat = $resultat->fetch();

				//On hash l'ancien mot de passe
				$hash = $BDD->hash_password($password);
				
				//Si l'utilisateur est inscrit
				if(!empty($resultat)){
					//On vérifie le mot de passe qu'il a entré
					if($resultat[2] != $hash){
						echo" Mot de passe incorrect.\n";
						
					}
					//S'il est correct
					else{
						//On vérifie que le nouveau mot de passe ainsi que sa confirmation sont égaux (et qu'ils sont pas vide)
						if((!empty($_POST["password"]))&&($newPassword==$_POST["confirmPassword"])){
							//Si c'est bon, on hash le nouveau mot de passe et on modifie l'ancien dans la Base de données
							$pass=$BDD->hash_password($newPassword);
							$BDD->modifierMdpUtilisateur($pass,$_login);
							echo "Le mot de passe à bien été changé.\n";
							sleep(2);
							header("Location: index.php?message=mot de passe changé");
						}
						else{
							echo " Le mot de passe confirmé n'est pas identique\n";
						}


					}

				}
				else{
					echo "Une erreur est survenu, veuillez vous reconnecté en clicant <a href='index.php'> ici </a>\n";
				}

			}

			//On affiche le formulaire de changement de mot de passe
			$form_changer_mdp=new form("changer_mdp","changer_mdp.php","post","");
			$form_changer_mdp->setinput("password","password","mot de passe",1);
			$form_changer_mdp->setinput("password","newPassword","nouveau mot de passe",1);
			$form_changer_mdp->setinput("password","confirmPassword","confirmez mot de passe",1);
			$form_changer_mdp->setsubmit("valider_changer_mdp","valider");
			$form_changer_mdp->setinput("reset","resset_changer_mdp","",0);
			$form_changer_mdp->getform();
		?>
	</div>
</body>
</html>