<?php

    require($_SERVER['DOCUMENT_ROOT']."/blog/getuser.php");
    
    $welcomeString="This string is under construction.";
    
?>

<HTML>

    <head>
        <title>Chris' Blog - SIGN UP</Title>
        <link rel="stylesheet" type="text/css" href="/blog/style.css">
    </head>

    <body>

        <h1>Chris' Blog - SIGN UP</h1>
        
        <div class="title">Welcome <?php echo $loginID; ?></div><br>
        <div class="contents"><?php echo $welcomeString; ?></div>

    </body>

</HTML>