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
			if($_condition == ""){
				//$requete = "SELECT ? FROM ?";
				//$requete = $this->pdo->prepare($requete);

				//$requete->execute(array($_attribut,$_table));

				$requete = "SELECT ".$_attribut." FROM ".$_table;

			}
			else{
				$requete = "SELECT ".$_attribut." FROM ".$_table." WHERE ".$_condition;
				//$requete = $this->pdo->prepare("SELECT ? FROM ? WHERE ?");
				//$requete->execute(array($_attribut,$_table,$_condition));

			}
			$res = $this->pdo->query($requete);
			
			if($_attribut == "*"){
				//$res = $stmt->fetch();
			}
			else{
				//$res = $stmt->fetch();
			}
			
			
			return $res;
		}

		public function insertUtilisateur($utilisateur){

			$requete = "INSERT INTO utilisateur (mail,login,password,admin) values (?,?,?,?)";
			$stmt = $this->pdo->prepare($requete);
			$stmt->execute(array($utilisateur->getMail(),$utilisateur->getLogin(),$utilisateur->getPassword(),$utilisateur->getAdmin()));
		}

		public function insertPhoto($image){

			$requete = "INSERT INTO image (id,nom,lieu,date,evenement,mot_cle,url,url_min) values (default,?,?,?,?,?,?,?)";
			$stmt = $this->pdo->prepare($requete);
			$stmt->execute(array($image->getNom(),$image->getLieu(),$image->getDate(),$image->getEvenement(),$image->getMot_cle(),$image->getUrl(),$image->getUrlM())); 
		}

		public function modifierPhoto($_attribut,$_nouvelleValeur, $_condition){
			try{
				//$requete = "UPDATE image SET :attribut = :nouvelleValeur WHERE :condition";
				$stmt = $this->pdo->prepare("UPDATE image SET :attribut = :nouvelleValeur WHERE id = :condition");
				$stmt->bindParam(':attribut',$_attribut,PDO::PARAM_STR);
				$stmt->bindParam(':nouvelleValeur',$_nouvelleValeur,PDO::PARAM_STR);
				$stmt->bindParam(':condition',$_condition,PDO::PARAM_INT);
				$stmt->execute();
			}
			catch(PDOException $e){
				echo "Echec lors de l'ajout : ".$e->getMessage();
			}
			
		}

	}
?>