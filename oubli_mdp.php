<?php
require_once "connexionbd.php";

session_start();
$_SESSION['form'] = $_POST;



?>

<!DOCTYPE html>
<html>
<head>
	<title>Mot de passe oublié</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="wrapper">
	<h1> Mot de passe oublié </h1>
	<p>Entrez votre login, nous vous enverrons un nouveau mot de passe à votre adresse mail.</p>

	<?php  

 		// fonction qui génère une chaine de charactère aléatoire
	function random_string($length){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i=0; $i<$length; $i++){
        $string .= $chars[rand(0, strlen($chars)-1)];
    }
    return $string;
}

	if(!empty($_POST)){
		$_login = htmlspecialchars($_POST['login']);

		//On effectue la requête SQL pour vérifier si l'utilisateur est inscrit 
		$resultat = $BDD->select("*","utilisateur","login = '" . $_login . "'");
		$resultat = $resultat->fetch();
		
		if(!empty($resultat)){

			$pass=random_string(10);
			


//envoie du mot de passe par mail

/*

$mail = $resultat[0]; // Déclaration de l'adresse de destination.

if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn|gmail).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.

{

    $passage_ligne = "\r\n";

}

else

{

    $passage_ligne = "\n";

}

//=====Déclaration des messages au format texte et au format HTML.

$message_txt = "Bonjour, voici ci-dessous votre nouveau mot de passe.\n Nous vous conseillons vivement de le changer dès votre prochaine connexion. \n".$pass;

//$message_html = "<html><head></head><body><b>Bonjour</b>, voici ci-dessous votre nouveau mot de passe. <i>script PHP</i>.</body></html>";

//==========

 

//=====Création de la boundary

$boundary = "-----=".md5(rand());

//==========

 

//=====Définition du sujet.

$sujet = "Nouveau mot de passe";

//=========

 

//=====Création du header de l'e-mail.

$header = "From: \"WeaponsB".$mail.$passage_ligne;

$header.= "Reply-to: \"WeaponsB".$mail.$passage_ligne;

$header.= "MIME-Version: 1.0".$passage_ligne;

$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

//==========

 

//=====Création du message.

$message = $passage_ligne."--".$boundary.$passage_ligne;

//=====Ajout du message au format texte.

$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;

$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

$message.= $passage_ligne.$message_txt.$passage_ligne;

//==========

$message.= $passage_ligne."--".$boundary.$passage_ligne;

//=====Ajout du message au format HTML

$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;

$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

//$message.= $passage_ligne.$message_html.$passage_ligne;

//==========

$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

//==========

 

//=====Envoi de l'e-mail.

mail($mail,$sujet,$message,$header);

//==========






*/

			$newPass=$BDD->hash_password($pass);
			 $BDD->modifierMdpUtilisateur($newPass,$_login);
			 echo "Un mail a été envoyer à l'adresse correspondant au login : ".$_login;
			 echo '<br>';
			 echo "Cliquez <a href='index.php'> ici </a> pour retourner à la page d'accueil \n";
		
			
			}
			
			else{
				
				echo "Ce login n'existe pas, veuillez entré un login existant <br> ";
			}

	}


	?>

	<form name="oubli_mdp" method="post">
		
		<input type="text" name="login" placeholder="Login" /><br>
		<input type="submit"/>
			<input type="reset"/><br>
	</form>
</div>
</body>
</html>