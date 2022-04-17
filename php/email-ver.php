<!DOCTYPE html>
<?php

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

$db = new mysqli("localhost","root","","ik");
if (isset($_POST["verify_email"]))
{
	$email = mysqli_real_escape_string($db, $_POST["email"]);
	$verification_code = mysqli_real_escape_string($db, $_POST["verification_code"]);
	
	
	
	$sql = "UPDATE users2 SET email_verified_at = NOW() 
	WHERE email='$email' AND verification_code='$verification_code'";
	$result = mysqli_query($db, $sql);
	
	if (mysqli_affected_rows($db) == 0)
	{
		die_nicely("Sikertelen hitelesítés!<br> <a href='email-ver.php'>probáld újra</a>");
		
	}else{
	die_nicely("<p>Sikeres hitelesítés!</p><p><a href=index.php>Bejelentkezés</a></p>");
	}
	exit();
}
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
</script>


<form method="POST">
	<input type="email" name="email" placeholder="Írd be az emailed!" required><br><br>
	<input type="text" name="verification_code" placeholder="Írd be a kódot!" required><br><br>
	<input type="submit" name="verify_email" value="Email hitelesítése">
</form>
	