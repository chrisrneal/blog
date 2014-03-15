<?php

    require($_SERVER['DOCUMENT_ROOT']."/include.php");

    $loginID="";
    $userPrivs=1000;
    
    if ($_COOKIE['authuser'] != ""){
        
        list($token, $hash)=split("\|", $_COOKIE['authuser']);
        $userPrivs=lookUpPriv($token);
        
        if(verify_login($token, $hash)){
            $loginID=$token;
        }
        
    }
    
    function verify_login($token, $hash){
        
        if (hash('sha256', $token)==$hash){
            return true;
        }
        
        return false;
    }
    
    //PrivCodes
    //0 - GOD
    //1 - EDITOR
    //100 - COMMENTS
    //999 - NO ACCESS
    //1000 - ERROR
    function lookUpPriv($user){
        
        include($_SERVER['DOCUMENT_ROOT']."/include.php");
    
        $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
            or die("unable to connect to mysql");
        $db = mysql_select_db('blogapp', $dbroot)
            or die("Unable to connect to db " . mysql_error());
        
        $sql = "SELECT * FROM users WHERE username = '$user'";
    
        $result = mysql_query($sql);
    
        while($row = mysql_fetch_array($result)){
            //Should only return one result as DB will have a constraint.  Will return.
            return $row['access_level'];
        }
    
        //if user doesn't exist - we should return 1000.
        return 1000;
    
}

    
?>