<?php

include_once "seja.php";
include_once "db.php";

$id_predmet = (int) $_POST['id_predmet'];
$studentiVsi = $_POST['studentiVsi'];
$predavanjaVsa = $_POST['predavanjaVsa'];
$prisotnost = $_POST['prisotnost'];

//vse vnose prisotnosti pri tem predmetu najprej izbrišem
foreach($studentiVsi as $id_student) {
    foreach($predavanjaVsa as $id_predavanje) {
        $query = "DELETE FROM prisotnost WHERE id_student=? && id_predavanje=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_student, $id_predavanje]);
    }
}


//vnesemo nove vnose
foreach($prisotnost as $string) {
    $podatki = explode("|",$string);
    $id_student = (int) $podatki[0];
    $id_predavanje = (int) $podatki[1];
    
    $query = "INSERT INTO prisotnost(id_predavanje,id_student) VALUES(?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_predavanje,$id_student]);
}

    //preusmeritev na predmet
    header("Location: predmet.php?id=$id_predmet"); 
    //nic pod die() se ne izvede
    die();
?>