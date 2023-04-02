<?php
// Start the session (if not already started)
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
</head>
<body>
	<h2>Edit User</h2>
	<?php
        // Include the database connection file
        require_once "config.php";
		
		// Check if the user is an admin
		if ($_SESSION['role'] != 'admin') {
			header("Location: dashboard.php");
			exit();
		}

		// Get the user ID from the URL parameter
		$id = $_GET['id'];

		// Get the user information from the database
		$sql = "SELECT * FROM users WHERE id='$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		// Check if the form has been submitted
		if (isset($_POST['submit'])) {
			// Get the form data
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$role = $_POST['role'];

			// Update the user information in the database
			$sql = "UPDATE users SET name='$name', email='$email', password='$password', role='$role' WHERE id='$id'";

			if ($conn->query($sql) === TRUE) {
				echo "User information updated successfully!";
			} else {
				echo "Error updating record: " . $conn->error;
			}
		}
	?>
	<form method="post">
		<p>
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
		</p>
		<p>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" value="<?php echo $row['email']; ?>">
		</p>
		<p>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" value="<?php echo $row['password']; ?>">
		</p>
		<p>
			<label for="role">Role:</label>
			<select id="role" name="role">
				<option value="plant owner" <?php if ($row['role'] == 'plant owner') echo 'selected'; ?>>Plant Owner</option>
				<option value="plant waterer" <?php if ($row['role'] == 'plant waterer') echo 'selected'; ?>>Plant Waterer</option>
				<option value="admin" <?php if ($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
			</select>
		</p>
		<p>
			<input type="submit" name="submit" value="Save">
		</p>
	</form>
</body>
</html>
