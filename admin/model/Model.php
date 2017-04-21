<?php
/* -------------------------------------
| fichier Model.php
| -------------------------
| CONTRIBUTEURS
|   Auteur: Cédrick Collin
|   Modifications: Cédrick Collin 
| -------------------------
| DATES
|   Création: 19 avril 2017
|   Dernière Modification: 20 avril 2017
| -------------------------
| DESCRIPTION
|   Modèle de la partie administration du site Foodie
|------------------------------------- */

class Model {
    
    /* -------------------------------------
    | fonction checkConnect
    | -------------------------
    | PARAM
    |   $username: (STRING) - Le nom d'utilisateur qu'on veut utiliser pour vérifier la connexion
    |   $password: (STRING) - Le mot de passe qu'on veut utiliser pour vérifier la connexion
    | -------------------------
    | RETURN
    |   (BOOLEAN) - True si la connexion est un succès, False si c'est un échec    
    | -------------------------
    | DESCRIPTION
    |   Tente une connexion au panneau d'administration
    |------------------------------------- */
    public function checkConnect($username, $password){
        $password = sha1($password);
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
        $PDO = new PDO("mysql:host=localhost;dbname=id1299011_foodie","id1299011_cedrick","pa14t336!0L",$options);
        $query = "SELECT idRole FROM utilisateur WHERE nomUtilisateur='$username' AND motDePasse='$password'";
        $PDOStatement = $PDO->prepare($query);
        $PDOStatement->execute();
        $resultat = $PDOStatement->fetch(PDO::FETCH_NUM);
        if($resultat[0]!= NULL && $resultat[0]==2){
            $_SESSION['username'] = $username;
            return true;
        } else {
            return false; 
        }
    } // FIN checkConnect
    
    
    /* -------------------------------------
    | fonction getErrCode
    | -------------------------
    | PARAM
    |   $username: (STRING) - Le contenu du champ de nom d'utilisateur
    |   $password: (STRING) - Le contenu du champ de mot de passe
    | -------------------------
    | RETURN
    |   $errCode:  (STRING) - Le code d'erreur(s) à utiliser pour
    |   l'affichage des messages d'erreur à l'accueil
    | -------------------------
    | DESCRIPTION
    |   Dans le cas d'un échec de connexion, analyse le contenu des 
    |   champs nom d'utilisateur et mot de passe afin de générer un
    |   code d'erreur pour la page d'accueil
    |------------------------------------- */
    public function getErrCode($username, $password){
        $errCode ="";
        if(!isset($username)||empty($username)) {
            $errCode.= "&1478";
        }
        if(!isset($password)||empty($password)){
            $errCode .= "&9632";
        }
        if ((isset($username)&&!empty($username))&&(isset($password)&&!empty($password))){
            $errCode .= "&2584";
        }
        return $errCode;
    } // FIN getErrCode
} // FIN classe Model


?>