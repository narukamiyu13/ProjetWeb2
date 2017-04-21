<?php
/* -------------------------------------
| fichier traitementAjax.php
| -------------------------
| CONTRIBUTEURS
|   Auteur: Cédrick Collin
|   Modifications: Laurie-Anne Gagnon, Cédrick Collin
| -------------------------
| DATES
|   Création: 6 avril 2017
|   Dernière Modification: 20 avril 2017
| -------------------------
| DESCRIPTION
|   Tout le traitement ajax de la partie utilisateur
|   du site foodie.
|------------------------------------- */

include('app/model/Publication.class.php');
session_start();

/* -------------------------------------
| SI on cherche à charger les informations d'une publication
| -------------------------
| PARAM
|   $_GET['recetteID']: (INT) - Le ID de la publication à afficher
| -------------------------
| RETURN
|   aucun   
| -------------------------
| DESCRIPTION
|   Sélectionne et génère l'affichage des informations d'une publication
|------------------------------------- */
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
         $('.fermerRecette').click(function(){
            $('#affichageRecette').addClass('hidden');
            })
        })
    </script>
    <div class='fermerRecette'><p>Fermer la recette</p></div>
    <div class='recetteImg' style='background-image:url(".$maRecette['photo']['url'].");background-size:cover;height:450px;overflow:hidden;background-position:center;position:relative'>
        <h2>".$maRecette['photo']['description']."</h2>
        <p> Par <a href='profil.php?userID=".$maRecette['photo']['idUtilisateur']."' >".$maRecette['photo']['prenom']." ".$maRecette['photo']['nom']."</a></p>
    </div>
    <div style='margin-top:25px;padding:25px;background-color:white;'><div class='informations'>";
    /* -------------------------------------
    | SI on cherche à charger les informations d'une recette
    | -------------------------
    | PARAM
    |   $maRecette['recette']: (INT) - La recette à afficher
    | -------------------------
    | RETURN
    |   aucun   
    | -------------------------
    | DESCRIPTION
    |   Génère l'affichage des informations d'une recette
    |------------------------------------- */
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
            }// FIN foreach ingredients
        $html.= "<h3>Étapes de préparation</h3>";
        foreach($maRecette['etapes'] as $etape) {
            $html .= "<p class='etape'>".$etape['numeroEtape'].") ".$etape['descriptionEtape']."</p>";
        } // FIN foreach Etapes
    } else {
        $html .= "<h3 style='height:300px;padding-top:100px;'> L'utilisateur n'a pas partagé sa recette </h3>";
    } //FIN ELSE if(isset($maRecette['recette']))
    $html .=" </div>
    <div class='commentaires'></div>
    <input type=\'text\' name=\'commentaire\' placeholder=\"Ajouter un commentaire...\" id=\"ajoutCommentaire\" />
    <div style='clear:both'></div>  
    </div>";
    echo $html;    
    echo "</div>";
} // FIN if(isset($_GET['selectPhoto']))
 
/* -------------------------------------
| SI on cherche à charger les commentaires d'une publication
| -------------------------
| PARAM
|   $_GET['recetteID']: (INT) - Le ID de la publication à afficher
| -------------------------
| RETURN
|   aucun   
| -------------------------
| DESCRIPTION
|   Sélectionne et génère l'affichage des commentaires d'une publication,
|   ainsi que les scripts reliés à ceux-ci et aux miams
|------------------------------------- */
if(isset($_GET['commentaires'])){
    $publication = new Publication;
    $maRecette = $publication->selectionnerPhotoRecette($_GET['recetteID']);
    if($publication->checkMiam($_SESSION['userID'],$maRecette['photo']['idPhoto']) != 0){
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
                    $('#ajoutCommentaire').keyup(function(event){
                        //console.log(event.which);
                        if(event.which == 13) {
                            console.log($(this).val());
                            $.ajax({
                                type:   'GET',
                                url:    'traitementAjax.php',
                                data:   'ajoutCommentaires&recetteID=".$_GET['recetteID']."&comment='+$(this).val(),
                                success:function(data){
                                    $('.commentaires').append(data);
                                    $('#ajoutCommentaire').val('');
                                }
                            })
                        }
                    })
                });
            </script>
            <p id='miams'><img src='app/assets/images/$src.png' width='30' height='30' alt='miam!' /><span>$nbMiams</span></p>";
    
     foreach($commentaires as $commentaire){
        $html .= "<p class='commentaire'><span><a href='profil.php?userID=".$commentaire['idUtilisateur']."'>".$commentaire['prenom']." ".$commentaire['nom']."</a></span><br/>".$commentaire['commentaires']."</p>";
    } // FIN foreach commentaires
    echo $html;
} // FIN if(isset($_GET['commentaires']))

/* -------------------------------------
| SI on cherche à donner une mention miam à une photo
| -------------------------
| PARAM
|   $_GET['userID'] : (INT) - Le ID de l'utilisateur qui miam
|   $_GET['idPhoto']: (INT) - Le ID de la photo à miam
| -------------------------
| RETURN
|   aucun   
| -------------------------
| DESCRIPTION
|   Attribue une mention Miam à une photo
|------------------------------------- */
if(isset($_GET['miam'])){
    $publication = new Publication();
    $idUtilisateur = $_GET['userID'];    
    $photo = $_GET['idPhoto']; 
    var_dump($publication->miam($idUtilisateur, $photo));
} // FIN if(isset($_GET['miam']))

/* -------------------------------------
| SI on cherche à retirer une mention miam à une photo
| -------------------------
| PARAM
|   $_GET['userID'] : (INT) - Le ID de l'utilisateur qui démiam
|   $_GET['idPhoto']: (INT) - Le ID de la photo à démiam
| -------------------------
| RETURN
|   aucun   
| -------------------------
| DESCRIPTION
|   Retire une mention Miam à une photo
|------------------------------------- */
if(isset($_GET['demiam'])){
    $publication = new Publication();
    $idUtilisateur = $_GET['userID'];    
    $photo = $_GET['idPhoto']; 
    var_dump($publication->demiam($idUtilisateur, $photo));
} // FIN if(isset($_GET['demiam']))

/* -------------------------------------
| SI on cherche à ajouter un commentaire sur une photo
| -------------------------
| PARAM
|   $_SESSION['userID']    : (INT) - Le ID de l'utilisateur qui commente
|   $_GET['recetteID']     : (INT) - Le ID de la photo à commenter
| -------------------------
| RETURN
|   aucun   
| -------------------------
| DESCRIPTION
|   Ajoute un commentaire à une photo dans la BDD et gère l'affichage immédiat de celui-ci
|------------------------------------- */
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