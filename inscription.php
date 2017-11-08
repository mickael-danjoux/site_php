<?php
	//On démarre la session 
	session_start();

	//On inclut les fichiers utilisés
	require_once("connexionbd.php");
	require_once("classes/form.php");
	require_once("fonctions_inscription.php");

	//On crée la variable de session 'form'
	$_SESSION['form'] = $_POST;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Galerie-Card || Inscription</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="bandeau">
		<?php
			//On regarde si on a un message d'erreur
			if(isset($_GET['message'])){
				echo $_GET['message'];
			}

			//On ajoute un lien sur la page d'accueil
			echo "<a id='accueil' href='index.php'>Accueil</a>";
				
		?>
	</div>
	<div class="contenu">
		<h1>Inscription</h1>
		<?php
			//incription utilisateur

			if (!empty($_POST)){
			
				//On sécurise les champs postés
				$_mail = htmlspecialchars($_POST['mail']);
				$_login = htmlspecialchars($_POST['login']);
				$_password = htmlspecialchars($_POST['password']);
				$_conpass = htmlspecialchars($_POST['confirm_password']);


				//On effectue la requête SQL pour vérifier si l'utilisateur n'existe pas déjà
				$resultat = $BDD->select("*","utilisateur","login = '" . $_login . "'");
				$resultat = $resultat->fetch();

				//On regarde si notre résultat est vide, si il est vide celà veut dire que l'utilisateur n'existe pas
				if(empty($resultat)){
				
					// on test les champs et affiche les messages d'erreur si necessaire
					$no_erreur_mail=erreurMail($_mail);
				
            		// on verifie que le formulaire à été validé
					$test=testValue($_login,$_password,$_conpass);
				
					// testLogin($_login);
				
					// on créer et enregistre le nouvel utilisateur
					if (($no_erreur_mail==1)&&($test==1)) {

						//On hash le mot de passe
						$hash=$BDD->hash_password($_password);
						// on créer un utilisateur
						$utilisateur=new Utilisateur ($_mail,$_login,$hash,0);
						// on l'ajoute dans la BD
						$BDD->insertUtilisateur($utilisateur);
					
						//renvoie a la page de connexion
						header("Location: index.php?message=Bienvenue ".$_POST['login']);
					}
				}
				else{
					echo "Ce login existe déjà <br>";
				}
			}
			
			//On regarde si on a déjà poster le formulaire
			if(isset($_POST['mail'],$_POST['login'])){
				//Si oui et qu'il y a des fautes dedans cela affiche le mail et le login écrit avant de poster
				$form_inscription=new form("Inscription","inscription.php","post","");
				$form_inscription->setinputValue("text","mail","Mail",1,$_POST['mail']);
				$form_inscription->setinputValue("text","login","Login",1,$_POST['login']);
				$form_inscription->setinput("password","password","Mot de passe",1);
				$form_inscription->setinput("password","confirm_password","Mot de passe",1);
				$form_inscription->setsubmit("valider_inscription","Valider");
				$form_inscription->setinput("reset","resset_inscription","",0);
				$form_inscription->getform();
			}
			else{
				//Si non, on affiche le formulaire d'inscription
				$form_inscription=new form("Inscription","inscription.php","post","");
				$form_inscription->setinputValue("text","mail","Mail",1,"");
				$form_inscription->setinputValue("text","login","Login",1,"");
				$form_inscription->setinput("password","password","Mot de passe",1);
				$form_inscription->setinput("password","confirm_password","Mot de passe",1);
				$form_inscription->setsubmit("valider_inscription","Valider");
				$form_inscription->setinput("reset","resset_inscription","",0);
				$form_inscription->getform();
			}

		?>	
	</div>
</body>
</html>