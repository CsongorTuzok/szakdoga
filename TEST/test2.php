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
<form method="post" action="test3.php">
captcha hitelesítés:
<br>
<?php echo $first_num . " " . $operator . " " . $second_num . " = ";?>
<br>
<input type="number" name="answer" size=8%>
<input type="submit" value="submit" name="submit" size=8%>
<br>

<br>
</form>