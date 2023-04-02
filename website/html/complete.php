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
		<thead>
			<tr>
				<th>Date</th>
				<th>Time</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php

            // Include the database connection file
            require_once "config.php";

			// Get the plant waterer's user ID from the session variable
			$user_id = $_SESSION['user_id'];

			// Get the watering schedule for the plant waterer
			$sql = "SELECT * FROM watering WHERE user_id = '$user_id'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // Output the watering schedule as a table
			    while($row = $result->fetch_assoc()) {
			        echo "<tr>";
			        echo "<td>" . $row['date'] . "</td>";
			        echo "<td>" . $row['time'] . "</td>";
			        echo "<td>";
			        if ($row['completed'] == 0) {
			            echo "<form action='complete.php' method='POST'>";
			            echo "<input type='hidden' name='watering_id' value='" . $row['id'] . "'>";
			            echo "<input type='submit' value='Mark as Completed'>";
			            echo "</form>";
			        } else {
			            echo "Completed";
			        }
			        echo "</td>";
			        echo "</tr>";
			    }
			} else {
			    // No watering schedule found for the plant waterer
			    echo "<tr><td colspan='3'>No watering schedule found.</td></tr>";
			}

			$conn->close();

			?>
		</tbody>
	</table>
</body>
</html>
<?php
// Update the watering information in the database
$sql = "UPDATE watering SET completed = '1' WHERE id = '$watering_id'";

if ($conn->query($sql) === TRUE) {
    echo "Watering completed!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
