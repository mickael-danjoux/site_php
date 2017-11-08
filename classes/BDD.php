<?php
	//On inclut les fichiers utilisés
	require_once("utilisateur.php");
	require_once("image.php");

	class BDD{
		//Attribut de la classe BDD
		private $user;
		private $password;
		private $host;
		private $bd_name;
		private $pdo;

		/**
		 * Constructeur de la classe BDD
		 *	@param string $_user le nom d'utilisateur pour se connecter à PhpMyAdmin
		 *  @param string $_bd_name le nom de la base utilisée
		 *  @param string $_password le mot de passe pour se connecter à PhpMyAdmin
		 *  @param string $_host l'adresse où se situe la base de données
		*/
		public function __construct($_user,$_bd_name,$_password,$_host){
			$this->setUser($_user);
			$this->setPassword($_password);
			$this->setHost($_host);
			$this->setBd_name($_bd_name);
		}

		/**
		 * Setter de l'attribut $user
		 *	@param string $_user le nom d'utilisateur pour se connecter à PhpMyAdmin
		*/
		public function setUser($_user){
			$this->user = $_user;
		}

		/**
		 * Setter de l'attribut $password
		 *	@param string $_password le mot de passe pour se connecter à PhpMyAdmin
		*/
		public function setPassword($_password){
			$this->password = $_password;
		}

		/**
		 * Setter de l'attribut $host
		 *	@param string $_host le nom d'utilisateur pour se connecter à PhpMyAdmin
		*/
		public function setHost($_host){
			$this->host = $_host;
		}


		/**
		 * Setter de l'attribut $bd_name
		 *	@param string $_bd_name le nom de la base de données utilisée
		*/
		public function setBd_name($_bd_name){
			$this->bd_name = $_bd_name;
		}

		/**
		 * Getter de l'attribut $pdo
		 *	@return pdo la base de données à laquelle on est connectée
		*/
		public function getPdo(){
			return $this->pdo;
		}

		/**
		 *  fonction qui permet de se connecter à la base de données grâce aux attributs de la classe
		*/
		public function connexion(){
			try{
				$dsn = 'mysql:host='.$this->host.';port=3306;dbname='.$this->bd_name.'';
				$this->pdo = new PDO($dsn, $this->user, $this->password);
			}
			catch (Exception $e){
				die('Erreur : ' . $e->getMessage());
			}
		}

		/**
		 * 	execute la requête sql 'SELECT'
		 *	@param string $_attribut l'attribut que l'on veut chercher grâce àa la requête
		 *  @param string $_table la table dans laquelle on va effectuer la requête
		 *	@param string $_condition la condition de la requête SQL
		 *  @return array|string qui contient le résultat de la requête effectuée (à fetch() ou pas)
		*/
		public function select($_attribut,$_table,$_condition){
			$requete = "SELECT $_attribut FROM $_table";

			if($_condition != ""){
				$requete .= " WHERE $_condition";
			}
			
			$res = $this->pdo->query($requete);
			return $res;
		}

		/**
		 * 	execute une requête SQL qui permet d'insérer des lignes dans la table 'utilisateur'
		 *	@param utilisateur $_utilisateur l'utilisateur à insérer dans la table de la base de données
		*/
		public function insertUtilisateur($utilisateur){

			$requete = "INSERT INTO utilisateur (mail,login,password,admin) values (?,?,?,?)";
			$stmt = $this->pdo->prepare($requete);
			$stmt->execute(array($utilisateur->getMail(),$utilisateur->getLogin(),$utilisateur->getPassword(),$utilisateur->getAdmin()));
		}

		/**
		 * 	execute une requête SQL qui permet d'insérer des lignes dans la table 'image'
		 *	@param image $_image l'image à insérer dans la table de la base de données
		*/
		public function insertPhoto($image){

			$requete = "INSERT INTO image (id,nom,lieu,date,evenement,mot_cle,url,url_min,url_copyright,lien_page,prix) values (default,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $this->pdo->prepare($requete);
			$stmt->execute(array($image->getNom(),$image->getLieu(),$image->getDate(),$image->getEvenement(),$image->getMot_cle(),$image->getUrl(),$image->getUrlM(),$image->getUrlCopy(),$image->getLienPage(),$image->getPrix())); 
		}

		
		/**
		 * 	execute une requête SQL qui permet de modifier des lignes dans la table 'image'
		 *	@param string $_attribut l'attribut à modifier dans la table
		 *  @param string $_nouvelleValeur la nouvelle valeur de l'attribut modifié
		 *	@param int $_condition l'id de la ligne où on va faire les modifications
		*/
		public function modifierPhoto($_attribut,$_nouvelleValeur, $_condition){
			try{
				$requete = "UPDATE image SET ".$_attribut." = ".$_nouvelleValeur." WHERE id = '".$_condition."'";
				$stmt = $this->pdo->query($requete);
			}
			catch(PDOException $e){
				echo "Echec lors de l'ajout : ".$e->getMessage();
			}
		}


		/**
		 * 	execute une requête SQL qui permet de modifier des lignes dans la table 'utilisateur'
		 *	@param string $_string le mot de passe à inserer dans la table 
		 *	@param string $_login le login qui indique la ligne où on va modifier le mot de passe
		*/
		public function modifierMdpUtilisateur($_string,$_login){
			try{
				
				$requete='UPDATE `utilisateur` SET `password`="'.$_string.'"WHERE login="'.$_login.'"';
				
				$stmt = $this->pdo->query($requete);
				

			}
			catch(PDOException $e){
				echo "Echec lors de l'ajout : ".$e->getMessage();
			}
			
		}

		/**
		 * 	execute une requête SQL qui permet de supprimer une image dans la table 'image'
		 *	@param int $_id l'id de l'image à supprimer 
		*/
		public function deleteImage($_id){
			$requete = "DELETE FROM image WHERE id ='".$_id."'";
			$stmt = $this->pdo->query($requete);
		}

		/**
		 * 	execute une requête SQL qui permet d'ajouter une ligne dans la table 'achat'
		 *	@param string $_login le login de la personne qui achète l'image 
		 *	@param int $_image l'id de l'image que la personne a achetée 
		*/
		public function insertAchat($_login, $_image){
			$requete = "INSERT INTO achat(login,id_image) values(?,?)";
			$stmt = $this->pdo->prepare($requete);
			$stmt->execute(array($_login,$_image));
		}

		/**
		 * 	execute une requête SQL qui permet de supprimer une image dans la table 'achat'
		 *	@param int $_id l'id de l'image à supprimer 
		*/
		public function deleteAchat($_id){
			$requete = "DELETE FROM achat WHERE id_image ='".$_id."'";
			$stmt = $this->pdo->query($requete);
		}

	}
?>