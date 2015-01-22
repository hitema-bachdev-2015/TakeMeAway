<?php 
	$profil = Tools::infoUser($_SESSION['user']['id']);
	$listeVehicule = Tools::listeVehicule($_SESSION['user']['id']);
	
	if(isset($_POST['btnModifProfil'])):
		extract($_POST);
		if($mdp == ''){
			$mdp = $mdp1;
		}		
			Tools::updateUser($nom, $prenom, $mdp, $adresse, $cp, $ville, $_SESSION['user']['id']);
			header("location:index.php?modification");
	endif;
?>