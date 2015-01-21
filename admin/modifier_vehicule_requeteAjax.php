<?php
	include("../classes/Vehicule.php");
	if(isset($_POST['id'])&&isset($_POST['marque'])&&isset($_POST['modele'])&&isset($_POST['conso'])&&isset($_POST['type_moteur'])){
		$vehicule = new Vehicule();
		$vehicule -> modifierVehicule($_POST['marque'],$_POST['modele'],$_POST['conso'],$_POST['type_moteur']);
	}
?>