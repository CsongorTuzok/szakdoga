<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/ffizet.css">
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
<p><a href="a">Kijelentkezés</a></p>
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
  <li><a href="ffizet.php" class="active">Fizetés és Szállítás</a></li>
  <li><a href="fvirtual.php">Virtuális séta</a></li>
  <li><a href="#kapcs">Kapcsolatok</a></li>  
  <li style="float: right;"><a href="fkosar.php">Kosár</a></li>
</ul>
<div class="row">
<div id="hasab">
<h2>
Fizetés és Szállítás:
</h2>
<h4>
<u>Fizetés</u>
</h4>
Utánvételi fizetés
<br>Gyűjtő számlára utalás
<br>
<table style="border-collapse: collapse; width: 30%; margin-left: 30%;">
	<tr>
	<td><b>Megrendelés értéke</b></td><td><b>Szállítási díj</b></td>
	</tr>
	<tr>
	<td>0-2999 Ft</td><td>999 Ft</td>
	</tr>
	<tr>
	<td>3000-4999 Ft</td><td>699 Ft</td>
	</tr>
	<tr>
	<td>5000 Ft felett</td><td><b>ingyenes</b></td>
	</tr>
</table>
<br><br>
<h4>
<u>Szállítás</u>
</h4>
Házhoz szállítás
<br>Csomagpont
<br>
<img src="img/furgon.jpg" style="margin-left: 30%;">
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