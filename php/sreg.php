<!DOCTYPE html>
<html lang="hu">
<?php
	session_start();
	include 'config.php';
	$true = true;
	
	
	if (isset($_POST['submit']))
	{
		
		$vname = mysqli_real_escape_string($db, $_POST['vname']);
		$kname = mysqli_real_escape_string($db, $_POST['kname']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$nickname = mysqli_real_escape_string($db, $_POST['nickname']);
		$pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
		$pass1 = md5(md5($pass1));
		
			if (empty($_POST['vname']))
			{
			$true = false;
			$vname_error = "A(z) \"Vezetéknév\" üres!";
			}
			if (empty($_POST['kname']))
			{
			$true = false;
			($kname_error = "A(z) \"Keresztnév\" üres!");
			}
			if (empty($_POST['email']))
			{
			$true = false;
			($email1_error = "A(z) \"email cím\" üres!");
			}
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
			$true = false;
			($email2_error = "A(z) \"email cím\" hibás!");
			}
			
			if (empty($_POST['nickname']))
			{
			$true = false;
			($nickname1_error = "A(z) \"Felhasználónév\" üres!");
			}
			if (empty($_POST['pass1']))
			{
			$true = false;
			($pass1_error = "A(z) \"Jelszó\" üres!");
			}
			if (empty($_POST['pass2']))
			{
			$true = false;
			($pass2_error = "A(z) \"Jelszó ismét\" üres!");
			}
			if (!($_POST['pass1']==$_POST['pass2']))
			{
			$true = false;
			($pass_error = "A Jelszavak nem egyeznek!");
			}
			$uppercase = preg_match('@[A-Z]@', $_POST['pass1']);
			$lowercase = preg_match('@[a-z]@', $_POST['pass1']);
			$number = preg_match('@[0-9]@', $_POST['pass1']);
			if(!$uppercase || !$lowercase || !$number || strlen($_POST['pass1']) < 8) {
			$true = false;
			($pass3_error = 
			"A Jelszónak minimum 8 karakter hosszúnak kell lenni és tartalmaznia kell egy nagy betűs karaktert és egy számot.");
			}
		
			$res_n = mysqli_query($db, "SELECT * FROM users WHERE nickname='$nickname'") or die(mysqli_error($db));
			$res_e = mysqli_query($db, "SELECT * FROM users WHERE email='$email'") or die(mysqli_error($db));
			
			if (mysqli_num_rows($res_n)>0)
			{				
				$true = false;
				$nickname_error = "Felhasználónév foglalt";
			}if(mysqli_num_rows($res_e)>0){
				$true = false;
				$email_error = "Email foglalt";
			}
			
		
		$answer = $_SESSION["answer"];
		$user_answer = $_POST["answer"];
		
		if (empty($user_answer))
			{
			$true = false;
			($captcha_error = "A(z) \"captcha\" üres!");
			}
			if ($answer != $user_answer)
		{
			$true = false;
			$captcha_error2 = "Hibás azonosítás";
		}
		
	if ($true)
		{
			
			$verification_code = substr(number_format
			(time() * rand(), 0,'', ''), 0, 6);
			mail($email,
			'Email verification','Verification code:'.$verification_code,
			'From: ifjusagikonyvesbolt@gmail.com');
			
			
			$sql = mysqli_query($db, "INSERT INTO `users` (vname, kname, email, nickname, pass1, date, verification_code)
			VALUES ('$vname','$kname','$email','$nickname','$pass1',NOW(),'$verification_code')");
			
			echo '<center><h3>SIKERS REGISZTRÁCIÓ </h3>
					<a href="index.php">Bejelentkezés</a></center>';
			
			
		}else{
			echo '<center><h3>SIKERTELEN REGISZTRÁCIÓ </h3>
					<a href="regisztracio.php">Vissza a regisztrációhoz</a></center>';
		}
	}

	$db->close();
?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="_css/regisztracio.css">
<style>
 </style>
</head>
<body>

<div class="row">
<center>
<p>
<?php
	if (!empty($vname_error))
	{
		echo "<b>".$vname_error."</b><br><br>";
	}
	if (!empty($kname_error))
	{
		echo "<b>".$kname_error."</b><br><br>";
	}
	if (!empty($email_error))
	{
		echo "<b>".$email_error."</b><br><br>";
	}
	if (!empty($email1_error))
	{
		echo "<b>".$email1_error."</b><br><br>";
	}
	if (!empty($email2_error))
	{
		echo "<b>".$email2_error."</b><br><br>";
	}
	if (!empty($nickname_error))
	{
			echo "<b>".$nickname_error."</b><br>";
	}
	if (!empty($nickname1_error))
	{
			echo "<b>".$nickname1_error."</b><br><br>";
	}
	if (!empty($pass1_error))
	{
		echo "<b>".$pass1_error."</b><br><br>";
	}
	if (!empty($pass2_error))
	{
		echo "<b>".$pass2_error."</b><br><br>";
	}
	if (!empty($pass_error))
	{
		echo "<b>".$pass_error."</b><br><br>";
	}
	if (!empty($pass3_error))
	{
		echo "<b>".$pass3_error."</b><br><br>";
	}
	if (!empty($captcha_error))
	{
		echo "<b>".$captcha_error."</b><br><br>";
	}
	if (!empty($captcha_error2))
	{
		echo "<b>".$captcha_error2."</b><br><br>";
	}
?>
</p>
</center>
</div>
</body>
</html>