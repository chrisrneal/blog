<?php

    require($_SERVER['DOCUMENT_ROOT']."/include.php");
    
    $title="";
    $entry="";

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $dbroot = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
            or die("unable to connect to mysql");
        $db = mysql_select_db('blogapp', $dbroot)
            or die("Unable to connect to db " . mysql_error());
            
        $title=htmlspecialchars($_POST["title"], ENT_QUOTES | ENT_HTML5);
        $entry=htmlspecialchars($_POST["post"], ENT_QUOTES | ENT_HTML5);
        $entry=nl2br($entry);
        
        $error="";
        
        if ($title == "" or $entry == ""){
            $error="You must have both a title and contents in your post in order to submit.";
        }
        
        if ($error == ""){
            $sql="insert into blog_entry (title, contents) values ('$title', '$entry')";
            mysql_query($sql);
            echo mysql_error();
            
            header('Location: displaypost.php');
        }
    }
    

?>

<HTML>

    <head>
        <title>Chris' Blog - New Entry</title>
        <link rel="stylesheet" type="text/css" href="/blog/style.css">
    </head>
    
    <body>

        <h1>Chris' Blog</h1>
        <div class="titlebar"><a href="/blog/">Home</a></div>
        
        <form method="post">
            <br><div class="error"><?php echo $error; ?></div><br>
            <label>
                <div>Title:<div>
                <input type="text" name="title" value="<?php echo $title; ?>">
            </label>
            <br>
        
            <label>
                <div>Post:</div>
                <textarea name="post"><?php echo $entry; ?></textarea>
            </label>
        
            <br><input type="submit">
        </form>
    
    </body>

</HTML>