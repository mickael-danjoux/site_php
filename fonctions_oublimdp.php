<?php
	//Fonction qui génère une chaine de caractère aléatoire
	function random_string($length){
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
		$string = '';
		
		for($i=0; $i<$length; $i++){
			$string .= $chars[rand(0, strlen($chars)-1)];
		}
			
		return $string;
	}
?>