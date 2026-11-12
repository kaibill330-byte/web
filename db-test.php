<?php
$host = '127.0.0.1';
$db   = 'sslip-student'; // Replace with your exact DB name
$user = 'sslip-student';  // Replace with your exact DB user
$pass = 'Saraswati@18';  // Replace with your exact DB password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Successfully connected to the MySQL server!";
?>