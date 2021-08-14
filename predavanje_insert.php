<?php

include_once "seja.php";
include_once "db.php";

$id_predmet = $_POST['id_predmet'];
$datum_izvajanja = $_POST['datum_izvajanja'];

//preverim ali so podatki polni
if(!empty($datum_izvajanja)) {

    //vnos v bazo
    $query = "INSERT INTO predavanja(datum_izvajanja, id_predmet) 
    VALUES(?,?)";

    //pripravi insert stavek tako, da sciti pred SQL inserti
    $stmt = $pdo->prepare($query); 
    //izvede insert v bazo
    $stmt->execute([$datum_izvajanja,$id_predmet]);


    //preusmeritev na seznam študentov
    header("Location: predmet.php?id=$id_predmet"); 
    //nic pod die() se ne izvede
    die(); 
}

//če se if stavek ne izvede, preusmeri nazaj na dodajanje študenta
header("Location: predavanje_add.php");
die();
?>