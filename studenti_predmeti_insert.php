<?php

include_once "seja.php";
include_once "db.php";

$id_predmet = (int) $_POST['id_predmet'];
$studenti = $_POST['studenti'];

//vse studente pri tem predmetu najprej izbrišem
$query = "DELETE FROM studenti_predmeti WHERE id_predmet=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id_predmet]);

foreach($studenti as $id_student) {
        $query = "INSERT INTO studenti_predmeti(id_student,id_predmet) VALUES(?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_student,$id_predmet]);
}

    //preusmeritev na predmet
    header("Location: predmet.php?id=$id_predmet"); 
    //nic pod die() se ne izvede
    die(); 


//če se if stavek ne izvede, preusmeri nazaj na dodajanje studentov
header("Location: studenti_predmeti_add.php?id=$id_predmet");
die();
?>