<?php
    include_once "header.php";
    include_once "db.php";

    $id_predmet = $_GET['id']; //id predmeta
?>

<div>

    <h3>Dodaj študente</h3>


    <form action="studenti_predmeti_insert.php" method="post">
        <input type="hidden" value = "<?php echo $id_predmet; ?>" name="id_predmet"/>   
        
        <?php
            //shranim že dodane studente v array          
            $query = "SELECT * FROM studenti_predmeti WHERE id_predmet=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id_predmet]);

            $studenti = array();
            while($row = $stmt->fetch()) {
                $studenti[] = $row['id_student'];
            }
            
            //izpis vseh studentov

            $query = "SELECT * FROM studenti ORDER BY priimek ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
                    
            while($row = $stmt->fetch()) {
                
        
                echo '<div class="student">';
                if(in_array($row['id'],$studenti)) {
                    echo '<input type="checkbox" checked="checked" name="studenti[]" value="'.$row['id'].'"/>';
                }
                else {
                    echo '<input type="checkbox" name="studenti[]" value="'.$row['id'].'"/>';
                }
                echo $row['priimek'].' '.$row['ime'].' '.$row['studentska_stevilka'];
                echo '</div>';
            }
        ?>

        <input type="submit" class="btn btn-primary text-black" name="submit" value="Shrani"/> <br />
        <!--<input type="reset" name="submit" value="Pobriši"/> <br /> -->
    </form>

</div>
<?php
    include_once "footer.php";
?>