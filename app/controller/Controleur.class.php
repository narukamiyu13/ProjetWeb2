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
        if(!isset($_GET['forgot'])){
            if(!isset($_POST['bt_connexion'])){
                $erreur=false;
                include_once ("app/view/connexion.php");
            }else{
                $erreur=false;
                $utilisateur = $this->modele->gererConnexion($_POST['nomUtilisateur'],$_POST['motDePasse']);
                if($utilisateur != NULL ){
                    $_SESSION['userID'] = intval($utilisateur);
                    var_dump($_SESSION["userID"]);
                    header("location:  profil.php?userID=$utilisateur");
                } else {
                    $erreur=true;
                    include_once ("app/view/connexion.php");
                    
                }
            }
        } else {
            include_once("app/view/forgotPassword.php");
        }
    }
    /* ------------------------------------
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
            $erreur=false;
            include_once ("app/view/inscription.php");
            
        }else{
            if (isset($_POST["courriel"])){
                $email = $_POST["courriel"];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $erreur=true;
                    include_once ("app/view/inscription.php");
                    
                }else{
                    $erreur=false;
                    $inscription = $this->modele->gererInscription($_POST['nomUtilisateur'],$_POST['motDePasse'],$_POST['courriel']);
                    $utilisateur = $this->modele->gererConnexion($_POST['nomUtilisateur'],$_POST['motDePasse']);
                    if($utilisateur != NULL ){
                        $_SESSION['userID'] = intval($utilisateur);
                        var_dump($_SESSION["userID"]);
                        header("location:  index.php");
                    } else {
                        $erreur=true;
                        include_once ("app/view/inscription.php");
                    } 
                }
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
    public function gererReset(){
        if(isset($_POST['reset'])) {
            $this->modele->expireToken($_GET['uid'],$_GET['token']);
            //var_dump($_POST);
            if($_POST['password1'] == $_POST['password2']) {
                $this->modele->updatePassword($_POST['password1']);
                header("location:connexion.php");
            }
        }
        //var_dump($this->modele->checkToken($_GET['uid'],$_GET['token']));
        if($this->modele->checkToken($_GET['uid'],$_GET['token'])){
            if($this->modele->checkExpiration($_GET['uid'],$_GET['token']) == 0){
                require_once("app/view/resetvalid.php");
            } else {
                require_once("app/view/resetexpired.php");
            }
        } else {
            require_once("app/view/resetinvalid.php");
        }
    }
         public function gererRecherche(){
   
            include_once ("app/view/recherche.php");

    }
}
?>