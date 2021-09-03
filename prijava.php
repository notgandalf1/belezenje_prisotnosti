<?php
    include_once "header.php";
?>


    
    <div class="obroba">
        <h3>Prijava</h3>
        <br>
        <form action="prijava_check.php" method="post">
            <input type="email" class="form-control" name="email" placeholder="Vnesi e-pošto" required="required"/> <br />
            <input type="password" class="form-control" name="geslo" placeholder="Vnesi geslo" required="required"/> <br />
            <input type="submit" class="btn btn-primary" value="Prijava"/> <br />
            
        </form>
    </div>

<?php
    include_once "footer.php";
?>