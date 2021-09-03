<?php
    include_once "header.php";
?>

<div class="vsebina-strani-forme">
    <h3>Prijava</h3>
    <div class="obroba">
        <form action="prijava_check.php" method="post">
            <input type="email" class="form-control" name="email" placeholder="Vnesi e-pošto" required="required"/> <br />
            <input type="password" class="form-control" name="geslo" placeholder="Vnesi geslo" required="required"/> <br />
            <input type="submit" class="btn btn-primary" value="Prijava"/> <br />
            
        </form>
    </div>
</div>

<?php
    include_once "footer.php";
?>