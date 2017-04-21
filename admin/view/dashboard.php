<?php
/* -------------------------------------
| fichier dashboard.php
| -------------------------
| CONTRIBUTEURS
|   Auteur: Cédrick Collin
|   Modifications: Cédrick Collin 
| -------------------------
| DATES
|   Création: 19 avril 2017
|   Dernière Modification: 20 avril 2017
| -------------------------
| DESCRIPTION
|   Vue - Affichage de l'interface de base du panneau d'administration
|------------------------------------- */
?>

<head>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
</head>

<body class="dashboard">
    <h2>Bienvenue sur le dashboard</h2>
    <p class="menu"><a href="index.php?page=liste">Liste des membres</a><a href="index.php?page=signalements">Membres Signalés</a><a href="index.php?logout">Déconnexion</a></p>
    <?php
    require_once("controller/Controller.php");
    $controller = new Controller();

    $controller->gererDashboard();


    ?>
 </body>