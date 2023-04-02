<?php
// Include the database connection file
require_once "config.php";

// Get the user ID from the URL parameter
$id = $_GET['id'];

// Delete the user from the database
$sql = "DELETE FROM users WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "User deleted!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
