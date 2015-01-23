<?php 
	if(isset($_POST['connexion'])):
		$mdp = uniqid();

		$contenu = 'Bonjour, votre mot de passe a été mise à jour. Veuillez le trouver ci-joint :'.$mdp;
		$sujet = "Nouveau mot de passe - TakeMeAway";
		$from = 'navecbatchi@gmail.com';
		$mail = $_POST['login'];

		thisMail($contenu, $sujet, $from, $mail);
	endif;
?>