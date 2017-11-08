<?php
	/*
	*test si l'adresse mail est une adresse valide grace a la fonction filter_var.
	*entré->une chaine de charactère.
	*retourne 1 si l'adresse à un format convenable : "XXXXXX@XXXXX.XXX"
	*/
	function testMail ($mail){

		if( !filter_var($mail, FILTER_VALIDATE_EMAIL) ){
				
			// impossible d'afficher un message d'erreur ici a cause de la valeur de retour par défaut de cette fonction (remplace la chaine $_POST[mail] par le message d'erreur)
			return 0;
				
		} 

		return 1;
	}

	/*
	*fonction d'affiche du message d'erreur en cas de mauvaise adresse mail
	*entré->chaine de charactère
	*retourne 1 si l'adresse est correct
	*retourne 0 sinon et affiche un message d'erreur
	*/

	function erreurMail($mail){
		if(testMail($mail)==1){
			return 1;

		}
		else
			echo "l'adresse mail saisi n'est pas correct <br>";
		return 0;
	}

	/*
	*fonction qui test les champs de POST
	*entré->3 chaines de charactère correspondant au login, au mot de passe et le mot de passe confirmé
	*on ajoute une variable $completed qui servira de valeur de retour
	*on verifie que tous les champs soit remplis et que les 2 mdp soient identiques
	* on affiche le(s) message(s) correspondant en cas d'eereur et la variable $completed devient false
	*retourne 1 si les valeurs sont correct, 0 sinon 
	*/
	function testValue($id,$mdp,$confirm_password){

		$completed=1;

		if(empty($id)){
			echo"Le champ 'login' n'est pas remplis<br>";
			$completed=0;
		}
		if(empty($mdp)){
			echo"Veuillez entrer un mot de passe<br>";
			$completed=0;
		}
		if(empty($confirm_password)){
			echo"Veuillez confirmer votre mot de passe<br>";
			$completed=0;
		}
		if($confirm_password!=$mdp){
			echo"Le mot de passe confirmé doit être identique au mot de passe entré <br>";
			$completed=0;
		}
		if($completed==1){
			return 1;
		}

		return 0;

	}
?>