<?php

include_once "seja.php";
include_once "db.php";

$email = $_POST['email'];
$geslo = $_POST['geslo'];


//preverim ali so podatki polni
if(!empty($email) && !empty($geslo)) {
    
    $query = "SELECT * FROM profesorji WHERE email=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);

    //ali obstaja profesor s tem emailom
    if($stmt->rowCount() == 1) {
        
        //v spremenljivko profesor shranim podatke iz baze
        $profesor = $stmt->fetch();
        
        //preverim ali se gesli ujemata
        if(password_verify($geslo,$profesor['geslo'])) {

            //v sejo shranim podatke iz baze
            $_SESSION['profesor_id'] = $profesor['id'];
            $_SESSION['ime'] = $profesor['ime'];
            $_SESSION['priimek'] = $profesor['priimek'];
            $_SESSION['admin'] = $profesor['admin'];
            
            
            //preusmeritev na index ob uspesnem loginu
            header("Location: index.php"); 
            die(); 
        }
        else {
            //napačno geslo
            echo '<script type="text/javascript">alert("Napačno geslo!");window.location="prijava.php";</script>';
            die();
        }
    } else {
        //napačen email
        echo '<script type="text/javascript">alert("Napačen email!");window.location="prijava.php";</script>';
        die();
    }

}

//če se if stavek ne izvede, preusmeri nazaj na login
header("Location: prijava.php");
die();
?>