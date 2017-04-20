<?php

if(isset($_GET['getListeMembres'])){
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
    $PDO = new PDO("mysql:host=localhost;dbname=Foodie","root","",$options);
    $query = "SELECT idUtilisateur, nom, prenom, nomUtilisateur, courriel FROM utilisateur ";
    $PDOStatement = $PDO->prepare($query);
    $PDOStatement->execute();
    $resultats = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($resultats as $resultat){
        echo "<p><span>".$resultat['nom'].", ".$resultat['prenom']."</span><span>".$resultat['nomUtilisateur']."</span><span>".$resultat['courriel']."</span><span></span><span><a href='traitement.php?supprimer&id=".$resultat['idUtilisateur']."'>Supprimer</a></span></p>";
    }
}


if(isset($_GET['search'])){
    $filter = $_GET['filter'];
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
    $PDO = new PDO("mysql:host=localhost;dbname=Foodie","root","",$options);
    $query = "SELECT idUtilisateur, nom, prenom, nomUtilisateur, courriel FROM utilisateur WHERE nom LIKE '%$filter%' OR prenom LIKE '%$filter%' OR nomUtilisateur LIKE '%$filter%' OR courriel LIKE '%$filter%'";
    $PDOStatement = $PDO->prepare($query);
    $PDOStatement->execute();
    $resultats = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($resultats as $resultat){
        echo "<p><span>".$resultat['nom'].", ".$resultat['prenom']."</span><span>".$resultat['nomUtilisateur']."</span><span>".$resultat['courriel']."</span><span></span><span><a href='traitement.php?supprimer&id=".$resultat['idUtilisateur']."'>Supprimer</a></span></p>";
    }
}


if(isset($_GET['supprimer'])){
    $id= $_GET['id'];
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
    $PDO = new PDO("mysql:host=localhost;dbname=Foodie","root","",$options);
    $query = "DELETE FROM utilisateur WHERE idUtilisateur=$id";
    $PDOStatement = $PDO->prepare($query);
    $PDOStatement->execute();
    header("location:index.php");
}
?>