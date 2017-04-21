<?php
/* -------------------------------------
| fichier index.php
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
|   La page d'administration du site foodie
|------------------------------------- */
?>
<!doctype html>

<?php session_start(); ?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Foodie - Administration</title>
</head>
<body>

    <?php
    require_once("controller/Controller.php");
    $controller = new Controller();
    $controller->gererAdmin();
    ?>


</body>
</html>