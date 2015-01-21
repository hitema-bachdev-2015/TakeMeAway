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
        $query->execute(array("email" => $mail, "mdp" => $password));
        $reponse = $query->Fetch();
        return $reponse;
    // //Verification de la présence d'un véhicule pour un utilisateur donné
    // public static function hasVehic($id){
    //     global $bdd;
    //     $sql = "SELECT * FROM vehicule WHERE id_user=:id ";
    //     $query = $bdd->prepare($sql);
    //     $query->execute(array("id" => $id));
    //     $reponse = $query->Fetch();
    //     return count($reponse);
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
       // $reponse = $query->Fetch();
        // retourner une valeur en cas d'echec
    }
}