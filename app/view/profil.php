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
                    this.style.fontSize = "14px";
                })
                //Remet un -si la variable checkAbonnement est vrai ou un + si elle est la variabl est fausse dans le rond d'abonnement lorsqu'on ne survol plus la division
                $(".plus").mouseout(function(){
                    $(this).html("<span><?= ($checkAbonnement == true) ?  "-" :  "+";?></span>");
                    this.style.fontSize ="70px";
                })
                //
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
                                        $("#affichageRecette").removeClass("hidden")
                                        },
                        fail    : function(){
                                        $(".contenuRecette").html("Oups! Cette recette n'existe pas!");
                                        $("#affichageRecette").removeClass("hidden")
                                        }
                    
                    });
                    
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
                        <div class='rond' style='background-image:url(".$photo['url'].");width:300px;height:300px;background-size:cover;'></div>";
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
            <div id="ajoutPhoto" class="popup hidden">
                <div class="contenu">
                    <div class="fermeture">X</div>
                        <form action="profil.php?userID=<?php echo $_GET['userID'];?>" method="post" enctype="multipart/form-data">
                            <p>Publiez vos créations culiniaires préférés</p>
                            <label for="description">Description</label><input type="text" name="description" id="description"><br>
                            <input type="file" name="photoCreation" id="photoCreation"><br>
<!--
                             <p>Voulez vous ajouter une recette?</p>
                            <label for="oui">Oui</label><input type="checkbox" name="oui" id="oui" value="oui">
                            <label for="Non">Non</label><input type="checkbox" name="non" id="non" value="non">
-->
                            <input type="submit" value="Publier une creation" name="publier">
                        </form>
                 </div>
            </div>

            <div id="affichageRecette" class="popup hidden">
                <div class="contenuRecette" style="overflow:hidden;">
                
                
                </div>
            
            </div>
        
        </main>
    </body>
</html>