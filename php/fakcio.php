<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/fakcio.css">
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
      <a href="fakcio.php" class="active">Akciók</a>
    </div>
  </li>
  <li><a href="ffizet.php">Fizetés és Szállítás</a></li>
  <li><a href="fvirtual.php">Virtuális séta</a></li>
  <li><a href="#kapcs">Kapcsolatok</a></li>
  <li style="float: right;"><a href="fkosar.php">Kosár</a></li>
</ul>

  <div class="raw">
 <div class="side">
<p>
<b style="	font-family: monospace">Keresés:</b>
<input type="text" name="kif" size=15%>
<input type="submit" value="Keresés">
<br><br>
<b style="	font-family: monospace; font-size: large">Szűrés:</b>
<br><br>
<b style="	font-family: monospace">Témák:</b>
<br><label>
<input type="checkbox" name="tema" value="1">1<br>
<input type="checkbox" name="tema" value="2">2<br>
<input type="checkbox" name="tema" value="3">3<br>
<input type="checkbox" name="tema" value="4">4<br>
<input type="checkbox" name="tema" value="5">5<br>
</label>
<br>
<b style="	font-family: monospace">Szerzők:</b>
<br><label>
<input type="checkbox" name="szerzo" value="1">1<br>
<input type="checkbox" name="szerzo" value="2">2<br>
<input type="checkbox" name="szerzo" value="3">3<br>
<input type="checkbox" name="szerzo" value="4">4<br>
<input type="checkbox" name="szerzo" value="5">5<br>
</label>
<br>
<input type="submit" value="Szűrés">
</div>

<div class="main">
<p  id="hasab3">
<img src="img/bookicon.jpg" alt="logo">
<br>
Fekete István
<br><br>
Tüskevár
<br><br>
régi ár: <del>1700Ft</del>
<br><br>
új ár: 1600Ft
<br><br>
<input type="submit" value="Kosárba">

<p  id="hasab4">
<img src="img/bookicon.jpg" alt="logo">
<br>
Fekete István
<br><br>
Tüskevár2
<br><br>
régi ár: <del>1702Ft</del>
<br><br>
új ár: 1602Ft
<br><br>
<input type="submit" value="Kosárba">

<p id="hasab5">
<img src="img/bookicon.jpg" alt="logo">
<br>
Fekete István
<br><br>
Tüskevár3
<br><br>
régi ár: <del>1703Ft</del>
<br><br>
új ár: 1603Ft
<br><br>
<input type="submit" value="Kosárba">

<p id="hasab6">
<img src="img/bookicon.jpg" alt="logo">
<br>
Fekete István
<br><br>
Tüskevár4
<br><br>
régi ár: <del>1704Ft</del>
<br><br>
új ár: 1604Ft
<br><br>
<input type="submit" value="Kosárba">

<p>
<div class="pagination">
  <a href="#">&laquo;</a>
  <a href="#" class="active">1</a>
  <a href="#">2</a>
  <a href="#">3</a>
  <a href="#">4</a>
  <a href="#">5</a>
  <a href="#">6</a>
  <a href="#">&raquo;</a>
</div>
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