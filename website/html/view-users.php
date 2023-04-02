<?php
// Start the session (if not already started)
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
</head>
<body>
	<h2>Users</h2>
	<table>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Password</th>
			<th>Role</th>
			<th>Action</th>
		</tr>
		<?php
            // Include the database connection file
            require_once "config.php";
			
			// Check if the user is an admin
			if ($_SESSION['role'] != 'admin') {
				header("Location: dashboard.php");
				exit();
			}

			// Get all users from the database
			$sql = "SELECT * FROM users";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["name"] . "</td>";
					echo "<td>" . $row["email"] . "</td>";
					echo "<td>" . $row["password"] . "</td>";
					echo "<td>" . $row["role"] . "</td>";
					echo "<td><a href='edit-user.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete-user.php?id=" . $row["id"] . "'>Delete</a></td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='5'>No users found.</td></tr>";
			}

			$conn->close();
		?>
	</table>
	<p><a href='register.php'>Add new user</a></p>
</body>
</html>
