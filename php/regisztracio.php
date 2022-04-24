<!DOCTYPE html>
<html lang="hu">
<?php
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
	
?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="_css/regisztracio2.css">
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
<form id="register" action="sreg.php" method="POST">
Vezetéknév:
<br>
<input type="text" name="vname" size=12% required>
<br><br>
Keresztnév:
<br>
<input type="text" name="kname" size=12% required>
<br><br>
email cím:
<br>
<input type="email" name="email" size=12% required>
<br><br>
felhasználó név:
<br>
<input type="text" name="nickname" size=12% required>
<br><br>
<label title="Min. 8 karakter kis- és nagy betű ill. szám szükséges.">*jelszó:</label>
<br>
<input type="password" name="pass1" size=12% required>
<br><br>
<label title="Min. 8 karakter kis- és nagy betű ill. szám szükséges.">*jelszó ismét: </label>
<br>
<input type="password" name="pass2" size=12% required>
<br><br>
Old meg a műveletet:
<br>
<?php echo $first_num . " " . $operator . " " . $second_num . " = ";?>
<input type="number" name="answer" size=12% required>
<br><br>
<input name="submit" value="Regisztráció" type="submit">
<br><br>
</form>
<a href="index.php">Vissza a belépéshez</a>
</div>
</div>
<?php include 'footer.php';?>
</body>
</html>