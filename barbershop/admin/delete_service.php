<?php

include '../db_connection.php';
include 'admin_auth.php';

if (isset($_GET['id'])) {

    $sluzbaID = $_GET['id'];

    $sql = "DELETE FROM sluzby WHERE sluzba_id = $sluzbaID";

    if ($conn->query($sql) === TRUE) {
        header('Location: produkty.php');
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    echo "No product ID provided";
}

$conn->close();
?>
