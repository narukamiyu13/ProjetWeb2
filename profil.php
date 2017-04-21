<!--
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
NOM : 
PROJET : Foodie
ORGANISDATION : College Maisonneuve
PAGE : profil.php
DATE DE CREATION : 27-03-17
DESCRIPTION : page appelant le controleur pour gerer le profil dun utilisateur

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
-->
<?php
session_start();
require_once("app/controller/ControleurProfil.class.php");
require_once("app/controller/ControleurPublication.class.php");
require_once("app/controller/ControleurRecette.class.php");
//Creer un nouveau controleur profil
$controleur = new ControleurProfil();
//Appel de la fonction pour gerer le profil
$controleur->gererProfil();
//$controleurRecette->rechercheIngredient();
//Creer un nouveau controleur publication
$controleurPublication =new ControleurPublication();
//Appel de la fonction pour gerer l'ajout de photo
$controleurPublication->gererVueAjoutPhoto();
//Creer un nouveau controleur recette
$controleurRecette =new ControleurRecette();
$controleurRecette->gererVueAjoutRecette();

?>