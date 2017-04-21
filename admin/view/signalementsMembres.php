<?php
/* -------------------------------------
| fichier signalementMembres.php
| -------------------------
| CONTRIBUTEURS
|   Auteur: Cédrick Collin
|   Modifications: Cédrick Collin 
| -------------------------
| DATES
|   Création: 19 avril 2017
|   Dernière Modification: 20 avril 2017
| -------------------------
| DESCRIPTION
|   Vue - Affiche la liste des membres signalés par d'autres
|   membres, par qui ils ont été signalés et le motif du 
|   signalement.
|------------------------------------- */
?>
<style type="text/css">
    p span{
        display:inline-block;
        width:400px;
    }
</style>

<script src="../app/assets/lib/jquery.min.js"></script>
<script>
    /* -------------------------------------
    | fonction anonyme
    | -------------------------
    | PARAM
    |   aucun
    | -------------------------
    | RETURN
    |   aucun   
    | -------------------------
    | DESCRIPTION
    |   au chargement de la page, charge la liste des signalements 
    |   effectués par les membres du site.
    |------------------------------------- */
$(document).ready(function(){
    console.log("document ready");
    $.ajax({
        type: "GET",
        url: "traitement.php",
        data: "getMembresSignales",
        success: function(data){
            $('#liste').html(data);
        }
    }); // fin AJAX
    
    
    
    
    
})
</script>


<h3>Signalements Membres</h3>
<p><span>Membre Signalé</span><span>Signalé Par</span><span>Motif</span></p>
<div id="liste"></div>