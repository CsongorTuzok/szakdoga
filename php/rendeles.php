<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/regisztracio.css">
<style>
 </style>
</head>
<body>
<?php
 include('config.php');
	session_start();
	if(!isset($_SESSION["nickname"]))
	{
		header("location:index.php");
	}
	echo $_SESSION['nickname'];
	
	if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   $send_email ="SELECT `email` FROM `checkout` WHERE ID='$remove_id'";
   $send = mysqli_query($db, $send_email) or die(mysqli_error($db));
   mail($send,
			'Változás','Rendelése státusza modosult: feladva.',
			'From: ifjusagikonyvesbolt@gmail.com');
   mysqli_query($db, "DELETE FROM `checkout` WHERE ID = '$remove_id'");
   header('location:rendeles.php');
	
}
?>
<br>
<a href="admin.php">Hagyományos könyv feltöltése</a>
<br>
<a href="afeltolt.php">Digitális könyv feltöltése</a>
<br>
<a href="logout.php">Kijelentkezés</a>

<div class="row">
  <b>Rendelések:</b><br><br>
<table>

      
         <th style="background-color: #38444d; color: white;">Vezetéknév</th>
         <th style="background-color: #38444d; color: white;">Keresztnév</th>
         <th style="background-color: #38444d; color: white;">email</th>
         <th style="background-color: #38444d; color: white;">lakcím</th>
         <th style="background-color: #38444d; color: white;">telefonszám</th>
         <th style="background-color: #38444d; color: white;">fizetési mód</th>
         <th style="background-color: #38444d; color: white;">termék</th>
         <th style="background-color: #38444d; color: white;">végösszeg</th>
         <th style="background-color: #38444d; color: white;">törlés</th>
      

      

         <?php 
		
         
         $select_cart = mysqli_query($db, "SELECT * FROM `checkout`");
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><?php echo $fetch_cart['v_name']; ?></td>
            <td><?php echo ($fetch_cart['k_name']); ?></td>
            <td><?php echo ($fetch_cart['email']); ?></td>
            <td><?php echo ($fetch_cart['address']); ?></td>
            <td><?php echo ($fetch_cart['mobil']); ?></td>
            <td><?php echo ($fetch_cart['method']); ?></td>
            <td><?php echo ($fetch_cart['item']); ?></td>
            <td><?php echo ($fetch_cart['total_price']); ?></td>
			<td>				
             <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['ID']; ?>" >				
			<a href="rendeles.php?remove=<?php echo $fetch_cart['ID']; ?>">eltávolítás</a>
			</td>
         </tr>
       
         


   
   <?php
		 }
		 }
   ?>
   </table>
  
</div>

</body>
</html>
