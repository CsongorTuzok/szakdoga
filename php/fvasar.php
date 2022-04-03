<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/vvasar.css">
<style>
</style>
</head>
<body>
<?php include 'header.php';?>

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
ár: 1700Ft
<br><br>
<input type="submit" value="Kosárba">

<p  id="hasab4">
<img src="img/bookicon.jpg" alt="logo">
<br>
Fekete István
<br><br>
Tüskevár2
<br><br>
ár: 1702Ft
<br><br>
<input type="submit" value="Kosárba">

<p id="hasab5">
<img src="img/bookicon.jpg" alt="logo">
<br>
Fekete István
<br><br>
Tüskevár3
<br><br>
ár: 1703Ft
<br><br>
<input type="submit" value="Kosárba">

<p id="hasab6">
<img src="img/bookicon.jpg" alt="logo">
<br>
Fekete István
<br><br>
Tüskevár4
<br><br>
ár: 1704Ft
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

<?php include 'footer.php';?>
</body>
</html>