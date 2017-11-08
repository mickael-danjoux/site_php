<?php
	/**
	 * Permet de donner une chaine de caractère aléatoire d'une taille donnée
	 * @param int $length la taille de la chaine à créer
	 * @return string $string une chaine de taille $length avec des caractères aléatoires dedans 
	*/
	function random_string($length){
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
		$string = '';
		
		for($i=0; $i<$length; $i++){
			$string .= $chars[rand(0, strlen($chars)-1)];
		}
			
		return $string;
	}
?>