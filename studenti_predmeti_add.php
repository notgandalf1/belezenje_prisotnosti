<?php
    include_once "header.php";
    include_once "db.php";

    $id_predmet = $_GET['id']; //id predmeta
?>



    
    <div class = "obroba">
        <h3>Dodaj študente</h3>
        <br>

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
                    
            
                    echo '<div class="vsi-elementi">';
                        echo '<div class="element-left">';
                            if(in_array($row['id'],$studenti)) {
                                echo '<label><input type="checkbox" checked="checked" name="studenti[]" value="'.$row['id'].'"/><br>'.$row['priimek'].'<br>'.$row['ime'].'</label>';
                            }
                            else {
                                echo '<label><input type="checkbox" name="studenti[]" value="'.$row['id'].'"/><br>'.$row['priimek'].'<br>'.$row['ime'].'</label>';
                            }
                        echo '</div>';
                        echo '<div class="element-middle">';
                        echo '</div>';
                        echo '<div class="element-right">';
                            echo $row['studentska_stevilka'];
                        echo '</div>';
                    echo '</div>';
                }
            ?>

            <input type="submit" class="btn btn-primary" name="submit" value="Shrani"/>
            <a href="predmet.php?id=<?php echo $id_predmet;?>" class="btn btn-primary">Nazaj</a>
            <!--<input type="reset" name="submit" value="Pobriši"/> <br /> -->
        </form>
    </div>
<?php
    include_once "footer.php";
?>