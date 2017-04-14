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
            
             
//            var_dump($_POST);
              
              //Requete Recette
              $requeteRecette= "INSERT INTO `recettes`(`titreRecette`, `vchTemperatureCuisson`, `vchTempsPreparation`, `vchTempsCuisson`, `idCategorieRecette`, `idtypeRecette`) VALUES ('$nomRecette','$temperatureDeCuisson','$tempsPrep','$tempsDeCuisson','$categorieRecette','$typeRecette')";
              
              $sth=$PDO->prepare($requeteRecette);
              $sth->execute();
              $lastRecetteid['ux']=$PDO->lastInsertId();

              //Requete ingredient
              $ingredientios=[];
              
              foreach($nomIngredient as $ingredient){
                $requeteIngredient="INSERT INTO `ingredients`(`nomIngredient`) VALUES ('$ingredient')";
                $sth2=$PDO->prepare($requeteIngredient);
                $sth2->execute();
                
                $lastidIngredient = $PDO->lastInsertId();
                $ingredientios[]=$lastidIngredient;
//                var_dump($ingredientios);
              }

              $requeteEtapePrep="INSERT INTO etapepreparation (numeroEtape, descriptionEtape, idRecette) VALUES ";
              echo "<p>$requeteEtapePrep</p>";
              $index = 0;
              foreach($numeroEtape as $etape){
          
                  $requeteEtapePrep.="($etape,'".$descriptionEtape[$index]."', ".$lastRecetteid['ux']."), ";
           
                  $index+=1;
              }
                $requeteEtapePrep=substr($requeteEtapePrep,0,-2);
                $sth3=$PDO->prepare($requeteEtapePrep);
//                var_dump($requeteEtapePrep);
                $sth3->execute();
                  
              
               
              //Requete Recette ingredient
              
              $indexu=0;
              $requeteIngreRecette="INSERT INTO `recettes_has_ingredients`(`idRecette`, `idingredient`, `quantite`, `uniteDeMesure`, `typeDePrep`, `adjectifIngredient`) VALUES ";
              foreach($quantite as $qt)
              {
                  $requeteIngreRecette.="(".$lastRecetteid['ux'].",".$ingredientios[$indexu].",".$qt.",'".$uniteDeMesure[$indexu]."','".$preparationIngredient[$indexu]."','".$adjectifIngredient[$indexu]."'),";
                  $indexu+=1;
              }
              $requeteIngreRecette=substr($requeteIngreRecette,0,-1);
              $sth4=$PDO->prepare($requeteIngreRecette);
//              var_dump($requeteIngreRecette);
                $sth4->execute();
              
               //Requete Photo
              $folder="app/assets/photo/";
              $idUtilisateur= $_GET['userID'];
              $photoCreationRecette = ("$folder".$_FILES['photoCreationRecette']['name']);
                $descriptionpr= $_POST['descriptionpr'];
              $requetePhoto="INSERT INTO `photo`(`url`, `description`, `idUtilisateur`,`idRecette`) VALUES ('".$photoCreationRecette."','".$descriptionpr."',".$idUtilisateur.",".$lastRecetteid['ux'].")";
              $sth5=$PDO->prepare($requetePhoto);
              $sth5->execute();
//              var_dump($requetePhoto);
              
          }
        }catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
        }
    }
}
