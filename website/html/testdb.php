<?php
$host = 'database';
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

echo 'Connected successfully';

echo "password123 : " . password_hash('password123', PASSWORD_DEFAULT) . "\n<br />";
echo "password456 : " . password_hash('password456', PASSWORD_DEFAULT) . "\n<br />";
echo "adminpassword : " . password_hash('adminpassword', PASSWORD_DEFAULT) . "\n<br />";


echo phpinfo();
?>
