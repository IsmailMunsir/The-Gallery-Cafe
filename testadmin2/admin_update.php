<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_category = $_POST['product_category'];  // New variable for category
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_category) || empty($product_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE products SET name='$product_name', price='$product_price', category='$product_category', image='$product_image'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:admin_page.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

   <header class="header">
        <div class="lg">
            <a href="index.php"><img src="./Logo/Logo1.png" alt="Logo" class="logo"></a>
            <h1>Add new product</h1>
        </div>
    </header>



<div class="container_nev">
    <aside class="sidebar">
        <div class="brand">
        </div>
        <ul class="nav">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./login.html">Admin Login or Register</a></li>
                <li><a href="./index_staff.php">Operational Staff</a></li>
                <li><a href="./admin_page.php">Add new product</a></li>
                <li><a href="./view_products.php">View product</a></li>
                <li><a href="./table.php">View Reservations</a></li>
            </ul>
    </aside>


<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

<?php
      
      $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">update the product</h3>
      <input type="text" class="box" name="product_name" value="<?php echo $row['name']; ?>" placeholder="enter the product name">
      <input type="number" min="0" class="box" name="product_price" value="<?php echo $row['price']; ?>" placeholder="enter the product price">
      <select name="product_category" class="box"> <!-- Dropdown for category -->
         <option value="" disabled>Select Category</option>
         <option value="Special foods" <?php if($row['category'] == 'Special foods'){ echo 'selected'; } ?>>Special foods</option>
         <option value="Meals" <?php if($row['category'] == 'Meals'){ echo 'selected'; } ?>>Meals</option>
         <option value="Beverages" <?php if($row['category'] == 'Beverages'){ echo 'selected'; } ?>>Beverages</option>
      </select>
      <input type="file" class="box" name="product_image"  accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="update product" name="update_product" class="btn">
      <a href="admin_page.php" class="btn">go back!</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>