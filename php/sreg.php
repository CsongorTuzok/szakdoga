<?php
	session_start();
	if(!isset($_SESSION["nickname"]))
	{
		header("location:index.php");
	}
	session_destroy();
?>
<h3>SIKERS REGISZTRÁCIÓ </h3>
<a href="login.php">Bejelentkezés</a>