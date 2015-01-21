<?php

class Vehicule {
	private $id;
	private $id_utilisateur;
	private $marque;
	private $modele;
	private $consommation;
	private $type_moteur;
	private $type_vehicule;
	private $hydrated = false;
	
	function __construct($id = null) {
		$this->id = $id;
		if(!$this->hydrated) $this->hydrate();
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
	public function getIdUser(){
		if(!$this->hydrated) $this->hydrate();
		return $this->id_utilisateur;
	}
	public function getMarque(){
		if(!$this->hydrated) $this->hydrate();
		return $this->marque;
	}	
	public function getModele(){
		if(!$this->hydrated) $this->hydrate();
		return $this->modele;
	}	
	public function getConsommation(){
		if(!$this->hydrated) $this->hydrate();
		return $this->consommation;
	}
	public function getTypeMoteur(){
		if(!$this->hydrated) $this->hydrate();
		return $this->type_moteur;
	}	
	public function getTypeVehicule(){
		if(!$this->hydrated) $this->hydrate();
		return $this->type_moteur;
	}	

	//Modifie les infos du vehicule dans la base de donnée
	public function modifierVehicule($marque,$modele,$conso,$typeMoteur,$typeVehicule){
		global $bdd; //permet d'acceder à la variable $bdd

		if(!$this->hydrated) $this->hydrate(); //recupere les infos sur le vehicule

		//Requete SQL pour mettre a jour les infos
		$sth = $bdd -> prepare("UPDATE `tma`.`vehicule` SET `marque` = :marque, `modele` = :modele, `consommation` = :consommation, `type_moteur` = :type_moteur, `type_vehicule` = :type_vehicule WHERE `vehicule`.`id` = :id");
		$sth->execute(array(
			":marque" => $marque,
			":modele" => $modele,
			":consommation" => $conso,
			":type_moteur" => $typeMoteur,
			":type_vehicule" => $typeVehicule,
			":id" => $this->id
		));
	}	
	
	//Gere le renseignement de la classe sur les infos du vehicule
	public function hydrate(){
		global $bdd;

		$query = "SELECT * FROM vehicule WHERE id = :id";

		$sth = $bdd->prepare($query);
		$sth->execute(array(
			"id" => $this->id
		));
		$reponse = $sth->fetch();

		$this->id_utilisateur = $reponse["id_utilisateur"];
		$this->marque = $reponse["marque"];
		$this->modele = $reponse["modele"];
		$this->consommation = $reponse["consommation"];
		$this->type_moteur = $reponse["type_moteur"];
		$this->type_vehicule = $reponse["type_vehicule"];
	
		$this->hydrate = true;
	}
}