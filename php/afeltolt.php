
<!DOCTYPE html>

<html>
<?php
	$db = new mysqli('localhost','root','','ik');
	$true = true;

	if (isset($_POST['submit']))
	{
			
	$pdf_name = mysqli_real_escape_string($db, $_POST['pdf_name']);
		
			if (empty($_POST['pdf_name']))
			{
			$true = false;
			$pdf_name_error = "A(z) mező üres!";
			}

	if ($true)
		{			
			$sql = "INSERT INTO pdf(pdf_name)
			VALUES ('$pdf_name')";
			$db->query($sql);			
		}
	}

	$db->close();
?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/regisztracio.css">
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
	echo $_SESSION['nickname'];
?>
<br>
<a href="admin.php">Hagyományos könyv feltöltése</a>
<br>
<a href="logout.php">Kijelentkezés</a>

<div class="row">
<div id="hasab1">
<form action="afeltolt.php" method="post" enctype="multipart/form-data">
  <b>Digitális könyv feltöltése</b><br><br>
  <input type="text" name="pdf_name"><br><br>
  <input type="submit" value="Feltöltés" name="submit">
  
</form>
</div>
</div>

</body>
</html>
