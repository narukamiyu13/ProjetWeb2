<?php

require_once("app/model/Publication.class.php");
require_once("app/model/Recette.class.php");
require_once("Controleur.class.php");

class ControleurPublication extends Controleur {
    
public function __construct(){
        $this->modele = new Publication();
    
}
public function gererVueAjoutPhoto(){
    if(isset($_POST['publier'])){
        $this->modele->ajouterCreations();
        $target_dir = "app/assets/photo/";
        $target_file = $target_dir . basename($_FILES["photoCreation"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        
        if(isset($_POST["publier"])) {
            $check = getimagesize($_FILES["photoCreation"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }
        if (file_exists($target_file)) {
            $uploadOk = 0;
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
            if (move_uploaded_file($_FILES["photoCreation"]["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES["photoCreation"]["name"]). " has been uploaded.";
            } else {
                //echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

    
    
    
    
}

?>