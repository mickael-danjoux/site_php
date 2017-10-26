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

		public function __construct($_nom,$_lieu,$_date,$_evenement,$_mot_cle,$_url,$_url_m){
			$this->setNom($_nom);
			$this->setLieu($_lieu);
			$this->setDate($_date);
			$this->setEvenement($_evenement);
			$this->setMot_cle($_mot_cle);
			$this->setUrl($_url);
			$this->setUrlm($_url_m);
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

		public function afficheMiniature(){
			echo "<div class=\"image\">";
				echo "<div class=\"photo\">";
					$tmp = "<img src=\"".$this->url_m."\">";
					echo $tmp;
				echo "</div>";

				echo "<div class=\"nom\">";
					echo $this->nom;
				echo "</div>";

				echo "<div class=\"lieu\">";
					echo $this->lieu;
				echo "</div>";

				echo "<div class=\"date\">";
					echo $this->date;
				echo "</div>";

				echo "<div class=\"evenement\">";
					echo $this->evenement;
				echo "</div>";

				echo "<div class=\"mot_cle\">";
					echo $this->mot_cle;
				echo "</div>";
			echo "</div>";
		}

	}
?>