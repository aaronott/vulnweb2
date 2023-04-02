<?php

// Include the database connection file
require_once "config.php";

// Get the form data
$id = $_POST['id'];
$date = $_POST['date'];
$time = $_POST['time'];

// Update the watering information in the database
$sql = "UPDATE watering SET date = '$date', time = '$time' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Watering updated!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
