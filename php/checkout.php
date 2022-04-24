<!DOCTYPE html>
<?php
include 'config.php';
if(isset($_POST['order_btn'])){

   $v_name =  mysqli_real_escape_string($db, $_POST['v_name']);
   $k_name =  mysqli_real_escape_string($db, $_POST['k_name']);
   $email =  mysqli_real_escape_string($db, $_POST['email']);
   $method =  mysqli_real_escape_string($db, $_POST['method']);
   $address =  mysqli_real_escape_string($db, $_POST['address']);
   $mobil =  mysqli_real_escape_string($db, $_POST['mobil']);

   $cart_query = mysqli_query($db, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['k_name'] .' ('. $product_item['quantity'] .') ';
         $product_price = ($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      }
   }

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($db, "INSERT INTO `checkout`(v_name, k_name, email, method, address, mobil, item, total_price) 
   VALUES('$v_name','$k_name','$email','$method','$address','$mobil','$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
         <h3>Köszönjük a vásárlásod!</h3>
            <span>".$total_product."</span>
            <span> total : ".$price_total. "Ft  </span>
            <p> Neved : <span>".$v_name." ".$k_name."</span> </p>
            <p> Telefon számod : <span>".$mobil."</span> </p>
            <p> Email címed : <span>".$email."</span> </p>
            <p> Lakcímed : <span>".$address."</span> </p>
            <p> Fizetési modod : <span>".$method."</span> </p>
            <p>(*pay when product arrives*)</p>
            <a href='fvasar.php' class='btn'>Vásárlás folytatása</a>
      ";
	  mail($email,
			'Siker','Rendelése feldolgozás alá került.',
			'From: ifjusagikonyvesbolt@gmail.com');
   }

}
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
<button style="float:left;"><a href="fkosar.php">Vissza</a></button>
<div id="hasab1">
   <h1 class="heading">Fejezd be a rendelésed!</h1>
   <form action="" method="post">
      <?php
         $select_cart = mysqli_query($db, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['k_name']; ?>(<?= $fetch_cart['quantity']; ?>): <?= $total_price; ?> Ft</span><br>
      <?php
         }
		 $sok=5000;
	$keves=3000;
	$ezer=999;
	$hatszaz=699;
	   if($grand_total<$keves)
		{
			$grand_total=$grand_total + $ezer;
		}elseif($grand_total<$sok && $grand_total>$keves){
			$grand_total=$grand_total + $hatszaz;
		}else{
			$grand_total=$grand_total;
		}
		?>
	<span> Végösszeg: <?= $grand_total; ?> Ft </span><br>
    <span>Vezetéknév</span><br>
    <input type="text" placeholder="" name="v_name" required><br>
	<span>Keresztnév</span><br>
    <input type="text" placeholder="" name="k_name" required><br>
	<span>Email</span><br>
    <input type="email" placeholder="" name="email" required><br>
	<span>Fizetési mod</span><br>
    <select name="method">
        <option value="cash on delivery" selected>kp</option>
        <option value="credit cart">kártya</option>
        <option value="paypal">paypal</option>
    </select><br>
    <span>Cím</span><br>
    <input type="text" placeholder="" name="address" required><br>
    <span>telefon</span><br>
    <input type="number" placeholder="" name="mobil" required><br>
    <input type="submit" value="Rendelés" name="order_btn" class="btn">
	</form>
</div>						
</div>
		<?php
      }else{
         echo "<div><span>A kosarad üres!</span></div>";
      }
      ?>  
</body>
</html>