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
			<th>Action</th>
		</tr>
		<?php
            // Include the database connection file
            require_once "config.php";
			
			// Get the watering schedule for the current plant waterer from the database
			$waterer_id = $_SESSION['id'];
			$sql = "SELECT users.name, watering.date, watering.time, watering.completed FROM watering INNER JOIN users ON watering.user_id = users.id WHERE watering.id IN (SELECT watering_id FROM watering_waterer WHERE waterer_id = '$waterer_id')";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["name"] . "</td>";
					echo "<td>" . $row["date"] . "</td>";
					echo "<td>" . $row["time"] . "</td>";
					echo "<td><a href='mark-completed.php?date=" . $row["date"] . "&time=" . $row["time"] . "'>Mark as completed</a></td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='4'>No watering scheduled for you yet.</td></tr>";
			}

			$conn->close();
		?>
	</table>
</body>
</html>
