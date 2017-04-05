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



// si la case est vide le user ne s'inscrit pas

		
			
                    // la requete du user
			
			$sql = "INSERT INTO utilisateur (nomUtilisateur, courriel, motDepasse) VALUES ('$nomUtilisateur', '$courriel', '$mp')";
                        
                        
                        
                        
			$result = mysqli_query($conn, $sql);
                        
                        // connecte deja le user au site // 
                        
                      $_SESSION['nomUtilisateur'] = $nomUtilisateur;
					  $_SESSION['courriel'] = $courriel; 
					  $_SESSION['motDePasse'] = $mpd; 

                                           

                                 $sql = "SELECT * FROM utilisateur WHERE nomUtilisateur='$nomUtilisateur' and motDePasse ='$mpd'";
                                $result = mysqli_query($conn, $sql);

                                             // metre le id du user dans une variable session
                                if(!$row = mysqli_fetch_assoc($result)) {
                                     echo "Votre email ou mot de passes est incorect";
								}else{
                                     $_SESSION['id'] = $row['idUtilisateur'] ;

									}
                    header("Location: ../index.php");
            
		   
		   
			
			
		
 




