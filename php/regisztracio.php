<!DOCTYPE html>
<html lang="hu">
<?php
//**************************************************//
	session_start();
		$first_num = rand(1, 10);
		$second_num = rand(1, 10);
		$operators = array("+", "-", "*");
		$operator = rand(0, count($operators) - 1);
		$operator = $operators[$operator];
		
		$answer = 0;
		switch($operator)
		{
			case "+":
			$answer = $first_num + $second_num;
			break;
			case "-":
			$answer = $first_num - $second_num;
			break;
			case "*":
			$answer = $first_num * $second_num;
			break;
		}
		$_SESSION["answer"] = $answer;
		echo $answer;
	if (isset($_POST['submit1']))	
	{
	$user_answer = $_POST["answer"];
	$answer = $_SESSION["answer"];
		
			if ($answer != $user_answer)
		{
			echo "hiba";
		}else{
			echo "YEEET";
		}
	}
//******************************************************************************//

	$db = new mysqli('localhost','root','','ik');
		

	if (isset($_POST['submit']))
	{
		$true = true;
		$vname = mysqli_real_escape_string($db, $_POST['vname']);
		$kname = mysqli_real_escape_string($db, $_POST['kname']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
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
		
			$sql_n = "SELECT * FROM users2 WHERE nickname='$nickname'";
			$sql_e = "SELECT * FROM users2 WHERE email='$email'";
			$res_n = mysqli_query($db, $sql_n) or die(mysqli_error($db));
			$res_e = mysqli_query($db, $sql_e) or die(mysqli_error($db));
			
			
			
			if (mysqli_num_rows($res_n)>0)
			{				
				$true = false;
				$nickname_error = "Felhasználónév foglalt";
			}if(mysqli_num_rows($res_e)>0){
				$true = false;
				$email_error = "Email foglalt";
			}
		
	if ($true)
		{
			
			$verification_code = substr(number_format
			(time() * rand(), 0,'', ''), 0, 6);
			
			

			mail($email,
			'Email verification','Verification code:'.$verification_code,
			'From: ifjusagikonyvesbolt@gmail.com');
			
			
			$sql = "INSERT INTO users2(vname, kname, email, nickname, pass1, date, verification_code, email_verified_at)
			VALUES ('$vname','$kname','$email','$nickname','$pass1',NOW(),'$verification_code',NULL)";
			$db->query($sql);
			session_start();
			$_SESSION['nickname'] = $nickname;
			header('location: sreg.php');
			
			
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
<br>
<?php
	if (!empty($vname_error))
	{
		echo "<b>".$vname_error."</b>";
	}
?>
<br>
Keresztnév:
<br>
<input type="text" name="kname" size=8%>
<br>
<?php
	if (!empty($kname_error))
	{
		echo "<b>".$kname_error."</b>";
	}
?>
<br>
email cím:
<br>
<input type="email" name="email" size=8%>
<br>
<?php
	if (!empty($email_error))
	{
		echo "<b>".$email_error."</b><br>";
	}
?>
<?php
	if (!empty($email1_error))
	{
		echo "<b>".$email1_error."</b><br>";
	}
?>
<?php
	if (!empty($email2_error))
	{
		echo "<b>".$email2_error."</b>";
	}
?>
<br>
felhasználó név:
<br>
<input type="text" name="nickname" size=8%>
<br>
<?php
	if (!empty($nickname_error))
	{
			echo "<b>".$nickname_error."</b><br>";
	}
?>
<?php
	if (!empty($nickname1_error))
	{
			echo "<b>".$nickname1_error."</b>";
	}
?>
<br>
jelszó:
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
jelszó ismét: 
<br>
<input type="password" name="pass2" size=8%>
<br>
<?php
	if (!empty($pass2_error))
	{
		echo "<b>".$pass2_error."</b><br>";
	}
	if (!empty($pass_error))
	{
		echo "<b>".$pass_error."</b>";
	}
?>
<br>

captcha hitelesítés:
<br>
<?php echo $first_num . " " . $operator . " " . $second_num . " = ";?>
<br>
<input type="number" name="answer" size=8%>
<input type="submit" value="OK" name="submit1" size=8%>
<br>
<?php
	if (!empty($ ))
	{
		echo "<b>".$captcha_error."</b>";
	}
?>
<br>


<input name="submit" value="Regisztráció" type="submit">
<br>
<br>
</form>
<a href="index.php">Vissza</a>
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