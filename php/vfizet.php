<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="_css/ffizet2.css">
<style>
</style>
</head>
<body>
<?php
include('vheader.php');

?>
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
<?php
include('footer.php')
?>
</body>
</html>