<?php
// Start the session (if not already started)
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
</head>
<body>
	<h2>Registration Form</h2>
	<form action="register.php" method="POST">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" required><br><br>
		
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required><br><br>
		
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required><br><br>
		
		<label for="role">Role:</label>
		<select id="role" name="role" required>
			<option value="plant owner">Plant Owner</option>
			<option value="plant waterer">Plant Waterer</option>
			<option value="admin">Admin</option>
		</select><br><br>
		
		<input type="submit" value="Register">
	</form>
</body>
</html>

<?php
// Include the database connection file
require_once "config.php";

// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Validate the form data (e.g. check if email is valid and password is strong enough)

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the user data into the database
$sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>