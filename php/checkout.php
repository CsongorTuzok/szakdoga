<!DOCTYPE html>
<?php
session_start();
?>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/fkosar.css">
<style>
</style>
</head>
<body>

<div class="row">

<h3 style="margin-top:100px;" align="center">Véglegesítés</h3>  
				<div style="clear:both">
                <div class="table-responsive">  
					<center>
                     <table style="border-collapse: collapse; ">  
                          <tr style="background-color: #38444d; color: white;">  
                               <th width="40%">Név</th>  
                               <th width="10%">Darab szám</th>  
                               <th width="20%">Ár</th>  
                               <th width="15%">Összesen</th>  
                            </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr style="background-color: #99e6ff;"> 
							
                               <td style="border: solid black 1px;" align="center"><?php echo $values["item_name"]; ?></td>
                               <td style="border: solid black 1px;" align="center"><?php echo $values["item_quantity"]; ?></td>  
                               <td style="border: solid black 1px;" align="center"><?php echo $values["item_price"]; ?>Ft</td>  
                               <td style="border: solid black 1px;" align="center"><?php echo $values["item_quantity"] * $values["item_price"]; ?>Ft</td>    
								
						  </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               } 
								$sok=5000;
								$keves=3000;
								$ezer=999;
								$hatszaz=699;
							   if($total<$keves)
							   {
								   $total=$total + $ezer;
							   }elseif($total<$sok && $total>$keves){
								   $total=$total + $hatszaz;
							   }else{
								   $total=$total;
							   }
                          ?>  
                          <tr style="background-color: #99e6ff;">  
                               <td style="border: solid black 1px;" colspan="3" align="right" title="A végösszeg már tartalmazza a szállítási díjat is.">
							   <b>*Végösszeg:</b></td>  
                               <td style="border: solid black 1px;" align="center"><?php echo $total; ?>Ft</td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
					 </center>
                </div> 
				<?php
	$db = new mysqli("localhost","root","","ik");
	if (isset($_POST["submit"]))
	{
		$true=true;
		$v_name = mysqli_real_escape_string($db, $_POST['v_name']);
		$k_name = mysqli_real_escape_string($db, $_POST['k_name']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$mobil = mysqli_real_escape_string($db, $_POST['mobil']);
		
		
			if (empty($_POST['v_name']))
			{
			$true = false;
			$v_name_error = "A(z) \"Vezetéknév\" üres!";
			}
			if (empty($_POST['k_name']))
			{
			$true = false;
			$k_name_error = "A(z) \"Keresztnév\" üres!";
			}
			if (empty($_POST['email']))
			{
			$true = false;
			$email1_error = "A(z) \"email cím\" üres!";
			}
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
			$true = false;
			$email2_error = "A(z) \"email cím\" hibás!";	
			}if (empty($_POST['address']))
			{
			$true = false;
			$address_error = "A(z) \"Cím\" üres!";
			}if (empty($_POST['mobil']))
			{
			$mobil_error = "A(z) \"Telefonszám\" üres!";
			$true = false;
			}
			
			if($true)
			{
			
			mail($email,
			'Rendelés értesítő','Név:'.$values["item_name"],
			'From: ifjusagikonyvesbolt@gmail.com');
			
			
			$sql = "INSERT INTO checkout(v_name, k_name, email, address, mobil)
			VALUES ('$v_name','$k_name','$email','$address','$mobil')";
			$db->query($sql);
			
			echo '<script>alert("Köszönjük a vásárlást! Email küldve")</script>';  
            echo '<script>window.location="fmain.php"</script>';
			
			
			}else{
				echo '<script>alert("Hiba történt")</script>';  
                echo '<script>window.location="checkout.php"</script>';
				
			}
	}
	
	$db->close();
				?>
				<form method="post" action="checkout.php">
					Vezetéknév:
					<br>
					<input type="text" name="v_name" required>
					<br>Keresztnév:<br>
					<input type="text" name="k_name" required>
					<br>Email:<br>
					<input type="email" name="email" required>
					<br>Cím:<br>
					<input type="text" name="address" required>
					<br>Telefonszám:<br>
					<input type="text" name="mobil" placeholder="+36XXXXXXX" required>
					<br>
					<input type="submit" name="submit">
				
				</form>
				<button style="margin-left: 21%;"><a href="fkosar.php">Vissza</a></button>		
				
</div>
</div>
</body>
</html>