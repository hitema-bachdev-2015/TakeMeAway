<?php 
	require_once('c:\xampp\htdocs\TakeMeAway\classes/header.php');
	$login = $_POST['login'];
	$mdp = $_POST['mdp'] ;
	$tls = Tools::connectUser($login,$mdp);
 echo "<div>vous etes ok</div>" ;
 var_dump($tls);

 ?>
