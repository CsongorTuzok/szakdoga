<!DOCTYPE html>
<html lang="hu">
<?php
	$db = new mysqli('localhost','root','','ik');
	$true = true;
		

	
	if (isset($_POST['submit']))
	{
		
		$sz_name = mysqli_real_escape_string($db, $_POST['sz_name']);
		$k_name = mysqli_real_escape_string($db, $_POST['k_name']);
		$topic = mysqli_real_escape_string($db, $_POST['topic']);
		$image = mysqli_real_escape_string($db, $_POST['image']);
		$price = mysqli_real_escape_string($db, $_POST['price']);
		
			if (empty($_POST['sz_name']))
			{
			$true = false;
			$sz_name_error = "A(z) \"Szerző neve\" üres!";
			}
			if (empty($_POST['k_name']))
			{
			$true = false;
			($k_name_error = "A(z) \"Könyv címe\" üres!");
			}
			if (empty($_POST['topic']))
			{
			$true = false;
			($topic_error = "A(z) \"Téma\" üres!");
			}			
			if (empty($_POST['image']))
			{
			$true = false;
			($image_error = "A(z) \"Kép\" üres!");
			}
			if (empty($_POST['price']))
			{
			$true = false;
			($price_error = "A(z) \"Ár\" üres!");
			}

	if ($true)
		{			
			$sql = "INSERT INTO product(sz_name, k_name, topic, image, price)
			VALUES ('$sz_name','$k_name','$topic','$image','$price')";
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
<a href="logout.php">Kijelentkezés</a>

<div class="row">
<div id="hasab1">
<b>Könyv feltöltés:</b>
<br><br>
<form id="register" action="admin.php" method="POST">
Szerző neve:
<br>
<input type="text" name="sz_name" size=12%>
<br>
<?php
	if (!empty($sz_name_error))
	{
		echo "<b>".$sz_name_error."</b>";
	}
?>
<br>
Könyv címe:
<br>
<input type="text" name="k_name" size=12%>
<br>
<?php
	if (!empty($k_name_error))
	{
		echo "<b>".$k_name_error."</b>";
	}
?>
<br>
Téma:
<br>
<input type="text" name="topic" size=12%>
<br>
<?php
	if (!empty($topic_error))
	{
		echo "<b>".$topic_error."</b>";
	}
?>
<br>
Kép:
<br>
<input type="text" name="image" size=12%>
<br>
<?php
	if (!empty($image_error))
	{
			echo "<b>".$image_error."</b>";
	}
?>
<br>
Ár:
<br>
<input type="number" name="price" size=12%>
<br>
<?php
	if (!empty($price_error))
	{
		echo "<b>".$price_error."</b>";
	}
?>
<br>
<input name="submit" value="Feltöltés" type="submit">
<br>
<br>
</form>
</div>
</div>
</body>
</html>