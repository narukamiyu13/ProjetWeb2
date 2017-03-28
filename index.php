<!DOCTYPE html>
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
<!--    menu slider-->
    <div id="menuSlider" class="sideMenu">
          <a href="javascript:void(0)" class="fermer" >&times;</a>
          <a href="#">Profil</a>
          <a href="#">Découverte</a>
            <a href="#">Ajouter une photo</a>
          <a href="#">Recherche</a>
          <a href="#">Modifier le profil</a>
            <a href="#">Connexion</a>
            <a href="#">Déconnexion</a>
    </div>
    <div id="container">
        <!--    entete-->
        <nav id ="navbar">
            <div class="row">
                <ul>
                    <img id="menu" src="app/assets/images/menu.png" alt="menu"/>
                    <li><a href="">Découverte </a></li>
                     <li><a href="">Connexion </a></li>
              </ul>
            </div>
        </nav>
        <section class="top">
            <div class="row">
                <div id="texte">
                    <h1>Foodie: Une personne ayant un intérêt particulier pour la cuisine, Un gourmet.</h1>
                    <button id="inscription"><a href="#">Inscription</a></button>
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
             <img id="burger" src="images/burger.png" alt="burger"/>
                <h2>Inspirez-vous de nos recettes!</h2>
                <p>Des idées pleins la tête</p>
        </section>
        <section class="connectezVous">
            <div class="row3">
                <h2>Arrêtez<br> d'attendre.<br>Commencez <br>à partager</h2></h1>
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
    <footer>
         <ul class="listeFooter">
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                    <a href="#">Termes</a>
                </li>
                <li>
                    <a href="#">FAQ</a>
                </li>
            </ul>
    
    </footer>
    </div>
</body>
</html>    