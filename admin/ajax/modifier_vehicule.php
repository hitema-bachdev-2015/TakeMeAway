<?php
	include("../../script/bdd.php");
	include("../../classes/Vehicule.php");
	if(isset($_POST['id'])&&isset($_POST['marque'])&&isset($_POST['modele'])&&isset($_POST['conso'])&&isset($_POST['type_moteur'])&&isset($_POST['type_vehicule'])){
		$vehicule = new Vehicule($_POST['id']);
		$vehicule -> modifierVehicule($_POST['marque'],$_POST['modele'],$_POST['conso'],$_POST['type_moteur'],$_POST['type_vehicule']);
	}
?>