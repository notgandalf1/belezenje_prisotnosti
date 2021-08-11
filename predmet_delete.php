<?php
    include_once "seja.php";
    
    include_once "db.php";

    $id = (int) $_GET['id']; //id predmeta, ki ga brišem

    $query = "DELETE FROM predmeti WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("Location: index.php");
    die();

?>