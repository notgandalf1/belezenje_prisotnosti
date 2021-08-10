<?php
    include_once "seja.php";

    session_destroy();
    $_SESSION = array();

    header("Location: prijava.php");
    die();
?>