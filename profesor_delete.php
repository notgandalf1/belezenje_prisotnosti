<?php
    include_once "seja.php";

    adminOnly();
    
    include_once "db.php";
    include_once "funkcije.php";

    $id = (int) $_GET['id']; //id profesorja/uporabnika ki ga brisem

    /*pred izbrisom profesorja moram pobrisati tudi njegove predmete, 
    * povezave med študenti in temi predmeti, njegova predavanja
    * in prisotnosti na teh predavanjih
    */
    //poiščemo vse profesorjove predmete, in zatem za vsak profesorjev predmet izbrišemo vse podatke
    //in na koncu tudi sam predmet
    $query = "SELECT * FROM predmeti WHERE id_profesor=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //gremo čez vse predmete
    while($row = $stmt->fetch()) {
        $query = "DELETE FROM studenti_predmeti WHERE id_predmet = ?";
        $stmt2 = $pdo->prepare($query);
        $stmt2->execute([$row['id']]);
    
        $query = "DELETE FROM prisotnost WHERE id_predavanje = 
            (SELECT id FROM predavanja WHERE id_predmet = ?)";
        $stmt2 = $pdo->prepare($query);
        $stmt2->execute([$row['id']]);
    
        $query = "DELETE FROM predavanja WHERE id_predmet = ?";
        $stmt2 = $pdo->prepare($query);
        $stmt2->execute([$row['id']]);
    
        $query = "DELETE FROM predmeti WHERE id = ?";
        $stmt2 = $pdo->prepare($query);
        $stmt2->execute([$row['id']]); 

    }
    
    //pred izbrisom profesorja, izbrišem tudi njegovo profilno, da ne ostane v mapi
    izbrisiPrejsnjoProfilno($id);

    //brisanje profesorja
    $query = "DELETE FROM profesorji WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("Location: profesorji.php");
    die();

?>