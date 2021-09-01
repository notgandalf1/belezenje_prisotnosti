<?php
    include_once "seja.php";

    adminOnly();
    
    include_once "db.php";

    $id = (int) $_GET['id']; //id studentaki ga brisem

    //preden izbrišem študenta, moram izbrisati tudi njegovo povezavo na predmete 
    //in njegove prisotnosti, da ne pride do foreign key napak
    $query = "DELETE FROM studenti_predmeti WHERE id_student = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $query = "DELETE FROM prisotnost WHERE id_student = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    
    //izbrišem študenta
    $query = "DELETE FROM studenti WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("Location: studenti.php");
    die();

?>