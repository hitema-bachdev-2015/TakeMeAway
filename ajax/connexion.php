<?php 
require_once('..\script\bdd.php');
	require_once('..\classes\Tools.php');

	$login = $_POST['login'];
	$mdp = $_POST['mdp'] ;
	$tls = Tools::connectUser($login,$mdp);
 echo "<div>vous etes ok</div>" ;
 var_dump($tls);

 ?>

