<?php
/* -------------------------------------
| fichier Controller.php
| -------------------------
| CONTRIBUTEURS
|   Auteur: Cédrick Collin
|   Modifications: Cédrick Collin 
| -------------------------
| DATES
|   Création: 19 avril 2017
|   Dernière Modification: 20 avril 2017
| -------------------------
| DESCRIPTION
|   Gère la partie administration du site Foodie
|------------------------------------- */



require_once("model/Model.php");
class Controller {
    
    
    public function __construct(){
        $this->model = new Model();
    }
    
    
    /* -------------------------------------
    | fonction gererAdmin
    | -------------------------
    | PARAM
    |   aucun 
    | -------------------------
    | RETURN
    |   aucun    
    | -------------------------
    | DESCRIPTION
    |   Gère l'affichage du coté administration
    |------------------------------------- */
    public function gererAdmin(){
        
        if(isset($_GET['logout'])){
            unset($_SESSION['username']);
            session_destroy(); 
        }        
        if(isset($_SESSION['username'])){
            require_once('view/dashboard.php');
        } else {
            if(!isset($_POST['connexion'])){
                require_once("view/index.php");
            } else {
                if($this->model->checkConnect($_POST['username'],$_POST['password'])) {
                    require_once('view/dashboard.php');
                } else {
                    var_dump($this->model->checkConnect($_POST['username'],$_POST['password']));
                    header("location:index.php?err".$this->model->getErrCode($_POST['username'],$_POST['password']));
                    require_once("view/index.php");
                } // fin ELSE de if($this->model->checkConnect($_POST['username'],$_POST['password']))
            } // fin ELSE de if(isset($_POST['connexion']))
        } // fin ELSE de if(isset($_POST['logout']))
    } // FIN gererAdmin
    
    
    /* -------------------------------------
    | fonction gererDashboard
    | -------------------------
    | PARAM
    |   aucun
    | -------------------------
    | RETURN
    |   aucun    
    | -------------------------
    | DESCRIPTION
    |   Gère l'affichage du dashboard administrateur
    |------------------------------------- */
    public function gererDashboard(){
        if(!isset($_GET['page']) || $_GET['page'] == "liste" ){
            require_once("view/listeMembres.php");
        } else if($_GET['page'] == "signalements"){
            require_once("view/signalementsMembres.php");
        } 
    } // FIN gererAdmin
} // FIN classe Controller


?>