<?php
    include_once "seja.php";
    
    include_once "db.php";

    $id = (int) $_GET['id']; //id predmeta, ki ga brišem

    /*pred izbrisom predmeta moram izbrisati tudi, 
    * povezave med študenti in predmetom, njegova predavanja
    * in prisotnosti na teh predavanjih
    */
    $query = "DELETE FROM studenti_predmeti WHERE id_predmet = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $query = "DELETE FROM prisotnost WHERE id_predavanje = 
        (SELECT id FROM predavanja WHERE id_predmet = ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $query = "DELETE FROM predavanja WHERE id_predmet = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $query = "DELETE FROM predmeti WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("Location: index.php");
    die();

?>