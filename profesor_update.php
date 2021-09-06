<?php

include_once "seja.php";
include_once "db.php";

$id = (int) $_POST['id'];

$ime = $_POST['ime'];
$priimek = $_POST['priimek'];
$email = $_POST['email'];
$geslo1 = $_POST['geslo1'];
$geslo2 = $_POST['geslo2'];
$admin = (int) $_POST['admin'];


try {
    //preverim ali so podatki polni (razen gesel)
    if(!empty($ime) && !empty($priimek) && !empty($email)) {
        
        //če je nastavljeno novo geslo, preverimo, če sta gesli enaki in posodobimo vse
        if(!empty($geslo1)) {
            if ($geslo1==$geslo2) {
                
                $geslo = password_hash($geslo1,PASSWORD_DEFAULT);

                //vnos v bazo
                $query = "UPDATE profesorji SET ime=?, priimek=?, email=?, geslo=? WHERE id=?";

                //pripravi sql stavek tako, da sciti pred SQL inserti
                $stmt = $pdo->prepare($query); 
                //izvede sql stavek
                $stmt->execute([$ime,$priimek,$email,$geslo,$id]);

                //nastavi admina če je checkbox bik checked
                if($admin == 1) {

                    $query = "UPDATE profesorji SET admin=? WHERE id=?";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$admin, $id]);
                }
                //odstrani admin pravice, če je checkbox unchecked
                else if($admin == 0) {
                    $query = "UPDATE profesorji SET admin=? WHERE id=?";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$admin, $id]);
                }
            }
            else {
                //ce se gesli ne ujemata
                echo '<script type="text/javascript">alert("Gesli se ne ujemata!");window.location="profesor_edit.php?id='.$id.'";</script>';
                die();
            }


        }
        //če je polje z gesli prazno, potem posodobimo vse razen gesla
        else {
            //vnos v bazo
            $query = "UPDATE profesorji SET ime=?, priimek=?, email=? WHERE id=?";

            //pripravi sql stavek tako, da sciti pred SQL inserti
            $stmt = $pdo->prepare($query); 
            //izvede sql stavek
            $stmt->execute([$ime,$priimek,$email,$id]);

            //nastavi admina če je checkbox bik checked
            if($admin == 1) {

                $query = "UPDATE profesorji SET admin=? WHERE id=?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$admin, $id]);
            }
            //odstrani admin pravice, če je checkbox unchecked
            else if($admin == 0) {
                $query = "UPDATE profesorji SET admin=? WHERE id=?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$admin, $id]);
            }
        }
        //preusmeritev na seznam profesorjev
        header("Location: profesorji.php"); 
        //nic pod die() se ne izvede
        die(); 
    }

    //če se if stavek ne izvede, preusmeri nazaj na vnos
    header("Location: profesor_edit.php?id=$id");
    die();

} catch (PDOException $e) {
    echo '<script type="text/javascript">alert("Ta email že obstaja!");window.location="profesor_edit.php?id='.$id.'";</script>';
    die();
}
?>