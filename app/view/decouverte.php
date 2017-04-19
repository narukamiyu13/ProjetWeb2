
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
    <title>decouverte</title>
    <link href="app/assets/reset.css" rel="stylesheet">
    <link href="app/assets/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

    
    
<?php  include_once'header.php' ?>
<section class="decouverte">
    
    
        <?php
     
  
    foreach($decouvertes as $decouverte)
    {
    $commentaires=$this->modele->selectionnerCommentaires($decouverte['idPhoto']);
    $miam = $this->modele->selectionnerNombre('idUtilisateur','likes',false,NULL,true,$decouverte['idPhoto']);
   
          $html= '<div class="blockAllo">
                        <div class="allo">
                            <div class="alloNom">
                                <h3>@'. $decouverte['nomUtilisateur'].'</h3>
                            </div>    
                              <img src="';
                if($decouverte['urlPhoto']!=NULL)
                {$html.=$decouverte['urlPhoto'];}
                else{
                    $html.="app/assets/images/images.png";
                }
                 $html.='" width="80px" height="80px" alt="photoProfil">


                        </div>
                        <div class="recetteAllo">
                            <h3>'.$decouverte['description'].'</h3>
                                <div class="cercleDecouverte">
                                    <img   src='.$decouverte['url'].' height="250px" width="250px">
                                </div>
                            <div class="burgerDecouverte">
                                <img src="app/assets/images/burger.png" width="35px" height="35px">
                                 <h5>'.$miam.'</h5>
                            </div>';
       
                            foreach($commentaires as $commentaire){
                           $html.= '<p>'.$commentaire['commentaires'].'</p>';
                            }
                           


                        $html.= '</div>
                    </div> ';
                          
       echo $html;                   
                        
    }

//}
        ?>
   
   </section>     
        <?php include_once'footer.php'?>
 