<?php
	function testMail ($mail){

		if( !filter_var($mail, FILTER_VALIDATE_EMAIL) ){
				
			// impossible d'afficher un message d'erreur ici a cause de la valeur de retour par défaut de cette fonction
			return 0;
				
		} 

		return 1;
	}

	function erreurMail($mail){
		if(testMail($mail)==1){
			return 1;

		}
		else
			echo "l'adresse mail saisi n'est pas correct <br>";
		return 0;
	}

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