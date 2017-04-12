<?php

require_once("app/model/Recette.class.php");
require_once("Controleur.class.php");

class ControleurRecette extends Controleur {
    
    public function __construct(){
            $this->modele = new Recette();

    }
     public function gererVueAjoutRecette(){
        if(isset($_POST['publierAvecRecette'])){
//            var_dump($_POST);
            $this->modele->queryInsererRecette();
            var_dump($lastidRecette);
            var_dump($lastidIngredient);
            $target_dir = "app/assets/photo/";
            $target_file = $target_dir . basename($_FILES["photoCreationRecette"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image

            if(isset($_POST['publierAvecRecette'])) {
                $check = getimagesize($_FILES["photoCreationRecette"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            }
            if (file_exists($target_file)) {
                $uploadOk = 0;
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
                if (move_uploaded_file($_FILES["photoCreationRecette"]["tmp_name"], $target_file)) {
                    //echo "The file ". basename( $_FILES["photoCreation"]["name"]). " has been uploaded.";
                } else {
                    //echo "Sorry, there was an error uploading your file.";
                }
            }
        }
       
    }

}

?>