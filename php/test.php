<!DOCTYPE html>
<?php
session_start();
require_once('config.php');
//**********************************
if(isset($_GET['page']))
{
	$page = $_GET['page'];
}else{
	$page = 1;
}

$num_per_page = 04;
$start_from = ($page-1)*4;

$query = "SELECT * FROM product LIMIT $start_from, $num_per_page";
$result = mysqli_query($db, $query);
//*****************************************


?>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/vvasar.css">
<style>
</style>
</head>
<body>



<div class="raw">


<?php
//*********************************************************
$pr_query = "SELECT * FROM product ORDER BY ID ASC";
$pr_result = mysqli_query($db, $pr_query);
$total_record = mysqli_num_rows($pr_result);
$total_page = ceil($total_record/$num_per_page);
$row = mysqli_fetch_array($pr_result);


//*******************************************************


	
?>	
	<div class="main">
	<form method="POST" action="test.php?action=add&ID=<?php echo $row["ID"];?>">
	<div style="float: left;
	border: 1px solid black;
	background-color: #99e6ff;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);">
	<img src="<?php echo $row["image"]?>"><br>
	<h4><?php echo $row["sz_name"] ?></h4>
	<h4><?php echo $row["k_name"] ?></h4>
	<h4><?php echo $row["topic"] ?></h4>
	<h4><?php echo $row["price"] ?> Ft</h4>
	<input type="number" name="quantity" value="1">
	<input type="hidden" name="hidden_szname" value="<?php echo $row["sz_name"]; ?>">
	<input type="hidden" name="hidden_kname" value="<?php echo $row["k_name"]; ?>">
	<input type="hidden" name="hidden_topic" value="<?php echo $row["topic"]; ?>">
	<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
	<input type="submit" name="add_to_cart" value="Kosárba">
	</form>
	</div>
	
<?php		
if($page>1)
{
	echo "<div class='pagination'><a href='test.php?page=".($page-1)."'>&laquo;</a></div>";
}

for($i=1;$i<$total_page;$i++)
{
	echo "<div class='pagination'><a href='test.php?page=".$i."' class='pagination'>$i</a></div>";
}

if($i>$page)
{
	echo "<div class='pagination'><a href='test.php?page=".($page+1)."' class='pagination'>&raquo;</a></div>";
}
?>

</div>
</body>
</html>