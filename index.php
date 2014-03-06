<HTML>

    <center>
    <h1>Chris' Blog</h1>
    <a href="/blog/post/">add entry</a>
    </center>
    
    <br>
    
    <?php
    
        require($_SERVER['DOCUMENT_ROOT']."/blog/lib/include.php");
        
        $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
            or die("unable to connect to mysql");
        $db = mysql_select_db('blogapp', $dbroot)
            or die("Unable to connect to db " . mysql_error());
            
        $result = mysql_query("SELECT * FROM blog_entry ORDER BY date_created DESC");
        
        while($row = mysql_fetch_array($result)){
            echo "<div class=\"title\">".$row['title'] . " " . $row['date_created'] ."</div><br>";
            echo "<div class=\"contents\">".$row['contents']."</div>";
            echo "<br><br><br>";
        }
    
    ?>

</HMTL>