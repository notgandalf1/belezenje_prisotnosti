<?php
    include_once "seja.php";

    adminOnly();
    
    include_once "db.php";

    $id = (int) $_GET['id']; //id studentaki ga brisem

    $query = "DELETE FROM studenti WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("Location: studenti.php");
    die();

?>