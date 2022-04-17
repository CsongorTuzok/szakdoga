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
                echo '<script>window.location="fakcio.php"</script>';  
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
                     echo '<script>window.location="fakcio.php"</script>';  
                }  
           }  
      }  
 }  

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM `product` WHERE CONCAT(`author_id`, `k_name`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `product`";
    $search_result = filterTable($query);
}

function filterTable($query)
{
    $db = mysqli_connect("localhost", "root", "", "ik");
    $filter_Result = mysqli_query($db, $query);
    return $filter_Result;
}

?>

 <!DOCTYPE html>  
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


<?php include 'header.php';?>



<div class="raw">
<div class="side">
<p>
<form action="fakcio.php?action=add&id=<?php echo $row["ID"]; ?>" method="post">
<b style="	font-family: monospace">Keresés:</b>
<input type="text" name="valueToSearch" size=15%>
<input type="submit" name="search" value="Keresés">

<h5> 
									
									Témák:
                                <button type="submit" class="btn btn-primary btn-sm float-end">Szűrés</button>
                            </h5>
							   <?php
                                

                                $topic_query = "SELECT * FROM topic";
                                $topic_query_run  = mysqli_query($db, $topic_query);


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
                                                    <?php if(in_array($topiclist['ID'], $checked)){ echo "checked"; } ?>
                                                 />
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

</div>
<div class="main">
 <?php  
                  
					
					
				     if(isset($_POST['topic']))
                            {
                                $topicchecked = [];
                                $topicchecked = $_POST['topic'];
                                foreach($topicchecked as $rowtopic)
                                {
                                    // echo $rowtopic;
                                    
									$new_price = "SELECT * FROM product WHERE new_price >0";
									$new_price_run = mysqli_query($db, $new_price);
									
									if(mysqli_num_rows($new_price_run) > 0)
                                    {
                                         while($row = mysqli_fetch_array($new_price_run))  
												{
                                            ?>
												
												<div style="float: left;
	border: 1px solid black;
	background-color: #99e6ff;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);" align="center">
                               <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["author_id"]; ?></h4>  
                               <h4 class="text-info"><?php echo $row["k_name"]; ?></h4>  
                               <h4 class="text-danger"><del><?php echo $row["price"]; ?>Ft</del></h4>  
                               <h4 class="text-danger"><?php echo $row["new_price"]; ?>Ft</h4>  
                               <input type="number" name="quantity" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["k_name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
                           </div>
                                            <?php
												}
                                    }
                                    
                                }
                            }
							
                elseif(mysqli_num_rows($search_result) > 0 )  
                {  
                     while($row = mysqli_fetch_array($search_result))  
                     {  
                ?>  
                   <div>  
                     <form method="post" action="fakcio.php?action=add&id=<?php echo $row["ID"]; ?>">  
					 <div style="float: left;
	border: 1px solid black;
	background-color: #99e6ff;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);" align="center">
                               <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["author_id"]; ?></h4>  
                               <h4 class="text-info"><?php echo $row["k_name"]; ?></h4>  
                               <h4 class="text-danger"><del><?php echo $row["price"]; ?>Ft<del></h4>  
                               <h4 class="text-danger"><?php echo $row["new_price"]; ?>Ft</h4>  
                               <input type="number" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["k_name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
                          </div>
						</form> 
						</form>    
                		</div>			  
                      
                <?php  
					 }
                }  
                	

?>
</div>
							
							
                        
             

         
				
               

				
				
                <div style="clear:both"></div>  
                <br />  
                 <h3>Order Details</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td><?php echo $values["item_price"]; ?>Ft</td>  
                               <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?>Ft</td>  
                               <td><a href="fakcio.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right"><?php echo number_format($total, 2); ?>Ft</td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div> 
           </div>  
           <br> 
		   <?php include 'footer.php';?>
      </body>  
 </html>
   