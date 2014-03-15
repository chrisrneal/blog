<?php

    require($_SERVER['DOCUMENT_ROOT']."/blog/getuser.php");

    setcookie("authuser", "", 0, '/', $MY_DOMAIN);
    header('Location: index.php');

?>