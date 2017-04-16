
<!DOCTYPE html>
<html lang="fr">
<head>
    <!--
    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    NOM : 
    PROJET : Foodie
    ORGANISDATION : College Maisonneuve
    PAGE : decouverte.php
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
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body class="milieu">

    <header class="adminHeader">
        <div class="adminLogo">

            <h1>Admin</h1>
            <img src="app/assets/images/burger.png" height="120px" width="120px">
                
        </div>    
    </header>  
    <section class="adminUtilisateur">
        
            <div class="adminTitre">
               <h2>Nom</h2>
                <h2>Courriel</h2>
                <h2>Sexe</h2>
                <h2>Membre depuis</h2>
            </div>
            <div class="adminPersonne">
                <p>Mathieu</p>
                <p>matmat@gmail.com</p>
                <p>M</p>
                <p>2017-04-11</p>
                <span class="adminPW"><p>Modifier le mot de passe</p></span>
                <span class="x"><p>X</p></span>
            </div>
        <form class="adminMotDePasse hidden">
           
            <label>Nouveau mot de passe:</label><input type="password" id="adminPassword">
            <input type="submit" class="adminSubmit" value="Modifier">
             <span class="fermeture">X</span>
        </form>
    </section>
  </body>  
    
    <script>
        //ouvrir la div mot de passe
        function motDePasse()
        {
            divMP = document.querySelector(".adminMotDePasse");
            divMP.classList.remove("hidden");
        }
         //fermer la div mot de passe
        function fermeture()
        {
            divMP = document.querySelector(".adminMotDePasse");
            divMP.classList.add("hidden"); 
        }
        window.addEventListener("load",function(){
           var sltMdp = document.querySelector(".adminPW");
            sltMdp.addEventListener("click",function(){
             motDePasse();
            });
            var selectX = document.querySelector(".fermeture");
            selectX.addEventListener("click",function(){
               fermeture();
            });
        });
    
    </script>

