<?php
$host = "sql13.hostcreators.sk:3318";
$username = "u27963_electroidk"; // Default MySQL username for XAMPP
$password = "R8-sL6Ie2zB.!!z0";     // Default MySQL password is usually empty in XAMPP
$database = "d27963_electroidk"; // Change to your actual database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>