
<!--
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
NOM : 
PROJET : Foodie
ORGANISDATION : College Maisonneuve
PAGE : decouverte.php
DATE DE CREATION : 27-03-17
DESCRIPTION : page decouverte

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
-->
<html lang="fr">
   <head>
        <meta charset="utf-8">
        <title>Decouverte</title>

        <!--<link href="app/assets/bootstrap.min.css" rel="stylesheet"> -->
        <link href="app/assets/reset.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
        <script src="app/assets/js/menu.js"></script>
        <link href="app/assets/style-laurie.css" rel="stylesheet">
        <link href="app/assets/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <script>
    
        $(document).ready(function(){
            $(".blockAllo").click(function(){
                    var recetteID = this.dataset.recetteid;
                    console.log("Je clique");
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

        })
    
    </script>
    <?php  include_once'header.php' ?>
    
    <section class="decouverte">
        <?php

            foreach($decouvertes as $decouverte)
            {
                $commentaires=$this->modele->selectionnerCommentaires($decouverte['idPhoto']);
                $miam = $this->modele->selectionnerNombre('idUtilisateur','likes',false,NULL,true,$decouverte['idPhoto']);

                $html= '<div class="blockAllo" data-recetteid="'.$decouverte['idPhoto'].'">
                            <div class="allo">
                                <div class="alloNom">
                                    <h3>@'. $decouverte['nomUtilisateur'].'</h3>
                                </div>
                                <img src="';
                                if($decouverte['urlPhoto']!=NULL)
                                {
                                    $html.=$decouverte['urlPhoto'];
                                }else{
                                    $html.="app/assets/images/images.png";
                                }
                                $html.='" width="80px" height="80px" alt="photoProfil">
                            </div>

                            <div class="recetteAllo">
                                <h3>'.$decouverte['description'].'</h3>

                                <img class="imagecursor" src='.$decouverte['url'].' height="250px" width="250px">

                                <div class="burgerDecouverte">
                                    <img src="app/assets/images/burger.png" width="35px" height="35px">
                                    <h5>'.$miam.'</h5>
                                </div>';
                                foreach($commentaires as $commentaire){
                                    $html.= '<p>'.$commentaire['commentaires'].'</p>';
                                }
                            $html.= '</div>
                        </div>';
                echo $html;
            }
        ?>
    </section>  
    <div id="affichageRecette" class="hidden">
        <div class="contenuRecette">
        </div>
    </div>
    <?php include_once'footer.php'; ?>
 