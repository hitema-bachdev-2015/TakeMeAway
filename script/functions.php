
<?php
function captcha()
{
	$liste = str_pad(mt_rand(1,999), 3, "0", STR_PAD_LEFT);
	// $_SESSION['captcha'] = $liste;
	return $liste;
}

function thisMail($contenu, $sujet, $from, $mail){
    try {
        $mandrill = new Mandrill('zQQmx-0apGL590tyABAImg');
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
        $result = $mandrill->messages->send($message, $async, $ip_pool);
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
        $curl = curl_init($url);
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