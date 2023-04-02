<?php
session_start();

// Check if the user is logged in
#if (!isset($_SESSION['username'])) {
#    header('Location: login.php');
#    exit();
#}

require_once 'config.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user's selected availability
    $availability = $_POST['availability'];

    // Delete any previous availability for the user
    $stmt = $conn->prepare('DELETE FROM availability WHERE user_id = ?');
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();

    // Insert the new availability into the database
    foreach ($availability as $day) {
        $stmt = $conn->prepare('INSERT INTO availability (user_id, day) VALUES (?, ?)');
        $stmt->bind_param('is', $_SESSION['user_id'], $day);
        $stmt->execute();
    }

    // Redirect to the homepage
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Set Availability</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>
    <h1>Set Availability</h1>
    <p>Please select the days you are available:</p>
    <form method="post">
        <?php
            $month = date('m');
            $year = date('Y');
            $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
            for ($day = 1; $day <= $days_in_month; $day++) {
                $date = "$year-$month-$day";
                $checked = '';
                $stmt = $conn->prepare('SELECT * FROM availability WHERE user_id = ? AND day = ?');
                $stmt->bind_param('is', $_SESSION['user_id'], $date);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $checked = 'checked';
                }
                echo "<label><input type='checkbox' name='availability[]' value='$date' $checked> $day</label>";
            }
        ?>
        <button type="submit">Save</button>
    </form>
</body>
</html>