<?php
//Mettre ?userID=2 ou 3 pour voir un demo controlleur pas encore fini d'inplementer
//Demarre la session de lutilisateur
error_reporting(0);

//Si il y a une variable suivre dans l'url l'utilisateur connecté s'abonne d'un autre utilisateur
if(isset($_GET['follow'])){
    $tonUsager->abonner($_SESSION['userID']);
    $curPage= $_GET['userID'];
    header("location:profil.php?userID=".$curPage);
}
//Si il y a une variable ne plus suivre dans l'url l'utilisateur connecté se desabonne d'un autre utilisateur
if(isset($_GET['unfollow'])){
    $tonUsager->desabonner($_SESSION['userID']);
    $curPage= $_GET['userID'];
    header("location:profil.php?userID=".$curPage);
}

//Si $checkAbonnement est vrai le html affiche se desabonner
if($checkAbonnement){
    $title ="Se désabonner";
}
if(isset($_POST["publier"])){
    $curPage= $_GET['userID'];
    header("location:profil.php?userID=".$curPage);
}
if(isset($_POST["publierAvecRecette"])){
    $curPage= $_GET['userID'];
    header("location:profil.php?userID=".$curPage);

}
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Page profil</title>
        <!-- Custom Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet"> 
        <link href="app/assets/reset.css" type="text/css" rel="stylesheet" />
        <link href="app/assets/style.css" type="text/css" rel="stylesheet" />
         <link href="app/assets/style-laurie.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="app/assets/lib/jquery.min.js" ></script>
        <script>
            //Si le document est pret execute le script
            $(document).ready(function(){
                console.log("ready");
                //Permet d'enlever la classe rond sur la classe recette si notre curseur survol la classe recette
                $(".recette").mouseover(function(){
                    $("div:first-of-type", this).removeClass("rond");
                })
                 //Permet d'ajouter la classe rond sur la classe recette si notre curseur ne survol plus la classe recette
                $(".recette").mouseout(function(){
                     $("div:first-of-type", this).addClass("rond");
                })
                //Permet d'ajouter le titre sur la classe plus si on la survole
                $(".plus").mouseover(function(){
                    $(this).html("<p><?= $title ?></p>");
                    this.style.fontSize = "1em";
                })
                //Remet un -si la variable checkAbonnement est vrai ou un + si elle est la variabl est fausse dans le rond d'abonnement lorsqu'on ne survol plus la division
                $(".plus").mouseout(function(){
                    $(this).html("<span style='line-height:15px; padding-left:5px; padding-right:5px;'><?= ($checkAbonnement == true) ?  "-" :  "+";?></span>");
//                    this.style.fontSize ="0px";
                })
                
                
                $(".popup").click(function(event){
                    if(event.target == $(this)[0]) {
                        $(this)[0].classList.add("hidden");
                    }
                })
                
                $(".recette").click(function(){
                    var recetteID = this.dataset.recetteid;
                    
                    $.ajax({
                        url         : "traitementAjax.php",
                        method      : "GET",
                        data        : "selectPhoto&recetteID="+recetteID,
                        contentType : "text/html;charset=utf-8;",   
                        success     : function(data){
                                        $(".contenuRecette").html(data);
                                        $("#affichageRecette").removeClass("hidden");
                                        },
                        fail    : function(){
                                        $(".contenuRecette").html("Oups! Cette recette n'existe pas!");
                                        $("#affichageRecette").removeClass("hidden");
                                        }
                    
                    });
                    
                })
                
                console.log("Abonné? <?= $checkAbonnement ?>");
                
                var ajouter=document.querySelector(".plus");
                var popup=document.querySelector('.popup');
              
                ajouter.addEventListener('click',function(){
                    <?php
                        if($profilUserActuel == true) {
                    ?>
                        popup.classList.remove('hidden');
                    <?php
                        } else {
                            $currentPage=$_GET['userID'];
                            echo ($checkAbonnement == false) ? ' window.location="profil.php?follow&userID='.$currentPage.'";' : 'window.location="profil.php?unfollow&userID='.$currentPage.'"';
                        }
                    ?>
                })
                var fermeture=document.querySelector('.fermeture');
                fermeture.addEventListener('click',function(evt){
                    console.log(fermeture);
                    popup.classList.add('hidden');
                });
                //selectionne les divers elements permettant de creer de l'interactivté avec l'utilisateur
                var photo = document.querySelector('input[name=photoinput]');
                var divPhoto=document.querySelector(".ajouterUnePhoto");
                var recette = document.querySelector('input[name=recetteinput]');
                var decision=document.querySelector(".decision");
                var ajouterUneRecette= document.querySelector(".laRecette");
                var precedentPhoto=document.querySelector('input[name=precedentPhoto]');
                var precedentRecette=document.querySelector('input[name=precedentRecette]');
                var lesIngredients=document.querySelector(".containsIngredients");
                var suivantRecette=document.querySelector(".suivantRecette");
                var ingreplus= document.querySelector(".ingreplus");
                var precedentIngredient= document.querySelector(".precedentIngredient");
                var suivantIngredient= document.querySelector(".suivantIngredient");
                var prepplus=document.querySelector(".prepplus");
                var index=1;
                var ind=1;
                var ajoutIgreedient=document.querySelector(".secingred");
                var etapePrep=document.querySelector(".containsEtapePrep");
                var ajoutEtapePrep=document.querySelector(".secEtapes");
                var precedentPrep=document.querySelector(".precedentPrep");
                var suivantPrep=document.querySelector(".suivantPrep");
                var photoRecette=document.querySelector(".photoRecette");
                var precedentPhotoRecette=document.querySelector(".precedentPhotoRecette");
                
                //Supprime un encart ingredient ou etape 
                function supprimer(id){
                    var select= '[data-id="'+ id +'"]';
                    var element = document.querySelector(select);
                    element.outerHTML = "";
                }
                //Ajoute un encart ingredient
                function ajouterIngredient(){
                    ajoutIgreedient.insertAdjacentHTML('beforeend', 
                           '<div class="ajoutIng" data-id="'+ (index) +'">'+
                                    '<div class="reti">'+
                                        '<input type="button" value="-" name="retirerIngredient" class="retirerIngredient petitB">'+
                                    '</div>' +
                                    '<h2>Ingredient '+ (index) +'</h2>'+                   
                                    '<div class="petitDiv">'+
                                        '<label class="petitL">Quantité</label><br>'+
                                        '<input class="petitI" type="number" name="quantite[]">'+
                                        '<select name="uniteDeMesure[]">'+
                                            '<option value="NULL">Unité</option>'+
                                            '<option value="ml">Ml</option>'+
                                            '<option value="tasse">Tasse</option>'+
                                            '<option value="cuillere a the">cuillere à thé</option>'+
                                            '<option value="cuillere a table">cuillere à table</option>'+
                                            '<option value="g">Gramme</option>'+
                                            '<option value="kg">kilogrammme</option>'+
                                            '<option value="lbs">livre</option>'+
                                            '<option value="l">litre</option>'+
                                            '<option value="cl">centilitre</option>'+
                                        '</select>'+
                                    '</div>'+
                                    '<div class="grandDiv">'+
                                        '<label class="grandL">Ingrédient</label>'+
                                        '<input type="text" name="nomIngredient[]" class="nomIngredient grandI">'+
                                        '<div id="suggesstion-box"></div>'+
                                    '</div>'+
                                    '<div class="grandDiv">'+
                                        '<label class="grandL">Preparation ingredient</label>'+
                                        '<input class="grandI" type="text" name="preparationIngredient[]">'+
                                    '</div>'+
                                    '<div class="grandDiv">'+
                                        '<label class="grandL">Adjectif Ingredient</label>'+
                                        '<input class="grandI" type="text" name="adjectifIngredient[]">'+
                                        '<input type="hidden" value="'+ (index++) +'">'+
                                    '</div>'+
                                '</div>');
                }
                ajouterIngredient();
                //Ajoute un encart etape
                function ajouterEtape(){
                    ajoutEtapePrep.insertAdjacentHTML('beforeend',
                                        '<div class="ajoutEtape" data-id="'+ (ind) +'">'+
                                            '<div class="reti">'+
                                                '<input type="button" value="-" name="retirerEtape" class="retirerEtape petitB">'+
                                            '</div>' +
                                            '<h2>Etape'+ (ind) +'</h2>'+
                                            '<div class="petitDiv">'+
                                                '<label class="petitL">Numero Etape</label><br>'+
                                                '<input class="petitI" type="number" value="'+ (ind) +'"name="numeroEtape[]">'+
                                            '</div>'+
                                            '<div class="grandDiv">'+
                                                '<label class="grandL">Description etape</label>'+
                                                '<textarea type="text" name="descriptionEtape[]" class="grandI"></textarea>'+
                                                '<input type="hidden" value="'+(ind++)+'">'+
                                            '</div>'+
                                        '</div>');
                }
                ajouterEtape();
                //Ajoute un ingredient si on clique sur plus
                ingreplus.addEventListener('click',function(){
                    ajouterIngredient();
                });
                //ajoute une etape si on clique sur plus
                prepplus.addEventListener('click',function(){
                    ajouterEtape();
                });
                //Permet de supprimer un ingredient 
                ajoutIgreedient.addEventListener("click", function(evt){
                    //console.log(evt.target);
                    if(evt.target.classList.contains("retirerIngredient"))
                    {
                        var itemIngredient = evt.target.parentElement.parentElement;
                        console.log(itemIngredient);
                        var id = itemIngredient.dataset.id;
                        console.log(id);
                        supprimer(id);
                        index--;
                    }
                });
                //permet de supprimer une étape de preparation
                ajoutEtapePrep.addEventListener("click", function(evt){
                    //console.log(evt.target);
                    if(evt.target.classList.contains("retirerEtape"))
                    {
                        console.log(evt.target);
                        var itemEtape = evt.target.parentElement.parentElement;
                        console.log(itemEtape);
                        var id = itemEtape.dataset.id;
                        console.log(id);
                        supprimer(id);
                        ind--;
                    }
                });
                //Permet de passer a l'étape suivante si l'input check box recette est coché
                recette.addEventListener('change', function (event) {
                    if (recette.checked) {
                        ajouterUneRecette.classList.remove("hidden");
                        decision.classList.add("hidden");
                    } 
                });
                 //Permet de passer a l'étape suivante si l'input check box photo est coché
                photo.addEventListener('change', function (event) {
                    if (photo.checked) {
                        divPhoto.classList.remove("hidden");
                        decision.classList.add("hidden");
                    }
                });
                //Permet la navigation entre les différentes étapes d'ajout de recette
                precedentPhoto.addEventListener('click',function(event){
                    divPhoto.classList.add("hidden");
                    decision.classList.remove("hidden");
                    photo.checked = false;
                });
                precedentRecette.addEventListener('click',function(event){
                    ajouterUneRecette.classList.add("hidden");
                    decision.classList.remove("hidden");
                    recette.checked=false;
                });
                suivantRecette.addEventListener('click',function(event){
                    ajouterUneRecette.classList.add("hidden");
                    lesIngredients.classList.remove("hidden");
                });
                precedentIngredient.addEventListener('click',function(event){
                    ajouterUneRecette.classList.remove("hidden");
                    lesIngredients.classList.add("hidden");
                });
                suivantIngredient.addEventListener('click',function(event){
                    lesIngredients.classList.add("hidden");
                    etapePrep.classList.remove("hidden");
                });
                precedentPrep.addEventListener('click',function(event){
                    lesIngredients.classList.remove("hidden");
                    etapePrep.classList.add("hidden");
                });
                suivantPrep.addEventListener('click',function(event){
                    photoRecette.classList.remove("hidden");
                    etapePrep.classList.add("hidden");
                });
                precedentPhotoRecette.addEventListener('click',function(event){
                    photoRecette.classList.add("hidden");
                    etapePrep.classList.remove("hidden");
                });
                
          
            })
            
        </script>
        <script src="app/assets/js/menu.js"></script>
    </head>
    <body>
       <?php include_once'header.php'; ?>
        <main>
           
            <!-- Section nom-->
            <section class="haut">
                <h2 class="nom"><?= "$tonUsager->prenom"?> <?= $tonUsager->nom ?></h2>
            </section>
            
            <!-- Section photo-->
            <section class="haut op">
                <figure class="photoProfilHov">
                    <!--Si la personne est connecter si sa photo est cliqué, revoye sur la page modifier profil sinon le lien refere a l'id de l'utilisateur non connecter-->
                    <?php if($profilUserActuel == true){
                            echo "<a href=\"profil.php?userID=".$_GET['userID']."&amp;modifier=".$_GET['modifier']."\">";
                        }else{
                            echo "<a href=\"#\">";}
                    ?> 
                    <!-- Si il n'y a pas de photo -->
                    <img class="rond" src="
                        <?php if($tonUsager->urlPhoto!=NULL){
                                echo"$tonUsager->urlPhoto";
                            }else{
                                echo"app/assets/images/images.png";
                            }?>" width="150px" height="150px" alt="photoProfil">
                    <?php echo "</a>";?>
                </figure>

                    <?php if($profilUserActuel == true) { echo "<span class=\"plusprofil\"><img height=\"50px\" width=\"50px\" src=\"app/assets/images/Modify.png\"></span>";} ?>

                <div title="<?= $title; ?>" alt="plus" class="plus">
                    <span><?= ($checkAbonnement == true) ?  "-" :  "+";?></span>
                </div>
            </section>
           
            <!-- section nb publications-->
            <section class="haut">
                <div><span><?= "$tonUsager->nbPhotos";?><br></span>Publications</div>
                <div><span><?= "$tonUsager->nbAbonnements";?><br></span>Abonnements</div>
                <div><span><?= "$tonUsager->nbAbonnes";?><br></span>Abonnés</div>
            </section>
            
            <!-- section membre depuis-->
            <section class="haut">
                 <p style="font-style:italic;"><?= utf8_encode($tonUsager->description) ?></p>
            </section>
            <section class="haut">
                <p> Membre depuis <?= date("Y",strtotime($tonUsager->dateJoint)); ?></p>
            </section>
              
            <!-- section galerie photo -->
            <section class="bottom">
                
                <?php
                
                foreach($tonUsager->photos as $photo){
                    $str =  "<div class='recette' data-recetteID=".$photo['idPhoto'].">
                        <div class='rond' style='background-image:url(".$photo['url'].");width:200px;height:200px;background-size:cover;'></div>";
                        if($photo['idRecette'] != NULL) {
                            $str .="<div class='corner'></div>
                                <img src='app/assets/images/fourchette.svg' width='30' height='30' />  
                                    
                            ";
                        }
                        
                    $str .="</div>";
                    echo $str;
                }
                
                ?>
            </section>
            <!-- pop up ajout de photo ou recette-->
            <div id="ajoutPhoto" class="popup hidden">
                <div class="contenu">
                    <div class="background">
                        <div class="imageback"></div>
                    </div>
                    <div class="fermeture">X</div>
                     <!-- Decision -->
                    <div class="decision">
                        <div class="titre">
                            <h1>Publiez vos créations culiniaires préférés</h1>
                        </div>
                        <div class="encart">
                           <span class="pad"><label>Publiez une photo avec recette</label><input type="checkbox" name="recetteinput"></span>
                           <span class="pad"><label>Publiez une photo sans recette</label><input type="checkbox" name="photoinput"></span>
                        </div>
                     </div>
                    <!-- Formulaire d'ajout de photo -->
                    <form class="ajouterUnePhoto hidden" action="profil.php?userID=<?php echo $_GET['userID'];?>" method="post" enctype="multipart/form-data">
                        <div class="titre">
                            <h1>Publiez les photos de vos créations culiniaires préférés</h1>
                        </div>
                        <div class="encartpho">
                            <label for="description">Description</label><input type="text" name="description" id="description"><br>
                            <input type="file" name="photoCreation" id="photoCreation">
                            <label for="photoCreation">Telecharger une photo</label>
                        </div>
                        <div class="controle">
                            <input type="button" value="Precedent" name="precedentPhoto">
                            <input type="submit" value="Publier une creation" name="publier">
                        </div>
                    </form>
                    <!-- Formulaire d'ajout de recette-->
                    <form class="ajouterUneRecette" action="profil.php?userID=<?php echo $_GET['userID'];?>" method="post" enctype="multipart/form-data">
                      <div class="laRecette hidden">
                          <div class="titre">
                                <h1>La recette</h1>
                          </div>
                          <div class="encartRe">
                              <label>Nom de la recette</label><input type="text" name="nomRecette">
                              <label>Type de recette</label>
                              <select name="typeRecette">
                                  <option value="1">Traditionel</option>
                                  <option value="2">Santé</option>
                                  <option value="3">Creatif</option>
                              </select>
                              <label>Categorie Recette</label>
                              <select name="categorieRecette">
                                  <option value="1">Plat</option>
                                  <option value="2">Entrée</option>
                                  <option value="3">Desert</option>
                              </select>
                              <label>Temperature de cuisson</label><input type="text" name="temperatureDeCuisson">
                              <label>Temps de cuisson</label><input type="text" name="tempsDeCuisson"><label>Temps de preparation</label><input type="text" name="tempsPrep">
                          </div>
                          <div class="controle">
                              <input type="button" value="Precedent" name="precedentRecette" class="precedentRecette">
                              <input type="button" value="suivant" name="suivantlaRecette" class="suivantRecette">
                          </div>
                        </div>
                        <div class="containsIngredients hidden">
                            <div class="titre">
                                <h1>Les Ingredients</h1>
                            </div>
                            <div class="lesIngredients">
                                <div class="ajouterDesIn">
                                    <label>Ajouter des ingrédients</label>
                                    <input class="ingreplus" type="button" value="+" name="ajouterPlus">
                                </div>
                                <div class="secingred">
                                    
                                </div>
                            </div><br>
                            <div class="controle">
                                <input type="button" value="Precedent" name="precedentIngredient" class="precedentIngredient">
                                <input type="button" value="Suivant" name="suivantIngredient" class="suivantIngredient">
                            </div>
                        </div>
                 
                        
                         <div class="containsEtapePrep hidden">
                             <div class="titre">
                                <h1>Les Étapes de préparations</h1>
                             </div>
                            <div class="lesEtapesPrep">
                                <div class="ajouterDesIn">
                                    <label>Ajouter des Etapes</label>
                                    <input class="prepplus" type="button" value="+" name="ajouterPlus">
                                </div>
                                <div class="secEtapes">
                                </div>

                            </div>
                            <br>
                            <div class="controle">
                                <input type="button" value="Precedent" name="precedentPrep" class="precedentPrep">
                                <input type="button" value="Suivant" name="suivantPrep" class="suivantPrep">
                             </div>
                        </div>
                        <div class="photoRecette hidden">
                            <div class="titre">
                                <h1>Publiez les photos de vos créations culiniaires préférés</h1>
                            </div>
                            <div class="encartphotor">
                                <label for="description">Description</label><input type="text" name="descriptionpr" id="descriptionpr"><br>
                                <input type="file" name="photoCreationRecette" id="photoCreationRecette">
                                <label for="photoCreationRecette">Telecharger une photo</label>
                                <br>
                            </div>
                            <div class="controle">
                                <input type="button" value="Precedent" name="precedentPrep" class="precedentPhotoRecette">
                                 <input type="submit" value="Publier une creation" name="publierAvecRecette">
                            </div>
                        
                        </div>
                        
                    </form>
                 </div>
            </div>

            <div id="affichageRecette" class="hidden">
                <div class="contenuRecette">
                
                
                </div>
            
            </div>
        
        </main>
    </body>
</html>