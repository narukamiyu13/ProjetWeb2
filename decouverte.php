<!--
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
NOM : 
PROJET : Foodie
ORGANISDATION : College Maisonneuve
PAGE : decouverte.php
DATE DE CREATION : 27-03-17
DESCRIPTION : page appelant le controleur qui appelle la fonction gerant e fil de decouverte

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
-->
<?php 

session_start();
require_once("app/controller/ControleurPublication.class.php");
$controleurPublication = new ControleurPublication();

$controleurPublication -> gererDecouverte();
