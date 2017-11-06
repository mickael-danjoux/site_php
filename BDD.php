<?php
require_once("utilisateur.php");
require_once("image.php");

class BDD{
	private $user;
	private $password;
	private $host;
	private $bd_name;
	private $pdo;


	public function __construct($_user,$_bd_name,$_password,$_host){
		$this->setUser($_user);
		$this->setPassword($_password);
		$this->setHost($_host);
		$this->setBd_name($_bd_name);
	}

	public function setUser($_user){
		$this->user = $_user;
	}

	public function setPassword($_password){
		$this->password = $_password;
	}

	public function setHost($_host){
		$this->host = $_host;
	}

	public function setBd_name($_bd_name){
		$this->bd_name = $_bd_name;
	}

	public function getPdo(){
		return $this->pdo;
	}

	public function connexion(){
		try{
			$dsn = 'mysql:host='.$this->host.';port=3306;dbname='.$this->bd_name.'';
			$this->pdo = new PDO($dsn, $this->user, $this->password);
		}
		catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
		}
	}

	public function select($_attribut,$_table,$_condition){
		$requete = "SELECT $_attribut FROM $_table";

		if($_condition != ""){
			$requete .= " WHERE $_condition";
		}
		
		$res = $this->pdo->query($requete);
		return $res;
	}

	public function insertUtilisateur($utilisateur){

		$requete = "INSERT INTO utilisateur (mail,login,password,admin) values (?,?,?,?)";
		$stmt = $this->pdo->prepare($requete);
		$stmt->execute(array($utilisateur->getMail(),$utilisateur->getLogin(),$utilisateur->getPassword(),$utilisateur->getAdmin()));
	}

	public function insertPhoto($image){

		$requete = "INSERT INTO image (id,nom,lieu,date,evenement,mot_cle,url,url_min,url_copyright,lien_page) values (default,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->pdo->prepare($requete);
		$stmt->execute(array($image->getNom(),$image->getLieu(),$image->getDate(),$image->getEvenement(),$image->getMot_cle(),$image->getUrl(),$image->getUrlM(),$image->getUrlCopy(),$image->getLienPage())); 

			//$requete = "INSERT INTO image values(default,'".$image->getNom()."','".$image->getLieu()."','".$image->getDate()."','".$image->getEvenement()."','".$image->getMot_cle()."','".$image->getUrl()."','".$image->getUrlM()."','".$image->getUrlCopy()."')";
			//$stmt = $this->pdo->query($requete);

		
	}

	public function modifierPhoto($_attribut,$_nouvelleValeur, $_condition){
		try{
				//$requete = "UPDATE image SET :attribut = :nouvelleValeur WHERE :condition";
				//$stmt = $this->pdo->prepare("UPDATE image SET :attribut = :nouvelleValeur WHERE id = :condition");
				//$stmt->bindParam(':attribut',$_attribut,PDO::PARAM_STR);
				//$stmt->bindParam(':nouvelleValeur',$_nouvelleValeur,PDO::PARAM_STR);
				//$stmt->bindParam(':condition',$_condition,PDO::PARAM_INT);
				//$stmt->execute();

			$requete = "UPDATE image SET ".$_attribut." = ".$_nouvelleValeur." WHERE id = '".$_condition."'";
			$stmt = $this->pdo->query($requete);

		}
		catch(PDOException $e){
			echo "Echec lors de l'ajout : ".$e->getMessage();
		}
		
	}

		// fonction pour modifier le MDP en cas d'oublie de mot de passe

	public function modifierMdpUtilisateur($_string,$_login){
		try{
			

			$requete='UPDATE `utilisateur` SET `password`="'.$_string.'"WHERE login="'.$_login.'"';
			
			$stmt = $this->pdo->query($requete);
			

		}
		catch(PDOException $e){
			echo "Echec lors de l'ajout : ".$e->getMessage();
		}
		
	}

	public function hash_password ($password){

		$hash = PREFIXE.hash("sha256",$password).SUFFIXE;
		return $hash;

	}

	public function deleteImage($_id){
		$requete = "DELETE FROM image WHERE id ='".$_id."'";
		$stmt = $this->pdo->query($requete);
	}

	public function insertAchat($_login, $_image){
		$requete = "INSERT INTO achat(login,id_image) values(?,?)";
		$stmt = $this->pdo->prepare($requete);
		$stmt->execute(array($_login,$_image));
	}

}
?>