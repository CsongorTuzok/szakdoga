<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="_css/feltoltes2.css">
<style>
</style>
</head>
<body>
<?php include 'header.php';?>
<div class="raw">
<div class="side">
<h4>Válassza ki a feltölteni kívánt PDF-et!</h4>
<p>
<form action="feltoltes2.php" method="post" enctype="multipart/form-data">
  <input type="file" name="fileToUpload" id="fileToUpload">
  <br>
  <br>
  <input type="submit" value="Feltöltés" name="submit">
</form>
<p>Feltöltés csak PDF formátumban lehetséges.<br> 
Maximális fájl méret nem haladhatja meg az 5MB nagyságot. </p> 
<p>Ennél nagyobb fájl esetén írjon az alábbi email címre: ifjusagikonyvesbolt@gmail.com</p>
<p>A könnyebb azonosítás és a megfelelő visszajelzések érdekében a 
dokumentum nevét az alábbiak szerint szükséges megadni: "username_Műcím"</p>
</div>
<div class="main">
</div>
</div>
<?php include 'footer.php';?>
</body>
</html>