<?php
/*
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
NOM : 
PROJET : Foodie
ORGANISDATION : College Maisonneuve
PAGE : ControleurRecette.php
DATE DE CREATION : 27-03-17
DESCRIPTION : controleur qui gere les requetes concernant lajout de recette 

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
*/
require_once("app/model/Recette.class.php");
require_once("Controleur.class.php");

class ControleurRecette extends Controleur {
    
    public function __construct(){
            $this->modele = new Recette();

    }
    /* -------------------------------------
    | gererVueAjoutRecette
    | -------------------------
    | PARAM
    |   aucun
    | -------------------------
    | RETURN
    |   aucun    
    | -------------------------
    | DESCRIPTION
    |   appelle la fonction permetant d'inserer des photos et des recette dans la base de données
    |------------------------------------- */
    public function gererVueAjoutRecette(){
        if(isset($_POST['publierAvecRecette'])){    
             if (!file_exists("app/assets/photo/".$_SESSION['userID'])) {
                    mkdir("app/assets/photo/".$_SESSION['userID'], 0777, true);
             }

            $this->modele->queryInsererRecette();

            $target_dir = "app/assets/photo/".$_SESSION['userID']."/";

            $target_file = basename($_FILES["photoCreationRecette"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image

            if(isset($_POST["publierAvecRecette"])) {
                $check = getimagesize($_FILES["photoCreationRecette"]["tmp_name"]);
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
                    $target_file = "($increment)-".basename($_FILES["photoCreationRecette"]["name"]);
                }

            }
            if ($_FILES["photoCreationRecette"]["size"] > 5000000) {
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
                if (move_uploaded_file($_FILES["photoCreationRecette"]["tmp_name"], $target_dir . $target_file)) {
                    //echo "The file ". basename( $_FILES["photoCreation"]["name"]). " has been uploaded.";

                } else {
                    //echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
}

?>