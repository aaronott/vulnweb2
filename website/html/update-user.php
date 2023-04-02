<?php
// Include the database connection file
require_once "config.php";

// Get the form data
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$role = $_POST['role'];

// Update the user's information in the database
$sql = "UPDATE users SET name = '$name', email = '$email', role = '$role' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "User updated!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
