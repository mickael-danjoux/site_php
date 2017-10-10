<?php
	class Image{
		private $id;
		private $nom;
		private $lieu;
		private $date;
		private $evenement;
		private $mot_cle;
		private $url;

		public function __construct(){
			
		}

		public function setNom($_nom){
			$this->nom = $_nom;
		}

		public function setLieu($_lieu){
			$this->lieu = $_lieu;
		}

		public function setDate($_date){
			$this->date = $_date;
		}

		public function setEvenement($_evenement){
			$this->evenement = $_evenement;
		}

		public function setMot_cle($_mot_cle){
			$this->mot_cle = $_mot_cle;
		}

		public function setUrl($_url){
			$this->url = $_url;
		}

	}
?>