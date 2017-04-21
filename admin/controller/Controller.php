<?php
require_once("model/Model.php");
class Controller {
    
    
    public function __construct(){
        $this->model = new Model();
    }
    
    
    
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
                }
            }
        }
        
    }
    
    public function gererDashboard(){
        if(!isset($_GET['page']) || $_GET['page'] == "liste" ){
            require_once("view/listeMembres.php");
        } else if($_GET['page'] == "signalements"){
            require_once("view/signalementsMembres.php");
        }
    }
    
}


?>