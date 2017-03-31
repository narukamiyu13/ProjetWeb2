<?php
error_reporting(0);
require_once("app/controller/ControleurProfil.class.php");
$controleur = new ControleurProfil();

$controleur->gererProfil();
?>