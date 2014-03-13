<?php

    include($_SERVER['DOCUMENT_ROOT']."/include.php");

    $loginID="";
    
    if ($_COOKIE['authuser']!=''){
        list($token, $hash)=split("|", $_COOKIE['authuser']);
        
        if(verify_login($token, $hash)){
            $loginID=$token;
        }
    }
    
    function verify_login($token, $hash){
        //need to come back and adjust this.  It's a weak security model.
        
        //lookUpPriv is a global function in hidden include.php file - valid userids have access <= 999
        if (lookUpPriv($token) > 999){
            return false;
        }
        
        if (hash('sha256', $token)==$hash){
            return true;
        }
        
        return false;
    }
    
?>