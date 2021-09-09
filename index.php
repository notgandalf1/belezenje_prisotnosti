<?php
    include_once "header.php";
    include_once "db.php";

?>

<br/>
<div class="obroba">
<?php
    echo '<h3 class="dinamicni-font-l">Moji predmeti</h3>';
    echo '<a href="predmet_add.php" class="btn btn-primary">Dodaj predmet</a>';
    echo '<hr>';
    
    $id = $_SESSION['profesor_id'];
    $query = "SELECT * FROM predmeti WHERE id_profesor=? ORDER BY ime_predmeta ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //izpis vseh lastnih predmetov
    while($row = $stmt->fetch()) {
        
        //štetje študentov v predmetu
        $query = "SELECT * FROM studenti_predmeti WHERE id_predmet=?";
        $stmt2 = $pdo->prepare($query);
        $stmt2->execute([$row['id']]);
        $stStudentov = $stmt2->rowCount();
        


        echo '<div class="vsi-elementi">';
            echo '<div class="element-left">';
                echo '<a href="predmet.php?id='.$row['id'].'" class="pisava-gumbi">';
                    echo '<label class="dinamicni-font-s">'.$row['ime_predmeta'].'<br>'.$row['leto_izvajanja'].'</label>';
                echo '</a><br>';
                echo '<label class="dinamicni-font-s">Študenti: '.$stStudentov.'</label>'; //izpis števila študentov v predmetu
            echo '</div>';
            echo '<div class="element-middle">';
            echo '</div>';  
            echo '<div class="element-right">';
                echo '<a href="predmet_edit.php?id='.$row['id'].'" class="btn btn-primary" >Uredi</a> '; 
                echo '<a href="predmet_delete.php?id='.$row['id'].' " class="btn btn-primary" onclick="return confirm(\'Prepričani?\')">Izbriši</a> ';
            echo '</div>';
        echo '</div>';
        echo '<hr>';
    }
?>
</div>

<?php
    include_once "footer.php";
?>