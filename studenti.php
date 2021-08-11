<?php
    include_once "header.php";
    include_once "db.php";

    
    if(isAdmin()) {
        echo '<a href="student_add.php" class="btn btn-primary">Dodaj študenta</a>';
    }

?>

<br/>
<div class="študentje">
<?php
    $query = "SELECT * FROM studenti ORDER BY ime ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    //izpis vseh studentov in njihovih študentskih številk
    while($row = $stmt->fetch()) {
        

        echo '<div class="student">';
        echo $row['ime'].' '.$row['priimek'].' '.$row['studentska_stevilka'];
        if(isAdmin()) {
            echo '<a href="student_edit.php?id='.$row['id'].'" class="btn btn-primary" >Uredi</a> '; 
            echo '<a href="student_delete.php?id='.$row['id'].' " class="btn btn-primary" onclick="return confirm(\'Prepričani?\')">Izbriši</a> ';
            }
        echo '</div>';
    }
?>
</div>

<?php
    include_once "footer.php";
?>