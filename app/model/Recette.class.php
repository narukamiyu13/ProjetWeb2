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
              $requeteRecette= "INSERT INTO `recettes`(`titreRecette`, `vchTemperatureCuisson`, `vchTempsPreparation`, `vchTempsCuisson`, `idCategorieRecette`, `idtypeRecette`) VALUES ('$nomRecette','$temperatureDeCuisson','$tempsPrep','$tempsDeCuisson','$categorieRecette','$typeRecette')";
              
              $sth=$PDO->prepare($requeteRecette);
        
              
              //Requete ingredient
              $requeteIngredient="INSERT INTO `ingredients`(`nomIngredient`) VALUES ('$nomIngredient')";
              $sth2=$PDO->prepare($requeteIngredient);
              
              $PDO->beginTransaction();
              // Recuperer id recette et ingredient
              var_dump($sth->execute());
              //Idrecette
              $lastidRecette = $PDO->lastInsertId();
              return $lastidRecette;
              $sth2->execute();
              //idIngredient
              $lastidIngredient = $PDO->lastInsertId(); 
              return $lastidIngredient;
              $PDO->commit();
              
        
          }
        }catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
        }
    }
//        //Requete Recette ingredient
//              $requeteIngreRecette="INSERT INTO `recettes_has_ingredients`(`idRecette`, `idingredient`, `quantite`, `uniteDeMesure`, `typeDePrep`, `adjectifIngredient`) VALUES ('$lastidRecette','$lastidIngredient','$quantite','$uniteDeMesure','$tempsPrep','$adjectifIngredient')";
//              $sth3=$PDO->prepare($requeteIngreRecette);
//              var_dump($lastidRecette);
//              var_dump($sth3->execute());
//              
////             Requete Etape Prep
//              $requeteEtapePrep="INSERT INTO `etapepreparation`(`numeroEtape`, `DescriptionEtape`, `idRecette`) VALUES ('$numeroEtape','$descriptionEtape','$lastidRecette')";
//              $sth4=$PDO->prepare($requeteEtapePrep);
//              var_dump($sth4->execute());
//              
//              
//              $requetePhoto="INSERT INTO `photo`(`url`, `description`, `idUtilisateur` `idRecette`) VALUES ('$photoCreation','$description','$idUtilisateur', '$lastIDRecette')";
//              $sth5=$PDO->prepare($requetePhoto);
//              var_dump($sth5->execute());
}
