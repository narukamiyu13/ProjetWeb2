<?php

require_once("Model.class.php");



class ModeleProfil extends Modele {
    
    
    function selectionnerInfosUtilisateur($idUtilisateur){
        try{
            $PDO = $this->connectionBD();
            $requete = "SELECT * FROM  utilisateur WHERE idUtilisateur=".$idUtilisateur;
            $PDOStatement = $PDO->prepare($requete);
            $PDOStatement->execute();
            $infos = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            
            return $infos;
        } catch(PDOException $e){
            echo "Erreur: ".$e->getMessage();
        }
    }
    
    
    function selectionnerPhotosUtilisateur($idUtilisateur){
         try{
            $PDO = $this->connectionBD();
            $requete = "SELECT * FROM  photo WHERE idUtilisateur=".$idUtilisateur;
            $PDOStatement = $PDO->prepare($requete);
            $PDOStatement->execute();
            $infos = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
            
            return $infos;
        } catch(PDOException $e){
            echo "Erreur: ".$e->getMessage();
        }
    }
    
    function profilUtilisateur($idUtilisateur){
        $infosUser = $this->selectionnerInfosUtilisateur($idUtilisateur);
        $photos = $this->selectionnerPhotosUtilisateur($idUtilisateur);
        $nbAbonnes = $this->selectionnerNombre('idabonne', 'abonnes', true, $idUtilisateur);
        $nbAbonnements = $this-> selectionnerNombre('id_user_suivi', 'abonnements', true, $idUtilisateur);
        $nbPhotos = $this->selectionnerNombre('idPhoto', 'photo', true, $idUtilisateur);
        
        
        return new Utilisateur($idUtilisateur, $infosUser['nom'], $infosUser['prenom'], $infosUser['description'], $infosUser['urlPhoto'], $infosUser['dateJoint'], $nbAbonnes, $nbAbonnements, $nbPhotos, $photos);
    }
    
    
}

?>