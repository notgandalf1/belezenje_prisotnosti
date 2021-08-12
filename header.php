<?php

include_once "seja.php";


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Beleženje prisotnosti</title>
        <!-- Favicon - moja slikica je boljsa :D-->
        <link rel="icon" type="image/x-icon" href="assets/feather.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                <h2 style="color:white">Beleženje prisotnosti</h2>
                <ul class="navbar-nav ms-auto">                    
                        <?php
                            //ce uporabnik/profesor ni prijavljen vidi le naslov in je vedno preusmerjen na prijavo
                            //ce je prijavljen vidi navigacijske gumbe
                            if(isset($_SESSION['profesor_id'])){
                                echo '<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="profesorji.php">Profesorji</a></li>';
                                echo '<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="studenti.php">Študenti</a></li>';
                                echo '<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php">Moji predmeti</a></li>';
                                echo '<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="profesor.php?id='.$_SESSION['profesor_id'].'">Moj Profil</a></li>';
                                echo '<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="odjava.php">Odjava</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="masthead bg-primary text-black text-left ">
            <div class="vsebina-strani">

        