<?php
    include_once "header.php";
    include_once "db.php";
?>

<br/>
<div class="obroba">
<?php
     if(isAdmin()) {
        echo '<a href="student_add.php" class="btn btn-primary">Dodaj študenta</a>';
        echo '<hr>';
    }


    $query = "SELECT * FROM studenti ORDER BY priimek ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    //izpis vseh studentov in njihovih študentskih številk
    while($row = $stmt->fetch()) {
        

        echo '<div class="vsi-elementi">';
            echo '<div class="element-left">';
                echo $row['priimek'].'<br>'.$row['ime'].'<br>'.$row['studentska_stevilka'];
            echo '</div>';
            echo '<div class="element-middle">';
            echo '</div>';  
            if(isAdmin()) {
                echo '<div class="element-right">';
                    echo '<a href="student_edit.php?id='.$row['id'].'" class="btn btn-primary" >Uredi</a> '; 
                    echo '<a href="student_delete.php?id='.$row['id'].' " class="btn btn-primary" onclick="return confirm(\'Prepričani?\')">Izbriši</a> ';
                echo '</div>';
                }
        echo '</div>';
        echo '<hr>';
    }
?>
</div>

<?php
    include_once "footer.php";
?>