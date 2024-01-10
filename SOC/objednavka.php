<?php
include('db_connection.php');

session_start();

// Function to get user ID from session or authentication mechanism
if (isset($_SESSION['email']) && $_SESSION['email'] != "") {
    // Get the user email from the session
    $userEmail = $_SESSION['email'];

    // Perform a database query to retrieve the user ID based on the email
    $sql = "SELECT user_id FROM users WHERE email = '$userEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user ID
        $row = $result->fetch_assoc();
        $userId = $row['user_id'];

        // Now, $userId contains the user ID associated with the email in the session
    }
    
}

else {
    header("Location: login.php");
    exit();
}

// Handle the order placement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    // Fetch the products in the shopping cart for the specific user
    $cartSql = "SELECT p.name, p.price, sc.quantity
                FROM shopping_cart sc
                JOIN products p ON sc.product_id = p.product_id
                WHERE sc.user_id = $userId";
    $cartResult = $conn->query($cartSql);

    // Display the receipt
    if ($cartResult->num_rows > 0) {
        echo "<h2>Order Receipt</h2>";

        while ($cartRow = $cartResult->fetch_assoc()) {
            echo "<p>" . $cartRow['quantity'] . ' x ' . $cartRow['name'] . ' - ' . $cartRow['price'] . "</p>";
        }

        // Calculate and display total price
        $totalPrice = 0;
        $cartResult->data_seek(0); // Reset the result set pointer
        while ($cartRow = $cartResult->fetch_assoc()) {
            $totalPrice += $cartRow['price'] * $cartRow['quantity'];
        }
        echo "<p>Total Price: $totalPrice</p>";

        // Delete shopping cart rows associated with the user
        $deleteCartSql = "DELETE FROM shopping_cart WHERE user_id = $userId";
        $conn->query($deleteCartSql);

        echo "<p>Your order has been placed. Thank you!</p>";
    } else {
        echo "<p>Your shopping cart is empty.</p>";
    }

    // Redirect back to the index page or display a success message
    echo "<p><a href='index.php'>Go to Index</a></p>";
    exit();
}

// ... (rest of your HTML/PHP code)

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        p {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Order Confirmation</h2>

    <form method="post" action="">
        <input type="submit" name="place_order" value="Place Order">
    </form>

    <p><a href="index.php">Go to Index</a></p>
</body>
</html>
