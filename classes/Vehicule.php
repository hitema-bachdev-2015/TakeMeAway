<?
class Category {
	private $id;
	private $id_utilisateur;
	private $marque;
	private $modele;
	private $consommation;
	private $type_moteur;
	private hydrate = false;
	
	function __construct($id = null) {
		$this->id = $id;
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

	public function modifierVehicule($marque,$modele,$conso,$typeMoteur){
		if(!$this->hydrated) $this->hydrate();
		
		$sth = $bdd->("UPDATE `tma`.`vehicule` SET `marque` = :marque, `modele` = :modele, `consommation` = :consommation, `type_moteur` = :type_moteur WHERE `vehicule`.`id` = :id");
		$sth->execute(array(
			":marque" => $marque,
			":modele" => $modele,
			":consommation" => $conso,
			":type_moteur" => $typeMoteur,
			":id" => $this->id,
		));
	}	
	
	public function hydrate(){
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
	
		$this->hydrate = true;
	}
}