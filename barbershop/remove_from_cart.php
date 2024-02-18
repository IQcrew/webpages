<?php
include 'db_connection.php';
include 'auth.php';

if(isset($_POST['cart_id'])) {
    $cartId = $_POST['cart_id'];

    $sql = "DELETE FROM Cart WHERE CartID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cartId);
    
    if ($stmt->execute()) {
        header("Location: kosik.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: kosik.php");
    exit();
}
?>
