<?php

require_once("Model.class.php");

class Recette extends Modele{
    
    public function queryRecherche(){
        if ((isset($_GET['userID']))&& (isset($_GET['term']))){
            $return_arr = array();
            try {
                $PDO = $this->connectionBD();
                $requete="SELECT nomIngredient FROM ingredients WHERE nomIngredient LIKE :term";
                $stmt = $PDO->prepare($requete);
                
                $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                var_dump($stmt->execute());
                while($row = $stmt->fetch()) {
                    $return_arr[] =  $row['nomIngredient'];
                }
                
            } catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }

            /* Toss back results as json encoded array. */
           $jason=json_encode($return_arr);
            return $jason;
        }
    }
}

?>