<?php
    include_once "header.php";

    adminOnly();

    include_once "db.php";

    $id = (int) $_GET['id'];

    $query = "SELECT * FROM studenti WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //iz baze preberem vse o studentu, ki ga urejam
    $student = $stmt->fetch();
?>
<div class = "vsebina-strani-forme">
    <h2>Uredi študenta</h2>
    <div class="obroba">

        <form action="student_update.php" method="post">
            <input type="hidden" value = "<?php echo $student['id']; ?>" name="id"/>
            <input type="text" value = "<?php echo $student['ime']; ?>" name="ime" class="form-control" placeholder="Vnesi ime" required="required"/> <br />
            <input type="text" value = "<?php echo $student['priimek']; ?>" name="priimek" class="form-control" placeholder="Vnesi priimek" required="required"/> <br />
            <input type="number" value = "<?php echo $student['studentska_stevilka']; ?>" name="studentska_stevilka" min="10000000000" max="99999999999" class="form-control" placeholder="Vnesi vpisno številko študenta" required="required"/> <br />
            
            <input type="submit" class="btn btn-primary" value="Shrani"/>
        </form>
    </div>
</div>
<?php
include_once "footer.php";
?>