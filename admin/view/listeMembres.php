<?php
/* -------------------------------------
| fichier listeMembres.php
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
|   Vue - Affichage de la liste de tous les membres du site, avec l'option
|   de changer leur niveau de permissions ou de les supprimer
|------------------------------------- */
?>
<style type="text/css">
    p span{
        display:inline-block;
        width:200px;
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
    |   au chargement de la page, charge la liste de tous
    |   les membres du site.
    |------------------------------------- */
$(document).ready(function(){
    console.log("document ready");
    $.ajax({
        type: "GET",
        url: "traitement.php",
        data: "getListeMembres",
        success: function(data){
            $('#liste').html(data);
        }
    }); // fin AJAX
    
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
    |   quand on tape dans le champ de recherche, filtre
    |   la liste des membres selon le contenu du champ
    |------------------------------------- */
    $('#search').keyup(function(){
        $.ajax({
        type: "GET",
        url: "traitement.php",
        data: "search&filter="+$('#search').val(),
        success: function(data){
            $('#liste').html(data);
        }
    }); // fin AJAX
        
    })
    
    
    
})
</script>



<h3>Liste des membres</h3>

<input type="text" id="search" placeholder="Rechercher un membre...">

<p><span>Nom</span><span>Nom d'utilisateur</span><span>Courriel</span><span>Role</span><span>Supprimer</span></p>
<div id="liste"></div>