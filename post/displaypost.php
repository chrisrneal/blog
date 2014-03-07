<HTML>

    <head>
        <title>Chris' Blog</Title>
        <link rel="stylesheet" type="text/css" href="/blog/style.css">
    </head>

    <body>

        <h1>Chris' Blog</h1>
        <div class="titlebar"><a href="/blog/">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/blog/post/">Add Entry</a></div>
    
        <br>
        
		<?php

		    require($_SERVER['DOCUMENT_ROOT']."/include.php");
        
    	    $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
        		or die("unable to connect to mysql");
	       	$db = mysql_select_db('blogapp', $dbroot)
            	or die("Unable to connect to db " . mysql_error());
    
            $sql="select * from blog_entry where date_created = (select max(date_created) from blog_entry)";
    	    $result=mysql_query($sql);
    		echo mysql_error();
            
    		while($row = mysql_fetch_array($result))
    		{
    			echo "<p><span class=\"title\">".$row['title'] . "</span><span class=\"date\">" . $row['date_created'] ."</span><br></p>";
    			echo "<div class=\"contents\">".$row['contents']."</div>";
    			echo "<br><br><br>";
    		}
    
		?>
	
	</body>

</HTML>
