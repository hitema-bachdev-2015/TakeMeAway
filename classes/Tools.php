<?php 

class Tools {
    
    // Insertion d'une nouvelle utilisateur
	public static function addUser($nom, $prenom, $email, $mdp, $token){
		global $bdd;
		$req=$bdd->prepare("INSERT INTO utilisateur (nom, prenom, email, mdp, token, date_subscrib) VALUES (:nom, :prenom, :email, :mdp, :token, :date_subscrib)");
		$req->execute(array(
            "nom"				=>	$nom,
            "prenom"			=>	$prenom,
            "email"				=>	$email,
            "mdp"				=>	$mdp,
            "token"				=> 	$token,
            "date_subscrib" 	=> 	date("Y-m-d")
        ));
    }
    
    // Insertion d'une nouvelle utilisateur
    public static function checkUser($mail){
        global $bdd;
        $sql = "SELECT * FROM utilisateur WHERE email=:mail ";
        $query = $bdd->prepare($sql);
        $query->execute(array("mail" => $mail));
        $reponse = $query->FetchAll();
        return count($reponse);
    }
    
    // Insertion d'une nouvelle utilisateur
    public static function infoUser($id){
        global $bdd;
        $sql = "SELECT * FROM utilisateur WHERE id=:id ";
        $query = $bdd->prepare($sql);
        $query->execute(array("id" => $id));
        $reponse = $query->Fetch();
        return $reponse;
    }

    public static function connectUser($mail,$password){
        global $bdd;
        $sql = "SELECT id FROM utilisateur WHERE email=:mail AND mdp=:password";
        $query = $bdd->prepare($sql);
        $query->execute(array("mail" => $mail, "password"=>$password));
        $reponse = $query->Fetch();
        return $reponse;
  
    }
    
    // Insertion d'une nouvelle utilisateur
    public static function listeVehicule($id){
        global $bdd;
        $sql = "SELECT * FROM vehicule WHERE id_utilisateur=:id ";
        $query = $bdd->prepare($sql);
        $query->execute(array("id" => $id));
        $reponse = $query->FetchAll();
        return $reponse;
    }

    // Insertion d'un nouvel itinéraires dans l'historique
    public static function insertHisto($depart, $arrivee, $longitude_dep, $longitude_arr, $latitude_dep, $latitude_arr, $id_user, $id_vehic){
        global $bdd;
        $sql = "INSERT INTO historique (id_utilisateur, date_h, adresse_depart, latitude_depart, longitude_depart, adresse_arrive, latitude_arrive, longitude_arrive, id_vehicule)
                VALUES (:id, :date_h, :adresse_dep, :latitude_dep, :longitude_dep, :adresse_arr, :latitude_arr, :longitude_arr, :id_vehic)";
 
        $query = $bdd->prepare($sql);
        $query->execute(array("id" => $id_user,
                              "date_h" => date ( "Y-m-d" ),
                              "adresse_dep" => $depart,
                              "latitude_dep" => $latitude_dep,
                              "longitude_dep" => $longitude_dep,
                              "adresse_arr" =>  $arrivee,
                              "latitude_arr" => $latitude_arr, 
                              "longitude_arr" => $longitude_arr, 
                              "id_vehic" => $id_vehic
                        ));
        $last_id = $bdd->lastInsertId();
        return $last_id;
    }

    //Mise à jour de la table historique, pour ajout de favoris
    public static function updateFav($id_hist){
        global $bdd;
        $sql = "UPDATE historique SET favori = 1 WHERE id=:id_historique";
        $query = $bdd->prepare($sql);
        $query->execute(array("id_historique" => $id_hist));
    }


    public static function updateUser($nom, $prenom, $mdp, $adresse, $cp, $ville, $id){
        global $bdd;
        $sql = "UPDATE utilisateur SET nom = :nom, prenom=:prenom, mdp=:mdp, adresse=:adresse, cp=:cp, ville=:ville WHERE id=:id";
        $query = $bdd->prepare($sql);
        $query->execute(array(
                "id" => $id,
                "nom" => $nom,
                "prenom" => $prenom,
                "mdp" => $mdp,
                "adresse" => $adresse,
                "cp" => $cp,
                "ville" => $ville
            ));
    }

}