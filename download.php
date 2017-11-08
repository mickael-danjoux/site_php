<?php
	//On assigne à une variable le lien de l'image à télécharger
	$lien = $_POST['lienImage'];

	//On enlève du lien la chaine 'images/reelle/' pour garder que le nom du fichier stocké
	$nom = substr($lien, 14);

	//On dit au navigateur qu'il s'agit d'un fichier à télécharger
	header('Content-Transfer-Encoding: binary');
	
	//On indique le nom du fichier
	header("Content-Disposition: attachment; filename='".$nom."'");

	//On envoie le fichier
	readfile($lien);
?>