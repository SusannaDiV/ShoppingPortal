<?php
    session_start();
    include("includes/config.php");
    $_SESSION=array();
    session_destroy();
    setcookie(session_name() , '', time() - 42000);
    header("location: index.php");
?> 