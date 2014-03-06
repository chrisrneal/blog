

<?php
    
    $user="";
    
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $user=htmlentities($_GET["user"]);
    }
        
    if ($user=""){
        #user was not provided in get request, ergo, send them back to signup root
        header("Location: /");
    }
    
?>

<HTML>

    <h2>Welcome <?php echo $user; ?><h2>

</HTML>