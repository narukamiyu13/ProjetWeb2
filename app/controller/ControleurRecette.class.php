<?php

require_once("app/model/Recette.class.php");
require_once("Controleur.class.php");

class ControleurRecette extends Controleur {
    
    public function __construct(){
            $this->modele = new Recette();

    }
    public function rechercheIngredient(){
        $jason=$this->modele->queryRecherche();
         include_once("app/view/profil.php");
        
    }

}

?>