<?php
// Start the session (if not already started)
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Watering Schedule</title>
</head>
<body>
	<h2>Watering Schedule</h2>
	<table>
		<tr>
			<th>Plant Owner</th>
			<th>Date</th>
			<th>Time</th>
			<th>Completed</th>
			<th>Action</th>
		</tr>
		<?php
            // Include the database connection file
            require_once "config.php";

			// Get the watering schedule from the database
			$sql = "SELECT watering.id, users.name, watering.date, watering.time, watering.completed FROM watering INNER JOIN users ON watering.user_id = users.id";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["name"] . "</td>";
					echo "<td>" . $row["date"] . "</td>";
					echo "<td>" . $row["time"] . "</td>";
					if ($row["completed"] == 1) {
						echo "<td>Yes</td>";
					} else {
						echo "<td>No</td>";
					}
					echo "<td><a href='edit-watering.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete-watering.php?id=" . $row["id"] . "'>Delete</a></td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='5'>No watering scheduled yet.</td></tr>";
			}

			$conn->close();
		?>
	</table>
	<?php
		// Show the link to schedule a watering for plant owners
		if ($_SESSION['role'] == 'plant owner') {
			echo "<p><a href='schedule-watering.php'>Schedule watering</a></p>";
		}
	?>
</body>
</html>
