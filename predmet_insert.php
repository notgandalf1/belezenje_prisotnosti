<?php

include_once "seja.php";
include_once "db.php";

$id_profesor = $_POST['id_profesor'];
$ime_predmeta = $_POST['ime_predmeta'];
$leto_izvajanja = $_POST['leto_izvajanja'];

//preverim ali so podatki polni
if(!empty($ime_predmeta) && !empty($leto_izvajanja)) {

    //vnos v bazo
    $query = "INSERT INTO predmeti(ime_predmeta, leto_izvajanja, id_profesor) 
    VALUES(?,?,?)";

    //pripravi insert stavek tako, da sciti pred SQL inserti
    $stmt = $pdo->prepare($query); 
    //izvede insert v bazo
    $stmt->execute([$ime_predmeta,$leto_izvajanja,$id_profesor]);


    //preusmeritev na seznam študentov
    header("Location: index.php"); 
    //nic pod die() se ne izvede
    die(); 
}

//če se if stavek ne izvede, preusmeri nazaj na dodajanje študenta
header("Location: predmet_add.php");
die();
?>