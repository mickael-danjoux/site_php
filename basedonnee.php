<?php
	include "utilisateur.php";
	include "image.php";

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
			if($_condition == ""){
				$requete = "SELECT ".$_attribut." FROM ".$_table;
			}
			else{
				$requete = "SELECT ".$_attribut." FROM ".$_table." WHERE ".$_condition;
			}

			$stmt = $this->pdo->query($requete);
			$res = $stmt->fetch();

			return $res;
		}

		public function insertUtilisateur($utilisateur){

			$requete = "INSERT INTO utilisateur (mail,login,password,admin) values (?,?,?,?)";
			$stmt = $this->pdo->prepare($requete);
			$stmt->execute(array($utilisateur->getMail(),$utilisateur->getLogin(),$utilisateur->getPassword(),$utilisateur->getAdmin()));
		}

		public function insertPhoto($image){

			$requete = "INSERT INTO image (id,nom,lieu,date,evenement,mot_cle,url) values (?,?,?,?,?,?,?)";
			$stmt = $this->pdo->prepare($requete);
			$stmt->execute(array()); //a completer
		}

	}
?>