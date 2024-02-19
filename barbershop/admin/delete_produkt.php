<?php
include '../db_connection.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $sqlDeleteProduct = "DELETE FROM Products WHERE ProductID = $productId";
    if ($conn->query($sqlDeleteProduct) === TRUE) {
        $sqlDeleteCartItems = "DELETE FROM Cart WHERE ProductID = $productId";
        if ($conn->query($sqlDeleteCartItems) === TRUE) {
            header("Location: produkty.php");
            exit();
        } else {
            echo "Error deleting cart items: " . $conn->error;
        }
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

$conn->close();
?>
