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
<div class="header">
<h1>IFJÚSÁGI KÖNYVESBOLT</h1>
<div id="kont">
<img src="img/logo.png" alt="logo">
<?php
	session_start();
	if(!isset($_SESSION["nickname"]))
	{
		header("location:login.php");
	}
	echo '<br>'.$_SESSION['nickname'];
?>
<p><a href="logout.php">Kijelentkezés</a></p>
</div>
</div>

<ul>
	<li><a href="fmain.php">Rólunk</a>
	<li class="dropdown">
	<a href="feltolt.php" class="dropbtn">Feltöltött könyvek</a>
	<div class="dropdown-content">
		<a href="feltoltes.php">Könyv feltöltés</a>
    </div>
	<li class="dropdown">
    <a href="fvasar.php" class="dropbtn">Vásárlás</a>
    <div class="dropdown-content">
		<a href="fakcio.php">Akciók</a>
    </div>
  </li>
  <li><a href="ffizet.php">Fizetés és Szállítás</a></li>
  <li><a href="fvirtual.php">Virtuális séta</a></li>
  <li><a href="#kapcs">Kapcsolatok</a></li>
  <li style="float: right;"><a href="fkosar.php"  class="active">Kosár</a></li>
</ul>

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

<div class="footer">
<hr>
<a id="kapcs">
<h3>Kapcsolatok:</h3>
<address>
email:<a href="mailto:csongortuzok@gmail.com">************</a><br>
tel.:06***********<br>
központi raktár:********
</address>
</a>
<img src="img/logo.png" alt="logo">
<p>Ifjúsági <br> könyvbolt</p>
</div>
</body>
</html>