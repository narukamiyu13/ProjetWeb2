<?php

require_once("app/model/Model.class.php");



class Controleur {
    
        
public function __construct(){
        $this->modele = new Modele();
    }
    
    
        /* -------------------------------------
        | fonction modifier le profil
        | -------------------------
        | PARAM
        |   $idUtilisateur : (int) Le ID de l'utilisateur connecté 
        | -------------------------
        | RETURN
        |   aucun    
        | -------------------------
        | DESCRIPTION
        |   modifie la photo de profil de l'utilisateur
        |------------------------------------- */
     public function gererConnexion(){
        if(!isset($_POST['bt_connexion'])){
            include_once ("app/view/connexion.php");
    }else{
            //$tonUsager = $this->modele->profilUtilisateur($_GET['userID']);
            //$this->modele->inscription($_SESSION['userID']);
            //include_once("app/view/profil.php");
            
            
            $utilisateur = $this->modele->gererConnexion($_POST['nomUtilisateur'],$_POST['motDePasse']);
            if($utilisateur != NULL ){
            $_SESSION['userID'] = intval($utilisateur);
            var_dump($_SESSION["userID"]);
            header("location:  profil.php?userID=$utilisateur");
              } else {
                include_once ("app/view/connexion.php");
            }
             
        }
    }
    
        /* -------------------------------------
        | fonction modifier le profil
        | -------------------------
        | PARAM
        |   $idUtilisateur : (int) Le ID de l'utilisateur connecté 
        | -------------------------
        | RETURN
        |   aucun    
        | -------------------------
        | DESCRIPTION
        |   modifie la photo de profil de l'utilisateur
        |------------------------------------- */
    public function gererInscription(){
        if(!isset($_POST['bt_inscription'])){
            include_once ("app/view/inscription.php");
    }else{
             $inscription = $this->modele->gererInscription($_POST['nomUtilisateur'],$_POST['motDePasse'],$_POST['courriel']);
             $utilisateur = $this->modele->gererConnexion($_POST['nomUtilisateur'],$_POST['motDePasse']);
             if($utilisateur != NULL ){
             $_SESSION['userID'] = intval($utilisateur);
             var_dump($_SESSION["userID"]);
             header("location:  index.php");
              } else {
                include_once ("app/view/inscription.php");
            }   
             
            
            
        }
    
    }
     
     public function gererRecherche(){
   
            include_once ("app/view/recherche.php");

    }
}
?>