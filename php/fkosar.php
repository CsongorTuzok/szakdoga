<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/fkosar.css">
<style>
</style>
</head>
<body>
<?php
	session_start();
	if(!isset($_SESSION["nickname"]))
	{
		header("location:index.php");
	}
	echo '<br>'.$_SESSION['nickname'];
?>
<?php include 'header.php';?>

<div class="row">
<div class="column side">
<h4>Ez is érdekelhet:</h4>
<p  id="hasab3">
<img src="img/bookicon.jpg" alt="logo">
<br>
Fekete István
<br><br>
Tüskevár
<br><br>
ár: <del>1700Ft</del>
<br><br>
ár: 1600Ft
<br><br>
<input type="submit" value="Kosárba">

<p  id="hasab4">
<img src="img/bookicon.jpg" alt="logo">
<br>
Fekete István
<br><br>
Tüskevár
<br><br>
ár: <del>1700Ft</del>
<br><br>
ár: 1600Ft
<br><br>
<input type="submit" value="Kosárba">
</div>

<div class="column middle">
<b>Kosaram:</b>
<span style="float: right; white-space: pre;">Összesen:    Ft</span>
<p style="white-space: pre;">Könyv:    db
<p id="kosar">cím szállítás db ár
<p style="font-family: monospace;"><a href="a">kosár tartalmának törlése</a>
<p style="float: right;"><input type="submit" value="Tovább">

</div>
</div>
<?php include 'footer.php';?>
</body>
</html>