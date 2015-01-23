<?php 
	$x = explode('/',$_SERVER['REDIRECT_URL']);
	$url= 'http://127.0.0.1';
	for ($i=0; $i < count($x)-1 ; $i++) { 
		if($i>0){
			$url = $url.'/'.$x[$i];
		}else{
			$url = $url.''.$x[$i];
		}
	}
	$url = $url.'/ajax/confirmeCompete.php';

	if(isset($_POST['btnInscription'])){
		$myReponse = isValid($_POST['g-recaptcha-response']);
		if($myReponse == true){
			extract($_POST);
			if(Tools::checkUser($mail) == 0):
				$uniqid = uniqid();
				$token = $nom.$uniqid.$prenom.$uniqid;
				$url = $url.'?cle='.$token;
				Tools::addUser($nom, $prenom, $mail, $mdp, $cp, $adresse, $ville, $token);
				$contenu = 'Bonjour, Votre inscription a bien été pris en compte pour le finaliser, veuillez cliquer sur le lien ci-dessous :'.$url;
				$sujet = "Confirmation d'inscription à TakeMeAway";
				$from = 'navecbatchi@gmail.com';

				thisMail($contenu, $sujet, $from, $mail);
				header("location:connexion.html?confirmation=send");
			else:
			$error_mail = 'error';
			endif;
		}else{
			$error_captcha = 'error';
		}
	}
?>