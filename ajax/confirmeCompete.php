<?php 
	include("../script/bdd.php");
	include("../classes/Tools.php");
	// Le clé de vérification
	$token = $_GET['cle'];

	$verification = Tools::checkToken($token);

	if(count($verification) > 0){
		header("location:../connexion.html?confirmation=ok");
		// var_dump($verification);
	}
?>