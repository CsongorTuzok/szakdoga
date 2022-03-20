<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/feltoltes.css">
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
      <a href="feltoltes.php" class="active">Könyv feltöltés</a>
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
  <li style="float: right;"><a href="fkosar.php">Kosár</a></li>
</ul>

<div class="raw">
<div class="side">
<h4>Válassza ki a feltölteni kívánt könyvet!</h4>
<p>
<input type="file" id="myfile" name="myfile">
<br><br>
<input type="submit" name="myfile" value="Feltöltés">
</div>

<div class="main">
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