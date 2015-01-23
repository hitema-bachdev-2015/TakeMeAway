<?php 
	require_once('..\script\bdd.php');
	require_once('..\classes\Tools.php');
	
	session_start();
	
	$login = $_POST['login'];
	$mdp = $_POST['mdp'] ;
	$tls = Tools::connectUser($login,$mdp);
 
 	if($tls!=null)
 	{
 		$_SESSION['user']['id']=$tls['id'];
 		echo json_encode($tls);
 	}
 	else
 	{
 		echo json_encode("EMPTY");
 	}
 ?>

