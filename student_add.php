<?php
    include_once "header.php";

    adminOnly();
?>



    
    <div class ="obroba">
        <h3>Dodaj študenta</h3>
        <br>
        <form action="student_insert.php" method="post">
            <input type="text" name="ime" class="form-control" placeholder="Vnesi ime" required="required"/> <br />
            <input type="text" name="priimek" class="form-control" placeholder="Vnesi priimek" required="required"/> <br />
            <input type="number" name="studentska_stevilka" min="10000000000" max="99999999999" class="form-control" placeholder="Vnesi vpisno številko študenta" required="required"/> <br />
            
            <input type="submit" class="btn btn-primary text-black" name="submit" value="Shrani"/> <br />
            <!--<input type="reset" name="submit" value="Pobriši"/> <br /> -->
        </form>
    </div>
<?php
    include_once "footer.php";
?>