<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE GALARY CAFE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="menu.css"> <!-- link to external CSS file -->
</head>
<body>
    <header class="header">
        <a href="index.php">
            <img src="Logo/Logo1.png" alt="Logo" class="logo">
        </a>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="About.html">About</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="./menu.php" id="allProductsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        All Products
                    </a>
                    <div class="dropdown-menu" aria-labelledby="allProductsDropdown">
                        <a class="dropdown-item" href="special_foods.php">Special Foods</a>
                        <a class="dropdown-item" href="meals.php">Meals</a>
                        <a class="dropdown-item" href="beverages.php">Beverages</a>
                        <a class="dropdown-item" href="./sweet.php">Sweet</a>
                        <a class="dropdown-item" href="./wines.php">Wines</a>
                        <a class="dropdown-item" href="./Snacks.php">Snacks</a>
                        <!-- Add more categories as needed -->
                    </div>
                </li>
                <li><a href="Table_Reservation.html">Table Reservation</a></li>
                <li><a href="Parking.html">Parking</a></li>
            </ul>
        </nav>
        <div class="icons">
            <i class="fas fa-search" id="search-icon"></i>
            <input type="text" class="search-bar" id="search-bar" placeholder="Search...">
            <a href="register.html"><i class="fas fa-user"></i></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
        </div>
    </header>

    <div class="banner-container" id="banner-container"></div>

    <h2 class="head2">Wines</h2>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <?php
    require 'testadmin2/config.php';

    $query = "SELECT * FROM products";
    $query_run = mysqli_query($conn, $query);

    $check_products = mysqli_num_rows($query_run) > 0;

    if ($check_products) {
    ?>
    <div class="container py-5">
        <div class="row">
            <?php
            while ($row = mysqli_fetch_array($query_run)) {
            ?>
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="testadmin2/uploaded_img/<?php echo $row['image']; ?>" width="300" height="200" class="img-fluid mb-3" alt="<?php echo $row['name']; ?>">
                            <h1 class="card-text mt-3"><?php echo $row['name']; ?></h1>   
                            <div class="row mt-4">
                                <div class="col">
                                    <h2 class="card-title">LKR <?php echo $row['price']; ?></h2>
                                </div>
                                <div class="col text-right">
                                    <form method="POST" action="add_to_cart.php">
                                        <div class="form-group">
                                            <label for="quantity">Quantity:</label>
                                            <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 70px; display: inline-block;">
                                        </div>
                                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-outline-success cart-btn">
                                            <i class="fas fa-shopping-cart" style="width: 200px;"></i> Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    } else {
        echo "No products found";
    }
    ?>

<footer>
        <div class="footer-container">
            <div class="footer-section about">
                <h3>ABOUT US</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="Table_Reservation.html">Table Reservation</a></li>
                    <li><a href="Parking.html">Parking</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h3>CONTACT US</h3>
                <p>Email: ahamedismial12345@gamil.com</p>
                <p>Phone: +94 75 223 6387</p>
                <p>Address: 2 Aifred House Rd, Colombo 00300</p>
                <div class="social-icons">
                    <a href="https://web.facebook.com/profile.php?id=61559588762495"><i class="bx bxl-facebook"></i></a>
                    <a href="https://x.com/AhamedI76122"><i class="bx bxl-twitter"></i></a>
                    <a href="https://www.instagram.com/ah____ismail_________/"><i class="bx bxl-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/ahamed-ismail-5ab879212/"><i class="bx bxl-linkedin"></i></a>
                </div>
            </div>
        </div>
    
        <div class="footer-bottom">
            <p>&copy; 2024 The Gallery Café | Designed by [Ahamed Ismail]</p>
        </div>
    </footer>

    <script src="./menu.js"></script> <!-- link to external JavaScript file -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
