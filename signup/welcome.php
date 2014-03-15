<?php

    require($_SERVER['DOCUMENT_ROOT']."/blog/getuser.php");
    
    $welcomeString="You have been given reader access by default.  
    An admin will promote you to be able to comment after 
    your access has been approved. <br><br>
    
    Have a great day! <br><br>
    
    Chris";
    
?>

<HTML>

    <head>
        <title>Chris' Blog - SIGN UP</Title>
        <link rel="stylesheet" type="text/css" href="/blog/style.css">
    </head>

    <body>

        <h1>Chris' Blog - SIGN UP</h1>
        <div class="titlebar"><a href="/blog/">Home</a></div><br><br>
        <div class="title">Welcome <?php echo $loginID; ?></div><br>
        <div class="contents"><?php echo $welcomeString; ?></div>

    </body>

</HTML>