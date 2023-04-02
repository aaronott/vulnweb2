<?php
// Get the watering ID from the URL parameter
$id = $_GET['id'];

// Include the database connection file
require_once "config.php";

// Delete the watering entry from the database
$sql = "DELETE FROM watering WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Watering deleted!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
