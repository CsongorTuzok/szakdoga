<!DOCTYPE html>
<html lang="hu">
<?php
	$db = new mysqli('localhost','root','','ik');
	if (isset($_POST['submit']))
	{
		$errors = array();
		$true = true;
		if (empty($_POST['vname']))
		{
			$true = false;
			array_push($errors, "A(z) \"Vezetéknév\" üres!");
		}
		if (empty($_POST['kname']))
		{
			$true = false;
			array_push($errors, "A(z) \"Keresztnév\" üres!");
		}
		if (empty($_POST['email']))
		{
			$true = false;
			array_push($errors, "A(z) \"email cím\" üres!");
		}
		if (empty($_POST['nickname']))
		{
			$true = false;
			array_push($errors, "A(z) \"Felhasználónév\" üres!");
		}
		if (empty($_POST['pass1']))
		{
			$true = false;
			array_push($errors, "A(z) \"Jelszó\" üres!");
		}
		if (empty($_POST['pass2']))
		{
			$true = false;
			array_push($errors, "A(z) \"Jelszó ismét\" üres!");
		}
		if (!($_POST['pass1']==$_POST['pass2']))
		{
			$true = false;
			array_push($errors, "A Jelszavak nem egyeznek!");
		}
		
	if ($true)
		{
				
			$vname = mysqli_real_escape_string($db, $_POST['vname']);
			$kname = mysqli_real_escape_string($db, $_POST['kname']);
			$email = mysqli_real_escape_string($db, $_POST['email']);
			$nickname = mysqli_real_escape_string($db, $_POST['nickname']);
			$pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
			$pass1 = md5(md5($pass1));
			
			$sql = "INSERT INTO users(vname, kname, email, nickname, pass1, date)
			VALUES ('$vname','$kname','$email','$nickname','$pass1',NOW())";
			$db->query($sql);
			session_start();
			$_SESSION['nickname'] = $nickname;
			header('location: fmain.php');
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
<div class="header">
<h1>IFJÚSÁGI KÖNYVESBOLT</h1>
<div id="kont">
<img src="img/logo.png" alt="logo">
</div>
</div>

<div class="row">
<div id="hasab1">
<b>Regisztráció:</b>
<br><br>
<form id="register" action="regisztracio.php" method="POST">
Vezetéknév:
<br>
<input type="text" name="vname" size=8%>
<br><br>
Keresztnév:
<br>
<input type="text" name="kname" size=8%>
<br><br>
email cím:
<br>
<input type="email" name="email" size=8%>
<br><br>
felhasználó név:
<br>
<input type="text" name="nickname" size=8%>
<br><br>
jelszó:
<br>
<input type="password" name="pass1" size=8%>
<br><br>
jelszó ismét:
<br>
<input type="password" name="pass2" size=8%>
<br><br>
<input name="submit" value="Regisztráció" type="submit">
<br><br>
</form>

<?php
	if (!empty($errors))
	{
		foreach ($errors as $key)
		{
			echo $key."<br>";
		}
	}
?>

<a href="login.html">Vissza</a>
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