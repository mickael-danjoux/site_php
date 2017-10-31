<?php
	class Image{
		private $id;
		private $nom;
		private $lieu;
		private $date;
		private $evenement;
		private $mot_cle;
		private $url;
		private $url_m;
		private $url_copyright;

		public function __construct($_nom,$_lieu,$_date,$_evenement,$_mot_cle,$_url,$_url_m,$_url_copy){
			$this->setNom($_nom);
			$this->setLieu($_lieu);
			$this->setDate($_date);
			$this->setEvenement($_evenement);
			$this->setMot_cle($_mot_cle);
			$this->setUrl($_url);
			$this->setUrlm($_url_m);
			$this->setUrlCopy($_url_copy);

		}


		public function setNom($_nom){
			$this->nom = $_nom;
		}

		public function getNom(){
			return $this->nom;
		}

		public function setLieu($_lieu){
			$this->lieu = $_lieu;
		}

		public function getLieu(){
			return $this->lieu;
		}

		public function setDate($_date){
			$this->date = $_date;
		}

		public function getDate(){
			return $this->date;
		}

		public function setEvenement($_evenement){
			$this->evenement = $_evenement;
		}

		public function getEvenement(){
			return $this->evenement;
		}

		public function setMot_cle($_mot_cle){
			$this->mot_cle = $_mot_cle;
		}

		public function getMot_cle(){
			return $this->mot_cle;
		}

		public function setUrl($_url){
			$this->url = $_url;
		}

		public function getUrl(){
			return $this->url;
		}

		public function setUrlM($_url_m){
			$this->url_m = $_url_m;
		}

		public function getUrlM(){
			return $this->url_m;
		}

		public function setUrlCopy($_url_copy){
			$this->url_copyright = $_url_copy;
		}

		public function getUrlCopy(){
			return $this->url_copyright;
		}

		public function afficheMiniature(){
			$min = "<div class='image'>";
			$min .= "<div class='photo'>";
				$min .= "<img src='".$this->url_m."'>";
			$min .= "</div>";
			$min .= "<div class='nom'>";
				$min .= $this->nom;
			$min .= "</div>";
			$min .= "<div class='lieu'>";
				$min .= $this->lieu;
			$min .= "</div>";
			$min .= "<div class='date'>";
				$min .= $this->date;
			$min .= "</div>";
			$min .= "<div class='evenement'>";
				$min .= $this->evenement;
			$min .= "</div>";
			$min .= "<div class='mot_cle'>";
				$min .= $this->mot_cle;
			$min .= "</div>";
			$min .= "</div>";

			return $min;
		}

		public function afficheMiniatureAvecSup(){
			$min = "<div class='image'>";
			$min .= "<div class='photo'>";
				$min .= "<img src='".$this->url_m."'>";
			$min .= "</div>";
			$min .= "<div class='nom'>";
				$min .= $this->nom;
			$min .= "</div>";
			$min .= "<div class='lieu'>";
				$min .= $this->lieu;
			$min .= "</div>";
			$min .= "<div class='date'>";
				$min .= $this->date;
			$min .= "</div>";
			$min .= "<div class='evenement'>";
				$min .= $this->evenement;
			$min .= "</div>";
			$min .= "<div class='mot_cle'>";
				$min .= $this->mot_cle;
			$min .= "</div>";
			$min .= "</div>";

			return $min;
		}

	}
?>