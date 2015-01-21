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
}