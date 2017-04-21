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
|   Dernière Modification: 20 avril 2017
| -------------------------
| DESCRIPTION
|   Tout le traitement ajax de la partie administration
|   du site foodie.
|------------------------------------- */


// SCRIPTS LISTES DE MEMBRES

    /* -------------------------------------
    | SI on cherche à charger toute la liste de membres
    | -------------------------
    | PARAM
    |   aucun
    | -------------------------
    | RETURN
    |   aucun   
    | -------------------------
    | DESCRIPTION
    |   sélectionne tous les membres du site dans la BDD et génère l'affichage de celle-ci
    |------------------------------------- */
if(isset($_GET['getListeMembres'])){
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
    $PDO = new PDO("mysql:host=localhost;dbname=Foodie","root","",$options);
    $query = "SELECT idUtilisateur, nom, prenom, nomUtilisateur, courriel, utilisateur.idRole, typeRole FROM utilisateur INNER JOIN role ON utilisateur.idRole = role.idRole";
    $PDOStatement = $PDO->prepare($query);
    $PDOStatement->execute();
    $resultats = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    echo '<script>
    
     $(".selectRole").change(function(){
        console.log(\'changement\');
        $.ajax({
        type: "GET",
        url: "traitement.php",
        data: "updateRole&role="+this.value+"&uid="+this.dataset.userid,
        success: function(data){
            console.log(data);
        }
        })
    })
    </script>';
    foreach($resultats as $resultat){
        echo "<p><span>".$resultat['nom'].", ".$resultat['prenom']."</span><span>".$resultat['nomUtilisateur']."</span><span>".$resultat['courriel']."</span><span>";
        echo "<select class='selectRole' data-userid=".$resultat['idUtilisateur'].">";
        echo ($resultat['idRole'] == 1) ? "<option value='1' selected>Utilisateur</option> <option value='2'>Administrateur</option> " : "<option value='1'>Utilisateur</option> <option value='2'  selected>Administrateur</option> ";
        echo "</select>";
        echo "</span><span><a href='traitement.php?supprimer&id=".$resultat['idUtilisateur']."'>Supprimer</a></span></p>";
    }
}

    /* -------------------------------------
    | SI on cherche à filtrer la liste de membres
    | -------------------------
    | PARAM
    |   $_GET['filter']: (STRING) - La chaine selon laquelle on veut filtrer la liste
    |   de membres
    | -------------------------
    | RETURN
    |   aucun   
    | -------------------------
    | DESCRIPTION
    |   Sélectionne certains membres dans la BDD et génère l'affichage de la liste de ceux-ci
    |------------------------------------- */
if(isset($_GET['search'])){
    $filter = $_GET['filter'];
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
    $PDO = new PDO("mysql:host=localhost;dbname=Foodie","root","",$options);
    $query = "SELECT idUtilisateur, nom, prenom, nomUtilisateur, courriel, utilisateur.idRole, typeRole  FROM utilisateur INNER JOIN role ON utilisateur.idRole = role.idRole WHERE nom LIKE '%$filter%' OR prenom LIKE '%$filter%' OR nomUtilisateur LIKE '%$filter%' OR courriel LIKE '%$filter%'";
    $PDOStatement = $PDO->prepare($query);
    $PDOStatement->execute();
    $resultats = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($resultats as $resultat){
        echo "<p><span>".$resultat['nom'].", ".$resultat['prenom']."</span><span>".$resultat['nomUtilisateur']."</span><span>".$resultat['courriel']."</span><span></span><span><a href='traitement.php?supprimer&id=".$resultat['idUtilisateur']."'>Supprimer</a></span></p>";
    }
}

    /* -------------------------------------
    | SI on cherche à supprimer un membre
    | -------------------------
    | PARAM
    |   $_GET['id']: (INT) - Le ID du membre qu'on désire supprimer
    | -------------------------
    | RETURN
    |   aucun   
    | -------------------------
    | DESCRIPTION
    |   Supprime un membre de la BDD
    |------------------------------------- */
if(isset($_GET['supprimer'])){
    $id= $_GET['id'];
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
    $PDO = new PDO("mysql:host=localhost;dbname=Foodie","root","",$options);
    $query = "DELETE FROM utilisateur WHERE idUtilisateur=$id";
    $PDOStatement = $PDO->prepare($query);
    $PDOStatement->execute();
    header("location:index.php");
}


    /* -------------------------------------
    | SI on cherche à changer le niveau de permissions d'un membre
    | -------------------------
    | PARAM
    |   $_GET['id']: (INT) - Le ID du membre qu'on désire supprimer
    |   $_GET['role']: (INT) - Le ID du role qu'on veut assigner au membre (1=user, 2=admin)
    | -------------------------
    | RETURN
    |   aucun   
    | -------------------------
    | DESCRIPTION
    |   Change le niveau de permission d'un membre dans la BDD
    |------------------------------------- */      
if(isset($_GET['updateRole'])) {
    $role = $_GET['role'];
    $id= $_GET['uid'];
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
    $PDO = new PDO("mysql:host=localhost;dbname=Foodie","root","",$options);
    $query = "UPDATE utilisateur SET idRole=$role WHERE idUtilisateur=$id";
    $PDOStatement = $PDO->prepare($query);
    $PDOStatement->execute();
    
}



//SCRIPT MEMBRES SIGNALÉS

    /* -------------------------------------
    | SI on cherche à charger la liste des signalements de membres
    | -------------------------
    | PARAM
    |   aucun
    | -------------------------
    | RETURN
    |   aucun   
    | -------------------------
    | DESCRIPTION
    |   Sélectionne la liste des signalements dans la BDD et
    |   génère son affichage.
    |------------------------------------- */
if(isset($_GET['getMembresSignales'])){
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
    $PDO = new PDO("mysql:host=localhost;dbname=Foodie","root","",$options);
    $query = "SELECT 
    signale.idUtilisateur AS idSignale,
    signale.prenom AS prenomSignale,
    signale.nom AS nomSignale,
    signaleur.idUtilisateur AS idSignaleur,
    signaleur.prenom AS prenomSignaleur,
    signaleur.nom AS nomSignaleur,
    raisonSignalement
    FROM signalements 
    INNER JOIN utilisateur AS signale 
    ON signalements.membreSignaleID = signale.idUtilisateur 
    INNER JOIN utilisateur AS signaleur 
    ON signalements.membreSignaleurID = signaleur.idUtilisateur ";
    $PDOStatement = $PDO->prepare($query);
    $PDOStatement->execute();
    $resultats = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($resultats as $resultat){
        echo "<p> <span><a href='../profil.php?userID=".$resultat['idSignale']."' target='_blank'>".$resultat['prenomSignale']." ".$resultat["nomSignale"]."</a></span><span><a href='../profil.php?userID=".$resultat['idSignaleur']."' target='_blank'>".$resultat['prenomSignaleur']." ".$resultat["nomSignaleur"]."</a></span><span>".$resultat['raisonSignalement']."</span></p>";
    }
}

?>