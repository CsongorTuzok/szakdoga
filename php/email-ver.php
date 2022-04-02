
<?php

if (isset($_POST["verify_email"]))
{
	$email = $_POST["email"];
	$verification_code = $_POST["verification_code"];
	
	$db = new mysqli("localhost","root","","ik");
	
	$sql = "UPDATE users2 SET email_verified_at = NOW() 
	WHERE email='$email' AND verification_code='$verification_code'";
	$result = mysqli_query($db, $sql);
	
	if (mysqli_affected_rows($db) == 0)
	{
		die ("Sikertelen hitelesítés!");
	}
	echo "<p>Sikeres hitelesítés!</p>";
	echo "<p><a href=login.php>Bejelentkezés</a></p>";
	exit();
}
?>


<form method="POST">
	<input type="text" name="email" placeholder="Írd be az emailed!" required>
	<input type="text" name="verification_code" placeholder="Írd be a kódot!" required>
	<input type="submit" name="verify_email" value="Email hitelesítése">
</form>
	