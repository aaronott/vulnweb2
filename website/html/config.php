<?php

// Database credentials
$host = 'database';
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
