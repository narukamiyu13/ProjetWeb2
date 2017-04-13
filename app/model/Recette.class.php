<?php

require_once("Model.class.php");

class Recette extends Modele{
    
    public function queryInsererRecette(){
      try{
          if(isset($_POST['publierAvecRecette'])){
              $PDO = $this->connectionBD();
             
              $nomRecette=$_POST['nomRecette'];
              $typeRecette=$_POST['typeRecette'];
              $categorieRecette=$_POST['categorieRecette'];
              $temperatureDeCuisson=$_POST['temperatureDeCuisson'];
              $tempsDeCuisson=$_POST['tempsDeCuisson'];
              $tempsPrep=$_POST['tempsPrep'];
              $quantite=$_POST['quantite'];
              $uniteDeMesure=$_POST['uniteDeMesure'];
              $nomIngredient=$_POST['nomIngredient'];
              $preparationIngredient=$_POST['preparationIngredient'];
              $adjectifIngredient=$_POST['adjectifIngredient'];
              $numeroEtape=$_POST['numeroEtape'];
              $descriptionEtape=$_POST['descriptionEtape'];
              $folder="app/assets/photo/";
              $description= $_POST['descriptionPr'];
              $idUtilisateur= $_GET['userID'];
              $photoCreation = ( "$folder".$_FILES['photoCreationRecette']['name']);
//            var_dump($_POST);
              
              //Requete Recette
//              $PDO->beginTransaction();
              $requeteRecette= "INSERT INTO `recettes`(`titreRecette`, `vchTemperatureCuisson`, `vchTempsPreparation`, `vchTempsCuisson`, `idCategorieRecette`, `idtypeRecette`) VALUES ('$nomRecette','$temperatureDeCuisson','$tempsPrep','$tempsDeCuisson','$categorieRecette','$typeRecette')";
              
              $sth=$PDO->prepare($requeteRecette);
              var_dump($sth->execute());
              $lastRecetteid['ux']=$PDO->lastInsertId();
              var_dump($lastRecetteid);
           
              //Requete ingredient
              foreach($nomIngredient as $ingredient){
                $requeteIngredient="INSERT INTO `ingredients`(`nomIngredient`) VALUES ('$ingredient')";
                $sth2=$PDO->prepare($requeteIngredient);
                $sth2->execute();
                $lastidIngredient=[];
                $lastidIngredient[] = $PDO->lastInsertId();
                var_dump($lastidIngredient);
              }
              
            //Requete etape prep
              foreach($numeroEtape as $etape){
                  foreach($descriptionEtape as $description){
                      $requeteEtapePrep="INSERT INTO etapepreparation(numeroEtape, descriptionEtape,idRecette) VALUES ('".$etape."','".$description."','".$lastRecetteid['ux']."');";
                  }
                 $sth4=$PDO->prepare($requeteEtapePrep);
                    var_dump($requeteEtapePrep);
                   var_dump($sth4->execute());
              }
               
            
              //idIngredient
//              $lastidIngredient = $PDO->lastInsertId(); 
//              $PDO->commit();
              //Requete Recette ingredient
//              $requeteIngreRecette="INSERT INTO `recettes_has_ingredients`(`idRecette`, `idingredient`, `quantite`, `uniteDeMesure`, `typeDePrep`, `adjectifIngredient`) VALUES ('$lastidRecette','$lastidIngredient','$quantite','$uniteDeMesure','$tempsPrep','$adjectifIngredient')";
//              $sth3=$PDO->prepare($requeteIngreRecette);
//                var_dump($requeteIngredient);
               //Requete Etape Prep

//              
//              
//              $requetePhoto="INSERT INTO `photo`(`url`, `description`, `idUtilisateur` `idRecette`) VALUES ('$photoCreation','$description','$idUtilisateur', '$lastIDRecette')";
//              $sth5=$PDO->prepare($requetePhoto);
//              var_dump($sth5->execute());
              
//              var_dump($lastidRecette);
//              var_dump($sth3->execute());
              
          }
        }catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
        }
    }
}
