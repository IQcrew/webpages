<?php
// update_status.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['new_status'];

    include("db_connection.php");

    // Perform the database update
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $stmt->bind_param("si", $newStatus, $orderId);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Database update failed']);
    }

    // Close the statement
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    echo json_encode(['error' => 'Invalid request method']);
}
?>