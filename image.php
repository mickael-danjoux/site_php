<?php
	class Image{
		private $id;
		private $nom;
		private $lieu;
		private $date;
		private $evenement;
		private $mot_cle;
		private $url;

		public function __construct($_nom,$_lieu,$_date,$_evenement,$_mot_cle,$_url){
			$this->setNom($_nom);
			$this->setLieu($_lieu);
			$this->setDate($_date);
			$this->setEvenement($_evenement);
			$this->setMot_cle($_mot_cle);
			$this->setUrl($_url);
		}

<<<<<<< HEAD
=======
		

>>>>>>> 3af6de7859e553088e236f03729f487e5d495584
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