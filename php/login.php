<!DOCTYPE html>

<?php
	session_start();
	if (!empty($_SESSION['nickname']))
	{
		header('location: fmain.php');
	}else{
		session_destroy();
	}
	$db = new mysqli("localhost","root","","ik");
	if (isset($_POST["submit"]))
	{
		$errors = array();
		$true = true;
		if (empty($_POST['nickname']))
		{
			$true = false;
			array_push($errors, "A Felhasználónév üres!");
		}
		if (empty($_POST['pass1']))
		{
			$true = false;
			array_push($errors, "A Jelszó üres!");
		}
		if ($true)
		{
			$nickname = mysqli_real_escape_string($db, $_POST['nickname']);
			$pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
			$pass1 = md5(md5($pass1));
			$sql = "SELECT * FROM users WHERE nickname='$nickname' AND
					pass1='$pass1'";
			$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_array($result);
			
			
			if ($row["usertype"] == "user")
			{
				session_start();
				$_SESSION['nickname'] = $nickname;
				header('location: fmain.php');
			}
			elseif ($row["usertype"] == "admin")
			{
				session_start();
				$_SESSION['nickname'] = $nickname;
				header('location: admin.php');
			}
			else
			{
				array_push($errors, "A Felhasználónév vagy a Jelszó nem megfelelő!");
			}
			
		}
	}
	$db->close();
?>

<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="ifjúsági könyvesbolt, Webshop, könyvek, könyvesbolt, online könyvesbolt,">
<meta name="description" content="Online Könyvesbolt">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/login.css">
<style>
</style>
<script>

	function main()
	{
		var nickname = document.forms['form']['nickname'];
		var pass1 = document.forms['form']['pass1'];
		var errors = document.getElementById('errors');
		
		if (nickname.value == "" && pass1.value == "")
		{
			nickname.style.border = "1px solid red";
			pass1.style.border = "1px solid red";
			errors.innerHTML = "A felhasználónév és jelszó üres!";
			nickname.focus();
			return false;
			
		}else if (nickname.value == "")
		{
			nickname.style.border = "1px solid red";
			nickname.focus();
			errors.innerHTML = "A felhasználónév üres!";
			return false;
			
		}else if (pass1.value == "")
		{
			pass1.style.border = "1px solid red";
			pass1.focus();
			errors.innerHTML = "A jelszó üres!";
			return false;
		}
	}

</script>
</head>
<body>
<h1 class="header">IFJÚSÁGI KÖNYVESBOLT</h1>
<div class="raw">
<div class="side">
<div id="hasab1">
<b>belépés:</b>
<br><br>
<form onsubmit="return main()" name="form" action="login.php" method="POST">
Felhasználónév:
<br>
<input type="text" name="nickname" size=8%>
<br><br>
Jelszó:
<br>
<input type="password" name="pass1" size=8%>
<br><br>
<input type="submit" name="submit" value="Belépés">
<br><br>
</form>
</form>
<div id="errors"></div>
<?php
	if (!empty($errors))
	{
		foreach ($errors as $key)
		{
			echo $key."<br>";
		}
	}
?>

<a href="regisztracio.php">regisztráció</a>
<br>
<a href="vmain.html">Belépés vendég felhasználóval</a>
</div>
</div>

<div class="main">
<blockquote id="idezet">
&quot; Aki könyvet olvas, kezdetnek éppúgy hajlandó eltársalogni az időjárásról,
<br><br>
mint akárki más, de innen általában tovább is tud lépni.
&quot; 
<br><br><br>
Stephen King
</blockquote>
</div>

<p id="hasab2">
<img src="img/book.jpeg" alt="book" style="max-width: 100%;">
</div>
</body>
</html>