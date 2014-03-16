<?php

    require($_SERVER['DOCUMENT_ROOT']."/blog/admin_menu/menu.php");
    
    $confirmMessage="Nothing was changed";
    $delete=False;
    $edit=False;
    $post=0;
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    	//Posting only happens on an edit request.
    	$title="";
    	$entry="";
    	
    	$title=htmlspecialchars($_POST["title"], ENT_QUOTES | ENT_HTML5);
        $entry=htmlspecialchars($_POST["post"], ENT_QUOTES | ENT_HTML5);
        $post=htmlspecialchars($_POST["id"])
        $entry=nl2br($entry);
        
        if ($title == "" or $entry == ""){
            header("Location: edit_post.php?delete=NO&edit=YES&post='$post'&err=YES");
        }else{
        	//it's a valid post, update db
        	$sql="UPDATE blog_entry SET title = '$title', contents = '$entry' WHERE id = '$post'";
        	$dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
            	or die("unable to connect to mysql");
        	$db = mysql_select_db('blogapp', $dbroot) 
            	or die("Unable to select db " . mysql_error());
            mysql_query($sql);
            //should probably get this on display post.
            header("Location: ../index.php");
        }
    }
    
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        
        $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
            or die("unable to connect to mysql");
        $db = mysql_select_db('blogapp', $dbroot) 
            or die("Unable to select db " . mysql_error());
            
        if(htmlspecialchars($_GET['post'])){
            $post=htmlspecialchars($_GET['post']);
        }
        
        if(htmlspecialchars($_GET['edit'])=="YES"){
        	$edit=True;
        	$sql="SELECT * FROM blog_entry WHERE id = '$post'";
        	$results=mysql_query($sql);
        	$err=htmlspecialchars($_GET['err']);
        	
        	if (mysql_num_rows($results == 1){
        		$confirmMessage = "";
        		if ($err){
        			$confirmMessage .= "<div class="error">You cannot leave the title or contents blank.</div>";
        		}
        		$row = mysql_fetch_array($sql);
	        	mysql_close();
    	    	$confirmMessage .= "<form method=\"post\"><br><label>
                				<div>Title:<div>
                				<input type=\"text\" name=\"title\" value=";
				$confirmMessage .= htmlspecialchars($row['title']);
				$confirmMessage .= "></label><br><label><div>Post:</div>
                				<textarea name=\"post\">";
	            $confirmMessage .= htmlspecialchars($row['contents']);
    	        $confirmMessage .= "</textarea></label><br>";
    	        $confirmMessage .= "<input type=\"hidden\" name=\"id\" value=\"";
    	        $confirmMessage .= $post . "\"><input type=\"submit\"></form>";
        	}else{
        		$confirmMessage = "There was an error processing your request."
        	}
        }
        
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