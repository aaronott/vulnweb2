<?php
// Start the session (if not already started)
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
</head>
<body>
	<h2>Welcome to the Dashboard</h2>
	<?php
		// Start the session (if not already started)
		session_start();
		
		// Check if the user is logged in
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			// Get the user's role
			$role = $_SESSION['role'];
			
			// Show different links based on the user's role
			if ($role == 'plant owner') {
				echo "<p><a href='schedule-watering.php'>Schedule watering</a></p>";
				echo "<p><a href='view-watering.php'>View watering schedule</a></p>";
			} elseif ($role == 'plant waterer') {
				echo "<p><a href='view-schedule.php'>View watering schedule</a></p>";
			} elseif ($role == 'admin') {
				echo "<p><a href='view-users.php'>View users</a></p>";
				echo "<p><a href='view-watering.php'>View watering schedule</a></p>";
			}
			
			// Show the logout link
			echo "<p><a href='logout.php'>Logout</a></p>";
		} else {
			// Redirect to the login page if the user is not logged in
			header("Location: login.php");
			exit();
		}
	?>
</body>
</html>
