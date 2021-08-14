<?php
    include_once "header.php";
    include_once "db.php";

    $id = (int) $_GET['id']; //predmet id

    $query = "SELECT * FROM predmeti WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //iz baze preberem vse o predmetu
    $predmet = $stmt->fetch();
?>

<h1><?php echo $predmet['ime_predmeta']?></h1>
<h3><?php echo $predmet['leto_izvajanja'];?></h3>

<?php
echo '<a href="predavanje_add.php?id='.$id.'" class="btn btn-primary">Dodaj predavanje</a>';
echo '<a href="studenti_predmeti_add.php?id='.$id.'" class="btn btn-primary">Dodaj/odstrani študente</a>';
?>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm table-primary">
    <thead>
        <tr>
        <th>ŠTUDENTI</th>
        <?php
            //izpis predavanj tega predmeta v tabelo

            $query = "SELECT * FROM predavanja 
                        WHERE id_predmet = $id
                        ORDER BY datum_izvajanja ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            while($row = $stmt->fetch()) {
                
                
                echo '<th scope="col">'.$row['datum_izvajanja'];
                echo '<a class="tabela-gumb" href="predavanje_delete.php?id='.$row['id'].' " onclick="return confirm(\'Prepričani?\')">Izbriši</a> ';
                echo '</th>';
                
                
            }
        ?>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php
            //izpis študentov tega predmeta v tabelo

            $query = "SELECT * FROM studenti st 
                        INNER JOIN studenti_predmeti sp
                        ON st.id = sp.id_student
                        WHERE sp.id_predmet = $id
                        ORDER BY st.priimek ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            while($row = $stmt->fetch()) {
                
                echo '<tr>';
                echo '<th>'.$row['priimek'].' '.$row['ime'];
                echo '</th>';
                
                //naredi en cell za vsako predavanje
                $query = "SELECT * FROM predavanja WHERE id_predmet=?";
                $stmt2 = $pdo->prepare($query);
                $stmt2->execute([$id]);

                while($row2 = $stmt2->fetch()) {
                    echo '<th>checkbox</th>';
                }


                echo '</tr>';
                
                
            }
        ?>
        </tr>
    </tbody>
    </table>
</div>



<?php
include_once "footer.php";
?>