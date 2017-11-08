<?php
	class Utilisateur{
		//Attribut de la classe 'Utilisateur'
		private $mail;
		private $login;
		private $password;
		private $admin;

		
		/**
		 * 	Constructeur de la classe 'Utilisateur'
		 *	@param string $_mail le mail de l'utilisateur (dans la base de données)
		 *	@param string $_login le login de l'utilisateur (dans la base de données)
		 *	@param string $_password le mot de passe de l'utilisateur (dans la base de données)
		 *	@param boolean $_admin le booléen pour savoir si cet utilisateur est administrateur ou pas 
		*/
		public function __construct($_mail,$_login,$_password,$_admin){
			$this->setMail($_mail);
			$this->setLogin($_login);
			$this->setPassword($_password);
			$this->setAdmin($_admin);
		}


		/**
		 * Setter de l'attribut $mail
		 *	@param string $_mail le mail de l'utilisateur (dans la base de données)
		*/
		public function setMail($_mail){
			$this->mail = $_mail;
		}

		/**
		 * Setter de l'attribut $login
		 *	@param string $_login le login de l'utilisateur (dans la base de données)
		*/
		public function setLogin($_login){
			$this->login = $_login;
		}

		/**
		 * Setter de l'attribut $password
		 *	@param string $_password le mot de passe de l'utilisateur (dans la base de données)
		*/
		public function setPassword($_password){
			$this->password = $_password;
		}

		/**
		 * Setter de l'attribut $admin
		 *	@param boolean $_admin le booléen de l'utilisateur pour savoir si cet utilisateur est administrateur ou pas (dans la base de données)
		*/
		public function setAdmin($_admin){
			$this->admin = $_admin;
		}

		/**
		 * Getter de l'attribut $mail
		 *	@return string $this->mail le mail de l'Utilisateur
		*/
		public function getMail(){
			return $this->mail;
		}

		/**
		 * Getter de l'attribut $login
		 *	@return string $this->login le login de l'Utilisateur
		*/
		public function getLogin(){
			return $this->login;
		}

		/**
		 * Getter de l'attribut $password
		 *	@return string $this->password le password de l'Utilisateur
		*/
		public function getPassword(){
			return $this->password;
		}

		/**
		 * Getter de l'attribut $admin
		 *	@return string $this->admin le booléen de l'utilisateur pour savoir si cet utilisateur est administrateur ou pas
		*/
		public function getAdmin(){
			return $this->admin;
		}
	}
?>