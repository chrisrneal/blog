<?php

    require($_SERVER['DOCUMENT_ROOT']."/blog/getuser.php");
    
    //if user isn't admin then, redirect to home and end script.
    if ($userPrivs > 5){
        header('Location: ../index.php');
        return 0;
    }

?>

<HTML>

    <head>
        <title>Chris' Blog - ADMIN_MENU</Title>
        <link rel="stylesheet" type="text/css" href="/blog/style.css">
    </head>

    <body>
    
        <h2>Admin Menu</h2>
        <div class="titlebar">
        <?php
            $tab="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "<a href=\"/blog/\">home</a>";
            echo $tab;
            //Posts can be deleted and selected for edit on the main page.
            //The page below will do the processing.  But there's no need to link from here.
            //echo "<a href=\"/blog/admin_menu/edit_post.php\">posts</a>";
            //echo $tab;
            echo "<a href=\"/blog/admin_menu/edit_user.php\">users</a>";
        ?>
        </div><br><br>