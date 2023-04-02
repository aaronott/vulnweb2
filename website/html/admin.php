<?php
// Include the database connection file
require_once "config.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
</head>
<body>
	<h2>Admin Dashboard</h2>
	<h3>Users</h3>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Get all users from the database
			$sql = "SELECT * FROM users";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // Output the users as a table
			    while($row = $result->fetch_assoc()) {
			        echo "<tr>";
			        echo "<td>" . $row['id'] . "</td>";
			        echo "<td>" . $row['name'] . "</td>";
			        echo "<td>" . $row['email'] . "</td>";
			        echo "<td>" . $row['role'] . "</td>";
			        echo "<td>";
			        if ($row['role'] != "admin") {
			            echo "<a href='edit-user.php?id=" . $row['id'] . "'>Edit</a>";
			            echo " | ";
			            echo "<a href='delete-user.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>";
			        }
			        echo "</td>";
			        echo "</tr>";
			    }
			} else {
			    // No users found in the database
			    echo "<tr><td colspan='5'>No users found.</td></tr>";
			}

			// $conn->close();

			?>
		</tbody>
	</table>
	<h3>Watering Schedule</h3>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>User ID</th>
				<th>Date</th>
				<th>Time</th>
				<th>Completed</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Get all watering information from the database
			$sql = "SELECT * FROM watering";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // Output the watering information as a table
			    while($row = $result->fetch_assoc()) {
			        echo "<tr>";
			        echo "<td>" . $row['id'] . "</td>";
			        echo "<td>" . $row['user_id'] . "</td>";
			        echo "<td>" . $row['date'] . "</td>";
			        echo "<td>" . $row['time'] . "</td>";
			        echo "<td>" . ($row['completed'] ? "Yes" : "No") . "</td>";
                    echo "<td>";
                    echo "<a href='edit-watering.php?id=" . $row['id'] . "'>Edit</a>";
                    echo " | ";
                    echo "<a href='delete-watering.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this watering?\")'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                    }
                    } else {
                    // No watering information found in the database
                    echo "<tr><td colspan='6'>No watering information found.</td></tr>";
                    }
                    $conn->close();

                    ?>
                </tbody>
            </table>
            </body>
</html>