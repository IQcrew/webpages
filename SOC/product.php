<?php
include('db_connection.php');

$productId = $productName = $productDescription = $productPrice = $productImage = '';

// Function to get user ID from session or authentication mechanism
function getUserId() {
    // Implement your logic to get the user ID here
    // For example, if you're using sessions:
    session_start();
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

$productId = $_GET['product_id'];
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product_id'])) {

    $sql = "SELECT * FROM products WHERE product_id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productName = $row['name'];
        $productDescription = $row['description'];
        $productPrice = $row['price'];
        $productImage = $row['image_path'];
    } else {
        echo "<p>Product not found.</p>";
        exit();
    }
} 

// Handle adding to the shopping cart
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    session_start();
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
    else{
        header("Location: index.php");
    }

        // Check if the user is authenticated

        // Check if the product is already in the cart
        $checkSql = "SELECT * FROM shopping_cart WHERE user_id = $userId AND product_id = $productId";
        $checkResult = $conn->query($checkSql);
        $productQuantity = $_POST['quantity'];
        if ($checkResult->num_rows > 0) {
            // If the product is in the cart, increase the quantity
            $updateSql = "UPDATE shopping_cart SET quantity = quantity + $productQuantity WHERE user_id = $userId AND product_id = $productId";
            $conn->query($updateSql);
        } else {
            // If the product is not in the cart, add a new row with the specified quantity
            $insertSql = "INSERT INTO shopping_cart (user_id, product_id, quantity) VALUES ($userId, $productId, $productQuantity)";
            $conn->query($insertSql);
        }

        // Redirect to the index page after adding to the shopping cart
        header("Location: index.php");
        exit();
    } else {
        // Redirect to the login page if the user is not authenticated
        header("Location: login.php");
        exit();
    }
}
else {
    echo "<p>Invalid request.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $productName; ?> Details</title>
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

        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    
    <h2><?php echo $productName; ?> Details</h2>
    
    <table>
        <tr>
            <th>Product Name</th>
            <td><?php echo $productName; ?></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?php echo $productDescription; ?></td>
        </tr>
        <tr>
            <th>Price</th>
            <td><?php echo $productPrice; ?></td>
        </tr>
        <tr>
            <th>Product Image</th>
            <td><img src="<?php echo "imgs/".$productImage; ?>" alt="Product Image"></td>
        </tr>
    </table>

    <form method="post" action="">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="1" min="1">
        <input type="submit" name="add_to_cart" value="Add to Shopping Cart">
    </form>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
