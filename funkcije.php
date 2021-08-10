<?php

//sposojena funkcija iz predavanj, vrača al profilno sliko al pa default sliko, če profilna ni nastavljena
function getProfilna($id) {
    require "db.php";
    $query = "SELECT * FROM profesorji WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $profilna_url = $stmt->fetch();

    if(!empty($profilna_url['profilna'])) {
        return $profilna_url['profilna'];
    }
    else {
        return './assets/img/prazen_avatar.jpg';
    }
}

//izbriše prejšnjo profilno iz mape profilnih slik, zato ker vsak profesor rabi le eno naenkrat
function izbrisiPrejsnjoProfilno($id) {
    require "db.php";
    $query = "SELECT * FROM profesorji WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $profilna_url = $stmt->fetch();

    if(!empty($profilna_url['profilna'])) {
        unlink($profilna_url['profilna']);
    }
}

?>