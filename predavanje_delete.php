<?php
    include_once "seja.php";
    
    include_once "db.php";

    $id = (int) $_GET['id']; //id predavanja

    $query = "SELECT * FROM predavanja WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $predavanje = $stmt->fetch();
    $id_predmet = $predavanje['id_predmet'];

    //najprej izbriše prisotnosti študentov pri tem predavanju (ker drugače pride do foreign key errorja)
    $query = "DELETE FROM prisotnost WHERE id_predavanje = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]); 
    
    //potem izbriše še predavanje
    $query = "DELETE FROM predavanja WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("Location: predmet.php?id=$id_predmet");
    die();

?>