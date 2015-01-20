<?php 
	if(isset($_POST['btnInscription'])){
		if($_SESSION['captcha'] == $_POST['captcha']){
			extract($_POST);
			if(Tools::checkUser($mail) == 0):
				$uniqid = uniqid();
				$token = $nom.'#'.$uniqid.'#'.$prenom.'#'.$uniqid;
				Tools::addUser($nom, $prenom, $mail, $mdp, $token, $adresse, $cp, $ville, $mdt);
			else:
			$error_mail = 'error';
			endif;
		}else{
			$error_captcha = 'error';
		}
	}
?>