<?php
    include_once "header.php";

    adminOnly();

    include_once "db.php";

    $id = (int) $_GET['id'];

    $query = "SELECT * FROM profesorji WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //iz baze preberem vse o profesorju, ki ga urejam
    $profesor = $stmt->fetch();
?>

<h2>Uredi profesorja</h2>


<form action="profesor_update.php" method="post">
    <input type="hidden" value = "<?php echo $profesor['id']; ?>" name="id"/>
    <input type="text" value = "<?php echo $profesor['ime']; ?>" name="ime" placeholder="Vnesi ime" class="form-control" required="required"/><br/>
    <input type="text" value = "<?php echo $profesor['priimek']; ?>" name="priimek" placeholder="Vnesi priimek" class="form-control" required="required"/><br/>
    <input type="text" value = "<?php echo $profesor['email']; ?>" name="email" placeholder="Vnesi email" class="form-control" required="required"/><br/>
    <input type="password" name="geslo1" class="form-control" placeholder="Vnesi geslo"/> <br />
    <input type="password" name="geslo2" class="form-control" placeholder="Ponovno vnesi geslo"/> <br />

    <?php
        //če je profesor admin, potem že obkljuka da je admin
        if($profesor['admin'] == 1) {
            echo '<input type="checkbox" checked="checked" name="admin" value="1"/>Admin <br />';
        }
        else {
            echo '<input type="checkbox" name="admin" value="1"/>Admin <br />';
        }
    ?>    
    <input type="submit" class="btn btn-primary" value="Shrani"/>
</form>

<?php
include_once "footer.php";
?>