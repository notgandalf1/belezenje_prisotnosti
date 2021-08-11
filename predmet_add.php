<?php
    include_once "header.php";

?>

<div>

    <h3>Dodaj nov predmet</h3>


    <form action="predmet_insert.php" method="post">
        <input type="hidden" value = "<?php echo $_SESSION['profesor_id']; ?>" name="id_profesor"/>
        <input type="text" name="ime_predmeta" class="form-control" placeholder="Vnesi naslov" required="required"/> <br />
        <input type="text" name="leto_izvajanja" class="form-control" placeholder="Vnesi šolsko leto izvajanja" required="required"/> <br />
        
        <input type="submit" class="btn btn-primary text-black" name="submit" value="Shrani"/> <br />
        <!--<input type="reset" name="submit" value="Pobriši"/> <br /> -->
    </form>

</div>
<?php
    include_once "footer.php";
?>