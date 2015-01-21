<?php 
	if(isset($_POST['btnInscription'])){
		if($_SESSION['captcha'] == $_POST['captcha']){
			extract($_POST);
			if(Tools::checkUser($mail) == 0):
				$uniqid = uniqid();
				$token = $nom.'#'.$uniqid.'#'.$prenom.'#'.$uniqid;
				Tools::addUser($nom, $prenom, $mail, $mdp, $token, $adresse, $cp, $ville, $mdt);
				try {
    				$mandrill = new Mandrill('zQQmx-0apGL590tyABAImg');
				    $template_content = array(
				        array(
				            'name' => 'Test',
				            'content' => 'Test'
				        )
				    );
				    $message = array(
				        'html' => '<p>Bonjour, Votre inscription a bien été pris en compte pour le finaliser, veuillez cliquer sur le lien ci-dessous :http://127.0.0.1/'.$_SERVER['REDIRECT_URL'].'?'.$token.'</p>',
				        'text' => 'Bonjour, Votre inscription a bien été pris en compte pour le finaliser, veuillez cliquer sur le lien ci-dessous :http://127.0.0.1/'.$_SERVER['REDIRECT_URL'].'?'.$token.'',
				        'subject' => 'example subject',
				        'from_email' => 'navecbatchi@gmail.com', //envoit
				        'from_name' => 'Example Name',
				        'to' => array(
				            array(
				                'email' => $mail, //recoit
				                'name' => 'Recipient Name',
				                'type' => 'to'
				            )
				        )
				    );
				    $async = false;
				    $ip_pool = 'Main Pool';
				    $result = $mandrill->messages->send($message, $async, $ip_pool);
				} catch(Mandrill_Error $e) {
				    // Mandrill errors are thrown as exceptions
				    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
				    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
				    throw $e;
				}
			else:
			$error_mail = 'error';
			endif;
		}else{
			$error_captcha = 'error';
		}
	}
?>
<?php

?>