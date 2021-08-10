<?php
    include_once "header.php";
?>

<div>

    <h3>Dodaj profesorja</h3>


    <form action="profesor_insert.php" method="post">
        <input type="text" name="ime" class="form-control" placeholder="Vnesi ime" required="required"/> <br />
        <input type="text" name="priimek" class="form-control" placeholder="Vnesi priimek" required="required"/> <br />
        <input type="email" name="email" class="form-control" placeholder="Vnesi e-pošto" required="required"/> <br />
        <input type="password" name="geslo1" class="form-control" placeholder="Vnesi geslo" required="required"/> <br />
        <input type="password" name="geslo2" class="form-control" placeholder="Ponovno vnesi geslo" required="required"/> <br />
        
        <!-- check ali bo narejeni uporabnik/profesor imel admin pravice ali ne-->
        <input type="checkbox" name="admin" value="1"/>Admin <br />
        
        <input type="submit" class="btn btn-primary text-black" name="submit" value="Shrani"/> <br />
        <!--<input type="reset" name="submit" value="Pobriši"/> <br /> -->
    </form>

</div>
<?php
    include_once "footer.php";
?>