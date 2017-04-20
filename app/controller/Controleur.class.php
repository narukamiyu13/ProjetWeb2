<?php

require_once("app/model/Model.class.php");



class Controleur {
    public function __construct()
    {
        $this->modele = new Modele();
    }
    
    
        /* -------------------------------------
        | fonction gerer connexion
        | -------------------------
        | PARAM
        |   aucun
        | -------------------------
        | RETURN
        |   aucun    
        | -------------------------
        | DESCRIPTION
        |   Permet a un utilisateur inscrit de se connecter
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
                include_once ("app/view/erreur.php");
            }
             
        }
    }
    
        /* -------------------------------------
        | fonction incription
        | -------------------------
        | PARAM
        |   aucun
        | -------------------------
        | RETURN
        |   aucun    
        | -------------------------
        | DESCRIPTION
        |   permet a un utilisatweur de s'inscrire
        |------------------------------------- */
    public function gererInscription(){
        if(!isset($_POST['bt_inscription'])){
            include_once ("app/view/inscription.php");
        }else{
            if (isset($_POST["courriel"])){
                
                $email = $_POST["courriel"];
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    include_once ("app/view/inscription.php");
                    include_once ("app/view/erreuremail.php");
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
        }
    
    }
}
?>