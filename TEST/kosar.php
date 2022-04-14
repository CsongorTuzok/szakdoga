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
                echo '<script>window.location="kosar.php"</script>';  
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
                     echo '<script>window.location="kosar.php"</script>';  
                }  
           }  
      }  
 }  

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM `product` WHERE CONCAT(`sz_name`, `k_name`) LIKE '%".$valueToSearch."%'";
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
 <html>  
      <head>  
           <title>Webslesson Tutorial | Simple PHP Mysql Shopping Cart</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:700px;">  
                <h3 align="center">Simple PHP Mysql Shopping Cart</h3><br />
				      
                        </div>
                        <div class="card-body">
                            <h6>Témák:</h6>
                            <hr>
							
							<form action="kosar.php?action=add&id=<?php echo $row["ID"]; ?>" method="post">
							<h5>Filter 
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
             

           <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
						<input type="submit" name="search" value="Filter"><br><br>
				
                <?php  
                  
					
					
				     if(isset($_POST['topic']))
                            {
                                $topicchecked = [];
                                $topicchecked = $_POST['topic'];
                                foreach($topicchecked as $rowtopic)
                                {
                                    // echo $rowtopic;
                                    $products = "SELECT * FROM product WHERE topic_id IN ($rowtopic)";
                                    $products_run = mysqli_query($db, $products);
									if(mysqli_num_rows($products_run) > 0)
                                    {
                                         while($row = mysqli_fetch_array($products_run))  
												{
                                            ?>
                                                <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                               <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["author_id"]; ?></h4>  
                               <h4 class="text-info"><?php echo $row["k_name"]; ?></h4>  
                               <h4 class="text-danger"><?php echo $row["price"]; ?>Ft</h4>  
                               <input type="number" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["k_name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
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
                <div class="col-md-4">  
                     <form method="post" action="kosar.php?action=add&id=<?php echo $row["ID"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                               <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["author_id"]; ?></h4>  
                               <h4 class="text-info"><?php echo $row["k_name"]; ?></h4>  
                               <h4 class="text-danger"><?php echo $row["price"]; ?>Ft</h4>  
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
                               <td><a href="kosar.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
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
           <br />  
      </body>  
 </html>
   