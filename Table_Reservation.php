<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the_gallery_cafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;
    $guests = $_POST['guests'] ?? null;
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $phone = $_POST['phone'] ?? null;

    // Check for duplicate reservations before inserting
    $sql = "SELECT * FROM reservations WHERE date = '$date' AND time = '$time'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Duplicate reservation found
        echo "Error: A reservation with the same date and time already exists.";
    } else {
        // No duplicate, proceed with the insertion
        $sql = "INSERT INTO reservations (date, time, guests, name, email, phone) VALUES ('$date', '$time', '$guests', '$name', '$email', '$phone')";
        if ($conn->query($sql) === TRUE) {
            echo "New reservation created successfully<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// ... (rest of your PHP code)
?>