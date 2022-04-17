<!DOCTYPE html>
<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "ik");
if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else 
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="fvasar.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="fkosar.php"</script>';  
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
<link rel="stylesheet" type="text/css" href="css/fkosar.css">
<style>
</style>
</head>
<body>
<?php include 'header.php';?>

<div class="row">

<h3 style="margin-top:100px;">Kosár Tartalma</h3>  
				<div style="clear:both">
                <div class="table-responsive">  
                     <table style="border-collapse: collapse; ">  
                          <tr style="background-color: #38444d; color: white;">  
                               <th width="40%">Név</th>  
                               <th width="10%">Darab szám</th>  
                               <th width="20%">Ár</th>  
                               <th width="15%">Összesen</th>  
                               <th width="5%">Törlés</th>  
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
                               <td style="border: solid black 1px;" align="center"><a href="fkosar.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
								
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
                               <td style="border: solid black 1px;" colspan="2" align="center"><?php echo $total; ?>Ft</td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div> <br>
				<button style="float: right; margin-right: 30%;"><a href="checkout.php">Tovább</a></button>
				<br>
				
</div>
		   <?php include 'footer.php';?>
</div>
</body>
</html>