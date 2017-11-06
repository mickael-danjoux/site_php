<?php
session_start();
require_once "BDD.php";
?>
	<link rel="stylesheet" href="theme.css"/>
	<?php 
		if(isset($_GET['message'])){
				echo $_GET['message'];
			}

if (!isset($_SESSION['mail'],$_SESSION['id'],$_SESSION['mdp'],$_SESSION['admin'])){
	header("Location: index.php?erreur=Veuillez vous connecté");
}

else{

	$_SESSION['panier']

     $form_valider_commande=new form("valider_commande","panier.php","post","");

    // on affiche le tableau de la facture
	echo '<table><tr><th>Article</th><th>prix</th></tr>';
	
	foreach($_SESSION['panier'] as $key => $value){
		$sum=$sum+$BDD->select("prix","image","id ='".$key."'");
		echo '<tr><td> ' . $key . '</td><td>' . $value . '</td><td><input type="radio" name="'.$key.'" checked value="supprimer" ></td></tr>';
	}
	echo '</table>';
	echo '<table><tr><th>Montant Total de la facture</th></tr>';
	echo '<tr><td>' . $sum . '</td></tr>';



$form_valider_commande->setsubmit("valider_commande","Valider la commande");

supprimerImage(){
// on verifier pour chaque article du panier si il est a supprimer
		foreach($_SESSION['panier'] as $key => $value){
			if($_POST[$key]=="on"){
				unset($_SESSION['panier'][$key]);

					}
			}
			header("Location: panier.php?message=article(s) supprimés");
		}
	
	if(!empty($_POST)){
		// redirection vers la page de paiement
		header("Location: paiement.php?");
		
			}
		

	
}
?>
<input type="button" onclick="supprimerImage()" value="Choisir un fruit">;