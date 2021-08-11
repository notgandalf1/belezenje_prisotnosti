<?php

include_once "seja.php";
include_once "db.php";

$id = $_POST['id']; //id studenta
$ime = $_POST['ime'];
$priimek = $_POST['priimek'];
$studentska_stevilka = $_POST['studentska_stevilka'];

//preverim ali so podatki polni
if(!empty($ime) && !empty($priimek) && !empty($studentska_stevilka)) {

    //vnos v bazo
    $query = "UPDATE studenti SET ime=?, priimek=?, studentska_stevilka=? WHERE id=?";

    $stmt = $pdo->prepare($query); 
    $stmt->execute([$ime,$priimek,$studentska_stevilka,$id]);


    //preusmeritev na seznam študentov
    header("Location: studenti.php"); 
    //nic pod die() se ne izvede
    die(); 
}

//če se if stavek ne izvede, preusmeri nazaj na dodajanje študenta
header("Location: student_edit.php");
die();
?>