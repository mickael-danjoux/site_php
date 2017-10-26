<?php
	require_once('connexionbd.php');

	//On stock les extensions autorisée dans un tableau
	$extensionsValides = array('jpg','jpeg','gif','png');

	//On vérifie que les champs obligatoires sont bien remplis
	if($_FILES['lienImage'] == UPLOAD_ERR_NO_FILE || !isset($_POST['nomImage']) || !isset($_POST['lieuImage']) || !isset($_POST['jourImage']) || !isset($_POST['moisImage']) || !isset($_POST['anneeImage']) || !isset($_POST['evenementImage'])){
		header("Location: administrateurAjout.php?erreur=Il manque des informations dans l'ajout");
	}
	else{
		//On vérifie l'image uploadée
		//if($_FILES['lienImage']['error'] > 0){
			//header("Location: administrateurAjout.php?erreur=Erreur lors du transfert");
		//}
		//else{
			if($_FILES['lienImage']['size'] > 1000000000){
				header("Location: administrateurAjout.php?erreur=Le fichier est trop gros");
			}
			else{
				//On vérifie l'extension du fichier
				//strrchr renvoie le l'extension avec le point
				//substr ignore le premier caractère de la chaine
				//strtolower met l'extension en minuscule
				$extensionUpload = strtolower(substr(strrchr($_FILES['lienImage']['name'],'.'),1));
				if(!in_array($extensionUpload,$extensionsValides)){
					header("Location: administrateurAjout.php?erreur=Le fichier n'est pas une image");
				}
				else{
					//Un fois toutes les vérifications faites on peut enregistrer la photo dans la BD, ainsi qu'en 3 exemplaires
					//On crée des variables pour sécuriser les données entrées dans le formulaire
					$nomI = htmlspecialchars($_POST['nomImage']);
					$lieuI = htmlspecialchars($_POST['lieuImage']);
					$evenementI = htmlspecialchars($_POST['evenementImage']);

					if(isset($_POST['mot_cleImage'])){
						$mot_cleI = htmlspecialchars($_POST['mot_cleImage']);
					}
					else{
						$mot_cleI = "";
					}

					//On vérifie la date
					if(!ctype_digit($_POST['jourImage']) || !ctype_digit($_POST['moisImage']) || !ctype_digit($_POST['anneeImage'])){
						header("Location: administrateurAjout.php?erreur=La date n'est pas bonne");
					}
					else{
						if($_POST['jourImage'] <= 31 && $_POST['moisImage'] <= 12 && $_POST['anneeImage'] <= 3000){
							$dateI = $_POST['anneeImage']."-".$_POST['moisImage']."-".$_POST['jourImage'];
						}
						else{
							header("Location: administrateurAjout.php?erreur=La date n'est pas bonne");
						}
					}

					//on crée un objet image
					//variable pour les url
					$url = "images/reelle/".$nomI.'.'.$extensionUpload;
					$urlm = "images/miniature/".$nomI.'.'.$extensionUpload;

					$image = new Image($nomI,$lieuI,$dateI,$evenementI,$mot_cleI,$url,$urlm);

					//On ajoute la photo dans la base
					$BDD->insertPhoto($image);

					//On va chercher l'ID de la photo ajoutée à la BD
					$resultat = $BDD->select("id","image","url = '".$url."'");
					$resultat = $resultat->fetch();

					$insert = "'images/reelle/".$resultat['id']."_".$nomI.".".$extensionUpload."'";
					$condition = $resultat['id'];


					$BDD->modifierPhoto("url",$insert,$condition);

					
					die();
					header('Location: administrateurAjout.php');
				}
			//}
		}
	}
?>