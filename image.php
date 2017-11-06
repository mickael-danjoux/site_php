<?php
	require_once('connexionbd.php');

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
		private $lien_page;

		public function __construct($_nom,$_lieu,$_date,$_evenement,$_mot_cle,$_url,$_url_m,$_url_copy,$_lien_page){
			$this->setNom($_nom);
			$this->setLieu($_lieu);
			$this->setDate($_date);
			$this->setEvenement($_evenement);
			$this->setMot_cle($_mot_cle);
			$this->setUrl($_url);
			$this->setUrlm($_url_m);
			$this->setUrlCopy($_url_copy);
			$this->setLienPage($_lien_page);

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

		public function setLienPage($_lien_page){
			$this->lien_page = $_lien_page;
		}

		public function getLienPage(){
			return $this->lien_page;
		}

		public function getId(){
			$resultat = $BDD->select("id","image","url ='".$this->url."'");
			return $resultat;
		}

		public function setId($_id){
			$this->id = $_id;
		}

		public function afficheMiniature(){
			$min = "<div class='image'>";
			$min .= "<div class='photo'>";
				$min .= "<a href='".$this->lien_page."'><img src='".$this->url_m."'></a>";
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

		public function creationPage(){
			//On créer le fichier
			try {
				$fichier = fopen($this->lien_page, "a");
			} 
			catch (Exception $e) {
				echo $e;
			}

			//On ouvre le fichier exemple 
			try {
				$fichierexemple = fopen("pagesImages/exemple.php", "r");
			} 
			catch (Exception $e) {
				echo $e;
			}

			//On lit le fichier exemple
			$contenu = fgets($fichierexemple);
			for ($i=1; $i < 98; $i++) { 
				$contenu .= fgets($fichierexemple);
			}

			//On ferme le fichier exemple
			fclose($fichierexemple);
			
			//on écrit dans le fichier
			fputs($fichier,$contenu);

			//on ferme le fichier puis on le rouvre avec l'option r+ (pour se mettre au début du fichier car ça ne marche pas sinon)
			fclose($fichier);
			try {
				$fichier = fopen($this->lien_page, "r+");
			} 
			catch (Exception $e) {
				echo $e;
			}

			//On se déplace de 6 lignes pour aller à celle de 'id ='
			for ($i=0; $i < 5; $i++) { 
				$temp = fgets($fichier);
			}

			//On se déplace de 7 caratères pour être après le "="
			for ($i=0; $i < 7; $i++) { 
				$temp = fgetc($fichier);
			}
			

			//On complète le fichier
			fputs($fichier,$this->id.";");

				
			//On ferme le fichier
			fclose($fichier);
		}
	}
?>