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