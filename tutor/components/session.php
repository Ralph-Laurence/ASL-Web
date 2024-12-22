<?php

    session_start();

    //CHECK IF LOGGED IN
    if(!isset($_SESSION['logged_in_user'])){
        session_destroy();
        header("Location: login.php");
    }

?>