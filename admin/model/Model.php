<?php

class Model {
    
    
    public function checkConnect($username, $password){
        $password = sha1($password);
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
        $PDO = new PDO("mysql:host=localhost;dbname=Foodie","root","",$options);
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
        
        
    }
    
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
        
        
    }
    
    
    
}


?>