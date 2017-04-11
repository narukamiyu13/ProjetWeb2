<?php

require_once("Model.class.php");

    class Publication extends Modele{
        
        
        /* -------------------------------------
        | fonction selectionnerPhotoRecette
        | -------------------------
        | PARAM
        |   $photoID : (int) Le ID de la photo de laquelle on veut les informations
        | -------------------------
        | RETURN
        |   Array   : (ARRAY) Les informations de la photo    
        | -------------------------
        | DESCRIPTION
        |   Sélectionne et renvoie toutes les informations relatives à une photo, 
        |   sa recette, les ingrédients nécessaires et les étapes de préparation.
        |------------------------------------- */ 
        public function selectionnerPhotoRecette($photoID){
            try{
                $PDO = $this->connectionBD();
                $query = "SELECT nom, prenom, idPhoto, url, photo.description, idRecette, photo.idUtilisateur FROM photo INNER JOIN utilisateur ON photo.idUtilisateur = utilisateur.idUtilisateur WHERE idPhoto=".$photoID;
                $PDOStatement = $PDO->prepare($query);
                $PDOStatement->execute();
                $photoRecette = $PDOStatement->fetch(PDO::FETCH_ASSOC);
                
                if($photoRecette['idRecette']!= NULL){
                    $query = "SELECT * FROM recettes WHERE idRecette=".$photoRecette['idRecette'];
                    $PDOStatement = $PDO->prepare($query);
                    $PDOStatement->execute();
                    $recette = $PDOStatement->fetch(PDO::FETCH_ASSOC);
                    
                    $query = "SELECT * FROM etapepreparation WHERE idRecette =".$photoRecette['idRecette']."  ORDER BY numeroEtape ASC";
                    $PDOStatement = $PDO->prepare($query);
                    $PDOStatement->execute();
                    $etapes = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);


                    $query = "SELECT * FROM recettes_has_ingredients INNER JOIN ingredients ON recettes_has_ingredients.idingredient = ingredients.idingredient WHERE recettes_has_ingredients.idRecette=".$photoRecette['idRecette'];
                    $PDOStatement = $PDO->prepare($query);
                    $PDOStatement->execute();
                    $ingredientsRecette = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
                    
                     return Array("photo"=>$photoRecette,"recette"=>$recette, "ingredients"=>$ingredientsRecette, "etapes"=>$etapes);
                } else {
                    return Array("photo"=>$photoRecette);
                }

               
            }catch(PDOException $e) {
                return "Erreur: ".$e->getMessage();
            }
            
        }
        
        
        /* -------------------------------------
        | fonction getMiam
        | -------------------------
        | PARAM
        |   $photoID : (int) Le ID de la photo de laquelle on veut les informations
        | -------------------------
        | RETURN
        |   $nbMiam   : (int) Le nombre de mentions miam de la photo
        | -------------------------
        | DESCRIPTION
        |   Sélectionne et retourne le nombre de mentions Miam d'une photo
        |------------------------------------- */ 
        public function getMiam($photoID){
            $nbMiam = $this->selectionnerNombre('idUtilisateur', 'likes', false, NULL,true,$photoID);
            return $nbMiam;
        }
        
        /* -------------------------------------
        | fonction getCommentaires
        | -------------------------
        | PARAM
        |   $photoID : (int) Le ID de la photo de laquelle on veut les informations
        | -------------------------
        | RETURN
        |   $commentaires   : (ARRAY) Les commentaires de la photo et leurs informations
        | -------------------------
        | DESCRIPTION
        |   Sélectionne et retourne les commentaires sur une photo et leurs informations
        |------------------------------------- */ 
        public function getCommentaires($photoID){
            $PDO = $this->connectionBD();
            $query = "SELECT comment.idUtilisateur, prenom, nom, comment.description FROM comment INNER JOIN utilisateur ON comment.idUtilisateur = utilisateur.idUtilisateur WHERE comment.idPhoto=".$photoID;
            $PDOStatement = $PDO->prepare($query);
            $PDOStatement->execute();
            $commentaires = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
            
            return $commentaires;
            
            //return $nbMiam;
        }
         public function ajouterCreations(){
          try{
     
                $PDO = $this->connectionBD();
              

                  if(isset($_FILES['photoCreation']) && isset($_POST['description']))
                  {
                        $folder="app/assets/photo/";
                        $description= $_POST['description'];
                        $idUtilisateur= $_GET['userID'];
                        $photoCreation = ( "$folder".$_FILES['photoCreation']['name']);
                        $requete="INSERT INTO `photo`(`url`, `description`, `idUtilisateur`) VALUES ('$photoCreation','$description','$idUtilisateur')";
                        $PDOStatement = $PDO->prepare($requete);
                        $PDOStatement->execute();
                  }

                    
                    
            
            }catch(PDOException $e) {
                echo "Erreur: ".$e->getMessage();
            }
    
       }
        
        public function checkMiam($photoID){
            $check = $this->selectionnerNombre("idUtilisateur", "likes",false,  NULL, true, $photoID);
            return $check;
            
        }
        
        
        public function miam($idPersonne, $idPhoto){
            $PDO = $this->connectionBD();
            $requete = "INSERT INTO likes (idUtilisateur,idPhoto, timestamp) VALUES ($idPersonne, $idPhoto, NOW())";
            $PDOStatement = $PDO->prepare($requete);
            $exec = $PDOStatement->execute();
            return $exec;
        }
        
        public function demiam($idPersonne, $idPhoto){
            $PDO = $this->connectionBD();
            $requete = "DELETE FROM likes WHERE idUtilisateur=$idPersonne AND idPhoto=$idPhoto";
            $PDOStatement = $PDO->prepare($requete);
            $exec = $PDOStatement->execute();
            return $exec;
            
        }
      
    } // FIN CLASSE

?>
