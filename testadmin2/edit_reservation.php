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

$date = $time = $guests = $name = $email = $phone = "";

if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $sql = "SELECT * FROM reservations WHERE id = $edit_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $date = $row['date'];
        $time = $row['time'];
        $guests = $row['guests'];
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
    } else {
        echo "Reservation not found.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_id = $_POST['id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql_update = "UPDATE reservations SET date = '$date', time = '$time', guests = '$guests', name = '$name', email = '$email', phone = '$phone' WHERE id = $edit_id";

    if ($conn->query($sql_update) === TRUE) {
        // Redirect back to view_reservations.php after a successful update
        header('Location: table.php');
        exit();
    } else {
        echo "Error updating reservation: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <link rel="stylesheet" href="./edit_reservation.css"> <!-- Optional: Link to your CSS file -->
</head>
<body>
    <h1>Edit Reservation</h1>

    <form method="post" action="edit_reservation.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_id); ?>">
        Date: <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required><br>
        Time: <input type="time" name="time" value="<?php echo htmlspecialchars($time); ?>" required><br>
        Guests: <input type="number" name="guests" value="<?php echo htmlspecialchars($guests); ?>" required><br>
        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>
        Phone: <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required><br>
        <input type="submit" value="Update Reservation">
    </form>
</body>
</html>
