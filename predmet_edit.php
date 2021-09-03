<?php
    include_once "header.php";

    include_once "db.php";


    $id = (int) $_GET['id']; // id od predmeta ki ga urejam

    $query = "SELECT * FROM predmeti WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //iz baze preberem vse o predmetu, ki ga urejam
    $predmet = $stmt->fetch();

?>

<div class = "vsebina-strani-forme">

    <h3>Uredi predmet</h3>
    <div class="obroba">


        <form action="predmet_update.php" method="post">
            <input type="hidden" value = "<?php echo $predmet['id']; ?>" name="id"/>
            <input type="text" value = "<?php echo $predmet['ime_predmeta']; ?>" name="ime_predmeta" class="form-control" placeholder="Vnesi naslov" required="required"/> <br />
            <input type="text" value = "<?php echo $predmet['leto_izvajanja']; ?>" name="leto_izvajanja" class="form-control" placeholder="Vnesi šolsko leto izvajanja" required="required"/> <br />
            
            <input type="submit" class="btn btn-primary text-black" name="submit" value="Shrani"/> <br />
            <!--<input type="reset" name="submit" value="Pobriši"/> <br /> -->
        </form>
    </div>
</div>
<?php
    include_once "footer.php";
?>