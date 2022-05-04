<!DOCTYPE html>
<?php
include 'config.php';
 $query = mysqli_query($db, "SELECT * FROM `checkout`") or die_nicely("Hiba!<br>próbáld újra.");
   if(mysqli_num_rows($query) > 0){
      while($product_item = mysqli_fetch_assoc($query)){
         $total_product = $product_item['item'];
         $price_total = $product_item['total_price'];
         $v_name = $product_item['v_name'];
         $k_name = $product_item['k_name'];
         $mobil = $product_item['mobil'];
         $email = $product_item['email'];
         $address = $product_item['address'];
         $method = $product_item['method'];	 
      }
   }
   $from = 'ifjusagikonyvesbolt@gmail.com';
   $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= 'From: '.$from."\r\n";
	  mail($email,
			'Siker','Rendelése feldolgozás alá került.',
			$headers);
	mysqli_query($db, "DELETE FROM `cart`") or die_nicely("Hiba!<br>próbáld újra.");
?>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="_css/regisztracio2.css">
<style>
</style>
</head>
<body>
<div class="row">
<div id="hasab1">
<?php
	  echo "
         <h3>Köszönjük a vásárlásod!</h3>
            <span>".$total_product."</span>
            <span> total : ".$price_total. "Ft  </span>
            <p> Név: <span>".$v_name." ".$k_name."</span> </p>
            <p> Telefon szám : <span>".$mobil."</span> </p>
            <p> Email cím : <span>".$email."</span> </p>
            <p> Lakcím : <span>".$address."</span> </p>
            <p> Fizetési mód : <span>".$method."</span> </p>
            <a href='fvasar.php' class='btn'>Vásárlás folytatása</a>
      ";
?>
</div>						
</div> 
</body>
</html>