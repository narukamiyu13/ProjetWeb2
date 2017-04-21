<?php
/* -------------------------------------
| fichier index.php
| -------------------------
| CONTRIBUTEURS
|   Auteur: Cédrick Collin
|   Modifications: Cédrick Collin 
| -------------------------
| DATES
|   Création: 19 avril 2017
|   Dernière Modification: 19 avril 2017
| -------------------------
| DESCRIPTION
|   Vue - Affichage du formulaire de connexion au panneau 
|   d'administration et des messages d'erreurs en cas de
|   tentative échouée
|------------------------------------- */


$errMsg = "&nbsp;";
if(isset($_GET['1478'])){
    $errMsg .="Vous devez entrer un nom d'utilisateur<br/>&nbsp;";
}
if(isset($_GET['9632'])){
    $errMsg .="Vous devez entrer un mot de passe<br/>&nbsp;";
}
if(isset($_GET['2584'])){
    $errMsg .="Les identifiants entrés sont incorrects";
}
?>


<p><?= $errMsg; ?></p>
<form method="post" action="index.php">

    <input type="text" name="username" placeholder="Nom d'utilisateur" >
    <input type="password" name="password" placeholder="Mot de passe" >
    <input type="submit" name="connexion" value="Connexion" >


</form>