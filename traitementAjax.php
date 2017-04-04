<?php
include('app/model/Publication.class.php');



if(isset($_GET['selectPhoto'])){
    $publication = new Publication;
    $maRecette = $publication->selectionnerPhotoRecette($_GET['recetteID']);
    $commentaires = $publication->getCommentaires($_GET['recetteID']);
    $nbMiams = $publication->getMiam($_GET['recetteID']);
    $html = utf8_encode("<div id='laRecette'>
    <div style='background-image:url(".$maRecette['photo']['url'].");background-size:cover;height:450px;overflow:hidden;background-position:center;position:relative'>
        <h2>".$maRecette['photo']['description']."</h2>
    </div>
    <div style='margin-top:25px;padding:25px;background-color:white;'><div class='informations'>");
    
    if(isset($maRecette['recette'])) {
       // $html .= "<p>Voici la recette </p>";
        $html .= utf8_encode("<h3>Ingredients</h3>
        <br>
        ");
        foreach($maRecette['ingredients'] as $ingredient) {
            $html .= utf8_encode("<p>".$ingredient['quantite']." ".$ingredient['nomIngredient']." ".$ingredient['typeDePrep'].", ".$ingredient['adjectifIngredient']."</p>");
        }
        
        $html.= "<h3>Étapes de préparation</h3>";
        foreach($maRecette['etapes'] as $etape) {
            $html .= utf8_encode("<p class='etape'>".$etape['numeroEtape'].") ".$etape['DescriptionEtape']."</p>");
        }
        
    } else {
        
        $html .= "<h3 style='height:300px;padding-top:100px;'> L'utilisateur n'a pas partagé sa recette </h3>";
        
        
        
    }
   
    
   $html .=utf8_encode(" </div>
    <div class='commentaires'>
    $nbMiams
    ");
    
    foreach($commentaires as $commentaire){
        $html.= utf8_encode("<p class='commentaire'><span>".$commentaire['prenom']." ".$commentaire['nom']."</span><br/>".$commentaire['description']."</p>");
    }
    
    $html.=utf8_encode("</div>
    </div>
    ");
    
    echo $html;    
    echo "</div>";
}
?>