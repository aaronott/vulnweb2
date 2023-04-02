<?php
// Start the session (if not already started)
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Watering</title>
</head>
<body>
	<h2>Edit Watering</h2>
	<?php
        // Include the database connection file
        require_once "config.php";

		// Check if the user is a plant owner
		if ($_SESSION['role'] != 'plant owner') {
			header("Location: dashboard.php");
			exit();
		}

		// Get the watering ID from the URL parameter
		$id = $_GET['id'];

		// Get the watering information from the database
		$sql = "SELECT * FROM watering WHERE id='$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		// Check if the form has been submitted
		if (isset($_POST['submit'])) {
			// Get the form data
			$date = $_POST['date'];
			$time = $_POST['time'];

			// Update the watering information in the database
			$sql = "UPDATE watering SET date='$date', time='$time' WHERE id='$id'";

			if ($conn->query($sql) === TRUE) {
				echo "Watering information updated successfully!";
			} else {
				echo "Error updating record: " . $conn->error;
			}
		}
	?>
	<form method="post">
		<p>
			<label for="date">Date:</label>
			<input type="date" id="date" name="date" value="<?php echo $row['date']; ?>">
		</p>
		<p>
			<label for="time">Time:</label>
			<input type="time" id="time" name="time" value="<?php echo $row['time']; ?>">
		</p>
		<p>
			<input type="submit" name="submit" value="Save">
		</p>
	</form>
</body>
</html>
