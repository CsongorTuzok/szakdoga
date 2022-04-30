<!DOCTYPE html>
<?php
include 'config.php';

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($db, "UPDATE `cart` SET quantity = '$update_value' WHERE ID = '$update_id'")
   or die_nicely("Hiba!<br>próbáld újra.");
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($db, "DELETE FROM `cart` WHERE ID = '$remove_id'") or die_nicely("Hiba!<br>próbáld újra.");
   header('location:fkosar.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($db, "DELETE FROM `cart`") or die_nicely("Hiba!<br>próbáld újra.");
   header('location:fkosar.php');
}

?> 
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="_css/fkosar2.css">
<style>
</style>
</head>
<body>
<?php include 'header.php';?>
<div class="row">
	<h1>Kosár tartalma:</h1>
	<center>
	<table>
         <th>Kép</th>
         <th>Író név</th>
         <th>Könyv név</th>
         <th>Ár</th>
         <th>Mennyiség</th>
         <th>Összesen</th>
         <th>Törlés</th>     
<?php 
	$select_cart = mysqli_query($db, "SELECT * FROM `cart`") or die_nicely("Hiba!<br>próbáld újra.");
	$grand_total = 0;
	if(mysqli_num_rows($select_cart) > 0){
		while($fetch_cart = mysqli_fetch_assoc($select_cart)){
?>
         <tr>
            <td><center><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt="botítókép"></center></td> 
            <td><?php echo $fetch_cart['author']; ?></td>
            <td><?php echo $fetch_cart['k_name']; ?></td>
            <td><?php echo ($fetch_cart['price']); ?>Ft</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['ID']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="módosítás" name="update_update_btn">
               </form>   
            </td>			
            <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>Ft</td>
            <td><a href="fkosar.php?remove=<?php echo $fetch_cart['ID']; ?>" onclick="return confirm('Biztos törölni szeretnéd?');">eltávolítás</a></td>
         </tr>
<?php
           $grand_total += $sub_total;  
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
         }	
?>
         <tr class="table-bottom">
            <td><a href="fvasar.php" style="margin-top: 0;">Vásárlás folytatása</a></td>
            <td colspan="3" title="A végösszeg már tartalmazza a szállítási díjat is."><div  style="float: right;">*Végösszeg:</div></td>
            <td><?php echo $grand_total; ?>Ft</td>
            <td><a href="fkosar.php?delete_all" onclick="return confirm('Biztos törlöd a kosár tartalmát?');">Összes törlése</a></td>
			<td><a href="checkout.php">Tovább</a></td>
         </tr>
   </table>
   </center>
</div>
<?php include 'footer.php';?>
</body>
</html>