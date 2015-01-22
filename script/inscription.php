<?php 
	$x = explode('/',$_SERVER['REDIRECT_URL']);
	$url= 'http://127.0.0.1';
	for ($i=0; $i < count($x)-1 ; $i++) { 
		$url = $url.'/'.$x[$i];
		// var_dump($x[$i]);
	}
	$url = $url.'/ajax/confirmeCompete.php';

	if(isset($_POST['btnInscription'])){
		var_dump($_POST);
		$myReponse = isValid($_POST['g-recaptcha-response']);
		if($myReponse == true){
			extract($_POST);
			if(Tools::checkUser($mail) == 0):
				$uniqid = uniqid();
				$token = $nom.$uniqid.$prenom.$uniqid;
				$url = $url.'?cle='.$token;
				Tools::addUser($nom, $prenom, $mail, $mdp, $cp, $adresse, $ville, $token);
				try {
    				$mandrill = new Mandrill('zQQmx-0apGL590tyABAImg');
				    $template_content = array(
				        array(
				            'name' => 'Test',
				            'content' => 'Test'
				        )
				    );
				    $message = array(
				        'html' => '<p>Bonjour, Votre inscription a bien été pris en compte pour le finaliser, veuillez cliquer sur le lien ci-dessous :'.$url.'</p>',
				        'text' => 'Bonjour, Votre inscription a bien été pris en compte pour le finaliser, veuillez cliquer sur le lien ci-dessous :'.$url.'',
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