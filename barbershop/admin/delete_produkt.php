<?php
include '../db_connection.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $sql = "DELETE FROM Products WHERE ProductID = $productId";
    if ($conn->query($sql) === TRUE) {
        header("Location: produkty.php");
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

$conn->close();
?>
