<?php
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