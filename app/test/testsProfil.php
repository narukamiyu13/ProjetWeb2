<?php

//Importation des vues

require_once('../model/modeleUser.php');
require_once('../view/profil.php');



/// selectionnerNombre($colone, $table, $personneUnique = false, $idPersonne = NULL, $photo = false, $photoID = NULL)

?>


<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tests Profil</title>
</head>
<body>
    
    <h1>Tests Profil</h1>
    
    <h2> Test selection du nombre total de publications</h2>

    <?php
    
        $userProfile = new modeleProfil();
    
        echo $userProfile->selectionnerNombre('idPhoto', 'photo');
    
    ?>
    
    <h2> Test selection du nombre d'abonnés de l'utilisateur 1</h2>

    <?php
    
       
    
        echo $userProfile-> selectionnerNombre('idabonne', 'abonnes', true, 1);
    
    ?>
    
     
    <h2> Test selection du nombre d'abonnements de l'utilisateur 1</h2>

    <?php
    
       
    
        echo $userProfile-> selectionnerNombre('id_user_suivi', 'abonnements', true, 1);
    
    ?>
    
     <h2> Test selection des infos de l'utilisateur 1</h2>

    <?php
    
       
    
        var_dump($userProfile-> selectionnerInfosUtilisateur(1));
    
    ?>
    
    
     <h2> Test selection des photos de l'utilisateur 1</h2>

    <?php
    
       
    
        var_dump($userProfile-> selectionnerPhotosUtilisateur(1));
    ?>
    
    
     <h2> Test Création d'un utilisateur et affichage de ses informations</h2>

    <?php
    
       
    $utilisateur = $userProfile->profilUtilisateur(1);
    
    
    
    ?>
    <pre>
    <?php
        print_r($utilisateur);
    ?>
    
    </pre>
    

</body>
</html>