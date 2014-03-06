<HTML>

    <head>
        <title>Chris' Blog</Title>
        <link rel="stylesheet" type="text/css" href="/blog/style.css">
    </head>

    <body>

        <h1>Chris' Blog</h1>
        <div class="titlebar"><a href="/blog/">Home</a>&nbsp;<a href="/blog/post/">Add Entry</a></div>
    
        <br>
        
		<?php

		    include($_SERVER['DOCUMENT_ROOT']."/include.php");
    
    		$id=""

	    	if ($_SERVER["REQUEST_METHOD"]=="GET"){
        
    	    	$dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
        	    	or die("unable to connect to mysql");
	        	$db = mysql_select_db('blogapp', $dbroot)
    	        	or die("Unable to connect to db " . mysql_error());

	        	$id=htmlentities($_GET["postid"], ENT_QUOTES | ENT_HTML5);
    	    
	    	    $error="";
        
    	    	if ($id == ""){
        	    	$error="You must have both a title and contents in your post in order to submit.";
            		echo $error;
		        }else{
    		        $sql="select * from blog_entry where id='$id'";
        		    $result=mysql_query($sql);
            		echo mysql_error();
            
            		while($row = mysql_fetch_array($result))
            		{
            			echo "<p><span class=\"title\">".$row['title'] . "</span><span class=\"date\">" . $row['date_created'] ."</span><br></p>";
            			echo "<div class=\"contents\">".$row['contents']."</div>";
            			echo "<br><br><br>";
            		}
            
            		header('Location: displaypost.php?post='.$id);
	        	}
    		}
    
		?>
	
	</body>

</HTML>
