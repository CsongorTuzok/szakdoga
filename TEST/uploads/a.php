  <?php
  $db = new mysqli('localhost','root','','ik');
  $products = "SELECT * FROM pdf";
                                    $products_run = mysqli_query($db, $products);
                                    if(mysqli_num_rows($products_run) > 0)
                                    {
                                         while($row = mysqli_fetch_array($products_run))  
												{
                                            ?>
                                                <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                           
                               <a href="<?php echo $row["pdf_name"]; ?>"><?php echo $row["pdf_name"]; ?></a>  
                               
                          </div>
                                            <?php
												}
                                    }
									?>