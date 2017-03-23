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
            $PDO = new PDO("mysql:host=localhost;dbname=Foodie","root","");
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
    | -------------------------
    | RETURN
    |   $resultat[0]    : (INT)     Le nombre d'entrées d'une colone
    | -------------------------
    | DESCRIPTION
    |   Sélectionne le nombre d'entrées d'une colone
    |------------------------------------- */ 
    public function selectionnerNombre($colone, $table, $personneUnique = false, $idPersonne = NULL){
        
        try{
            $PDO = connectionBD();
            $requete = "SELECT COUNT(".$colone.") FROM ".$table." ";

            if($personneUnique) {
                $requete.="WHERE idUtilisateur=".$idPersonne;
            }

            $PDOStatement = $PDO->prepare($requete);
            $execution = $PDOStatement->execute();

            $resultat =  $execution->fetch(PDO::FETCH_NUM);

            return $resultat[0];
        } catch(PDOException $erreur) {
            echo "Erreur: ".$erreur->getMessage()." <br/>";
            die();
        }
        
    } // FIN DE FONCTION selectionnerNombre
    
    
    
    
} // FIN DE CLASSE






$query = "WHATEVER";
$PDOStatement = $PDO->prepare($query);
$pDOStatement->bindParam();
$pDOStatement->bindParam();
$pDOStatement->bindParam();
$pDOStatement->bindParam();
$exec = $PDOStatement->execute();


$resultat = $exec->fetchAll();


?>