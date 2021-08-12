<?php
    //zacetek seje
    session_start();

    $root_path = '/prisotnost';

    $dovoljeno = [
        $root_path.'/prijava.php',
        $root_path.'/prijava_check.php',      
    ];


    //ce uporabnik ni prijavljen ga preusmeri na prijavo
    if(!isset($_SESSION['profesor_id']) && 
    (!in_array($_SERVER['REQUEST_URI'],$dovoljeno))) {
        header('Location: prijava.php');
        die();
    }
    


    /*
    funkcija vrača ali je trenutno prijavljen user admin
    */

    function isAdmin() {
        if(isset($_SESSION['admin'])) {
            return $_SESSION['admin'];
        }
        else {
            return 0;
        }
    }

    /*
    funkcija omogoča dostop do strani let adminom, ostale preusmeri na index
    */

    function adminOnly() {
        //ce spremenljivka admin ne obstaja v seji ali user ni admin, preusmeri na index
        if(!isset($_SESSION['admin']) || (!isAdmin())) {
            header("Location: index.php");
            die();
        }

    }




?>