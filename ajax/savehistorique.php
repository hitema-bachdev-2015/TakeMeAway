<?php
	include("../script/bdd.php");
	include("../classes/Tools.php");

	$_SESSION['user']['id'] = 1;
	$adresse_dep = "1 rue de la liberte";
	$adresse_arr = "2 rue de la liberte";
	$longitude_dep="18";
	$longitude_arr="28";
	$latitude_dep="17";
	$latitude_arr="27";
	$id_vehicule=1;

	$tool = new Tools();
	$reponse = $tool -> infoUser($_SESSION['user']['id']);

	if ($reponse != null) {
		$id=$tool -> insertHisto($adresse_dep, $adresse_arr, $longitude_dep, $longitude_arr, $latitude_dep, $latitude_arr, $_SESSION['user']['id'], $id_vehicule);
	}

	$_SESSION['user']['id_historique']=$id;
	

	// $adresse_depart = array('adresse_complete' => $adresse_dep , 'longitude' => $longitude_dep , 'latitude' => $latitude_de);
	// $adresse_arrivee = array('adresse_complete' => $adresse_arr , 'longitude' => $longitude_arr , 'latitude' => $latitude_arr);
?>