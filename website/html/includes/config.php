<?php
// DB credentials.
define('DB_HOST','database');
define('DB_USER','carrental');
define('DB_PASS','carrental');
define('DB_NAME','carrental');
// Establish database connection.

$host = "localhost";
$user = "";
$pass = "";
$db = "";

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($conn->connect_error){
  echo "Failed:" . $conn->connect_error;
}
?>
