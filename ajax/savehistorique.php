<?php
	include("../script/bdd.php");
	include("../classes/Tools.php");
	session_start();
	//TEST D'INTEGRITE DES DONNEES
	/*if(isset($_POST['DEP']) && isset($_POST['DEP'])  && isset($_POST['DEP'])&& &&))
	{
		echo ;
	}
	else
	{


	}*/
	$_SESSION['user']['id'] = 1;
	$adresse_dep = $_POST['DEP'];
	$adresse_arr = $_POST['ARR'];
	$longitude_dep=$_POST['LONGDEP'];
	$longitude_arr=$_POST['LATDEP'];
	$latitude_dep=$_POST['LONGARR'];
	$latitude_arr=$_POST['LATARR'];
	$id_vehicule=$_POST['IDVEHIC'];

	$tool = new Tools();
	$reponse = $tool -> infoUser($_SESSION['user']['id']);

	if ($reponse != null) {
		$id=$tool -> insertHisto($adresse_dep, $adresse_arr, $longitude_dep, $longitude_arr, $latitude_dep, $latitude_arr, $_SESSION['user']['id'], $id_vehicule);
	}
	
	if($id!=0)
	{
		$_SESSION['user']['id_historique']=$id;
	}
	echo $id;

	// $adresse_depart = array('adresse_complete' => $adresse_dep , 'longitude' => $longitude_dep , 'latitude' => $latitude_de);
	// $adresse_arrivee = array('adresse_complete' => $adresse_arr , 'longitude' => $longitude_arr , 'latitude' => $latitude_arr);
	