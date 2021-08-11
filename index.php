<?php
    include_once "header.php";
    include_once "db.php";

    
        echo '<a href="predmet_add.php" class="btn btn-primary">Dodaj predmet</a>';

?>

<br/>
<div class="predmeti">
<?php
    $id = $_SESSION['profesor_id'];
    $query = "SELECT * FROM predmeti WHERE id_profesor=? ORDER BY ime_predmeta ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //izpis vseh lastnih predmetov
    while($row = $stmt->fetch()) {
        

        echo '<div class="predmet">';
        echo '<a href="predmet.php?id='.$row['id'].'" class="pisava-gumbi">';
        echo $row['leto_izvajanja'].' '.$row['ime_predmeta'];
        echo '</a>';
        echo '<a href="predmet_edit.php?id='.$row['id'].'" class="btn btn-primary" >Uredi</a> '; 
        echo '<a href="predmet_delete.php?id='.$row['id'].' " class="btn btn-primary" onclick="return confirm(\'Prepričani?\')">Izbriši</a> ';
        echo '</div>';
    }
?>
</div>

<?php
    include_once "footer.php";
?>