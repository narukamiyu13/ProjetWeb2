<?php

require_once("Model.class.php");

    class Publication extends Modele{
        
        public function selectionnerPhotoRecette($photoID){
            try{
                $PDO = $this->connectionBD();
                $query = "SELECT * FROM photo WHERE idPhoto=".$photoID;
                $PDOStatement = $PDO->prepare($query);
                $PDOStatement->execute();
                $photoRecette = $PDOStatement->fetch(PDO::FETCH_ASSOC);
                
                if($photoRecette['idRecette']!= NULL){
                    $query = "SELECT * FROM recettes WHERE idRecette=".$photoRecette['idRecette'];
                    $PDOStatement = $PDO->prepare($query);
                    $PDOStatement->execute();
                    $recette = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);


                    $query = "SELECT * FROM recettes_has_ingredients INNER JOIN ingredients ON recettes_has_ingredients.idingredient = ingredients.idingredient WHERE recettes_has_ingredients.idRecette=".$photoRecette['idRecette'];
                    $PDOStatement = $PDO->prepare($query);
                    $PDOStatement->execute();
                    $ingredientsRecette = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
                    
                     return Array("photo"=>$photoRecette,"recette"=>$recette, "ingredients"=>$ingredientsRecette);
                } else {
                    return Array("photo"=>$photoRecette);
                }

               
            }catch(PDOException $e) {
                return "Erreur: ".$e->getMessage();
            }
            
        }

    }

?>
