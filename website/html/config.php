<?php

// Database credentials
define('DB_SERVER', 'database');
define('DB_USERNAME', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_NAME', $_ENV['DB_NAME']);

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
