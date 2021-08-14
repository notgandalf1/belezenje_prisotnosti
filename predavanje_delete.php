<?php
    include_once "seja.php";
    
    include_once "db.php";

    $id = (int) $_GET['id']; //id predavanja

    $query = "SELECT * FROM predavanja WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $predavanje = $stmt->fetch();
    $id_predmet = $predavanje['id_predmet'];
    
    $query = "DELETE FROM predavanja WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("Location: predmet.php?id=$id_predmet");
    die();

?>