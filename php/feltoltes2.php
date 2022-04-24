<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (file_exists($target_file)) {
  echo "Ilyen nevű fájl már létezik.";
  $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Túl nagy a fájl mérete.";
  $uploadOk = 0;
}

if($FileType != "pdf") {
  echo "Csak PDF formátum engedélyezet.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo "<br>A fájl nem lett feltöltve.";
  echo "<br><a href='feltoltes.php'>Vissza a feltöltéshez.</a>";

} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "A ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " nevű fájl feltöltése sikeres volt.";
	echo "<br><a href='index.php'>Vissza a főoldalra.</a>";
  } else {
    echo "A feltöltés közben hiba merült fel, probáld újra.";
	echo "<br><a href='feltoltes.php'>Vissza a feltöltéshez.</a>";
  }
}
?>
