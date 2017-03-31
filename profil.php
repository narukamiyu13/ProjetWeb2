<?php
//Mettre ?userID=2 ou 3 pour voir un demo controlleur pas encore fini d'in
session_start();


require_once('app/controller/ControleurProfil.class.php');

if(isset($_GET['follow'])){
    $tonUsager->abonner($_SESSION['userID']);
    $curPage= $_GET['userID'];
    header("location:profil-laurie.php?userID=".$curPage);
}

if(isset($_GET['unfollow'])){
    $tonUsager->desabonner($_SESSION['userID']);
    $curPage= $_GET['userID'];
    header("location:profil-laurie.php?userID=".$curPage);
}


if($checkAbonnement){
    $title ="Désabonner";
}

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page profil</title>
        <!-- Custom Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet"> 
        <script src="app/assets/lib/script2.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="app/assets/lib/jquery.min.js" ></script>
        <script>
            
            
            
            $(document).ready(function(){
                console.log("ready");
                $(".recette").mouseover(function(){
                    $("div:first-of-type", this).removeClass("rond");
                })
                $(".recette").mouseout(function(){
                     $("div:first-of-type", this).addClass("rond");
                })
                
                $(".plus").mouseover(function(){
                    $(this).html("<p><?= $title ?></p>");
                    this.style.fontSize = ".75em";
                })
                
                $(".plus").mouseout(function(){
                    $(this).html("<p><?php
                    echo ($checkAbonnement == true) ?  "-" :  "+";?></p>");
                    this.style.fontSize ="5em";
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
                    
                  echo ($checkAbonnement == false) ? ' window.location="profil-laurie.php?follow&userID='.$currentPage.'";' : 'window.location="profil-laurie.php?unfollow&userID='.$currentPage.'"';
                    
                             
                    
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
        <link href="app/assets/style-laurie.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav><!--nav ici--></nav>
        </header>
        <main>
            
            <!-- Section nom-->
            <section class="top">
                <h2><?= "$tonUsager->prenom"?> <?= $tonUsager->nom ?></h2>
            </section>
            
            <!-- Section photo-->
            <section class="top op">
                <figure class="<?php if($tonUsager->urlPhoto!=NULL){echo "unePhoto";}else{echo "photoProfilHov";}?>" >
                    <img class="rond" src="<?php if($tonUsager->urlPhoto!=NULL){echo"$tonUsager->urlPhoto";}else{echo"app/assets/images/images.png";}?>" width="100px" height="100px" alt="photoProfil" >
                </figure>
                <span class="plusprofil">Ajouter une<br>photo de profil</span>
                <div title="<?= $title; ?>" alt="plus" class="plus" width="50px" height="50px">
                    <p><?php echo ($checkAbonnement == true) ?  "-" :  "+";?></p>
                </div>
            </section>
           
            <!-- section nb publications-->
            <section class="top">
                <div><span><?= "$tonUsager->nbPhotos";?><br></span>Publications</div>
                <div><span><?= "$tonUsager->nbAbonnements";?><br></span>Abonnements</div>
                <div><span><?= "$tonUsager->nbAbonnes";?><br></span>Abonnés</div>
            </section>
            
            <!-- section membre depuis-->
            <section class="top">
                <p> Membre depuis <?= date("Y",strtotime($tonUsager->dateJoint)); ?></p>
            </section>
            
            <!-- section galerie photo -->
            <section class="bottom">
                
                <?php
                
                foreach($tonUsager->photos as $photo){
                    $str =  "<div class='recette'>
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
            <div class="popup hidden">
                 <div class="contenu">
                     <div class="fermeture">X</div>
                 </div>
            </div>
        </main>
    </body>
</html>