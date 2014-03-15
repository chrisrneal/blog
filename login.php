<?php

    require($_SERVER['DOCUMENT_ROOT']."/blog/getuser.php");
 
    $errorMsg="";
    
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $user=htmlspecialchars($_POST['user']);
        $pass=htmlspecialchars($_POST['pass']);
        
        
        //Lets do our SQL stuff
        $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS) or die("Could not connect to mysql.");
        $db = mysql_select_db('blogapp', $dbroot) or die("Could not select database. " . mysql_error());
        $sql="SELECT * FROM users WHERE username = '$user'";
        $results=mysql_query($sql);
        
        //Now lets test results for authentication using weak unsalted model.
        if (mysql_num_rows($results) == 1){
            $userHash=hash('sha256', $user);
            $passHash=hash('sha256', $pass);
            $userRow=mysql_fetch_array($results);
            if ($passHash == $userRow['passwd_hash']){
                setcookie("authuser", "$user|$userHash", 0, '/', $MY_DOMAIN);
                header('Location: index.php');
            }else{
                $errorMsg="Username or password was not correct";
            }
        }else{
            $errorMsg="Username or password was not correct";
        }
        
    }

?>

<HTML>
    <head>
        <title>Chris' Blog - Login</Title>
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
                </tr>
                <tr>
                    <td><label for="pass">Password:</label></td>
                    <td><input type="password" name="pass" value="<?php echo $pass; ?>"></td>
                </tr>
                <tr>
                    <td><input type="submit"></td>
                    <td><div style="color:red"><?php echo $errorMsg; ?></div></td>
                </tr>
            </table>
        </form>
        
    </body>
    
</HTML>