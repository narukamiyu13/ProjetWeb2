<?php
/*
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
NOM : 
PROJET : Foodie
ORGANISDATION : College Maisonneuve
PAGE : ControleurPublication.php
DATE DE CREATION : 27-03-17
DESCRIPTION : controleur qui gere les requetes concernant la selection de photo et de publications

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
*/

require_once("app/model/Publication.class.php");
require_once("app/model/Recette.class.php");
require_once("Controleur.class.php");

class ControleurPublication extends Controleur {
    
    public function __construct(){
            $this->modele = new Publication();

    }
     /* -------------------------------------
    | fonction gerer Vue ajout photo
    | -------------------------
    | PARAM
    |   aucun
    | -------------------------
    | RETURN
    |   aucun
    | -------------------------
    | DESCRIPTION
    |   Gère l'ajout de photo et appelle la requete permettant d<ajouter des photos a la base de donnees
    |------------------------------------- */ 
    
    public function gererVueAjoutPhoto(){
        if(isset($_POST['publier'])){    
             if (!file_exists("app/assets/photo/".$_SESSION['userID'])) {
                    mkdir("app/assets/photo/".$_SESSION['userID'], 0777, true);
             }
            $this->modele->ajouterCreations();

            $target_dir = "app/assets/photo/".$_SESSION['userID']."/";

            $target_file = basename($_FILES["photoCreation"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image

            if(isset($_POST["publier"])) {
                $check = getimagesize($_FILES["photoCreation"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            }
            if (file_exists($target_dir.$target_file)) {
                $increment=0;
                while(file_exists($target_dir.$target_file)) {
                    $increment++;
                    $target_file = "($increment)-".basename($_FILES["photoCreation"]["name"]);
                }

            }
            if ($_FILES["photoCreation"]["size"] > 5000000) {
                $uploadOk = 0;
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["photoCreation"]["tmp_name"], $target_dir . $target_file)) {
                    //echo "The file ". basename( $_FILES["photoCreation"]["name"]). " has been uploaded.";

                } else {
                    //echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
    
    /* -------------------------------------
    | fonction gerer decouverte
    | -------------------------
    | PARAM
    |   aucun
    | -------------------------
    | RETURN
    |   aucun
    | -------------------------
    | DESCRIPTION
    |  Appelle le modele qui permet de creer le feed et appelle la vue d/couverte
    |------------------------------------- */ 
    
    public function gererDecouverte(){
     $decouvertes=$this->modele->selectionnerPostDecouverte(); 
     include_once('app/view/decouverte.php');
    }
    
    
    

}

?>