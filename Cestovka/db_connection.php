<?php
$host = "localhost";
$username = "root"; // Default MySQL username for XAMPP
$password = "";     // Default MySQL password is usually empty in XAMPP
$database = "cestovna_kancelaria"; // Change to your actual database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>