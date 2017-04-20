<h2>Bienvenue sur le dashboard</h2>
<p><a href="index.php?page=liste">Liste des membres</a> || <a href="index.php?page=resetRequests">requetes Changements password</a> || <a href="index.php?logout">Déconnexion</a></p>
<?php
require_once("controller/Controller.php");
$controller = new Controller();

$controller->gererDashboard();

?>