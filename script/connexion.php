<?php
	require_once('c:\xampp\htdocs\TakeMeAway\classes\Tools.php');

	if(isset($_POST['login'])):
		$login = $_POST['login'];
	$mdp = $_POST['mdp'] ;
	$tls = Tools::connectUser($login,$mdp);
 echo "<div>vous etes ok</div>" ;
 var_dump($tls);
 endif;

		?> 	