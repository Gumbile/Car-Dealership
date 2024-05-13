<?php
$host = 'localhost';
$username = "root";
$passwordDB = "";
$database = 'car_dealership';

// Create connection
$conn = new mysqli($host, $username, $passwordDB, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
