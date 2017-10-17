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

		public function __construct(){

		}

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
	}
?>