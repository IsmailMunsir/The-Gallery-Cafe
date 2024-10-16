<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "operational_staff_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $position = $conn->real_escape_string($_POST['position']);
    $email = $conn->real_escape_string($_POST['email']);

    // Insert new staff member into the database
    $sql = "INSERT INTO staff (name, position, email) VALUES ('$name', '$position', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "New staff member added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    // Redirect back to the index page
    header("Location: index_staff.php");
    exit();
}
?>
