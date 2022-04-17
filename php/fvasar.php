 <?php 
 session_start();
$db = mysqli_connect("localhost", "root", "", "ik");
   
 

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM `product` WHERE CONCAT(`author_id`, `k_name`) LIKE '%".$valueToSearch."%'";
    $search_result = mysqli_query($db,$query);
    
}
 else {
    $query = "SELECT * FROM `product`";
    $search_result = mysqli_query($db,$query);
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
<form action="fvasar.php" method="post">
<b style="	font-family: monospace">Keresés:</b>
<input type="text" name="valueToSearch" size=15%>
<input type="submit" name="search" value="Keresés">
</form> 
<form action="fvasar.php" method="post">
<h5> 
									
									Témák:
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
								<p>
								
                                <button type="submit" class="btn btn-primary btn-sm float-end">Szűrés</button>
								</form>

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
                                    $products = "SELECT * FROM product WHERE topic_id IN ($rowtopic)";
                                    $products_run = mysqli_query($db, $products);
									if(mysqli_num_rows($products_run) > 0)
                                    {
                                         while($row = mysqli_fetch_array($products_run))  
												{
                                            ?>
												
												<div style="float: left;
	border: 1px solid black;
	background-color: #99e6ff;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	margin: 25px;"" align="center">
	
<form method="post" action="fkosar.php?action=add&id=<?php echo $row["ID"]; ?>">
                               <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["author_id"]; ?></h4>  
                               <h4 class="text-info"><?php echo $row["k_name"]; ?></h4>  
                               <h4 class="text-danger"><?php echo $row["price"]; ?>Ft</h4>  
                               <input type="number" name="quantity" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["k_name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" /><br>
							   
							   <input type="submit" name="add_to_cart" class="btn btn-success" value="Add to Cart" /> 
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
                <div>   
					 <div style="float: left;
						border: 1px solid black;
						background-color: #99e6ff;
						box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
						margin: 25px;" align="center">
	
							<form method="post" action="fkosar.php?action=add&id=<?php echo $row["ID"]; ?>">
                               <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["author_id"]; ?></h4>  
                               <h4 class="text-info"><?php echo $row["k_name"]; ?></h4>  
                               <h4 class="text-danger"><?php echo $row["price"]; ?>Ft</h4>  
                               <input type="number" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["k_name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" /> <br> 
							   
                               <input type="submit" name="add_to_cart" class="btn btn-success" value="Add to Cart" />  
							</form>
                          </div>
						   
						    
                </div>						  
                      
                <?php  
					 }
                }  
                	

?>
</div>
						
</div>
		   <?php include 'footer.php';?>
		   
      </body>  
 </html>
   