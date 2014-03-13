<?php

    require($_SERVER['DOCUMENT_ROOT']."/include.php");

    $loginID="";
    
    echo "cookie is: ".$_COOKIE['authuser'];
    
    if ($_COOKIE['authuser'] != ""){
        
        echo "hi";
        
        list($token, $hash)=split("|", $_COOKIE['authuser']);
        
        echo "<br>$token<br>$hash<br>";
        
        if(verify_login($token, $hash)){
            $loginID=$token;
        }
        
    }else{
        echo "cookie wasn't blank";
    }
    
    function verify_login($token, $hash){
        //need to come back and adjust this.  It's a weak security model.
        
        //lookUpPriv is a global function in hidden include.php file - valid userids have access <= 999
        if (lookUpPriv($token) >= 1000){
            return false;
        }
        
        echo $hash;
        echo $token;
        echo hash('sha256', $token);
        
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
        
        require($_SERVER['DOCUMENT_ROOT']."/include.php");
    
        $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
            or die("unable to connect to mysql");
        $db = mysql_select_db('blogapp', $dbroot)
            or die("Unable to connect to db " . mysql_error());
        
        $sql = "SELECT * FROM users WHERE user_id = '$user'";
    
        $result = mysql_query($sql);
    
        while($row = mysql_fetch_array($result)){
            //Should only return one result as DB will have a constraint.  Will return.
            return $row['access_level'];
        }
    
        //if user doesn't exist - we should return 1000.
        return 1000;
    
}

    
?>