<?php 
	if(isset($_POST['connexion'])):
		var_dump($_POST);
		$check = Tools::checkUser($_POST['login']);

		if($check > 0){
			$mdp = uniqid();

			Tools::updateUserPass($mdp, $_POST['login']);

			$contenu = 'Bonjour, votre mot de passe a été mise à jour. Veuillez le trouver ci-joint :'.$mdp;
			$sujet = "Nouveau mot de passe - TakeMeAway";
			$from = 'navecbatchi@gmail.com';
			$mail = $_POST['login'];

			thisMail($contenu, $sujet, $from, $mail);
		}
	endif;
?>