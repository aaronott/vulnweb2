<!DOCTYPE html>
<html>
<head>
	<title>Schedule Watering</title>
</head>
<body>
	<h2>Schedule Watering</h2>
	<form action="schedule.php" method="POST">
		<label for="date">Date:</label>
		<input type="date" id="date" name="date" required><br><br>
		
		<label for="time">Time:</label>
		<input type="time" id="time" name="time" required><br><br>
		
		<input type="submit" value="Schedule">
	</form>
</body>
</html>