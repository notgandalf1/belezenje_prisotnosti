<?php
    include_once "header.php";
    include_once "db.php";

    $id = (int) $_GET['id']; //predmet id

    $query = "SELECT * FROM predmeti WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //iz baze preberem vse o predmetu
    $predmet = $stmt->fetch();
?>

<h1><?php echo $predmet['ime_predmeta']?></h1>
<h3><?php echo $predmet['leto_izvajanja'];?></h3>






<?php
include_once "footer.php";
?>