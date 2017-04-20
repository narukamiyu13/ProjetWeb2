<?php

class Model {
    
    
    public function checkConnect($username, $password){
        
        if($username=="admin" && $password=="banane"){
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