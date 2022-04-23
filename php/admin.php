<?php

include 'config.php';

if(isset($_POST['add_product'])){
   $author = $_POST['author'];
   $k_name = $_POST['k_name'];
   $price = $_POST['price'];
   $topic_id = $_POST['topic_id'];
   $image = $_FILES['image']['name'];
   $p_image_tmp_name = $_FILES['image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$image;

   $insert_query = mysqli_query($db, "INSERT INTO `product`(author, k_name, topic_id, price, image) VALUES('$author', '$k_name', '$topic_id', '$price', '$image')") or die('Hiba!!!!!');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'Termék sikeresen hozzáadva';
   }else{
      $message[] = 'Termék hozzáadása nem sikerült';
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($db, "DELETE FROM `product` WHERE ID = $delete_id ") or die('Adatbázishoz csatlakozás sikertelen');
   if($delete_query){
      header('location:admin.php');
      $message[] = 'Termék törlésre került';
   }else{
      header('location:admin.php');
      $message[] = 'Termék törlése nem sikerült';
   }
}

if(isset($_POST['update_product'])){
   $update_p_author = mysqli_real_escape_string($db, $_POST['update_p_author']);
   $update_p_id = mysqli_real_escape_string($db, $_POST['update_p_id']);
   $update_p_name = mysqli_real_escape_string($db, $_POST['update_p_name']);
   $update_topic_id = mysqli_real_escape_string($db, $_POST['update_topic_id']);
   $update_p_price = mysqli_real_escape_string($db, $_POST['update_p_price']);
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($db, "UPDATE `product` SET author = '$update_p_author', k_name = '$update_p_name', 
   topic_id = '$update_topic_id', price = '$update_p_price', image = '$update_p_image' WHERE ID = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'Termék frisités sikeres';
      header('location:admin.php');
   }else{
      $message[] = 'Termék frisités nem sikerült';
      header('location:admin.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Ifjúsági Könyvesbolt </title>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="_css/regisztracio.css">
<style>
 </style>
</head>
<body>
<?php
	session_start();
	if(!isset($_SESSION["nickname"]))
	{
		header("location:index.php");
	}
	echo $_SESSION['nickname'];
?>
<br>
<a href="afeltolt.php">Digitális könyv feltöltése</a>
<br>
<a href="rendeles.php">Rendelések</a>
<br>
<a href="logout.php">Kijelentkezés</a>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;">x</i> </div>';
   }
}

?>


<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>Új termék</h3>
   <input type="text" name="author" placeholder="Író" class="box" required>
   <input type="text" name="k_name" placeholder="cím" class="box" required>
   <select name="topic_id">
               <option value="1" selected>ifjúsági regény</option>
               <option value="2">horror</option>
               <option value="3">comedia</option>
               <option value="4">scifi</option>
               <option value="5">fikcio</option>
               <option value="6">valamiaminincs</option>
   </select>
   <input type="number" name="price" min="0" placeholder="Ár" class="box" required>
   <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="Feltöltés" name="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>kép</th>
         <th>író neve</th>
         <th>könyv neve</th>
         <th>ár</th>
         <th>törlés</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($db, "SELECT * FROM `product`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['k_name']; ?></td>
            <td><?php echo $row['price']; ?> Ft</td>
            <td>
               <a href="admin.php?delete=<?php echo $row['ID']; ?>" class="delete-btn" onclick="return confirm('Biztos törölni szeretnéd?');"> <i class="fas fa-trash"></i> törlés </a>
               <a href="admin.php?edit=<?php echo $row['ID']; ?>" class="option-btn"> <i class="fas fa-edit"></i> frisités </a>
            </td>
         </tr>

         <?php
            }  
            }else{
               echo "<div class='empty'>Nincs egy termék se hozzáadva</div>";
            }
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($db, "SELECT * FROM `product` WHERE ID = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="admin.php" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['ID']; ?>">
      <input type="text" class="box" required name="update_p_author" value="<?php echo $fetch_edit['author']; ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['k_name']; ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the prodcut" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            }
         }
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      }
   ?>

</section>

</div>


</body>
</html>