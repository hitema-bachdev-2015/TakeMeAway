<?php
	include("../../script/bdd.php");
	include("../../classes/Vehicule.php");
	session_start();
	if(isset($_SESSION['user']['id'])&&isset($_POST['marque'])&&isset($_POST['modele'])&&isset($_POST['conso'])&&isset($_POST['type_moteur'])&&isset($_POST['type_vehicule'])){
		$vehicule = new Vehicule();
		$id=$vehicule -> insertVehicule($_SESSION['user']['id'], $_POST['marque'],$_POST['modele'],$_POST['conso'],$_POST['type_moteur'],$_POST['type_vehicule']);
		echo $id;
	}
?>