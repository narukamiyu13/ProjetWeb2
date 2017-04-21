<?php
/*
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
NOM : 
PROJET : Foodie
ORGANISDATION : College Maisonneuve
PAGE : Recette.class.php
DATE DE CREATION : 27-03-17
DESCRIPTION : modele qui insere une recette

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
*/
require_once("Model.class.php");

class Recette extends Modele{
     /* -------------------------------------
     | fonction queryInsererRecette
     | -------------------------
     | PARAM
     |   aucun
     | -------------------------
     | RETURN
     |   aucun
     | -------------------------
     | DESCRIPTION
     |   Inserer une photo et une recette dans la base de donnée
     |------------------------------------- */ 
    
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
   
              
              //Requete Recette
              $requeteRecette= "INSERT INTO `recettes`(`titreRecette`, `vchTemperatureCuisson`, `vchTempsPreparation`, `vchTempsCuisson`, `idCategorieRecette`, `idtypeRecette`) VALUES ('$nomRecette','$temperatureDeCuisson','$tempsPrep','$tempsDeCuisson','$categorieRecette','$typeRecette')";
              
              $sth=$PDO->prepare($requeteRecette);
              $sth->execute();
              $lastRecetteid['ux']=$PDO->lastInsertId();

              //Requete ingredient
              $ingredientios=[];
              
              foreach($nomIngredient as $ingredient){
                $requeteIngredient="INSERT INTO `ingredients`(`nomIngredient`) VALUES (\"$ingredient\")";
                $sth2=$PDO->prepare($requeteIngredient);
                $sth2->execute();
                
                $lastidIngredient = $PDO->lastInsertId();
                $ingredientios[]=$lastidIngredient;

              }
              
              //Requete Recette ingredient
              
              $indexu=0;
              $requeteIngreRecette="INSERT INTO `recettes_has_ingredients`(`idRecette`, `idingredient`, `quantite`, `uniteDeMesure`, `typeDePrep`, `adjectifIngredient`) VALUES ";
              
              foreach($quantite as $qt)
              {
                  $requeteIngreRecette.="(".$lastRecetteid['ux'].",".$ingredientios[$indexu].",".$qt.",";
                      if($uniteDeMesure[$indexu]=="NULL"){ 
                          $requeteIngreRecette.="".$uniteDeMesure[$indexu].",";
                      }else{
                          $requeteIngreRecette.= "'".$uniteDeMesure[$indexu]."',"; 
                      } $requeteIngreRecette.="'".$preparationIngredient[$indexu]."','".$adjectifIngredient[$indexu]."'),";
                  $indexu+=1;
              }
              
              $requeteIngreRecette=substr($requeteIngreRecette,0,-1);
              $sth3=$PDO->prepare($requeteIngreRecette);
              
              $sth3->execute();

              $requeteEtapePrep="INSERT INTO etapepreparation (numeroEtape, descriptionEtape, idRecette) VALUES ";

              $index = 0;
              
              foreach($numeroEtape as $etape){
                  $requeteEtapePrep.="($etape,\"".$descriptionEtape[$index]."\", ".$lastRecetteid['ux']."), ";
           
                  $index+=1;
              }
              $requeteEtapePrep=substr($requeteEtapePrep,0,-2);
              $sth4=$PDO->prepare($requeteEtapePrep);
              $sth4->execute();
              
              //Requete Photo
              $folder="app/assets/photo/".$_SESSION['userID']."/";
              $target_file=basename($_FILES['photoCreationRecette']['name']);
              $descriptionpr= $_POST['descriptionpr'];
              $idUtilisateur= $_GET['userID'];
              
              if (file_exists($folder.$target_file)) {
                  $increment=0;
                  while(file_exists($folder.$target_file)){
                      $increment++;
                      $target_file = "($increment)-".basename($_FILES['photoCreationRecette']["name"]);
                  }
              }
              $photoCreationRecette ='\"'.$folder.$target_file.'\"';
              $requetePhoto="INSERT INTO `photo`(`url`, `description`, `idUtilisateur`,`idRecette`) VALUES ('".$photoCreationRecette."','".$descriptionpr."',".$idUtilisateur.",".$lastRecetteid['ux'].")";
              
              $sth5=$PDO->prepare($requetePhoto);
              $sth5->execute();
          }
      }catch(PDOException $e) {
          echo 'ERROR: ' . $e->getMessage();
      }
    }
}// FIN CLASSE
