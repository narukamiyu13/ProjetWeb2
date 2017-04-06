<?php 
session_start();
require_once("app/controller/Controleur.class.php");
$controleur = new Controleur();

$controleur -> gererConnexion();