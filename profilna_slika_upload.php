<?php
include_once "seja.php";

include_once "db.php";
include_once "funkcije.php";

$id = (int)$_POST['id']; //id profesorja


//lokacija uploada
$target_dir = "./profilne_slike/";

//random name generator - se izognemu pobrisanju slik zaradi istih imen
$random = $id.'-'.date("YmdHis")."-".rand(10,10000).'-';


$target_file = $target_dir . $random . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

// Check file size
if ($_FILES["file"]["size"] > 5000000) {
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 0;
}

// Check if $uploadOk is set to 1 - vse je ok
if ($uploadOk == 1) {
//pred uploadom še zbrišem staro profilno iz mape, zato da se ne nabirajo v neskončnost
    izbrisiPrejsnjoProfilno($id);

// if everything is ok, try to upload file
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      //datoteko je prestavil, zapišemo v bazo
      $query = "UPDATE profesorji SET profilna=? WHERE id=?";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$target_file,$id]);
  }
}
//preusmerim nazaj na profesorja
header("Location: profesor.php?id=".$id);
die();
?>