<!DOCTYPE html>
<?php
session_start();
require_once('config.php');

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


if(isset($_POST["add_to_cart"]))
{
	if(isset($SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["ID"], $item_array_id))
		{
			$count = count($SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'=>$_GET["ID"],
				'item_szname'=>$_POST["hidden_szname"],
				'item_kname'=>$_POST["hidden_kname"],
				'item_price'=>$_POST["hidden_price"],
				'item_quantity'=>$_POST["quantity"]
			);
			$SESSION["shopping_cart"][$count] = $item_array;
		}else{
			echo '<script>alert("Hozzá adva")</script>';
			echo '<script>window.location="fvasar.php"</script>';
		}
	}else
	{
		$item_array = array(
			'item_id'=>$_GET["ID"],
			'item_szname'=>$_POST["hidden_szname"],
			'item_kname'=>$_POST["hidden_kname"],
			'item_price'=>$_POST["hidden_price"],
			'item_quantity'=>$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($GET["action"]))
{
	if($GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["ID"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Tétel törölve")</script>';
				echo '<script>window.location="fvasar.php"</script>';
			}
		}
	}
}
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
<div class="side">
<p>
<b style="	font-family: monospace">Keresés:</b>
<input type="text" name="search" size=15%>
<input type="submit" name="submit" value="Keresés">

<!--******************************************-->
<?php
if (isset($_POST["submit"]))
{
	$str = $_POST["search"];
	$sth = $db -> prepare("SELECT * FROM 'product' WHERE k_name = '$str'");
	
	$sth -> setFetchMode(PDO:: FETCH_OBJ);
	$sth -> execute();
	
	if($row = $sth -> fetch())
	{
?>
		<div class="main">
	<form method="POST" action="fvasar.php?action=add&ID=<?php echo $row["ID"];?>">
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
	</div>

<?php
	
	}else{
		echo "Nincs ilyen könyv!";
	}
}
?>
<!--******************************************-->
<br><br>
<b style="	font-family: monospace; font-size: large">Szűrés:</b>
<br><br>
<b style="	font-family: monospace">Témák:</b>
<br><label>
<input type="checkbox" name="tema" value="1">1<br>
<input type="checkbox" name="tema" value="2">2<br>
<input type="checkbox" name="tema" value="3">3<br>
<input type="checkbox" name="tema" value="4">4<br>
<input type="checkbox" name="tema" value="5">5<br>
</label>
<br>
<b style="	font-family: monospace">Szerzők:</b>
<br><label>
<input type="checkbox" name="szerzo" value="1">1<br>
<input type="checkbox" name="szerzo" value="2">2<br>
<input type="checkbox" name="szerzo" value="3">3<br>
<input type="checkbox" name="szerzo" value="4">4<br>
<input type="checkbox" name="szerzo" value="5">5<br>
</label>
<br>
<input type="submit" value="Szűrés">
</div>

<?php
$pr_query = "SELECT * FROM product ORDER BY ID ASC";
$pr_result = mysqli_query($db, $pr_query);
$total_record = mysqli_num_rows($pr_result);
$total_page = ceil($total_record/$num_per_page);



if (mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_array($result))
	{
	
?>	
	<div class="main">
	<form method="POST" action="fvasar.php?action=add&ID=<?php echo $row["ID"];?>">
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
	}
}
if($page>1)
{
	echo "<div class='pagination'><a href='fvasar.php?page=".($page-1)."'>&laquo;</a></div>";
}

for($i=1;$i<$total_page;$i++)
{
	echo "<div class='pagination'><a href='fvasar.php?page=".$i."' class='pagination'>$i</a></div>";
}

if($i>$page)
{
	echo "<div class='pagination'><a href='fvasar.php?page=".($page+1)."' class='pagination'>&raquo;</a></div>";
}
?>

<h4>Kosár:</h4>
<table>
<tr>
	<th>Szerző neve</th>
	<th>Könyv címe</th>
	<th>Ár</th>
	<th>Összesen</th>
	<th>action</th>
</tr>
<?php
if(!empty($SESSION["shopping_cart"]))
{
	$total = 0;
	foreach($SESSION["shopping_cart"] as $keys => $values)
	{

?>
<tr>
	<td><?php echo $values["item_szname"];?></td>
	<td><?php echo $values["item_kname"];?></td>
	<td><?php echo $values["item_price"];?>Ft</td>
	<td><?php echo number_format($values["item_quantity"]*$values["item_price"], 2);?></td>
	<td><a href="fvasar.php?action=delete&ID=<?php echo $values["item_id"];?>"><span>Törlés</span></a></td>
</tr>
<?php
		$total = $total + ($values["item_quantity"]*$values["item_price"]);
	}
?>
<tr>
	<td colspan="3" align="right">Összesen:</td>
	<td align="right"><?php echo number_format($total, 2);?></td>
	<td></td>
</tr>
<?php
}
?>
</table>
</div>
<?php include 'footer.php';?>
</body>
</html>