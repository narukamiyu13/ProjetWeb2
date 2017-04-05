<!DOCTYPE html>
<?php
session_start();

//echo $_SESSION['id'];


?>
<html lang="fr">
<head>
    <!--
    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    NOM : Alice Pare
    PROJET : Foodie
    ORGANISDATION : College Maisonneuve
    PAGE : index.php
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
<?php include_once'header.php'; ?>
        <section class="top">
            <div class="row">
                <div id="texte">
                    <h1>Foodie: Une personne ayant un intérêt particulier pour la cuisine, Un gourmet.</h1>
                    <button id="inscription"><a href="inscription.php">Inscription</a></button>
                </div>    
            </div>    
        </section>
        <section class="banniereJaune">
            <div class="row2">
            <h2>Découvrez les nouvelles tendances culinaire!</h2>
                <p><a href ="">Inscrivez-vous dès aujourd'hui</a></p>
            </div>
        </section>
         <section class="banniereBlanche">
             <img id="burger" src="app/assets/images/burger.png" alt="burger"/>
                <h2>Inspirez-vous de nos recettes!</h2>
                <p>Des idées pleins la tête</p>
        </section>
        <section class="connectezVous">
            <div class="row3">
                <h2>Arrêtez<br> d'attendre.<br>Commencez <br>à partager</h2>
                <a href="" >Creez votre compte Foodie dès aujourd'hui</a>
            </div>
        </section>
    <section class="viveFoodie">
        <div class="cercle">
            <img id="oeuf" src="app/assets/images/oeuf1.png" alt="oeuf"/>
            <img id="oeuf" src="app/assets/images/oeuf1.png" alt="oeuf"/>
            <img id="oeuf" src="app/assets/images/oeuf1.png" alt="oeuf"/>
        </div>
        <h2>Vive les Foodies</h2>
    </section>
		<?php include_once'footer.php'; ?>
    
</body>
</html>    