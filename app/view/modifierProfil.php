<?php
//echo $tonUsager->sexe;
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <!--
    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    NOM : 
    PROJET : Foodie
    ORGANISDATION : College Maisonneuve
    PAGE : modifierProfil.php
    DATE DE CREATION : 27-03-17
    DESCRIPTION : page d'accueil
	
    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    -->
    <meta charset="utf-8">
    <title>Home</title>
    <link href="app/assets/style.css" rel="stylesheet">
    <link href="app/assets/reset.css" rel="stylesheet">
     <!-- police de google -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <!-- menu JavaScript -->
    <script src="app/assets/js/menu.js"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

    <body>
        <div id="container">
            <div id="modfierProfil">
                <section class="formulaireProfil">
                    <form action= "<?= $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="blockprofil">
                            <h1>Modifer votre profil</h1>
                            <figure class="<?php if($tonUsager->urlPhoto!=NULL){echo "unePhoto";}else{echo "photoProfil";}?>" >
                                <!--<a href="//<?php echo "userID=".$_GET['userID']."";?>">-->
                                <img class="rond" src="<?php if($tonUsager->urlPhoto!=NULL){echo "$tonUsager->urlPhoto";}else{echo"app/assets/images/images.png";}?>" width="150px" height="150px" alt="photoProfil">
                                <p>Prénom:</p><input id="prenom" type="text" value="<?php echo $tonUsager->prenom;?>"><br>
                                <p>Nom:</p><input id="nom" type="text" value="<?php echo $tonUsager->nom;?>"><br>
                                <p>Description:</p><input id="description" type="text" value="<?php echo $tonUsager->description;?>" ><br>
                                <p>Courriel:</p><input id="courriel" type="text" value="<?php echo $tonUsager->courriel;?>"><br>
                                <p>Sexe:</p><input id="sexe" type="text" value="<?php echo $tonUsager->sexe;?>">
        <!--<select id="sexe">
            <option value="Femme">Femme</option>
            <option value="homme">Homme</option> </select><br>
        -->                     <input id="submitProfil" type="submit" value="Modifier">
                            </figure>
                        </div>
                    </form>
                </section> 
            </div>
        </div>
    </body>
</html>