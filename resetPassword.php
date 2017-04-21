<?php 
/* -------------------------------------
| fichier resetPassword.php
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
|   Page de la récupération de mot de passe
|------------------------------------- */
session_start();
require_once("app/controller/Controleur.class.php");
$controleur = new Controleur();

$controleur -> gererReset();
