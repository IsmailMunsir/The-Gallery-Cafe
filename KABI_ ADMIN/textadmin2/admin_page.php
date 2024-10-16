<?php

@include 'config.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO product(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM product WHERE id = $id");
   header('location:admin_page.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>

<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- custom css file link -->
<link rel="stylesheet" href="./css/style.css">

<style>
   body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    color: #333;
    width: 100%;
    height: 100%;
    background: linear-gradient(270deg, #ffc107, #ac9a66, #9d7808, #382c06);
    background-size: 600% 600%;
    animation: GradientAnimation 15s ease infinite;
    z-index: -1;
  }
  
  @keyframes GradientAnimation {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
  }

.container_na {
    display: flex;
    height: 100vh; /* Make sure the container takes full height */
    width: 100vw;  /* Make sure the container takes full width */
    position: absolute;
}

.sidebar {
    width: 250px;
    background-color: #333;
    color: #fff;
    padding: 20px;
    height: 100vh;
}

.logo {
    width: 50px;
    height: 50px;
    margin-right: 20px;
    border-radius: 50%;
    overflow: hidden;
    background-color: #000000;
    box-shadow: 0 0 10px rgba(28, 28, 28, 0.2);
}

.logo img {
    max-width: 100%;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    display: block;
    padding: 10px;
    color: #fff;
    text-decoration: none;
    transition: background-color 0.3s;
}

.sidebar ul li a:hover {
    background-color: #555;
}

.sidebar ul li.active a {
    background-color: #555;
}

.active a{
    margin-top: 10px;
}
</style>
</head>
<body>
<div class="container_na">
        <div class="sidebar">
            <div class="logo">
                <img src="./Logo/Logo1.png" alt="Logo">
            </div>
            <ul>
                <li class="active">
                <a href="login.html">Admin Register or Login</a></li>
                <li><a href="textadmin2/admin_page.php">Second Page</a></li>
            </ul>
        </div>
    </div>
    <script src="script.js"></script>
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>

<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Add new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price" name="product_price" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM product");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
            <td>
               <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>