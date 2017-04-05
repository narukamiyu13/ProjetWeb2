<?php
session_start();
include 'connexionBD.php';

// recuper les valeurs

$nomUtilisateur = $_POST['nomUtilisateur'];
$courriel= $_POST['courriel'];
$mp = $_POST['motDePasse'];


// les mettre dans des variables sessions

$_SESSION['nomUtilisateur'] = $nomUtilisateur;
$_SESSION['courriel'] = $courriel; 
$_SESSION['motDePasse'] = $mp; 





		
			
                    // la requete du user
			
			$sql = "INSERT INTO utilisateur (nomUtilisateur, courriel, motDepasse) VALUES ('$nomUtilisateur', '$courriel', '$mp')";
                        
                        
                        
                        
			$result = mysqli_query($conn, $sql);
                        
                        // connecte deja le user au site // 
                        
                      $_SESSION['nomUtilisateur'] = $nomUtilisateur;
					  $_SESSION['courriel'] = $courriel; 
					  $_SESSION['motDePasse'] = $mp; 

                                           

                                 $sql = "SELECT * FROM utilisateur WHERE nomUtilisateur='$nomUtilisateur' and motDePasse ='$mp'";
                                $result = mysqli_query($conn, $sql);

                                             // metre le id du user dans une variable session
                                if(!$row = mysqli_fetch_assoc($result)) {
                                     echo "Votre nomUtilisateurt incorect";
								}else{
                                     $_SESSION['id'] = $row['idUtilisateur'] ;

									}
                    header("Location: ../index.php");
            
		   
		   
			
			
		
 




