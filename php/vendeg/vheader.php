<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/header2.css">
<style>
</style>
</head>
<body>

<div class="header">
<h1>IFJÚSÁGI KÖNYVESBOLT</h1>
<div id="kont">
<img src="img/logo.png" alt="logo">
<p><a href="/../index.php">Belép/regisztráció</a></p>
</div>
</div>

<ul>
<label class="check"><input type="checkbox" id="checkbox_toggle" /></label>
<label for="checkbox_toggle" class="hamburger">&#9776;</label>
<div class="menu">
  <li><a href="vmain.php">Rólunk</a>
  <li class="dropdown">
    <a href="vfeltolt.php" class="dropbtn">Feltöltött könyvek</a>
    <div class="dropdown-content">
      <a href="vfeltoltes.php">Könyv feltöltés</a>
    </div>
	<li class="dropdown">
    <a href="vvasar.php" class="dropbtn">Vásárlás</a>
    <div class="dropdown-content">
      <a href="vakcio.php" ><!--class="active"-->Akciók</a>
    </div>
  </li>
  <li><a href="vfizet.php">Fizetés és Szállítás</a></li>
  <li><a href="vvirtual.php">Virtuális séta</a></li>
  <li><a href="#kapcs">Kapcsolatok</a></li>
  <li style="float: right;"><a href="regisztralj.php">Kosár</a></li>
 </div>
</ul>
</body>
</html>