<?php
// Start the session (if not already started)
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
</head>
<body>
	<h2>Login Form</h2>
	<form action="login.php" method="POST">
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required><br><br>
		
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required><br><br>
		
		<input type="submit" value="Login">
	</form>
</body>
</html>
<?php
// Include the database connection file
require_once "config.php";

// Get the form data
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the email exists in the database
$sql = "SELECT * FROM users WHERE email = '$email'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // The email exists in the database, check if the password is correct
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // The password is correct, set the session variable and redirect to the user's dashboard
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_role'] = $row['role'];
        header('Location: dashboard.php');
    } else {
        // The password is incorrect, show an error message
        echo "Invalid email or password.";
    }
} else {
    // The email doesn't exist in the database, show an error message
    echo "Invalid email or password.";
}

$conn->close();

?>