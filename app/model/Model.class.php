<?php

class Modele {
    
    
    /* -------------------------------------
    | fonction connectionBD
    | -------------------------
    | PARAM
    |   aucun
    | -------------------------
    | RETURN
    |   $PDO    : Objet de connection à la BDD
    | -------------------------
    | DESCRIPTION
    |   Tente une connection à la BDD
    |   afficher une erreur en cas d'échec.
    |------------------------------------- */ 
    public function connectionBD() {
        try{
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
            $PDO = new PDO("mysql:host=localhost;dbname=Foodie","root","",$options);
            return $PDO;
        } catch(PDOException $erreur) {
            echo "Erreur: ".$erreur->getMessage()."<br/>";
            die();
        }
    }
    
    
     /* -------------------------------------
    | fonction selectionnerNombre
    | -------------------------
    | PARAM
    |   $colone         : (STRING)  la colone à compter
    |   $table          : (STRING)  la table dans laquelle se trouve la colone à compter
    |   $personneUnique : (BOOL)    Indique si on veut sélectionner les informations d'une personne unique. False par défaut.
    |   $idPersonne     : (INT)     Si personne unique, le ID de la personne dont on veut les informations NULL par défaut.
    |   $photo          : (BOOL)    Indique si on sélectionne sur une photo. False par défaut
    |   $photoID        : (INT)     Si sélection sur photo, indique l'ID de la photo. NULL par défaut.
    | -------------------------
    | RETURN
    |   $resultat[0]    : (INT)     Le nombre d'entrées d'une colone
    | -------------------------
    | DESCRIPTION
    |   Sélectionne le nombre d'entrées d'une colone
    |------------------------------------- */ 
    public function selectionnerNombre($colone, $table, $personneUnique = false, $idPersonne = NULL, $photo = false, $photoID = NULL){
        
        try{
            $PDO = $this->connectionBD();
            $requete = "SELECT COUNT(".$colone.") FROM ".$table."";
            
            if($personneUnique){
                $requete.=" WHERE idUtilisateur=".$idPersonne;
            }
            
            if($photo){
                $requete.=" WHERE idPhoto=".$photoID;
            }
            
            $PDOStatement = $PDO->prepare($requete);
            $execution = $PDOStatement->execute();
            $resultat =  $PDOStatement->fetch(PDO::FETCH_NUM);
            return $resultat[0];
            
        } catch(PDOException $erreur){
            echo "Erreur: ".$erreur->getMessage()." <br/>";
            die();
        }
        
    } // FIN DE FONCTION selectionnerNombre
    
    /* -------------------------------------
        | fonction gererConnexion
        | -------------------------
        | PARAM
        |   $idUtilisateurConnecte : (int) Le ID de l'utilisateur connecté qui navigue
        | -------------------------
        | RETURN
        |   bool    
        | -------------------------
        | DESCRIPTION
        |   Verifie si la personne qui navigue est abonnée a un utilisateur.
        |------------------------------------- */ 
            function gererConnexion($nomUtilisateur,$password){
            try{
                $PDO = $this->connectionBD();
                $password = sha1($password);
                $requete = "SELECT idUtilisateur FROM utilisateur WHERE nomUtilisateur = '$nomUtilisateur' AND motDePasse= '$password'";
                $PDOStatement = $PDO->prepare($requete);
                //var_dump();
                $PDOStatement->execute();
                return $PDOStatement->fetch(PDO::FETCH_NUM)[0];
                        
               
            } catch(PDOException $e){
                echo "Erreur: ".$e->getMessage();
            }
        } // FIN DE FONCTION gererConnexion


    /* -------------------------------------
        | fonction gererInscription
        | -------------------------
        | PARAM
        |   $idUtilisateurConnecte : (int) Le ID de l'utilisateur connecté qui navigue
        | -------------------------
        | RETURN
        |   bool    
        | -------------------------
        | DESCRIPTION
        |   Verifie si la personne qui navigue est abonnée a un utilisateur.
        |------------------------------------- */ 
    
    function gererInscription($nomUtilisateur,$password,$courriel){
            try{
                $PDO = $this->connectionBD();
                $nomUtilisateur = htmlspecialchars($nomUtilisateur);
                $courriel = htmlspecialchars($courriel);
                 $password = sha1($password);
                $requete = "INSERT INTO utilisateur (nomUtilisateur,motDePasse,courriel) VALUES ('$nomUtilisateur','$password','$courriel')";
                $PDOStatement = $PDO->prepare($requete);
                $PDOStatement->execute();
                        
               
            } catch(PDOException $e){
                echo "Erreur: ".$e->getMessage();
            }
        } // FIN DE FONCTION gererInscription
    
    
        /* -------------------------------------
        | fonction checkToken
        | -------------------------
        | PARAM
        |   $idUtilisateurConnecte : (int) Le ID de l'utilisateur connecté qui navigue
        | -------------------------
        | RETURN
        |   bool    
        | -------------------------
        | DESCRIPTION
        |   Verifie si la personne qui navigue est abonnée a un utilisateur.
        |------------------------------------- */ 
    
    function checkToken($uid, $token){
            try{
               $PDO = $this->connectionBD();
                $query = "SELECT COUNT(resetID) FROM passwordResets WHERE userID=$uid AND confirmationCode=$token";
                $PDOStatement = $PDO->prepare($query);
                $PDOStatement->execute();
                $resultat = $PDOStatement->fetch(PDO::FETCH_NUM)[0];
                
                if($resultat == 1) {
                    return true;
                } else {
                    return false;
                }
                        
               
            } catch(PDOException $e){
                echo "Erreur: ".$e->getMessage();
            }
        } // FIN DE FONCTION checkToken
    
    
     /* -------------------------------------
        | fonction checkToken
        | -------------------------
        | PARAM
        |   $idUtilisateurConnecte : (int) Le ID de l'utilisateur connecté qui navigue
        | -------------------------
        | RETURN
        |   bool    
        | -------------------------
        | DESCRIPTION
        |   Verifie si la personne qui navigue est abonnée a un utilisateur.
        |------------------------------------- */ 
    
    function checkExpiration($uid, $token){
            try{
               $PDO = $this->connectionBD();
                $query = "SELECT expired FROM passwordResets WHERE userID=$uid AND confirmationCode=$token";
                $PDOStatement = $PDO->prepare($query);
                $PDOStatement->execute();
                $resultat = $PDOStatement->fetch(PDO::FETCH_NUM)[0];
                
                return $resultat;
                        
               
            } catch(PDOException $e){
                echo "Erreur: ".$e->getMessage();
            }
        } // FIN DE FONCTION checkToken
    
    
    
     /* -------------------------------------
        | fonction checkToken

        | -------------------------
        | PARAM
        |   $idUtilisateurConnecte : (int) Le ID de l'utilisateur connecté qui navigue
        | -------------------------
        | RETURN
        |   bool    
        | -------------------------
        | DESCRIPTION
        |   Verifie si la personne qui navigue est abonnée a un utilisateur.
        |------------------------------------- */ 
    

    function expireToken($uid, $token){
            try{
               $PDO = $this->connectionBD();
                $query = "UPDATE passwordResets SET expired=1 WHERE userID=$uid AND confirmationCode=$token";
                $PDOStatement = $PDO->prepare($query);

                $PDOStatement->execute();
                        
               
            } catch(PDOException $e){
                echo "Erreur: ".$e->getMessage();
            }

        } // FIN DE FONCTION gererInscription

    
    /* -------------------------------------
        | fonction gererInscription
        | -------------------------
        | PARAM
        |   $idUtilisateurConnecte : (int) Le ID de l'utilisateur connecté qui navigue
        | -------------------------
        | RETURN
        |   bool    
        | -------------------------
        | DESCRIPTION
        |   Verifie si la personne qui navigue est abonnée a un utilisateur.
        |------------------------------------- */ 
    
    function gererInscription($nomUtilisateur,$password,$courriel){
            try{
                $PDO = $this->connectionBD();
                $requete = "INSERT INTO utilisateur (nomUtilisateur,motDePasse,courriel) VALUES ('$nomUtilisateur','$password','$courriel')";
                $PDOStatement = $PDO->prepare($requete);
                $PDOStatement->execute();
                        
               
            } catch(PDOException $e){
                echo "Erreur: ".$e->getMessage();
            }
        } // FIN DE FONCTION gererInscription
    
     /* -------------------------------------
        | fonction checkToken
        | -------------------------
        | PARAM
        |   $idUtilisateurConnecte : (int) Le ID de l'utilisateur connecté qui navigue
        | -------------------------
        | RETURN
        |   bool    
        | -------------------------
        | DESCRIPTION
        |   Verifie si la personne qui navigue est abonnée a un utilisateur.
        |------------------------------------- */ 
    
    function updatePassword($pass){
            try{
                $pass = sha1($pass);
                $PDO = $this->connectionBD();
                $query = "UPDATE utilisateur SET motDePasse='$pass' WHERE idUtilisateur=".$_GET['uid'];
                $PDOStatement = $PDO->prepare($query);
                $PDOStatement->execute();
                        
               
            } catch(PDOException $e){
                echo "Erreur: ".$e->getMessage();
            }
        } // FIN DE FONCTION checkToken
    
} // FIN DE CLASSE




?>