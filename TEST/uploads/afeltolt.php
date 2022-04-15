
<!DOCTYPE html>

<html>
<?php
	$db = new mysqli('localhost','root','','ik');
	$true = true;

	if (isset($_POST['submit']))
	{
			
	$pdf_name = mysqli_real_escape_string($db, $_POST['pdf_name']);
		
			if (empty($_POST['pdf_name']))
			{
			$true = false;
			$pdf_name_error = "A(z) mező üres!";
			}

	if ($true)
		{			
			$sql = "INSERT INTO pdf(pdf_name)
			VALUES ('$pdf_name')";
			$db->query($sql);			
		}
	}

	$db->close();
?>
<body>

<form action="afeltolt.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="text" name="pdf_name">
  <input type="submit" value="Upload Image" name="submit">
  
</form>

</body>
</html>
