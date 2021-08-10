<?php
    include_once "header.php";
    include_once "db.php";

    
    if(isAdmin()) {
        echo '<a href="profesor_add.php" class="btn btn-primary">Dodaj profesorja</a>';
    }

?>

<br/>
<div class="profesorji">
<?php
    $query = "SELECT * FROM profesorji ORDER BY ime ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    //izpis vseh profesorjev
    while($row = $stmt->fetch()) {
        

        echo '<div class="profesor">';
        echo '<a href="profesor.php?id='.$row['id'].'" class="pisava-gumbi">';
        echo $row['ime'].' '.$row['priimek'];
        echo '</a>';
        if(isAdmin()) {
            echo '<a href="profesor_edit.php?id='.$row['id'].'" class="btn btn-primary" >Uredi</a> ';
            if($row['admin'] == 0) { //adminov se ne sme izbrisat, ce res hoces mores prvo nastavit da ni admin 
                echo '<a href="profesor_delete.php?id='.$row['id'].' " class="btn btn-primary" onclick="return confirm(\'Prepričani?\')">Izbriši</a> ';
            }
        }
        echo '</div>';
    }
?>
</div>

<?php
    include_once "footer.php";
?>