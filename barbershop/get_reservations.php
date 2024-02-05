<?php
// Include the database connection file
include 'db_connection.php';

// Get the date parameter from the AJAX request
$date = $_GET['date'];

// SQL query to retrieve distinct hours for the specified day
$sql = "SELECT Hour
        FROM Reservations
        WHERE DATE(Time) = '$date'";

$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Fetch the results and encode them as JSON
    $hours = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($hours);
} else {
    // No reservations for the specified day
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
