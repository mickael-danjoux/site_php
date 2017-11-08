<?php
	//On inclut les fichiers utilisés
	require_once("/connexionbd.php");

	class Image{
		//Attribut de la classe Image
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
		private $prix;

		
		/**
		 * Constructeur de la classe Image
		 *	@param string $_nom le nom de l'image (dans la base de données)
		 *  @param string $_lieu le lieu de l'image (dans la base de données)
		 *  @param string $_date la date de l'image (dans la base de données)
		 *  @param string $_evenement l'évènement de l'image (dans la base de données)
		 *	@param string $_mot_cle les mots clé de l'image (dans la base de données)
		 *	@param string $_url l'url de l'image réelle (dans la base de données)
		 *	@param string $_url_m l'url de l'image miniature (dans la base de données)
		 *	@param string $_url_copy l'url de l'image en copyright (dans la base de données)
		 *	@param string $_lien_page l'url de la page de l'image (dans la base de données)
		 *	@param float $_prix le prix de l'image (dans la base de données)
		*/
		public function __construct($_nom,$_lieu,$_date,$_evenement,$_mot_cle,$_url,$_url_m,$_url_copy,$_lien_page,$_prix){
			$this->setNom($_nom);
			$this->setLieu($_lieu);
			$this->setDate($_date);
			$this->setEvenement($_evenement);
			$this->setMot_cle($_mot_cle);
			$this->setUrl($_url);
			$this->setUrlm($_url_m);
			$this->setUrlCopy($_url_copy);
			$this->setLienPage($_lien_page);
			$this->setPrix($_prix);
		}


		/**
		 * Setter de l'attribut $nom
		 *	@param string $_nom le nom de l'image (dans la base de données)
		*/
		public function setNom($_nom){
			$this->nom = $_nom;
		}

		/**
		 * Getter de l'attribut $nom
		 *	@return string $this->nom le nom de l'Image
		*/
		public function getNom(){
			return $this->nom;
		}

		/**
		 * Setter de l'attribut $lieu
		 *	@param string $_lieu le lieu de l'image (dans la base de données)
		*/
		public function setLieu($_lieu){
			$this->lieu = $_lieu;
		}

		/**
		 * Getter de l'attribut $lieu
		 *	@return string $this->lieu le lieu de l'Image
		*/
		public function getLieu(){
			return $this->lieu;
		}

		/**
		 * Setter de l'attribut $date
		 *	@param string $_date la date de l'image (dans la base de données)
		*/
		public function setDate($_date){
			$this->date = $_date;
		}

		/**
		 * Getter de l'attribut $date
		 *	@return string $this->date la date de l'Image
		*/
		public function getDate(){
			return $this->date;
		}

		/**
		 * Setter de l'attribut $evenement
		 *	@param string $_evenement l'évènement de l'image (dans la base de données)
		*/
		public function setEvenement($_evenement){
			$this->evenement = $_evenement;
		}

		/**
		 * Getter de l'attribut $evenement
		 *	@return string $this->evenement l'évènement de l'Image
		*/
		public function getEvenement(){
			return $this->evenement;
		}

		/**
		 * Setter de l'attribut $mot_cle
		 *	@param string $_mot_cle les mots clé de l'image (dans la base de données)
		*/
		public function setMot_cle($_mot_cle){
			$this->mot_cle = $_mot_cle;
		}

		/**
		 * Getter de l'attribut $mot_cle
		 *	@return string $this->mot_cle les mots clé de l'Image
		*/
		public function getMot_cle(){
			return $this->mot_cle;
		}

		/**
		 * Setter de l'attribut $url
		 *	@param string $_url l'url de l'image réelle (dans la base de données)
		*/
		public function setUrl($_url){
			$this->url = $_url;
		}

		/**
		 * Getter de l'attribut $url
		 *	@return string $this->url l'url de l'Image réelle
		*/
		public function getUrl(){
			return $this->url;
		}

		/**
		 * Setter de l'attribut $url_m
		 *	@param string $_url_m l'url de l'image miniature (dans la base de données)
		*/
		public function setUrlM($_url_m){
			$this->url_m = $_url_m;
		}

		/**
		 * Getter de l'attribut $url_m
		 *	@return string $this->url_m l'url de l'Image miniature
		*/
		public function getUrlM(){
			return $this->url_m;
		}

		/**
		 * Setter de l'attribut $url_copy
		 *	@param string $_url_copy l'url de l'image en copyright (dans la base de données)
		*/
		public function setUrlCopy($_url_copy){
			$this->url_copyright = $_url_copy;
		}

		/**
		 * Getter de l'attribut $url_copy
		 *	@return string $this->url_copy l'url de l'Image en copyright
		*/
		public function getUrlCopy(){
			return $this->url_copyright;
		}

		/**
		 * Setter de l'attribut $lien_page
		 *	@param string $_lien_page l'url de la page de l'image (dans la base de données)
		*/
		public function setLienPage($_lien_page){
			$this->lien_page = $_lien_page;
		}

		/**
		 * Getter de l'attribut $lien_page
		 *	@return string $this->lien_page l'url de la page de l'Image
		*/
		public function getLienPage(){
			return $this->lien_page;
		}

		/**
		 * Getter de l'id d'une image (dans la base de données)
		 *	@return array(int) $resultat[0] l'id de cette Image 
		*/
		public function getId(){
			$resultat = $BDD->select("id","image","url ='".$this->url."'");
			return $resultat;
		}

		/**
		 * Setter de l'attribut $id
		 *	@param int $_id l'id de l'image (dans la base de données)
		*/
		public function setId($_id){
			$this->id = $_id;
		}

		
		/**
		 * Getter de l'attribut $prix
		 *	@return float $this->prix le prix de l'Image
		*/
		public function getPrix(){
			return $this->prix;
		}

		/**
		 * Setter de l'attribut $prix
		 *	@param float $_prix le prix de l'image (dans la base de données)
		*/
		public function setPrix($_prix){
			$this->prix = $_prix;
		}

		/**
		 * 	Permet d'afficher la miniature de l'image avec son nom, son lieu, sa date, son evenement, ses mots_clé et son prix
		 *	@return string $min le code HTML 
		*/
		public function afficheMiniature(){
			$min = "<div class='image'>";
			$min .= "<div class='photo'>";
				$min .= "<a href='".$this->lien_page."'><img src='".$this->url_m."' alt=''></a>";
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
			$min .= "<div class='prix'>";
				$min .= $this->prix." €";
			$min .= "</div>";
			$min .= "</div>";

			return $min;
		}

		/**
		 * 	Permet d'afficher l'image réelle de l'image avec son nom, son lieu, sa date, son evenement, ses mots_clé et son prix
		 *	@return string $reelle le code HTML 
		*/
		public function afficheReelle($_admin){
			$reelle = "<div class='imagepage'>";
				//On regarde si l'utilisateur est administrateur ou pas, si non, on affiche les photos avec un copyright
				if($_admin){
					$reelle .= "<img src='../".$this->getUrl()."' alt='' >";
				}
				else{
					$reelle .= "<img src='../".$this->getUrlCopy()."' alt='' >";
				}
			$reelle .= "</div>
				<div class='nompage'>";
					$reelle .= $this->getNom();
			$reelle .= "</div>
			<div class='lieupage'>";
					$reelle .= $this->getLieu();
			$reelle .= "</div>
			<div class='datepage'>";
					$reelle .= $this->getDate();
			$reelle .= "</div>
			<div class='evenementpage'>";
					$reelle .= $this->getEvenement();
			$reelle .= "</div>
			<div class='motclepage'>";
					$reelle .= $this->getMot_cle();
			$reelle .= "</div>
		 	<div class='prixpage'>";
		 		$reelle .= $this->getPrix()." €";
		 	$reelle .= "</div>";

		 	return $reelle;
		}

		
		/**
		 * 	Permet de créer la page PHP de l'image et de l'enregistrer dans le dossier 'pagesImages'
		*/
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

			//On lit le fichier exemple --- 109 le nombre de ligne du fichier exemple 
			$contenu = fgets($fichierexemple);
			for ($i=1; $i < 109; $i++) { 
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

			//On se déplace de 10 lignes pour aller à celle de 'id ='
			for ($i=0; $i < 9; $i++) { 
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