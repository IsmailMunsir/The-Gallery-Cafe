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

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Convert delete_id to an integer to prevent SQL injection
    $sql_delete = "DELETE FROM reservations WHERE id = $delete_id";

    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Reservation deleted successfully.');</script>";
        echo "<script>window.location.href = 'table.php';</script>"; // Redirect to the same page to refresh the list
    } else {
        echo "<script>alert('Error deleting reservation: " . $conn->error . "');</script>";
    }
}

// Retrieve all reservations from the database
$sql = "SELECT * FROM reservations ORDER BY date, time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations</title>
    <link rel="stylesheet" href="./table.css"> <!-- Optional: Link to your CSS file -->
</head>
<body>
    <h1>View Reservations</h1>

    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Guests</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"]. "</td>
                    <td>" . $row["date"]. "</td>
                    <td>" . $row["time"]. "</td>
                    <td>" . $row["guests"]. "</td>
                    <td>" . $row["name"]. "</td>
                    <td>" . $row["email"]. "</td>
                    <td>" . $row["phone"]. "</td>
                    <td>
                        <a href='./edit_reservation.php?edit_id=" . $row["id"] . "'>Edit</a> | 
                        <a href='table.php?delete_id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this reservation?');\">Delete</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No reservations found.";
    }

    $conn->close();
    ?>

</body>
</html>
