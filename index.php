<?php

//   include($_SERVER['DOCUMENT_ROOT']."/include.php");
    require($_SERVER['DOCUMENT_ROOT']."/blog/getuser.php");

?>

<HTML>

    <head>
        <title>Chris' Blog</Title>
        <link rel="stylesheet" type="text/css" href="/blog/style.css">
    </head>

    <body>

        <h1>Chris' Blog</h1>
        <div class="titlebar"><a href="/blog/post/">add entry</a>
        <?php
            $tab="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            if ($loginID==""){
                echo $tab;
                echo "<a href=\"/blog/signup/\">sign up</a>";
                echo $tab;
                echo "<a href=\"/blog/login/\">login</a>";
            }else{
                echo $tab;
                echo "<a href=\"/blog/logout/\">logout $loginID!</a>";
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
    			echo "<br><br><br>";
            }
    
        ?>

</HMTL>