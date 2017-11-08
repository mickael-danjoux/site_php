<?php
	//On inclut les fichiers utilisés
	require_once('connexionbd.php');

	//On stock les extensions autorisée dans un tableau
	$extensionsValides = array('jpg','jpeg','gif','png');

	//On vérifie que les champs obligatoires sont bien remplis
	if($_FILES['lienImage'] == UPLOAD_ERR_NO_FILE || !isset($_POST['nomImage']) || !isset($_POST['lieuImage']) || !isset($_POST['jourImage']) || !isset($_POST['moisImage']) || !isset($_POST['anneeImage']) || !isset($_POST['evenementImage']) || !isset($_POST['prixImage'])){
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

					//On vérifie si il y a quelque chose dans le champs 'mot clé'
					if(isset($_POST['mot_cleImage'])){
						//S'il y a quelque chose, on sécurise la donnée entrée dans le formulaire
						$mot_cleI = htmlspecialchars($_POST['mot_cleImage']);
					}
					else{
						//Sinon on met la chaine vide
						$mot_cleI = "";
					}

					//On vérifie que la date comporte bien que des nombres
					if(!ctype_digit($_POST['jourImage']) || !ctype_digit($_POST['moisImage']) || !ctype_digit($_POST['anneeImage'])){
						header("Location: administrateurAjout.php?erreur=La date n'est pas bonne");
					}
					else{
						//On vérifie que le champs 'jour' ne dépasse pas 31, que le champs 'mois' ne dépasse pas 12 et on fixe l'année maximum à 3000 pour ne pas mettre des trop grosses dates
						if($_POST['jourImage'] <= 31 && $_POST['moisImage'] <= 12 && $_POST['anneeImage'] <= 3000){
							//On crée la date grâce à ces trois champs
							$dateI = $_POST['anneeImage']."-".$_POST['moisImage']."-".$_POST['jourImage'];
						}
						else{
							header("Location: administrateurAjout.php?erreur=La date n'est pas bonne");
						}
					}

					//On vérifie si le prix est bien un float
					if(!is_numeric($_POST['prixImage'])){
						header("Location: administrateurAjout.php?erreur=Le prix n'est pas correct");
					}
					else{$
						//Si oui, on l'ajoute à une variable
						$prixI = $_POST['prixImage'];
					}

					//On crée des variables pour les url des photos et du lien de la page photo
					$url = "images/reelle/".$nomI.'.'.$extensionUpload;
					$urlm = "images/miniature/".$nomI.'.'.$extensionUpload;
					$urlc = "images/copyright/".$nomI.'.'.$extensionUpload;
					$lienp = "pagesImages/".$nomI.'.php';

					//on crée un objet image
					$image = new Image($nomI,$lieuI,$dateI,$evenementI,$mot_cleI,$url,$urlm,$urlc,$lienp,$prixI);

					//On ajoute la photo dans la base
					$BDD->insertPhoto($image);

					//On va chercher l'ID de la photo ajoutée à la BD
					$resultat = $BDD->select("id","image","url = '".$url."'");
					$resultatSelect = $resultat->fetch();

					//On modifie les url des images pour toutes les différencier grâce à l'ID auto-incrémenté de la base
					$idI = $resultatSelect['id'];

					//On ajoute la nouvelle URL de l'image réelle
					$insert = "'images/reelle/".$idI."_".$nomI.".".$extensionUpload."'";
					$BDD->modifierPhoto("url",$insert,$idI);

					//On ajoute la nouvelle URL de l'image miniature
					$insert = "'images/miniature/".$idI."_".$nomI.".".$extensionUpload."'";
					$BDD->modifierPhoto("url_min",$insert,$idI);

					//On ajoute la nouvelle URL de l'image en copyright
					$insert = "'images/copyright/".$idI."_".$nomI.".".$extensionUpload."'";
					$BDD->modifierPhoto("url_copyright",$insert,$idI);

					//On ajoute le nouveau lien de la page image
					$insert = "'pagesImages/".$idI."_".$nomI.".php'";
					$BDD->modifierPhoto("lien_page",$insert,$idI);

					//On ajoute à l'objet image le lien de la page image
					$insert = "pagesImages/".$idI."_".$nomI.".php";
					$image->setLienPage($insert);

					//On ajoute à l'objet image l'id de celle-ci (id de la base de données)
					$image->setId($idI);


					//Ensuite on enregistre la photo réelle
					$cheminDestination = "images/reelle/".$idI."_".$nomI.".".$extensionUpload;
					$resultatTransfert = move_uploaded_file($_FILES['lienImage']['tmp_name'], $cheminDestination);
					if($resultatTransfert){
						echo "Transfert réussi";
					}


					//On regarde de quelle extension est notre fichier
					//Si l'extension est 'jpg' ou 'jpeg'
					if($extensionUpload == "jpg" || $extensionUpload == "jpeg"){

						//On enregistre sa miniature
						$nomDestination = "images/miniature/".$idI."_".$nomI.".".$extensionUpload;
						//On prend l'image source
						$source = imagecreatefromjpeg($cheminDestination);
						//On crée une image de destination d'une taille de 239px par 227px
						$destination = imagecreatetruecolor(239, 227);

						//On sauvegarde dans des variables les tailles de l'image réelle et de celle crée
						$largeur_source = imagesx($source);
						$hauteur_source = imagesy($source);

						$largeur_destination = imagesx($destination);
						$hauteur_destination = imagesy($destination);

						//On crée la miniature dans l'image créée
						imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

						//On enregistre la miniature
						imagejpeg($destination, $nomDestination);


						//On crée le copyright
						$nomDestination = "images/copyright/".$idI."_".$nomI.".".$extensionUpload;

						//On créer le tampon copyright avec un arrière plan foncé mais transparent
						$stamp = imagecreatetruecolor($largeur_source, $hauteur_source);
						//On crée la couleur du text copyright
						$grey = imagecolorallocate($stamp, 255, 255, 255);
						//On ajoute la police du text copyright
						$font = 'polices/consola.ttf';
						//On ajoute le texte au tampon
						imagettftext($stamp, 50, 0, imagesx($stamp)/5, imagesy($stamp)/2, $grey, $font, "Copyright");
						//On ajoute le fond transparent
						$copyrightI = imagecreatetruecolor($largeur_source,$hauteur_source);

						//on fusionne les deux (l'image réelle et le tampon) dans une nouvelle image 
						imagecopyresampled($copyrightI, $source, 0, 0, 0, 0, $largeur_source, $hauteur_source, $largeur_source, $hauteur_source);
						imagecopymerge($copyrightI, $stamp, 0, 0, 0, 0, imagesx($stamp), imagesy($stamp), 50);

						//On enregistre l'image avec le copyright dessus
						imagejpeg($copyrightI, $nomDestination);

					}
					//Si l'extention est 'gif'
					else if($extensionUpload == "gif"){
						
						//On enregistre sa miniature
						$nomDestination = "images/miniature/".$idI."_".$nomI.".".$extensionUpload;
						//On prend l'image source
						$source = imagecreatefromgif($cheminDestination);
						//On crée une image de destination d'une taille de 239px par 227px
						$destination = imagecreatetruecolor(239, 227);
						//On sauvegarde dans des variables les tailles de l'image réelle et de celle crée
						$largeur_source = imagesx($source);
						$hauteur_source = imagesy($source);

						$largeur_destination = imagesx($destination);
						$hauteur_destination = imagesy($destination);

						//On crée la miniature dans l'image créée
						imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

						//On enregistre la miniature
						imagegif($destination, $nomDestination);

						//On crée le copyright
						$nomDestination = "images/copyright/".$idI."_".$nomI.".".$extensionUpload;
						//On créer le tampon copyright avec un arrière plan foncé mais transparent
						$stamp = imagecreatetruecolor($largeur_source/2, $hauteur_source/2);
						//On crée la couleur du text copyright
						$grey = imagecolorallocate($stamp, 128, 128, 128);
						//On ajoute la police du text copyright
						$font = 'polices/consola.ttf';;
						//On ajoute le texte au tampon
						imagettftext($stamp, 20, 0, 0, 0, $grey, $font, "Copyright");
						//On ajoute le fond transparent
						$copyrightI = imagecreatetruecolor($largeur_source,$hauteur_source);

						//on fusionne les deux (l'image réelle et le tampon) dans une nouvelle image 
						imagecopyresampled($copyrightI, $source, 0, 0, 0, 0, $largeur_source, $hauteur_source, $largeur_source, $hauteur_source);
						imagecopymerge($copyrightI, $stamp, $largeur_source/4, $hauteur_source/4, 0, 0, imagesx($stamp), imagesy($stamp), 50);

						//On sauvegarde
						imagegif($copyrightI, $nomDestination);
					}
					//Si l'extention est 'png'
					else if($extensionUpload == "png"){
						
						//On enregistre sa miniature
						$nomDestination = "images/miniature/".$idI."_".$nomI.".".$extensionUpload;
						//On prend l'image source
						$source = imagecreatefrompng($cheminDestination);
						//On crée une image de destination d'une taille de 239px par 227px
						$destination = imagecreatetruecolor(239, 227);

						//On sauvegarde dans des variables les tailles de l'image réelle et de celle crée
						$largeur_source = imagesx($source);
						$hauteur_source = imagesy($source);

						$largeur_destination = imagesx($destination);
						$hauteur_destination = imagesy($destination);

						//On crée la miniature dans l'image créée
						imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

						//On enregistre la miniature
						imagepng($destination, $nomDestination);

						//On crée le copyright
						$nomDestination = "images/copyright/".$idI."_".$nomI.".".$extensionUpload;
						//On créer le tampon copyright avec un arrière plan foncé mais transparent
						$stamp = imagecreatetruecolor($largeur_source/2, $hauteur_source/2);
							//On crée la couleur du text copyright
						$grey = imagecolorallocate($stamp, 128, 128, 128);
							//On ajoute la police du text copyright
						$font = 'polices/consola.ttf';;
						//On ajoute le texte au tampon
						imagettftext($stamp, 20, 0, 0, 0, $grey, $font, "Copyright");
						//On ajoute le fond transparent
						$copyrightI = imagecreatetruecolor($largeur_source,$hauteur_source);

						//on fusionne les deux (l'image réelle et le tampon) dans une nouvelle image
						imagecopyresampled($copyrightI, $source, 0, 0, 0, 0, $largeur_source, $hauteur_source, $largeur_source, $hauteur_source);
						imagecopymerge($copyrightI, $stamp, $largeur_source/4, $hauteur_source/4, 0, 0, imagesx($stamp), imagesy($stamp), 50);

						//On sauvegarde
						imagepng($copyrightI, $nomDestination);
					}			

					//On crée la page de la photo
					$image->creationPage();

					//On retourne sur la page d'ajout d'image
					header('Location: administrateurAjout.php');
				}
			//}
		}
	}
?>