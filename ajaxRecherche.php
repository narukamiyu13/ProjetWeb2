<!--
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
NOM : 
PROJET : Foodie
ORGANISDATION : College Maisonneuve
PAGE : ajaxRecherche.php
DATE DE CREATION : 27-03-17
DESCRIPTION : recupere les resultats de recette de facon asynchrone

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
-->
<?php  

session_start();

include('app/model/Model.class.php');
if(isset($_POST['idCategorie'])){
    $model = new Modele();
    $idCategorie = $_POST["idCategorie"];
    $recettes =  $model->gererRechercheRecette($idCategorie);

           
             
    foreach($recettes as $recette){

        $ingredients = $model-> gererRechercheRecetteIngredients($idCategorie,$recette['idRecette']);
        $html='
            <div  class="wrapperRecherche">
                <div class="boiteRecette">
                    <div class="headerBoiteRecette" >
                        <i class="fa fa-cutlery icon" aria-hidden="true"></i>
                        <h2 class="nomRecette" >'. $recette['titreRecette'].'</h2>
                        <p class="temps">(Préparation : '.$recette['vchTempsPreparation'].' )  </p>
                        <p class="temps">(Cuisson : '.$recette['vchTempsCuisson'].' )  </p>
                    </div>    
                    <div class="imageRecette">
                        <img src='.$recette["url"].' height="300px" width="600px">
                    </div>
                    <div  class="listeIngredient" >
                        <h3 class="listeIngredientTitre" > Ingredient  </h3>';
                        foreach($ingredients['ingredients'] as $ingredient){
                            $html.= '<p>'.$ingredient['nomIngredient'].'('.$ingredient['quantite'].' '.$ingredient['uniteDeMesure'].')</p>';
                        };
                        $html.= '</div>
                    <div class="listeEtape">
                    <h3 class="listeEtapeTitre" > Etape Preparation</h3>';
                    foreach($ingredients['etapes'] as $etape){
                        $html.= '<p>'.$etape['numeroEtape'].' . '.$etape['descriptionEtape'].'</p><br>';
                    };
                    $html.= ' 
                </div>
            </div> 
        </div>';
        echo $html;
    }   
       
 }
 
 ?>  
