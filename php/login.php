<?php
session_start();
include 'connexionBD.php';

// recuper les valeurs et les mettres dans une variable session
$nomUtilisateur = $_POST['nomUtilisateur'];
$mp = $_POST['motDePasse'];


$_SESSION['nomUtilisateur'] = $nomUtilisateur;
$_SESSION['motDePasse'] = $mp; 

// verifaction pour connecter le user

$sql = "SELECT * FROM utilisateur WHERE nomUtilisateur='$nomUtilisateur' and motDePasse ='$mp'";
$result = mysqli_query($conn, $sql);

if(!$row = mysqli_fetch_assoc($result)) {
    echo "Votre email ou mot de passes est incorect";
}else{
     $_SESSION['id'] = $row['idUtilisateur'] ;
    
}

header("Location: ../index.php");