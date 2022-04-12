<?php
		session_start();
		$answer = $_SESSION["answer"];
		$user_answer = $_POST["answer"];
		
			if ($answer != $user_answer)
		{
			echo "hiba";
		}else{
			echo "joooo";
		}
?>