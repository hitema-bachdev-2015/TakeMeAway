<?php
	include("../script/bdd.php");
	$sth = $bdd -> prepare("SELECT * FROM vehicule WHERE id = :id");
	$sth->execute(array(":id" => $_POST['id']));		
	$rps = $sth -> fetch();
	echo json_encode( array(
		'marque' => $rps['marque'],
		'modele' => $rps['modele'],
		'consommation' => $rps['consommation'],
		'type_moteur' => $rps['type_moteur']
	)); 
?>