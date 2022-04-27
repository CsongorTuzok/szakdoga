<?php
include 'config.php';
if(isset($_POST['add_to_cart'])){

   $product_author = $_POST['hidden_author'];
   $product_name = $_POST['hidden_name'];
   $product_price = $_POST['hidden_price'];
   $product_image = $_POST['product_image'];
   $product_topic = $_POST['hidden_topic'];
   $product_quantity = 1;
   $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE k_name = '$product_name'") or die_nicely("Hiba!<br>próbáld újra.");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = '<script>alert("Termék már bele lett helyezve a kosárba!")</script> 
					<script>window.location="fvasar.php"</script>'; 
   }else{
      $insert_product = mysqli_query($db, "INSERT INTO `cart`(author, k_name, image, topic_id, price, quantity) 
	  VALUES('$product_author', '$product_name', '$product_image', '$product_topic', '$product_price', '$product_quantity')") 
	  or die_nicely("Hiba!<br>próbáld újra.");
      $message[] = '<script>alert("Termék sikeresen hozzá adva a kosárhoz!")</script> 
					<script>window.location="fvasar.php"</script>';
   }
}
if(isset($_POST['search']))
{
    $valueToSearch = mysqli_real_escape_string($db, $_POST['valueToSearch']);
    $search_result = mysqli_query($db, "SELECT * FROM `product` WHERE CONCAT(`author`, `k_name`) LIKE '%".$valueToSearch."%'")
	or die_nicely("Hiba!<br>próbáld újra.");
    
}
 else {
    $search_result = mysqli_query($db, "SELECT * FROM `product`") or die_nicely("Hiba!<br>próbáld újra.");
}
?>
<!DOCTYPE html>  
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="_css/vvasar2.css">
<style>
</style>
</head>
<body>
<?php include 'header.php';?>
<div class="raw">
<div class="side">
<form action="fvasar.php" method="post">
<b style="	font-family: monospace">Keresés:</b>
<input type="text" name="valueToSearch" size=15%>
<input type="submit" name="search" value="Keresés">
</form> 
<form action="fvasar.php" method="post">
<h5> Témák:</h5>
<?php
	$topic_query_run  = mysqli_query($db, "SELECT * FROM topic") or die_nicely("Hiba!<br>próbáld újra.");
	if(mysqli_num_rows($topic_query_run) > 0)
	{
		foreach($topic_query_run as $topiclist)
		{
		$checked = [];
		if(isset($_POST['topic']))
			{
			$checked = $_POST['topic'];
			}
?>
<div>
	<input type="checkbox" name="topic[]" value="<?= $topiclist['ID']; ?>" 
	<?php if(in_array($topiclist['ID'], $checked)){ echo "checked"; } ?>>
	<?= $topiclist['name']; ?>
</div>
<?php
		}
	}
	else
	{
		echo "Nincs ilyen téma!";
	}
?>
<p>
<button type="submit">Szűrés</button>
</form>
</div> 
<div class="main">
<section>
<h1 class="heading">Legújabb termékek</h1>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<span>'.$message.'</span>';
   }
}
?>
<div class="box-container">
<?php  
if(isset($_POST['topic']))
{
	$topicchecked = [];
	$topicchecked = $_POST['topic'];
	foreach($topicchecked as $rowtopic)
	{
		$products_run = mysqli_query($db, "SELECT * FROM product WHERE topic_id IN ($rowtopic)") or die_nicely("Hiba!<br>próbáld újra.");
		if(mysqli_num_rows($products_run) > 0)
		{
			while($row = mysqli_fetch_array($products_run))  
			{
?>
<div style="float: left;
	width:180px;
	border: 1px solid black;
	background-color: #99e6ff;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	margin: 25px;" align="center">
	<form method="post" action="fvasar.php">
		<img src="uploaded_img/<?php echo $row["image"]; ?>" height="100" /><br />  
		<h4><?php echo $row["author"]; ?></h4>  
		<h4><?php echo $row["k_name"]; ?></h4>  
		<h4><?php echo $row["price"]; ?>Ft</h4>  
		<input type="hidden" name="hidden_author" value="<?php echo $row["author"]; ?>" />  
		<input type="hidden" name="hidden_name" value="<?php echo $row["k_name"]; ?>" />								
		<input type="hidden" name="hidden_topic" value="<?php echo $row["topic_id"]; ?>" />
		<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
		<input type="hidden" name="product_image" value="<?php echo $row['image']; ?>"><br>
		<input type="submit" name="add_to_cart" value="Kosárba" /> 
	</form>
</div>
<?php
				}
		}
	}
}
elseif(mysqli_num_rows($search_result) > 0)  
{  
	while($row = mysqli_fetch_array($search_result))  
	{
?>
<div style="float: left;
	width:180px;
	border: 1px solid black;
	background-color: #99e6ff;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	margin: 25px;" align="center">	
	<form method="post" action="fvasar.php">
		<img src="uploaded_img/<?php echo $row["image"];?>"height="100"/><br />  
		<h4><?php echo $row["author"]; ?></h4>  
		<h4><?php echo $row["k_name"]; ?></h4>  
		<h4><?php echo $row["price"]; ?>Ft</h4>  							   
		<input type="hidden" name="hidden_author" value="<?php echo $row["author"]; ?>" />
		<input type="hidden" name="hidden_name" value="<?php echo $row["k_name"]; ?>" />  
		<input type="hidden" name="hidden_topic" value="<?php echo $row["topic_id"]; ?>" />
		<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
		<input type="hidden" name="product_image" value="<?php echo $row['image']; ?>"><br>
		<input type="submit" name="add_to_cart" value="Kosárba" /> 
		</form>
</div>
<?php
	}
}
?>
</div>
</section>
</div>
</div>
<?php include 'footer.php';?>
</body>  
</html>
   