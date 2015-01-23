
<?php
function captcha()
{
	$liste = str_pad(mt_rand(1,999), 3, "0", STR_PAD_LEFT);
	// $_SESSION['captcha'] = $liste;
	return $liste;
}

function thisMail($contenu, $sujet, $from, $mail){
    try {
    $mandrill = new Mandrill('8PD2vK0-lFipgL0ovhPV0g');
    $template_name = 'Test';
    $template_content = array(
        array(
            'name' => 'Test',
            'content' => 'Test'
        )
    );
    $message = array(
                    'html' => $contenu,
                    'text' => $contenu,
                    'subject' => $sujet,
                    'from_email' => $from, //envoit
                    'from_name' => $sujet,
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
    /*$send_at = 'example send_at';*/
    $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool);
    print_r($result);
    /*
    Array
    (
        [0] => Array
            (
                [email] => recipient.email@example.com
                [status] => sent
                [reject_reason] => hard-bounce
                [_id] => abc123abc123abc123abc123abc123
            )
    
    )
    */
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}
}


function isValid($code, $ip = null)
{
    if (empty($code)) {
        return false; // Si aucun code n'est entré, on ne cherche pas plus loin
    }
    $params = [
        'secret'    => '6Ld0uwATAAAAADAu2QuLwFWwvnMt7T5a-WMwAOvb',
        'response'  => $code
    ];
    if( $ip ){
        $params['remoteip'] = $ip;
    }
    $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
    if (function_exists('curl_version')) {
        // initialisation de l'url
        $curl = curl_init($url);
        // options 
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le ser
        $response = curl_exec($curl);
    } else {
        // Si curl n'est pas dispo, un bon vieux file_get_contents
        $response = file_get_contents($url);
    }

    if (empty($response) || is_null($response)) {
        return false;
    }

    $json = json_decode($response);
    return $json->success;
}
?>