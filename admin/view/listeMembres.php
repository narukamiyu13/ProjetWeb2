<style type="text/css">
    p span{
        display:inline-block;
        width:200px;
    }
</style>
<script src="../app/assets/lib/jquery.min.js"></script>
<script>
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