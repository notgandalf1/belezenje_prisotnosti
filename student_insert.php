<?php

include_once "seja.php";
include_once "db.php";

$ime = $_POST['ime'];
$priimek = $_POST['priimek'];
$studentska_stevilka = $_POST['studentska_stevilka'];

//preverim ali so podatki polni
if(!empty($ime) && !empty($priimek) && !empty($studentska_stevilka)) {

    //vnos v bazo
    $query = "INSERT INTO studenti(ime, priimek, studentska_stevilka) 
    VALUES(?,?,?)";

    //pripravi insert stavek tako, da sciti pred SQL inserti
    $stmt = $pdo->prepare($query); 
    //izvede insert v bazo
    $stmt->execute([$ime,$priimek,$studentska_stevilka]);


    //preusmeritev na seznam študentov
    header("Location: studenti.php"); 
    //nic pod die() se ne izvede
    die(); 
}

//če se if stavek ne izvede, preusmeri nazaj na dodajanje študenta
header("Location: student_add.php");
die();
?>