<?php
    include_once "seja.php";

    adminOnly();
    
    include_once "db.php";

    $id = (int) $_GET['id']; //id profesorja/uporabnika ki ga brisem

    $query = "DELETE FROM profesorji WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("Location: profesorji.php");
    die();

?>