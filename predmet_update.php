<?php

include_once "seja.php";
include_once "db.php";

$id = $_POST['id']; //id studenta
$ime_predmeta = $_POST['ime_predmeta'];
$leto_izvajanja = $_POST['leto_izvajanja'];

//preverim ali so podatki polni
if(!empty($ime_predmeta) && !empty($leto_izvajanja)) {

    //vnos v bazo
    $query = "UPDATE predmeti SET ime_predmeta=?, leto_izvajanja=? WHERE id=?";

    $stmt = $pdo->prepare($query); 
    $stmt->execute([$ime_predmeta,$leto_izvajanja,$id]);


    //preusmeritev na seznam študentov
    header("Location: index.php"); 
    //nic pod die() se ne izvede
    die(); 
}

//če se if stavek ne izvede, preusmeri nazaj na dodajanje študenta
header("Location: predmet_edit.php");
die();
?>