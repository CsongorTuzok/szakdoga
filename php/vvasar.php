<?php
include 'config.php';

if(isset($_POST['add_to_cart'])){

   header('location:regisztralj.php');
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
<?php include 'vheader.php';?>
<div class="raw">
<div class="side">
	<form action="vvasar.php" method="post">
	<b style="	font-family: monospace">Keresés:</b>
	<input type="text" name="valueToSearch" size=15%>
	<input type="submit" name="search" value="Keresés">
	</form> 
	<form action="vvasar.php" method="post">
	<h5>Témák:</h5>
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
	<button type="submit" class="btn btn-primary btn-sm float-end">Szűrés</button>
	</form>
</div> 
<div class="main">
<section>
   <h1 class="heading">Legújabb termékek</h1>
   <div class="box-container">
<?php  
	if(isset($_POST['topic']))
	{
		$topicchecked = [];
		$topicchecked = $_POST['topic'];
		foreach($topicchecked as $rowtopic)
		{
		$products_run = mysqli_query($db, "SELECT * FROM product WHERE topic_id IN ($rowtopic)")
		or die_nicely("Hiba!<br>próbáld újra.");
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
	<form method="post" action="vvasar.php">
	<img src="uploaded_img/<?php echo $row["image"]; ?>" height="100"><br>  
	<h4><?php echo $row["author"]; ?></h4>  
	<h4><?php echo $row["k_name"]; ?></h4>  
	<h4><?php echo $row["price"]; ?>Ft</h4>  
	<br>
	<input type="submit" name="add_to_cart" value="Kosárba"> 
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
	<form method="post" action="vvasar.php">
	<img src="uploaded_img<?php echo $row["image"];?>"height="100"><br>  
	<h4><?php echo $row["author"]; ?></h4>  
	<h4><?php echo $row["k_name"]; ?></h4>  
	<h4><?php echo $row["price"]; ?>Ft</h4>  							   
	<br>
	<input type="submit" name="add_to_cart" value="Kosárba"> 
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
<?php 
include 'footer.php';
?>	   
</body>    
</html>
   