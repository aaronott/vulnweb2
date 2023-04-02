<?php
// Include the database connection file
require_once "config.php";

// Get the form data
$date = $_POST['date'];
$time = $_POST['time'];

// Get the plant owner's user ID from the session variable
$user_id = $_SESSION['user_id'];

// Insert the watering information into the database
$sql = "INSERT INTO watering (user_id, date, time) VALUES ('$user_id', '$date', '$time')";

if ($conn->query($sql) === TRUE) {
    echo "Watering scheduled!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
