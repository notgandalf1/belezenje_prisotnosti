<?php
    include_once "header.php";

?>

<div class = "vsebina-strani-forme">

    <h3>Dodaj novo predavanje</h3>
    <div class ="obroba">

        <form action="predavanje_insert.php" method="post">
            <input type="hidden" value = "<?php echo $_GET['id']; ?>" name="id_predmet"/>
            <input type="date" name="datum_izvajanja" class="form-control" placeholder="Vnesi datum izvajanja" required="required"/> <br />        
            <input type="submit" class="btn btn-primary text-black" name="submit" value="Shrani"/> <br />
            <!--<input type="reset" name="submit" value="Pobriši"/> <br /> -->
        </form>
    </div>
</div>
<?php
    include_once "footer.php";
?>