<?php
	class Utilisateur{
		private $mail;
		private $login;
		private $password;
		private $admin;

		public function __construct($_mail,$_login,$_password,$_admin){
			$this->setMail($_mail);
			$this->setLogin($_login);
			$this->setPassword($_password);
			$this->setAdmin($_admin);
		}

<<<<<<< HEAD
=======

>>>>>>> 3af6de7859e553088e236f03729f487e5d495584
		public function setMail($_mail){
			$this->mail = $_mail;
		}

		public function setLogin($_login){
			$this->login = $_login;
		}

		public function setPassword($_password){
			$this->password = $_password;
		}

		public function setAdmin($_admin){
			$this->admin = $_admin;
		}

		public function getMail(){
			return $this->mail;
		}

		public function getLogin(){
			return $this->login;
		}

		public function getPassword(){
			return $this->password;
		}

		public function getAdmin(){
			return $this->admin;
		}
	}
?>