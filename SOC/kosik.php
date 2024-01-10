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

// Retrieve products in the shopping cart for the specific user
$cartSql = "SELECT p.product_id,p.name, p.price, sc.quantity
            FROM shopping_cart sc
            JOIN products p ON sc.product_id = p.product_id
            WHERE sc.user_id = $userId";
$cartResult = $conn->query($cartSql);

// Calculate total price
$totalPrice = 0;


// Handle deleting products from the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $productIdToDelete = $_POST['product_id_to_delete'];

    // Perform the delete operation (you may want to add more error handling)
    $deleteSql = "DELETE FROM shopping_cart WHERE user_id = $userId AND product_id = $productIdToDelete";
    $conn->query($deleteSql);

    // Redirect back to the shopping cart page
    header("Location: kosik.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .total-price {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Shopping Cart</h2>

    <?php if ($cartResult->num_rows > 0) : ?>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            <?php while ($cartRow = $cartResult->fetch_assoc()) : 
                $totalPrice += $cartRow['price'] * $cartRow['quantity'];
                ?>
                <tr>
                <td><a href="product.php?product_id=<?php echo $cartRow['product_id']; ?>"><?php echo $cartRow['name']; ?></a></td>
                    <td><?php echo $cartRow['price']; ?></td>
                    <td><?php echo $cartRow['quantity']; ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="product_id_to_delete" value="<?php echo $cartRow['product_id']; ?>">
                            <input type="submit" name="delete_product" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <div class="total-price">
            Total Price: <?php echo $totalPrice; ?>
        </div>

        <form method="post" action="objednavka.php">
            <input type="submit" value="Proceed to Order">
        </form>
    <?php else : ?>
        <p>Your shopping cart is empty.</p>
    <?php endif; ?>

    <form method="post" action="index.php">
        <input type="submit" value="Go to Index">
    </form>
</body>
</html>
