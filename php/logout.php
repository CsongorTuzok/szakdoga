<?php
	include 'config.php';
	mysqli_query($db, "DELETE FROM `cart`") or die_nicely("Hiba!<br>próbáld újra.");
	session_start();
	session_unset();
	session_destroy();
	header('location: index.php');
?>