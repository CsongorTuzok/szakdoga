<?php
	include 'config.php';
	mysqli_query($db, "DELETE FROM `cart`");
	session_start();
	session_unset();
	session_destroy();
	header('location: index.php');


?>