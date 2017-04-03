<?php
include('app/model/Publication.class.php');



if(isset($_GET['selectPhoto'])){
    $publication = new Publication;
    $maRecette = $publication->selectionnerPhotoRecette($_GET['recetteID']);
    echo "<div>
    <div style='background-image:url(".$maRecette['photo']['url'].");background-size:cover;height:450px;overflow:hidden;background-position:center'>
    
    </div>
    
    ";
    
    echo "<pre>";
    print_r($maRecette);
    echo "</pre>";
    
    echo "</div>";
}
?>