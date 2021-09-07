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




<div class = "obroba-tabela">
<h1><?php echo $predmet['ime_predmeta']?></h1>
<h3><?php echo $predmet['leto_izvajanja'];?></h3>

<?php
echo '<div>';
    echo '<a href="predavanje_add.php?id='.$id.'" class="btn btn-primary">Dodaj predavanje</a>';
echo '</div>';
echo '<hr>';
echo '<div>';
    echo '<a href="studenti_predmeti_add.php?id='.$id.'" class="btn btn-primary">Dodaj / odstrani študente</a>';
echo '</div>';   
echo '<hr>';
echo '<div>';
echo '<form action="prisotnost_insert.php" method="post">';
echo '<input type="hidden" value = "'.$id.'" name="id_predmet"/>';
echo '<input type="submit" class="btn btn-primary" value="Shrani prisotnost"/>';
?>
<div class="table-responsive">
    <br>
    <table class="table table-bordered table-hover table-sm table-primary">
    <thead>
        <tr>
        <th class="tabela-stolpec">ŠTUDENTI</th>
        <?php
            //izpis predavanj tega predmeta v tabelo

            $query = "SELECT * FROM predavanja 
                        WHERE id_predmet = ?
                        ORDER BY datum_izvajanja ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id]);

            while($row = $stmt->fetch()) {
                
                
                echo '<th class="tabela-stolpec">'.$row['datum_izvajanja'];
                echo '<br>';
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
                        WHERE sp.id_predmet = ?
                        ORDER BY st.priimek ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id]);

            
            
            $i = 0; //stevec, da se izognemo ponovitvam pošiljanja idja predavanj pri vsakem novem študentu
            //row so podatki o trenutnem studentu
            while($row = $stmt->fetch()) {
                
                echo '<tr>';
                echo '<th>'.$row['priimek'].'<br>'.$row['ime'];
                echo '</th>';
                echo '<input type="hidden" value = "'.$row['id_student'].'" name="studentiVsi[]"/>';

                //naredi en cell za vsako predavanje
                $query = "SELECT * FROM predavanja WHERE id_predmet=? ORDER BY datum_izvajanja ASC";
                $stmt2 = $pdo->prepare($query);
                $stmt2->execute([$id]);

                //row2 so podatki o trenutnem predavanju
                while($row2 = $stmt2->fetch()) {
                    
                    if($i==0) echo '<input type="hidden" value = "'.$row2['id'].'" name="predavanjaVsa[]"/>';

                    echo '<td style="text-align:center">';
                    //struktura stringa idstudenta|idpredavanja
                    $string = $row['id_student'].'|'.$row2['id'];
                    
                    //pošlje array stringov z idji

                    $query = "SELECT * FROM prisotnost WHERE id_student=? && id_predavanje=?";
                    $stmt4 = $pdo->prepare($query);
                    $stmt4->execute([$row['id_student'],$row2['id']]);
                    $result = $stmt4->fetch();
                    
                    if(isset($result['prisotnost'])) {
                        echo '<input type="checkbox" checked="checked" name="prisotnost[]" value="'.$string.'"/>';
                    }
                    else {
                        echo '<input type="checkbox" name="prisotnost[]" value="'.$string.'"/>';
                    }
                    echo '</td>';
                    
                }
                $i++;
                echo '</tr>'; 
            }
                        
        ?>
        </tr>
    </tbody>
    </table>
</div>


<?php
echo '</form>';
echo '</div>';

include_once "footer.php";
?>