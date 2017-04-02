<?php

require_once("Model.class.php");



class ModeleProfil extends Modele {
    
     /* -------------------------------------
        | fonction selectionnerInfosUtilisateur
        | -------------------------
        | PARAM
        |   $idUtilisateur : (int) Le ID de l'utilisateur dont on veut les informations
        | -------------------------
        | RETURN
        |   $info   : (ARRAY) Les informations de l'utilisateur    
        | -------------------------
        | DESCRIPTION
        |   Sélectionne toutes les informations sur un utilisateur
        |------------------------------------- */ 
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
    
     /* -------------------------------------
        | fonction selectionnerPhotosUtilisateur
        | -------------------------
        | PARAM
        |   $idUtilisateur : (int) Le ID de l'utilisateur dont on veut les photos
        | -------------------------
        | RETURN
        |   $photos     : (ARRAY) Les photos de l'utilisateur   
        | -------------------------
        | DESCRIPTION
        |   Sélectionne toutes les photos d'un utilisateur
        |------------------------------------- */ 
    function selectionnerPhotosUtilisateur($idUtilisateur){
         try{
            $PDO = $this->connectionBD();
            $requete = "SELECT * FROM  photo WHERE idUtilisateur=".$idUtilisateur;
            $PDOStatement = $PDO->prepare($requete);
            $PDOStatement->execute();
            $photos = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
            
            return $photos;
        } catch(PDOException $e){
            echo "Erreur: ".$e->getMessage();
        }
    }
    
    
     /* -------------------------------------
        | fonction profilUtilisateur
        | -------------------------
        | PARAM
        |   $idUtilisateur : (int) Le ID de l'utilisateur a partir duquel on veut créer l'objet pour le profil
        | -------------------------
        | RETURN
        |   Object Utilisateur :    (UTILISATEUR) Objet contenant toutes les informations sur l'utilisateur    
        | -------------------------
        | DESCRIPTION
        |   Crée un objet Utilisateur à partir des informations
        |------------------------------------- */ 
    function profilUtilisateur($idUtilisateur){
        $infosUser = $this->selectionnerInfosUtilisateur($idUtilisateur);
        $photos = $this->selectionnerPhotosUtilisateur($idUtilisateur);
        $nbAbonnes = $this->selectionnerNombre('idabonne', 'abonnes', true, $idUtilisateur);
        $nbAbonnements = $this-> selectionnerNombre('id_user_suivi', 'abonnements', true, $idUtilisateur);
        $nbPhotos = $this->selectionnerNombre('idPhoto', 'photo', true, $idUtilisateur);
        
        
        return new Utilisateur($idUtilisateur, $infosUser['nom'], $infosUser['prenom'], $infosUser['nomUtilisateur'], $infosUser['sexe'],$infosUser['courriel'],$infosUser['description'], $infosUser['urlPhoto'], $infosUser['dateJoint'], $nbAbonnes, $nbAbonnements, $nbPhotos, $photos);
    }
    
    
}

?>