<?php
session_start();
require_once("app/controller/ControleurProfil.class.php");
require_once("app/controller/ControleurPublication.class.php");
//Creer un nouveau controleur profil
$controleur = new ControleurProfil();
//Appel de la fonction pour gerer le profil
$controleur->gererProfil();
//Creer un nouveau controleur publication
$controleurPublication =new ControleurPublication();
//Appel de la fonction pour gerer l'ajout de photo
$controleurPublication->gererVueAjoutPhoto();
//$controleurPublication->gererAjoutRecette();

?>