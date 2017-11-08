<?php
	/**
	 * Permet de tester si l'adresse mail est une adresse valide ou pas
	 * @param string $mail le mail à vérifier
	 * @return boolean retourne 1 si l'adresse est dans un format valide
	*/
	function testMail ($mail){

		if( !filter_var($mail, FILTER_VALIDATE_EMAIL) ){
				
			// impossible d'afficher un message d'erreur ici a cause de la valeur de retour par défaut de cette fonction (remplace la chaine $_POST[mail] par le message d'erreur)
			return 0;
				
		} 

		return 1;
	}

	/**
	 *  Permet d'afficher un message d'erreur en cas de mauvaise adresse mail
	 *	@param string $mail le mail à vérifier
	 *	@return boolean retourne 1 si l'adresse est valide, affiche une erreur sinon
	*/
	function erreurMail($mail){
		if(testMail($mail)==1){
			return 1;

		}
		else
			echo "l'adresse mail saisi n'est pas correct <br>";
		return 0;
	}

	/**
	 *	Permet de vérifier si les champs (login, mot de passe et confirmer mot de passe) du formulaire sont remplis
	 *	@param string $id le login de l'utilisateur qui change son mot de passe
	 *	@param string $mdp le mot de passe de l'utilisateur
	 *	@param string $confirm_password la vérification du mot de passe de l'utilisateur
	 *	@return booloean retourne 1 si les valeurs sont correct, 0 sinon 
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