<?php

    require($_SERVER['DOCUMENT_ROOT']."/blog/admin_menu/menu.php");
    
    $confirmMessage="Nothing was changed";
    $delete=False;
    $edit=False;
    $post=0;
    
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(htmlspecialchars($_GET['post'])){
            $post=htmlspecialchars($_GET['post']);
        }
        
        $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
            or die("unable to connect to mysql");
        $db = mysql_select_db('blogapp', $dbroot) 
            or die("Unable to select db " . mysql_error());
        
        if(htmlspecialchars($_GET['delete'])=="YES"){
            $delete=True;
            $sql="DELETE FROM blog_entry WHERE id = '$post'";
            mysql_query($sql);
            $confirmMessage="Your post was deleted.";
        }
        
        mysql_close();
    }

?>


    <div class="title">
    Post Edit
    </div><br>
    
    <div class="contents">
    <?php
        
        echo $confirmMessage;
    
    ?>
    </div>

    </body>
    
</HTML>