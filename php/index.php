<!DOCTYPE html>

<?php
	session_start();
	
	function die_nicely($msg) {
    echo <<<END
	<style>body
{
	background-color: lightblue;
}</style>
<center><div><h3>$msg</h3></div></center>
END;
    exit;
}
	
	if (!empty($_SESSION['nickname']))
	{
		header('location: fmain.php');
	}else{
		
		session_destroy();
	}
	$db = new mysqli("localhost","root","","ik");
	if (isset($_POST["submit"]))
	{
		$true = true;
		if (empty($_POST['nickname']))
		{
			$true = false;
			($nickname_error = "A Felhasználónév üres!");
		}
		if (empty($_POST['pass1']))
		{
			$true = false;
			($pass1_error = "A Jelszó üres!");
		}
		
		if ($true)
		{
		$nickname = mysqli_real_escape_string($db, $_POST['nickname']);
		$pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
		$pass1 = md5(md5($pass1));
		$sql = "SELECT * FROM users WHERE nickname='$nickname' AND
					pass1='$pass1'";
		$result=mysqli_query($db,$sql);
				
		if(mysqli_num_rows($result) > 0)
         {
         $row = mysqli_fetch_array($result);  
					
			
				if ($row["email_verified_at"] == NULL)
			{
				
				die_nicely("Erösitd meg az emailed <a href='email-ver.php'>itt</a>");
				
			}
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
			
			
		}else
			{
				($error = "A Felhasználónév vagy a Jelszó nem megfelelő!");
			}
		
		}
		
		
	}
	$db->close();
?>

<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="ifjúsági könyvesbolt, Webshop, könyvek, könyvesbolt, online könyvesbolt">
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
			errors.innerHTML = "<b>A felhasználónév és jelszó üres!</b>";
			nickname.focus();
			return false;
			
		}else if (nickname.value == "")
		{
			nickname.style.border = "1px solid red";
			nickname.focus();
			errors.innerHTML = "<b>A felhasználónév üres!</b>";
			return false;
			
		}else if (pass1.value == "")
		{
			pass1.style.border = "1px solid red";
			pass1.focus();
			errors.innerHTML = "<b>A jelszó üres!</b>";
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
<form onsubmit="return main()" name="form" action="index.php" method="POST">
Felhasználónév:
<br>
<input type="text" name="nickname" size=8%>
<br>
<?php
	if (!empty($nickname_error))
	{
		echo "<b>".$nickname_error."</b>";
	}
?>
<br>
Jelszó:
<br>
<input type="password" name="pass1" size=8%>
<br>
<?php
	if (!empty($pass1_error))
	{
		echo "<b>".$pass1_error."</b>";
	}
?>
<br>
<input type="submit" name="submit" value="Belépés">
<br><br>
</form>
<div id="errors"></div>
<?php
	if (!empty($error))
	{
		echo "<b>".$error."</b><br>";
	}
?>
<p><a href="regisztracio.php">Regisztráció</a>
<br>
<a href="vmain.html">Belépés vendég felhasználóval</a>
<br>
<a href="reset_password_input.php">Elfelejtetted a jelszavad?</a>
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