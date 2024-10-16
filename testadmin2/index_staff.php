<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operational Staff Management</title>
    <link rel="stylesheet" href="./staff.css">
    <style>
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
    flex: 1; /* Fill the remaining space */
    max-width: 700px; /* Adjusted max-width */
    margin: 0 auto;
    background: #fff;
    padding: 20px; /* Adjusted padding */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    color: #333;
}

.staff-list {
    list-style-type: none;
    padding: 0;
}

.staff-list li {
    background: #f9f9f9;
    margin: 5px 0;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

label {
    display: block;
    margin: 5px 0;
    font-size: 14px;
}

input[type="text"], input[type="email"] {
    width: 100%;
    padding: 6px;
    margin-bottom: 8px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-size: 14px;
}

button {
    background-color: #333;
    color: #fff;
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

button:hover {
    background-color: #555;
}

    </style>
</head>
<body>
<header class="header">
        <div class="lg">
            <a href="index.php"><img src="./Logo/Logo1.png" alt="Logo" class="logo"></a>
            <h1>Operational Staff</h1>
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

    <div class="container">
        <h1>Operational Staff</h1>
        <ul class="staff-list">
            <?php
            // Connect to the database
            $conn = new mysqli("localhost", "root", "", "operational_staff_db");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch staff members
            $sql = "SELECT name, position, email FROM staff";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li><strong>" . $row['name'] . "</strong> - " . $row['position'] . " <br> Email: " . $row['email'] . "</li>";
                }
            } else {
                echo "<li>No staff members found.</li>";
            }

            $conn->close();
            ?>
        </ul>

        <h2>Add New Staff Member</h2>
        <form action="add_staff.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="position">Position:</label>
            <input type="text" id="position" name="position" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Add Staff</button>
        </form>
    </div>
</div>

</body>
</html>
