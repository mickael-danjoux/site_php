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
					$urlc = "images/copyright/".$nomI.'.'.$extensionUpload;

					$image = new Image($nomI,$lieuI,$dateI,$evenementI,$mot_cleI,$url,$urlm,$urlc);


					//On ajoute la photo dans la base
					$BDD->insertPhoto($image);

					//On va chercher l'ID de la photo ajoutée à la BD
					$resultat = $BDD->select("id","image","url = '".$url."'");
					$resultatSelect = $resultat->fetch();

					//On modifie les url des images pour toutes les différencier
					$idI = $resultatSelect['id'];
					$insert = "'images/reelle/".$idI."_".$nomI.".".$extensionUpload."'";
					

					$BDD->modifierPhoto("url",$insert,$idI);

					$insert = "'images/miniature/".$idI."_".$nomI.".".$extensionUpload."'";
					$BDD->modifierPhoto("url_min",$insert,$idI);

					$insert = "'images/copyright/".$idI."_".$nomI.".".$extensionUpload."'";
					$BDD->modifierPhoto("url_copyright",$insert,$idI);

					//Ensuite on enregistre la photo
					$cheminDestination = "images/reelle/".$idI."_".$nomI.".".$extensionUpload;
					$resultatTransfert = move_uploaded_file($_FILES['lienImage']['tmp_name'], $cheminDestination);
					if($resultatTransfert){
						echo "Transfert réussi";
					}


					//On regarde de quelle extension est notre fichier
					if($extensionUpload == "jpg" || $extensionUpload == "jpeg"){
							//On enregistre sa miniature
						$nomDestination = "images/miniature/".$idI."_".$nomI.".".$extensionUpload;
						$source = imagecreatefromjpeg($cheminDestination);
						$destination = imagecreatetruecolor(239, 227);

						$largeur_source = imagesx($source);
						$hauteur_source = imagesy($source);

						$largeur_destination = imagesx($destination);
						$hauteur_destination = imagesy($destination);

							//On crée la miniature
						imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

							//On enregistre
						imagejpeg($destination, $nomDestination);


							//On crée le copyright
						$nomDestination = "images/copyright/".$idI."_".$nomI.".".$extensionUpload;

						$stamp = imagecreatetruecolor($largeur_source, $hauteur_source);
							//On crée la couleur du text copyright
						$grey = imagecolorallocate($stamp, 255, 255, 255);
							//On ajoute la police du text copyright
						$font = 'polices/consola.ttf';
						imagettftext($stamp, 50, 0, imagesx($stamp)/5, imagesy($stamp)/2, $grey, $font, "Copyright");

						$copyrightI = imagecreatetruecolor($largeur_source,$hauteur_source);

						//on fusionne les deux 
						imagecopyresampled($copyrightI, $source, 0, 0, 0, 0, $largeur_source, $hauteur_source, $largeur_source, $hauteur_source);
						imagecopymerge($copyrightI, $stamp, 0, 0, 0, 0, imagesx($stamp), imagesy($stamp), 50);


						imagejpeg($copyrightI, $nomDestination);

					}
					else if($extensionUpload == "gif"){
							//On enregistre sa miniature
						$nomDestination = "images/miniature/".$idI."_".$nomI.".".$extensionUpload;
						$source = imagecreatefromgif($cheminDestination);
						$destination = imagecreatetruecolor(239, 227);

						$largeur_source = imagesx($source);
						$hauteur_source = imagesy($source);

						$largeur_destination = imagesx($destination);
						$hauteur_destination = imagesy($destination);

							//On crée la miniature
						imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

							//On enregistre
						imagegif($destination, $nomDestination);

						//On crée le copyright
						$nomDestination = "images/copyright/".$idI."_".$nomI.".".$extensionUpload;

						$stamp = imagecreatetruecolor($largeur_source/2, $hauteur_source/2);
							//On crée la couleur du text copyright
						$grey = imagecolorallocate($stamp, 128, 128, 128);
							//On ajoute la police du text copyright
						$font = 'polices/consola.ttf';;
						imagettftext($stamp, 20, 0, 0, 0, $grey, $font, "Copyright");

						$copyrightI = imagecreatetruecolor($largeur_source,$hauteur_source);

						//on fusionne les deux 
						imagecopyresampled($copyrightI, $source, 0, 0, 0, 0, $largeur_source, $hauteur_source, $largeur_source, $hauteur_source);
						imagecopymerge($copyrightI, $stamp, $largeur_source/4, $hauteur_source/4, 0, 0, imagesx($stamp), imagesy($stamp), 50);

						imagegif($copyrightI, $nomDestination);
					}
					else if($extensionUpload == "png"){
							//On enregistre sa miniature
						$nomDestination = "images/miniature/".$idI."_".$nomI.".".$extensionUpload;
						$source = imagecreatefrompng($cheminDestination);
						$destination = imagecreatetruecolor(239, 227);

						$largeur_source = imagesx($source);
						$hauteur_source = imagesy($source);

						$largeur_destination = imagesx($destination);
						$hauteur_destination = imagesy($destination);

							//On crée la miniature
						imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

							//On enregistre
						imagepng($destination, $nomDestination);

						//On crée le copyright
						$nomDestination = "images/copyright/".$idI."_".$nomI.".".$extensionUpload;

						$stamp = imagecreatetruecolor($largeur_source/2, $hauteur_source/2);
							//On crée la couleur du text copyright
						$grey = imagecolorallocate($stamp, 128, 128, 128);
							//On ajoute la police du text copyright
						$font = 'polices/consola.ttf';;
						imagettftext($stamp, 20, 0, 0, 0, $grey, $font, "Copyright");

						$copyrightI = imagecreatetruecolor($largeur_source,$hauteur_source);

						//on fusionne les deux 
						imagecopyresampled($copyrightI, $source, 0, 0, 0, 0, $largeur_source, $hauteur_source, $largeur_source, $hauteur_source);
						imagecopymerge($copyrightI, $stamp, $largeur_source/4, $hauteur_source/4, 0, 0, imagesx($stamp), imagesy($stamp), 50);

						imagepng($copyrightI, $nomDestination);
					}			

					
					header('Location: administrateurAjout.php');
				}
			//}
		}
	}
?>