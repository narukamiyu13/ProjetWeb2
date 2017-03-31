<?php


//Importation des modeles
require_once('app/model/User.class.php');
require_once('app/model/Profil.class.php');

$tonUsager = new ModeleProfil();
$tonUsager = $tonUsager->profilUtilisateur($_GET['userID']);



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

?>