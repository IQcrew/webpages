<?php

include 'db_connection.php';


$date = $_GET['date'];


$sql = "SELECT Hour
        FROM Reservations
        WHERE DATE(Time) = '$date'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $hours = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($hours);
} else {
    echo json_encode([]);
}

$conn->close();
?>
