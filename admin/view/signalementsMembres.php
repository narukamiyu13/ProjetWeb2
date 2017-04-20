<style type="text/css">
    p span{
        display:inline-block;
        width:28%;
    }
</style>

<script src="../app/assets/lib/jquery.min.js"></script>
<script>
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