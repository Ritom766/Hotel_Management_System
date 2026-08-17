<?php
$host     = "localhost";
$username = "root";
$password = "";
$dbname   = "hotel_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// echo "Connected successfully!";
?>