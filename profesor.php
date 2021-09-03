<?php
    include_once "header.php";
    include_once "db.php";
    include_once "funkcije.php";

    $id = (int) $_GET['id']; //profesor id

    $query = "SELECT * FROM profesorji WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //iz baze preberem vse o profesorju
    $profesor = $stmt->fetch();
?>

    <div class="obroba">
        <div class="profil">
            <h1 class="dinamicni-font"><?php echo $profesor['ime'].' '.$profesor['priimek'];?></h1>
            <h3 class="dinamicni-font"><?php echo $profesor['email'];?></h3>
        </div>

        <div class="profil">
            <?php
                echo '<img class="slika" src="'.getProfilna($id).'" alt="slika" >';
            ?>
        </div>
        <?php
            //če profesor gleda svojo stran, si lahko naloži profilno sliko
            if($_SESSION['profesor_id'] == $id) { //ZACETEK IF STAVKA
        ?>

        <hr>
        <h3 class="dinamicni-font">Naloži profilno sliko</h3>
        <form action="profilna_slika_upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value = "<?php echo $profesor['id']; ?>" name="id"/>
            <input type="file" name="file" class="form-control"/> <br/>
            <input type="submit" name="submit" class="btn btn-primary" value="Naloži"/>
        </form>



        <?php
            } //KONEC IF STAVKA
        ?>
    </div>



<?php
include_once "footer.php";
?>