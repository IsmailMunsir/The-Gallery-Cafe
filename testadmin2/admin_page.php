<?php

@include 'config.php';

if(isset($_POST['add_product'])){

$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_category = $_POST['product_category'];  // New variable for category
$product_image = $_FILES['product_image']['name'];
$product_image_tmp_name = $_FILES['product_image']['tmp_name'];
$product_image_folder = 'uploaded_img/'.$product_image;

if(empty($product_name) || empty($product_price) || empty($product_category) || empty($product_image)){
   $message[] = 'Please fill out all fields';
}else{
   $insert = "INSERT INTO products(name, price, category, image) VALUES('$product_name', '$product_price', '$product_category', '$product_image')";
   $upload = mysqli_query($conn,$insert);
   if($upload){
      move_uploaded_file($product_image_tmp_name, $product_image_folder);
      header('Location: admin_page.php?success=1'); // Redirect after successful form submission
      exit();
   }else{
      $message[] = 'Could not add the product';
   }
}
}

if(isset($_GET['success']) && $_GET['success'] == 1){
   $message[] = 'New product added successfully';  // Show the success message after redirection
   // Redirect to avoid message showing on refresh
   header('Location: admin_page.php');
   exit();
}

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE id = $id");
   header('location:admin_page.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

    <!-- JavaScript for message fade-out -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.querySelector('.success');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.classList.add('fade-out');
                }, 4000); // Adjust the timing as needed (4000ms = 4 seconds)
            }
        });
    </script>

<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

:root {
   --primary-color: #9d7808; /* Blue color for the primary elements */
   --text-color: #382c06; /* Dark gray for text */
   --bg-color: #f5f5f5; /* Light gray background */
   --white: #fff; /* White color */
   --box-shadow: 0 .5rem 1rem rgba(0,0,0,.1); /* Subtle shadow */
   --border: .1rem solid var(--text-color); /* Border color */
}

/* Global Styles */
* {
   box-sizing: border-box;
   margin: 0;
   padding: 0;
}

body {
   font-family: Arial, sans-serif;
   line-height: 1.6;
   color: #333;
   width: 100%;
   height: 100%;
   background: linear-gradient(270deg, #ffc107, #ac9a66, #9d7808, #382c06);
   background-size: 600% 600%;
   animation: GradientAnimation 15s ease infinite;
   position: relative;
   overflow-x: hidden;
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

.header {
    background-color: #382c07;
    padding: 1em;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    z-index: 1;
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

.lg {
    display: flex;
    align-items: center;
}

.lg h1 {
    color: #fff;
    margin-left: 10px;
    font-size: 24px;
}

.container_nev {
   display: flex;
   height: calc(100vh - 80px); 
   
}

.sidebar {
   width: 250px;
   background-color: #382c06;
   color: #fff;
   padding: 20px;
   height: 100%;
}

.sidebar .nav {
   list-style: none;
   padding: 0;
}

.sidebar .nav li {
   margin: 15px 0;
}

.sidebar .nav li a {
   color: #fff;
   text-decoration: none;
   font-size: 18px;
}

.sidebar .nav li a:hover {
   text-decoration: underline;
}

.container {
   max-width: 1200px;
   padding: 2rem;
   margin: 0 auto;
}

.admin-product-form-container {
   display: flex;
   align-items: center;
   justify-content: center;
   min-height: 100vh;
}

.admin-product-form-container form {
   max-width: 50rem;
   margin: 0 auto;
   padding: 2rem;
   border-radius: .5rem;
   background: #9d7808; /* Blue background for form */
   box-shadow: var(--box-shadow); /* Shadow for form */
   color: var(--white); /* White text color */
}

.admin-product-form-container form h3 {
   text-transform: uppercase;
   color: var(--white); /* White color for heading */
   margin-bottom: 1rem;
   text-align: center;
   font-size: 2.5rem;
}

.admin-product-form-container form .box {
   width: 100%;
   border-radius: .5rem;
   padding: 1.2rem 1.4rem;
   font-size: 1.8rem;
   margin: 1rem 0;
   background: var(--white); /* White background for input fields */
   color: var(--text-color); /* Dark text color */
}

.admin-product-form-container form .btn {
   display: block;
   width: 100%;
   cursor: pointer;
   border-radius: .5rem;
   margin-top: 1rem;
   font-size: 1.8rem;
   padding: 1rem 3rem;
   background: #382c06; /* Dark background for button */
   color: var(--white); /* White text color */
   text-align: center;
}

.admin-product-form-container form .btn:hover {
   background: var(--primary-color); /* Hover effect: Blue background for button */
}

.product-display {
   margin: 2rem 0;
}

.product-display-table {
   width: 100%;
   text-align: center;
}

.product-display-table thead {
   background: var(--text-color); /* Dark background for table header */
}

.product-display-table thead th {
   padding: 1rem;
   font-size: 2rem;
   color: var(--white); /* White text color */
}

.product-display-table tr {
   border-bottom: var(--border); /* Border for table rows */
}

.product-display-table tr:last-child {
   border-bottom: none;
}

.product-display-table td {
   padding: 1.5rem;
   font-size: 2rem;
   color: var(--text-color); /* Dark text color */
}

.product-display-table td img {
   height: 10rem;
}

.product-display-table td a {
   cursor: pointer;
   font-size: 2rem;
   text-decoration: none; /* Remove underline */
   display: inline-block; /* Ensure it behaves like a block element */
}

.product-display-table td a.btn {
   color: var(--white); /* White color for other buttons */
   background: var(--primary-color); /* Blue background for other buttons */
   border-radius: .5rem;
   padding: .5rem 1.5rem;
}

.product-display-table td a.btn:hover {
   background: var(--text-color); /* Darker background on hover */
}

.product-display-table td a.delete-btn {
   color: #ffffff; /* Red color for delete button */
   background: none;
   padding: 0;
   font-size: 2rem;
   text-decoration: none; /* Remove underline */
   display: inline-block; /* Ensure it behaves like a block element */
   margin: 0 0.5rem; /* Space between buttons */
}

.product-display-table td a.delete-btn:hover {
   color: #ffffff; /* Darker red on hover */
   text-decoration: underline; /* Underline on hover */
}

.message {
   position: fixed;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   padding: 1.5rem 3rem;
   background-color: var(--primary-color); /* Blue background for success message */
   color: var(--white); /* White text color */
   font-size: 2rem;
   border-radius: .5rem;
   z-index: 1000;
   box-shadow: var(--box-shadow);
}

.message.success {
   background-color: #9d7808; /* Optional: Green background for success */
}

.fade-out {
   opacity: 0;
   transition: opacity 1s ease-out;
}

</style>
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
          echo '<span class="message success">'.$message.'</span>';  // Updated class to include "success"
       }
    }

    ?>

    <div class="container">

       <div class="admin-product-form-container">

          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
             <h3>Add new product</h3>
             <input type="text" placeholder="Enter product name" name="product_name" class="box">
             <input type="number" placeholder="Enter product price" name="product_price" class="box">
             <select name="product_category" class="box"> <!-- Dropdown for category -->
                <option value="" disabled selected>Select Category</option>
                <option value="special foods">Special foods</option>
                <option value="Meals">Meals</option>
                <option value="Beverages">Beverages</option>
                <option value="Snacks">Snacks</option>
                <option value="Wines">Wines</option>
                <option value="Sweet">Sweet</option>
             </select>
             <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
             <input type="submit" class="btn" name="add_product" value="Add Product">
          </form>

       </div>

       <?php

       $select = mysqli_query($conn, "SELECT * FROM products");
       
       ?>
       <div class="product-display">
          <table class="product-display-table">
             <thead>
             <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Category</th> <!-- New column for category -->
                <th>Action</th>
             </tr>
             </thead>
             <?php while($row = mysqli_fetch_assoc($select)){ ?>
             <tr>
                <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                <td><?php echo $row['name']; ?></td>
                <td>Rs.<?php echo $row['price']; ?>/-</td>
                <td><?php echo $row['category']; ?></td> <!-- Display the category -->
                <td>
                  <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> 
                     <i class="fas fa-edit"></i> Edit 
                  </a>
                  <br>
                  <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn delete-btn"> 
                     <i class="fas fa-trash"></i> Delete 
                  </a>
               </td>

             </tr>
          <?php } ?>
          </table>
       </div>

    </div>
</div>

</body>
</html>
