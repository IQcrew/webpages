<?php

include '..\db_connection.php';
include 'admin_auth.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $price = $_POST['price'];


    $sql = "INSERT INTO sluzby (name, price) VALUES ('$name', '$price')";

    if ($conn->query($sql) === TRUE) {
        header('Location: sluzby.php');
        exit();
    } else {
        echo "Error adding product: " . $conn->error;
    }
}

$conn->close();
?>
