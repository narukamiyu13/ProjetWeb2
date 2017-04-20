<style type="text/css">
    .menu {
        width:100%;
        height:30px;
    }
    
    .menu a {
        line-height:30px;
        text-align:center;
        border:1px solid black;
        display:inline-block;
        width:32%;
        height:30px;
    }
</style>
<h2>Bienvenue sur le dashboard</h2>
<p class="menu"><a href="index.php?page=liste">Liste des membres</a><a href="index.php?page=signalements">Membres Signalés</a><a href="index.php?logout">Déconnexion</a></p>
<?php
require_once("controller/Controller.php");
$controller = new Controller();

$controller->gererDashboard();

?>