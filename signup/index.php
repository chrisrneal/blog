<?php

    $user="";
    $pass="";
    $verifypass="";
    $email="";
    
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $user=verifyPostData($_POST["user"]);
        $pass=verifyPostData($_POST["pass"]);
        $verifypass=verifyPostData($_POST["verifypass"]);
        $email=verifyPostData($_POST["email"]);
        
        $hasError=FALSE;
        
        $errUser=verify_user($user);
        $errPass=verify_pass($pass);
        $errEmail=verify_email($email);
        $errVerifyPass=verify_verifypass($pass, $verifypass);
        
        if($errUser != ""){
            $hasError=TRUE;
        }elseif($errPass != ""){
            $hasError=TRUE;
        }elseif($errEmail != ""){
            $hasError=TRUE;
        }elseif($errVerifyPass != ""){
            $hasError=TRUE;
        }
        
        if($hasError){
            #respond to post request - do nothing
        }else{
            #redirect user var to welcome page.
            #http_redirect("/signup/welcome.php", array("user" => "$user"));
            header("Location: welcome.php?user=".$user);
        }
    }


    function verifyPostData($data){
        $data=htmlentities($data);
        return $data;
    }
    
    function verify_user($data){
        
        if (!preg_match("/^[a-zA-Z0-9_-]{3,20}$/", $data)){
            return "String has invalid characters";
        }
        
        return "";
        
    }
    
    function verify_pass($pass){
        
        #verify password first for length and special chars
        if (!preg_match("/^.{3,20}$/", $pass)){
            return "Password is not between 3 and 20 characters.";
        }
        
        return "";

    }
    
    function verify_verifypass($pass, $verifypass){
        
        #check for verify password being the same as the password
        if ($pass != $verifypass){
            return "Passwords are not the same";
        }
        
        return "";
    
    }
    
    function verify_email($email){
        
        #check for @
        #check for domain
        if(!preg_match("/^[\S]+@[\S]+\.[\S]+$/", $email)){
            return "Email address is not correct";
        }
        
        return "";
    }

?>

<HTML>

    <head>
        <title>Chris' Blog - SIGN UP</Title>
        <link rel="stylesheet" type="text/css" href="/blog/style.css">
    </head>
    
    <body>

        <h1>Chris' Blog</h1>
        <div class="titlebar"><a href="/blog/">Home</a></div>
        <br><br>

        <form method="post">
            <table>
                <tr>
                    <td><label for="user">Username:</label></td>
                    <td><input type="text" name="user" value="<?php echo $user; ?>"></td>
                    <td><div style="color:red"><?php echo $errUser; ?></div><td>
                </tr>
                <tr>
                    <td><label for="pass">Password:</label></td>
                    <td><input type="password" name="pass" value="<?php echo $pass; ?>"></td>
                    <td><div style="color:red"><?php echo $errPass; ?></div></td>
                </tr>
                <tr>
                    <td><label for="verifypass">Verify Password:</label></td>
                    <td><input type="password" name="verifypass" value="<?php echo $verifypass; ?>"></td>
                    <td><div style="color:red"><?php echo $errVerifyPass; ?></div></td>
                </tr>
                <tr>
                    <td><label for="email">Email Address:</label></td>
                    <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
                    <td><div style="color:red"><?php echo $errEmail; ?></div></td>
                </tr>
            </table>
            <input type="submit">
        </form>
    
    </body>

</HMTL>