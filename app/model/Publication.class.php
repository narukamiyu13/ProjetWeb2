<?php
/*
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
NOM : 
PROJET : Foodie
ORGANISDATION : College Maisonneuve
PAGE : Publicattion.class.php
DATE DE CREATION : 27-03-17
DESCRIPTION : modele qui gere les publications

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
*/
require_once("Model.class.php");

class Publication extends Modele{
          
    /* -------------------------------------
    | fonction selectionnerPhotoRecette
    | -------------------------
    | PARAM
    |   $photoID : (int) Le ID de la photo de laquelle on veut les informations
    | -------------------------
    | RETURN
    |   Array   : (ARRAY) Les informations de la photo    
    | -------------------------
    | DESCRIPTION
    |   Sélectionne et renvoie toutes les informations relatives à une photo, 
    |   sa recette, les ingrédients nécessaires et les étapes de préparation.
    |------------------------------------- */ 
    
    public function selectionnerPhotoRecette($photoID){
        try{
            $PDO = $this->connectionBD();
            $query = "SELECT nom, prenom, idPhoto, url, photo.description, idRecette, photo.idUtilisateur FROM photo INNER JOIN utilisateur ON photo.idUtilisateur = utilisateur.idUtilisateur WHERE idPhoto=".$photoID;
            $PDOStatement = $PDO->prepare($query);
            $PDOStatement->execute();
            $photoRecette = $PDOStatement->fetch(PDO::FETCH_ASSOC);

            if($photoRecette['idRecette']!= NULL){
                $query = "SELECT * FROM recettes WHERE idRecette=".$photoRecette['idRecette'];
                $PDOStatement = $PDO->prepare($query);
                $PDOStatement->execute();
                $recette = $PDOStatement->fetch(PDO::FETCH_ASSOC);

                $query = "SELECT * FROM etapepreparation WHERE idRecette =".$photoRecette['idRecette']."  ORDER BY numeroEtape ASC";
                $PDOStatement = $PDO->prepare($query);
                $PDOStatement->execute();
                $etapes = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);


                $query = "SELECT * FROM recettes_has_ingredients INNER JOIN ingredients ON recettes_has_ingredients.idingredient = ingredients.idingredient WHERE recettes_has_ingredients.idRecette=".$photoRecette['idRecette'];
                $PDOStatement = $PDO->prepare($query);
                $PDOStatement->execute();
                $ingredientsRecette = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

                 return Array("photo"=>$photoRecette,"recette"=>$recette, "ingredients"=>$ingredientsRecette, "etapes"=>$etapes);
            } else {
                return Array("photo"=>$photoRecette);
            }


        }catch(PDOException $e) {
            return "Erreur: ".$e->getMessage();
        }

    }

        
    /* -------------------------------------
    | fonction getMiam
    | -------------------------
    | PARAM
    |   $photoID : (int) Le ID de la photo de laquelle on veut les informations
    | -------------------------
    | RETURN
    |   $nbMiam   : (int) Le nombre de mentions miam de la photo
    | -------------------------
    | DESCRIPTION
    |   Sélectionne et retourne le nombre de mentions Miam d'une photo
    |------------------------------------- */ 
    
    public function getMiam($photoID){
        $nbMiam = $this->selectionnerNombre('idUtilisateur', 'likes', false, NULL,true,$photoID);
        return $nbMiam;
    }

    /* -------------------------------------
    | fonction getCommentaires
    | -------------------------
    | PARAM
    |   $photoID : (int) Le ID de la photo de laquelle on veut les informations
    | -------------------------
    | RETURN
    |   $commentaires   : (ARRAY) Les commentaires de la photo et leurs informations
    | -------------------------
    | DESCRIPTION
    |   Sélectionne et retourne les commentaires sur une photo et leurs informations
    |------------------------------------- */ 
    
    public function getCommentaires($photoID){
        $PDO = $this->connectionBD();
        $query = "SELECT comment.idUtilisateur, prenom, nom, commentaires FROM comment INNER JOIN utilisateur ON comment.idUtilisateur = utilisateur.idUtilisateur WHERE comment.idPhoto=".$photoID." ORDER BY timestamp ASC";
        $PDOStatement = $PDO->prepare($query);
        $PDOStatement->execute();
        $commentaires = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

        return $commentaires;

        //return $nbMiam;
    }
    
    /* -------------------------------------
    | fonction ajouterCreations
    | -------------------------
    | PARAM
    |   aucun
    | -------------------------
    | RETURN
    |   aucun
    | -------------------------
    | DESCRIPTION
    |   Inserer les photos de lutilisateur dans la base de données
    |------------------------------------- */ 
    public function ajouterCreations(){
        try{
            $PDO = $this->connectionBD();
            if(isset($_FILES['photoCreation']) && isset($_POST['description']))
            {
                $folder="app/assets/photo/".$_SESSION['userID']."/";
                $target_file=basename($_FILES['photoCreation']['name']);
                $description= $_POST['description'];
                $idUtilisateur= $_GET['userID'];
                 if (file_exists($folder.$target_file)) {
                     $increment=0;
                     while(file_exists($folder.$target_file)){
                         $increment++;
                         $target_file = "($increment)-".basename($_FILES["photoCreation"]["name"]);
                     }
                 }
                $photoCreation ='\"'.$folder.$target_file.'\"';
                $requete="INSERT INTO `photo`(`url`, `description`, `idUtilisateur`) VALUES ('$photoCreation','$description','$idUtilisateur')";
                $PDOStatement = $PDO->prepare($requete);
                $PDOStatement->execute();
            }
        }catch(PDOException $e) {
            echo "Erreur: ".$e->getMessage();
        }
    }
    
    /* -------------------------------------
    | fonction checkMiam
    | -------------------------
    | PARAM
    |   $user(int)
    |   $photoID(int)
    | -------------------------
    | RETURN
    |   $check(int)
    | -------------------------
    | DESCRIPTION
    |   Verifie si un utilisateur a aimé une photo
    |------------------------------------- */ 
    public function checkMiam($user,$photoID){
        $PDO = $this->connectionBD();
        $query = "SELECT COUNT(idUtilisateur) FROM likes WHERE idUtilisateur=$user AND idPhoto=$photoID";
        $PDOStatement = $PDO->prepare($query);
        $PDOStatement->execute();
        $check = $PDOStatement->fetch(PDO::FETCH_NUM)[0];
        return $check;
    }
    
    /* -------------------------------------
    | fonction miam
    | -------------------------
    | PARAM
    |   $idPersonne(int)
    |   $idPhoto(int)
    | -------------------------
    | RETURN
    |   $exec(bool)
    | -------------------------
    | DESCRIPTION
    |   Insere une mention miam a une photo
    |------------------------------------- */ 
    
    public function miam($idPersonne, $idPhoto){
        $PDO = $this->connectionBD();
        $requete = "INSERT INTO likes (idUtilisateur,idPhoto, timestamp) VALUES ($idPersonne, $idPhoto, NOW())";
        $PDOStatement = $PDO->prepare($requete);
        $exec = $PDOStatement->execute();
        return $exec;
    }
    
    /* -------------------------------------
    | fonction demiam
    | -------------------------
    | PARAM
    |   $idPersonne(int)
    |   $idPhoto(int)
    | -------------------------
    | RETURN
    |   $exec(bool)
    | -------------------------
    | DESCRIPTION
    |   Enleve une mention miam a une photo
    |------------------------------------- */ 
    
    public function demiam($idPersonne, $idPhoto){
        $PDO = $this->connectionBD();
        $requete = "DELETE FROM likes WHERE idUtilisateur=$idPersonne AND idPhoto=$idPhoto";
        $PDOStatement = $PDO->prepare($requete);
        $exec = $PDOStatement->execute();
        return $exec;

    }
    
     /* -------------------------------------
    | fonction ajoutCommentaire
    | -------------------------
    | PARAM
    |   $idPersonne(int)
    |   $idPhoto(int)
    |   $commentaire(string)
    | -------------------------
    | RETURN
    |   $exec(bool)
    | -------------------------
    | DESCRIPTION
    |   Ajoute un commentaire a une photo 
    |------------------------------------- */ 
    
    public function ajoutCommentaire($idPersonne, $idPhoto, $commentaire){
        $PDO = $this->connectionBD();
        $requete = "INSERT INTO comment (idPhoto, idUtilisateur, commentaires, timestamp) VALUES ($idPhoto, $idPersonne, \"$commentaire\", NOW())";

        $PDOStatement = $PDO->prepare($requete);
        $exec = $PDOStatement->execute();
        return $exec;
    }
    
    /* -------------------------------------
    | fonction selectionnerPostDecouverte
    | -------------------------
    | PARAM
    |   aucun
    | -------------------------
    | RETURN
    |   $decouvertes(array)
    | -------------------------
    | DESCRIPTION
    |   Affiche le feed découverte c'est a dire les photos de tout les utilisateur ayant publié
    |------------------------------------- */ 
    public function selectionnerPostDecouverte(){
        try{  
            $PDO = $this->connectionBD(); 
            $requete = "SELECT idPhoto,url,photo.idUtilisateur,nomUtilisateur,urlPhoto,photo.description FROM `photo` INNER JOIN utilisateur ON photo.`idUtilisateur`= utilisateur.`idUtilisateur` ";
            $PDOStatement = $PDO->prepare($requete);
            $PDOStatement->execute();
            $decouvertes = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

            return $decouvertes ;
        }catch(PDOException $e) {
            return "Erreur: ".$e->getMessage();
        }
    }
    
    /* -------------------------------------
    | fonction selectionnerCommentaires
    | -------------------------
    | PARAM
    |   $idPhoto
    | -------------------------
    | RETURN
    |   $commentaire(array)
    | -------------------------
    | DESCRIPTION
    |   Affiche les commentaires relié au photos affiché sur le fil decouverte
    |------------------------------------- */ 
    
    public function selectionnerCommentaires($idPhoto){
        try{    
            $PDO = $this->connectionBD(); 
            $requete = "SELECT commentaires from comment WHERE idPhoto = $idPhoto ";
            $PDOStatement = $PDO->prepare($requete);
            $PDOStatement->execute();
            $commentaires = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
            return  $commentaires;
        }catch(PDOException $e) {
            return "Erreur: ".$e->getMessage();
        }
    }
    
} // FIN CLASSE

?>
