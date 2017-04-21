<!--
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
NOM : 
PROJET : Foodie
ORGANISDATION : College Maisonneuve
PAGE : inscription.php
DATE DE CREATION : 27-03-17
DESCRIPTION : page appelant le controleur pour gerer linscription dun utilisateur

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
-->
<?php 
session_start();
require_once("app/controller/Controleur.class.php");
$controleur = new Controleur();

$controleur -> gererInscription();