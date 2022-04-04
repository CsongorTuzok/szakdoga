<?php
	session_start();
	if(!isset($_SESSION["nickname"]))
	{
		header("location:index.php");
	}
	echo $_SESSION['nickname'];
?>
<a href="logout.php">Kijelentkezés</a>