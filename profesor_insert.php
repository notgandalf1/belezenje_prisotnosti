<?php

include_once "seja.php";
include_once "db.php";

$ime = $_POST['ime'];
$priimek = $_POST['priimek'];
$email = $_POST['email'];
$geslo1 = $_POST['geslo1'];
$geslo2 = $_POST['geslo2'];
$admin = (int) $_POST['admin'];

//preverim ali so podatki polni in gesli enaki
if(!empty($ime) && !empty($priimek) && !empty($email)
&& !empty($geslo1) && ($geslo1==$geslo2)) {
    
    //šifriranje passworda
    $geslo = password_hash($geslo1,PASSWORD_DEFAULT);

    //vnos v bazo
    $query = "INSERT INTO profesorji(ime, priimek, email, geslo) 
    VALUES(?,?,?,?)";

    //pripravi insert stavek tako, da sciti pred SQL inserti
    $stmt = $pdo->prepare($query); 
    //izvede insert v bazo
    $stmt->execute([$ime,$priimek,$email,$geslo]);

    //nastavi admina če je checkbox bik checked
    if($admin == 1) {

        $query = "UPDATE profesorji SET admin=? WHERE email=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$admin, $email]);
    }
    //odstrani admin pravice, če je checkbox unchecked
    else if($admin == 0) {
        $query = "UPDATE profesorji SET admin=? WHERE email=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$admin, $email]);
    }

    //preusmeritev na seznam profesorjev
    header("Location: profesorji.php"); 
    //nic pod die() se ne izvede
    die(); 
}

//če se if stavek ne izvede, preusmeri nazaj na registracijo
header("Location: profesor_add.php");
die();
?>