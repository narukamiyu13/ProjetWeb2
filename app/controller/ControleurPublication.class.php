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
 public function gererDecouverte()
 {
     
      $decouvertes=$this->modele->selectionnerPostDecouverte(); 
    include_once('app/view/decouverte.php');
     
        //$miam = $this->modele->selectionnerNombre('idUtilisateur','likes',false,NULL,true,);
     
    // ($colone, $table, $personneUnique = false, $idPersonne = NULL, $photo = false, $photoID = NULL)
      //$idRecette = 1;
     // pour chaque photo tu appel la fonction dans ta vue qui lafficghe
     // ex: fonction vueDecouvert
//      foreach($decouvertes as $decouverte)
//        {
//          $vueDecouverte->gererPublicationDecouverte($decouverte['idPhoto']);
//        }
        
 
        
        
 }
    
    
    

}

?>