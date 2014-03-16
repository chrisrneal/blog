<?php

    require($_SERVER['DOCUMENT_ROOT']."/blog/getuser.php");

?>

<HTML>

    <head>
        <title>Chris' Blog</Title>
        <link rel="stylesheet" type="text/css" href="/blog/style.css">
    </head>

    <body>

        <h1>Chris' Blog</h1>
        <div class="titlebar">
        <?php
            $tab="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            if ($userPrivs < 10){
                echo "<a href=\"/blog/post/\">add entry</a>";
                echo $tab;
            }
        
            if ($loginID==""){
                echo "<a href=\"/blog/signup/\">sign up</a>";
                echo $tab;
                echo "<a href=\"/blog/login.php\">login</a>";
            }else{
                echo "<a href=\"/blog/logout.php\">logout $loginID!</a>";
            }
            
            if ($userPrivs < 6){
                //User has administrator privledges and can access the admin_menu
                echo $tab;
                echo "<a href=\"/blog/admin_menu/\">admin_menu</a>";
            }
        ?>
        </div>
    
        <br>
    
        <?php
        
            $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
                or die("unable to connect to mysql");
            $db = mysql_select_db('blogapp', $dbroot)
                or die("Unable to connect to db " . mysql_error());
            
            $result = mysql_query("SELECT * FROM blog_entry ORDER BY date_created DESC");
        
            while($row = mysql_fetch_array($result)){
    			echo "<table><tr><td><div class=\"title\">".$row['title'] . "</div></td><td><div class=\"date\">" . $row['date_created'] ."</div></td></tr></table><hr noshade>";
    			echo "<table><tr><td><p class=\"contents\">".$row['contents']."</p></td></tr></table>";
    			//provide admin functions for admins
    			if($userPrivs < 10){
    			    echo "<br><a href=\"/blog/admin_menu/edit_post.php?delete=YES&edit=NO&post=" . $row['id'] . "\">DELETE</a>";
    			}
    			echo "<br><br><br>";
            }
    
        ?>

</HMTL>