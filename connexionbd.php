
<?php
	//On inclut les fichiers utilisés
	require_once('classes/BDD.php');

	//On crée une nouvelle Base de données
	$BDD = new BDD("root","site_php","","localhost");
	//On s'y connecte
	$BDD->connexion();

	//Pour éviter les erreurs d'accent dans les mots
	$requete = $BDD->getPdo()->prepare("SET NAMES utf8");
	$requete->execute();

	//Ajout d'un prefixe et d'un suffixe pour augmenter la sécurité des mots de passe
	define("PREFIXE","15af14gh");
	define("SUFFIXE","654ighj5");

	/**
	 * 	Permet de hasher un mot de passe en 'sha256'
	 *	@param string $password le mot de passe à hasher en brute
	 *	@return string $hash le mot de passe hashé  	 
	*/
	public function hash_password ($password){

			$hash = PREFIXE.hash("sha256",$password).SUFFIXE;
			return $hash;

	}
?>