<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/feltolt.css">
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
  <?php
  $db = new mysqli('localhost','root','','ik');
  $products = "SELECT * FROM pdf";
                                    $products_run = mysqli_query($db, $products);
                                    if(mysqli_num_rows($products_run) > 0)
                                    {
                                         while($row = mysqli_fetch_array($products_run))  
												{
                                            ?>
                                                <div class="konyv" style="border:1px solid #333; background-color:#38444d; border-radius:5px; padding:16px;" align="center">  
                           
                               <a style="color: white; text-decoration: none; cursor:pointer;  display: block;" href="<?php echo $row["pdf_name"]; ?>"><?php echo $row["pdf_name"]; ?></a>  
                               
                          </div>
                                            <?php
												}
                                    }
									?>
</div>
</div>

<?php include 'footer.php';?>
</body>
</html>