<?php
	class BDD{
		private $mail;
		private $user;
		private $password;
		private $host;
		private $bd_name;


		public function __construct($_mail,$_user,$_password,$_host,$_bd_name){
			$this->setMail($_mail);
			$this->setUser($_user);
			$this->setPassword($_password);
			$this->setHost($_host);
			$this->setBd_name($_bd_name);
		}

		public function setMail($_mail){
			$this->mail = $_mail);
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
				$dsn = 'mysql:host='.$this->host.';port=3306;dbname='.$this->bdname.'';
				$pdo = new PDO($dsn, $this->user, $this->password);
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

			$stmt = $pdo->query($requete);
			$res = $stmt->fetch();

			return $res;
		}

		public function insertUtilisateur($_mail,$_login,$_password,$_admin){

			$requete = "INSERT INTO utilisateur (mail,login,password,admin) values (?,?,?,?)";
			$stmt = $pdo->prepare($requete);
			$stmt->execute(array($_mail,$_login,$_password,$_admin));
		}

		public function insertPhoto($_photo){

			$requete = "INSERT INTO image (id,nom,lieu,date,evenement,mot_cle,url) values (?,?,?,?,?,?,?)";
			$stmt = $pdo->prepare($requete);
			$stmt->execute(array()); //a completer
		}

	}
?>