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
<div class="main">
  <?php
  include 'config.php';
  $products_run = mysqli_query($db, "SELECT * FROM pdf");
        if(mysqli_num_rows($products_run) > 0)
        {
         while($row = mysqli_fetch_array($products_run)) 
			{
?>
<div class="konyv" style="border:1px solid #333; background-color:#38444d; border-radius:5px; padding:16px; margin-top:5px;" align="center">  
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