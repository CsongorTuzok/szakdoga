<?php
	session_start();
	if(!isset($_SESSION["nickname"]))
	{
		header("location:login.php");
	}
	echo $_SESSION['nickname'];
?>
<a href="logout.php">Kijelentkezés</a>