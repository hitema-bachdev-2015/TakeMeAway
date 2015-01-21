<?php 
	$profil = Tools::infoUser($_SESSION['user']['id']);
	$listeVehicule = Tools::listeVehicule($_SESSION['user']['id']);
?>