<?php

    require_once("Model.class.php");

    class Utilisateur extends Modele{
        
        public function __construct($idUtilisateur, $nom, $prenom, $nomUtilisateur, $description, $urlPhoto, $dateJoint, $nbAbonnes, $nbAbonnements, $nbPhotos, $photos){
            $this->idUtilisateur = $idUtilisateur;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->nomUtilisateur = $nomUtilisateur;
            $this->description = $description;
            $this->urlPhoto = $urlPhoto;
            $this->dateJoint = $dateJoint;
            $this->nbAbonnes = $nbAbonnes;
            $this->nbAbonnements = $nbAbonnements;
            $this->nbPhotos = $nbPhotos;
            $this->photos = $photos;
        }
        
        
        /* -------------------------------------
        | fonction checkAbonnement
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
            function checkAbonnement($idUtilisateurConnecte){
            try{
                $PDO = $this->connectionBD();
                $requete = "SELECT * FROM abonnes WHERE idabonne=".$idUtilisateurConnecte." AND idUtilisateur=".$this->idUtilisateur;
                $PDOStatement = $PDO->prepare($requete);
                $PDOStatement->execute();
                $resultat = $PDOStatement->fetch(PDO::FETCH_NUM);
                
                if($resultat[0]) {
                    return true;
                } else {
                    return false;
                }
               
            } catch(PDOException $e){
                echo "Erreur: ".$e->getMessage();
            }
        }
        
         /* -------------------------------------
        | fonction abonner
        | -------------------------
        | PARAM
        |   $idUtilisateurConnecte : (int) Le ID de l'utilisateur connecté qui navigue
        | -------------------------
        | RETURN
        |   aucun    
        | -------------------------
        | DESCRIPTION
        |   Abonne l'utilisateur qui navigue sur le site au détenteur du profil qu'il visite
        |------------------------------------- */
        function abonner($idUtilisateurQuiNavigue){
            try{
                $PDO = $this->connectionBD();
                $requete = "INSERT INTO abonnements (id_user_suivi,idUtilisateur,timestamp) VALUES (".$this->idUtilisateur.",".$idUtilisateurQuiNavigue.", NOW())";
                $PDOStatement = $PDO->prepare($requete);
                $exec = $PDOStatement->execute();
               // echo $exec;
                $requete = "INSERT INTO abonnes (idUtilisateur,idabonne,timestamp) VALUES (".$this->idUtilisateur.",".$idUtilisateurQuiNavigue.", NOW())";
                $PDOStatement = $PDO->prepare($requete);
                $PDOStatement->execute();
            } catch(PDOException $e){
                echo "Erreur: ".$e->getMessage();
            }
        }
        
        
        /* -------------------------------------
        | fonction desabonner
        | -------------------------
        | PARAM
        |   $idUtilisateurConnecte : (int) Le ID de l'utilisateur connecté qui navigue
        | -------------------------
        | RETURN
        |   aucun    
        | -------------------------
        | DESCRIPTION
        |   Desabonne l'utilisateur qui navigue sur le site au détenteur du profil qu'il visite
        |------------------------------------- */
        function desabonner($idUtilisateurQuiNavigue){
            try{
                $PDO = $this->connectionBD();
                $requete = "DELETE FROM abonnements WHERE id_user_suivi=".$this->idUtilisateur." AND idUtilisateur=".$idUtilisateurQuiNavigue;
                $PDOStatement = $PDO->prepare($requete);
                $PDOStatement->execute();
                $requete = "DELETE FROM abonnes WHERE idUtilisateur=".$this->idUtilisateur." AND idabonne=".$idUtilisateurQuiNavigue;
                $PDOStatement = $PDO->prepare($requete);
                $PDOStatement->execute();
            } catch(PDOException $e) {
                echo "Erreur: ".$e->getMessage();
            }
        }
        
        
        
    }

?>