<?php
include('app/model/Publication.class.php');

session_start();


if(isset($_GET['selectPhoto'])){
    $publication = new Publication;

    $recetteID=$_GET['recetteID'];
    $maRecette = $publication->selectionnerPhotoRecette($recetteID);
   
    $html = "<div id='laRecette'>
    <script>
    $(document).ready(function(){
      $.ajax({
        type:   'GET',
        url:    'traitementAjax.php',
        data:   'commentaires&recetteID=$recetteID',
        success:function(data){
            $('.commentaires').html(data);
        }
                
    })
    
        $('#ajoutCommentaire').keyup(function(event){
        console.log(event.which);
    })
    
    })
  
    

    
    </script>
    <div class='recetteImg' style='background-image:url(".$maRecette['photo']['url'].");background-size:cover;height:450px;overflow:hidden;background-position:center;position:relative'>
        <h2>".$maRecette['photo']['description']."</h2>
        <p> Par <a href='profil.php?userID=".$maRecette['photo']['idUtilisateur']."' >".$maRecette['photo']['prenom']." ".$maRecette['photo']['nom']."</a></p>
    </div>
    <div style='margin-top:25px;padding:25px;background-color:white;'><div class='informations'>";
    
    if(isset($maRecette['recette'])) {
       // $html .= "<p>Voici la recette </p>";
        $html .= "<h3>Ingredients</h3>
        <br>
        ";

          foreach($maRecette['ingredients'] as $ingredient) {
            if ((preg_match("/\ml|tasse|cuillereasoupe|cuillereatable|l|lbs|cl|cuillereathe|g|kg\b/i",$ingredient['uniteDeMesure']))&&(preg_match("/^[^aeyiuoh]/", $ingredient['nomIngredient']))){
                $html .= "<p>".$ingredient['quantite']." ".$ingredient['uniteDeMesure']." de ".$ingredient['nomIngredient']." ".$ingredient['typeDePrep']." ".$ingredient['adjectifIngredient']."</p>";
                }else{
                    if((preg_match("/\ml|tasse|cuillereasoupe|cuillereatable|l|lbs|cl|cuillereathe|g|kg\b/i",$ingredient['uniteDeMesure']))&& (preg_match("/^[aeyiuoh]/", $ingredient['nomIngredient']))){
                           $html .= "<p>".$ingredient['quantite']." ".$ingredient['uniteDeMesure']." d' ".$ingredient['nomIngredient']." ".$ingredient['typeDePrep']." ".$ingredient['adjectifIngredient']."</p>";
                    }else{
                        $html .= "<p>".$ingredient['quantite']." ".$ingredient['uniteDeMesure']." ".$ingredient['nomIngredient']." ".$ingredient['typeDePrep']." ".$ingredient['adjectifIngredient']."</p>";
                    }
                }   
            }
        
        $html.= "<h3>Étapes de préparation</h3>";
        foreach($maRecette['etapes'] as $etape) {

            $html .= "<p class='etape'>".$etape['numeroEtape'].") ".$etape['descriptionEtape']."</p>";
        }
        
    }else {
        
        $html .= "<h3 style='height:300px;padding-top:100px;'> L'utilisateur n'a pas partagé sa recette </h3>";
    }
   
    
   $html .=" </div>
    <div class='commentaires'>
    
    ";
     $html.=" </div>
            <input type=\'text\' name=\'commentaire\' placeholder=\"Ajouter un commentaire...\" id=\"ajoutCommentaire\" />
       
    </div>
    ";
    
   
    
 
    echo $html;    
    echo "</div>";
}
 // FIN if(isset($_GET['selectPhoto']))

if(isset($_GET['commentaires'])){
    $publication = new Publication;
    $maRecette = $publication->selectionnerPhotoRecette($_GET['recetteID']);
    if($publication->checkMiam($maRecette['photo']['idPhoto'])){
         $src="burger";
     } else {
         $src="burgerBW";
     }
     $commentaires = $publication->getCommentaires($_GET['recetteID']);
     $nbMiams = $publication->getMiam($_GET['recetteID']);
    
    $html = "<script>
    
            $(document).ready(function(){
            
            $('#miams img').click(function(){
            console.log('bonjour');
             var src = $('#miams img').attr('src');
             console.log(src);
             
             if(src == 'app/assets/images/burger.png'){
             $.ajax({
                type: 'GET',
                url : 'traitementAjax.php',
                data: 'demiam&idPhoto=".$maRecette['photo']['idPhoto']."&userID=".$_SESSION['userID']."',
                success: function(){
                    $('#miams img').attr('src', 'app/assets/images/burgerBW.png') ;
                    var newNbMiam = $('#miams span').html();
                    newNbMiam--;
                    $('#miams span').html(newNbMiam);
                }
             })
             } else {
              $.ajax({
                type: 'GET',
                url : 'traitementAjax.php',
                data: 'miam&idPhoto=".$maRecette['photo']['idPhoto']."&userID=".$_SESSION['userID']."',
                success: function(data){
                    $('#miams img').attr('src', 'app/assets/images/burger.png') ;
                    var newNbMiam = $('#miams span').html();
                    newNbMiam++;
                    $('#miams span').html(newNbMiam);
                    
                }
             })
             
             }
            });
            
           
            
            });
    
    
            </script><p id='miams'><img src='app/assets/images/$src.png' width='30' height='30' alt='miam!' /><span>$nbMiams</span></p>";
    
     foreach($commentaires as $commentaire){
        $html .= "<p class='commentaire'><span><a href='profil.php?userID=".$commentaire['idUtilisateur']."'>".$commentaire['prenom']." ".$commentaire['nom']."</a></span><br/>".$commentaire['description']."</p>";
    }
    
      
    
    
    echo $html;
} // FIN if(isset($_GET['commentaires']))


if(isset($_GET['miam'])){
    $publication = new Publication();
    $idUtilisateur = $_GET['userID'];    
    $photo = $_GET['idPhoto']; 
    
    var_dump($publication->miam($idUtilisateur, $photo));
} // FIN if(isset($_GET['miam']))


if(isset($_GET['demiam'])){
    $publication = new Publication();
    $idUtilisateur = $_GET['userID'];    
    $photo = $_GET['idPhoto']; 
    echo "banane";
   var_dump($publication->demiam($idUtilisateur, $photo));
} // FIN if(isset($_GET['demiam']))



if(isset($_GET['ajoutCommentaires'])) {
    
    $commentaire = htmlspecialchars($_GET['comment']);
    $publication = new Publication();
    
    $publication->ajoutCommentaire($_SESSION['userID'], $_GET['recetteID'], $commentaire);
    $PDO = $publication->connectionBD();
    $query="SELECT nom, prenom FROM utilisateur WHERE idUtilisateur=".$_SESSION['userID'];
    $PDOStatement = $PDO->prepare($query);
    $PDOStatement->execute();
    $personne = $PDOStatement->fetch(PDO::FETCH_ASSOC);
    
    
    
    echo "<p class='commentaire'><span><a href='profil.php?userID=".$_SESSION['userID']."'>".$personne['prenom']." ".$personne['nom']."</a></span><br/>".$commentaire."</p>";
} // FIN isset($_GET['ajoutCommentaires'])



?>