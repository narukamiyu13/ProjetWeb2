<?php


//Importation des modeles
require_once('app/model/User.class.php');
require_once('app/model/Profil.class.php');

//set $tonUsager 2- on appel la fonction qui retourne l'objet user
$tonUsager = new ModeleProfil();
$tonUsager = $tonUsager->profilUtilisateur($_GET['userID']);
//$tonusager(ojbet) contient tout les informations sur ton utilisateur


$_SESSION['userID'] = 2;




//Gérer les différences de comportement entre notre profil, et le profil des autres.
if($_SESSION['userID'] == $tonUsager->idUtilisateur){
     //Le code si c'est le profil de l'utilisateur connecté
    $profilUserActuel = true;
    $title = "Ajout photo";
    $checkAbonnement=false;
   
} else {
    //Le code si c'est le profil d'un autre utilisateur
    $profilUserActuel = false;
    $title = "S'Abonner";
    $checkAbonnement = $tonUsager->checkAbonnement($_SESSION['userID']);
}

//appel de la vue

?>