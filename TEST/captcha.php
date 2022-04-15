<?php
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
		$legit_answer = (int)$answer;
		?>
<form method="post" action="captcha.php">


captcha hitelesítés:
<br>
<?php echo $first_num . " " . $operator . " " . $second_num . " = ";?>
<br>
<input type="number" name="answer" size=8%>
<input type="submit" value="submit" name="submit" size=8%>
<br>

<br>
<?php
		
		
		
		
		if(isset($_POST["submit"]))
		{
			$user_answer = (int)$_POST["answer"];
		
			if ($legit_answer !== $user_answer)
		{
			echo "hiba";
		}else{
			echo "joooo";
		}
		}

		
		
?>
</form>