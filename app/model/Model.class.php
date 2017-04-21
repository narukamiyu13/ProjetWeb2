<?php
/*
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
NOM : 
PROJET : Foodie
ORGANISDATION : College Maisonneuve
PAGE : Model.class.php
DATE DE CREATION : 27-03-17
DESCRIPTION : modele qui gere les fonctionnalites de base

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
*/
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
    |   $uid(int)
    |   $token(int)
    | -------------------------
    | RETURN
    |   bool    
    | -------------------------
    | DESCRIPTION
    |   Verifie la validaté du jeton qui permet a l'utilisateur de retrouver un mot de passe oublier
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
    | fonction checkExpiration
    | -------------------------
    | PARAM
    |   $uid(int)
    |   $token(int) 
    | -------------------------
    | RETURN
    |   bool    
    | -------------------------
    | DESCRIPTION
    |   Verfie si le jeton est expiré et si oui le renvoi a une page qui dit que le jeton est expiré
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
    | fonction expireToken
    | -------------------------
    | PARAM
    |   $uid(int)
    |   $token(int) 
    | -------------------------
    | RETURN
    |   bool 
    | -------------------------
    | DESCRIPTION
    |   Fait expirer le jeton pour la recuperation de mot de passe
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
    } // FIN DE FONCTION checkToken
    
    
     /* -------------------------------------
     | fonction updatePassword
     | -------------------------
     | PARAM
     |   $pass (string)
     | -------------------------
     | RETURN
     |   aucun  
     | -------------------------
     | DESCRIPTION
     |   Met a jour le mot de passe d'un utilisateur
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
    
    /* -------------------------------------
    | fonction gererRechercheRecette
    | -------------------------
    | PARAM
    |   $idCategorie(int)
    | -------------------------
    | RETURN
    |  $recette (int)   
    | -------------------------
    | DESCRIPTION
    |   Sectionne les recette relié a une cateorie de recette (plat, entré, dessert)
    |------------------------------------- */ 
    function gererRechercheRecette($idCategorie){
        try{
            $PDO = $this->connectionBD();
            $requete = "SELECT * FROM photo 
                        INNER JOIN utilisateur ON photo.idUtilisateur = utilisateur.idUtilisateur 
                        INNER JOIN recettes on photo.idRecette = recettes.idRecette
                        WHERE recettes.idCategorieRecette = '$idCategorie'";
            $PDOStatement = $PDO->prepare($requete);
            $PDOStatement->execute();
            $recettes = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
            return $recettes; 
        } catch(PDOException $e){
            echo "Erreur: ".$e->getMessage();
        }
    } // FIN DE FONCTION gererRechercheRecette
    
     /* -------------------------------------
    | fonction ggererRechercheRecetteIngredients
    | -------------------------
    | PARAM
    |   $idCategorie(int)
    |   $idRecette(int)
    | -------------------------
    | RETURN
    |  $recette (int)   
    | -------------------------
    | DESCRIPTION
    |  Selectionne les ingredients relatif a une categorie et a une recette 
    |------------------------------------- */ 
    
    function gererRechercheRecetteIngredients($idCategorie,$idRecette){
        try{
            $PDO = $this->connectionBD();
            $requete = "SELECT recettes.idRecette,ingredients.nomIngredient, recettes_has_ingredients.quantite,             recettes_has_ingredients.uniteDeMesure FROM recettes
            INNER JOIN recettes_has_ingredients ON recettes_has_ingredients.idRecette=recettes.idRecette
            INNER JOIN ingredients ON recettes_has_ingredients.idingredient=ingredients.idingredient
            WHERE recettes.idrecette = '$idRecette'  AND recettes.idCategorieRecette = '$idCategorie'";
            
            $PDOStatement = $PDO->prepare($requete);
            $PDOStatement->execute();
            $ingredients = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
            
            $requete = "SELECT * FROM recettes
                        INNER JOIN etapepreparation on recettes.idRecette = etapepreparation.idRecette
                        WHERE idCategorieRecette = '$idCategorie' AND recettes.idRecette = '$idRecette'";
            $PDOStatement = $PDO->prepare($requete);
            $PDOStatement->execute();
            $etapes = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
            //return $etapes;
            return Array("ingredients"=>$ingredients, "etapes"=>$etapes);
        } catch(PDOException $e){
            echo "Erreur: ".$e->getMessage();
        }
    }
} // FIN DE CLASSE




?>