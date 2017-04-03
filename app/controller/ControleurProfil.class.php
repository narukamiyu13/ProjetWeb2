<?php
//Importation du contrôleur parent
    require_once("Controleur.class.php");


//Importation des modeles
    require_once('app/model/User.class.php');
    require_once('app/model/Profil.class.php');

class ControleurProfil extends Controleur {
    
    public function __construct(){
        $this->modele = new ModeleProfil();
    }
    
    
    
     /* -------------------------------------
    | fonction afficher
    | -------------------------
    | PARAM
    |   aucun
    | -------------------------
    | RETURN
    |   aucun
    | -------------------------
    | DESCRIPTION
    |   Gère l'affichage des profils
    |------------------------------------- */ 
    public function gererProfil(){
        
        $tonUsager = $this->modele->profilUtilisateur($_GET['userID']);
        $_SESSION['userID'] = 2;

        //Gérer les différences de comportement entre notre profil, et le profil des autres.
        if($_SESSION['userID'] == $tonUsager->idUtilisateur){
             //Le code si c'est le profil de l'utilisateur connecté
            $profilUserActuel = true;
            $title = "Ajout photo";
            $checkAbonnement=false;

        } else {
            //Le code si c'est le profil d'un autre utilisateur
            $profilUserActuel = false;
            $title = "S'Abonner";
            $checkAbonnement = $tonUsager->checkAbonnement($_SESSION['userID']);
        }
        //Gérer l'affichage  
        if(!isset($_GET['modifier'])){
            include_once("app/view/profil.php");
            $profilUserActuel = false;
        } else {
                $profilUserActuel = true;
                include_once("app/view/modifierProfil.php");
            
        }
        
    }
    
}

  



?>