<?php

    include($_SERVER['DOCUMENT_ROOT']."/include.php");
    
    $title="";
    $entry="";

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
            or die("unable to connect to mysql");
        $db = mysql_select_db('blogapp', $dbroot)
            or die("Unable to connect to db " . mysql_error());
            
        $title=htmlentities($_POST["title"], ENT_QUOTES | ENT_HTML5);
        $entry=htmlentities($_POST["post"], ENT_QUOTES | ENT_HTML5);
        $id=htmlentities($_POST["id"], ENT_QUOTES | ENT_HTML5);
        
        $error="";
        
        if ($title == "" or $entry == ""){
            $error="You must have both a title and contents in your post in order to submit.";
        }
        
        if ($error == ""){
            $sql="insert into blog_entry (title, contents) values ('$title', '$entry')";
            mysql_query($sql);
            echo mysql_error();
            
            header('Location: displaypost.php?postid='.$id);
        }
    }
    

?>

<HTML>

    <head>
        <title>New Post</title>
        <link rel="stylesheet" type="text/css" href="/blog/style.css">
    </head>
    
    <body>

        <h1>New Post</h1>
        <h2><i>Chris' Blog</i></h2>
        
        <form method="post">
            <label>
                <div>Title:<div>
                <input type="text" name="title" value="<?php echo $title; ?>">
            </label>
        
            <label>
                <div>Post:</div>
                <textarea name="post"><?php echo $entry; ?></textarea>
            </label>
            
            <div class="error"><?php echo $error; ?></div>
        
            <br><input type="submit">
        </form>
    
    </body>

</HTML>