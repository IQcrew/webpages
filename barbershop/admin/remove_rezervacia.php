<?php
include '..\db_connection.php';

if(isset($_GET['id'])) {
    $reservationID = $_GET['id'];

    $sql = "DELETE FROM Reservations WHERE ReservationID = $reservationID";

    if ($conn->query($sql) === TRUE) {
        header("Location: rezervacie.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No Reservation ID provided";
}

$conn->close();
?>
