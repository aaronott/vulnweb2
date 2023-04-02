<?php

// Include the database connection file
require_once "config.php";

// Get the date and time from the URL parameters
$date = $_GET['date'];
$time = $_GET['time'];

// Get the ID of the watering entry
$sql = "SELECT id FROM watering WHERE date='$date' AND time='$time'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$id = $row['id'];

// Update the completion status of the watering entry
$sql = "UPDATE watering SET completed='1' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
	echo "Watering marked as completed!";
} else {
	echo "Error updating record: " . $conn->error;
}

$conn->close();

?>
