<?php
include('db_connection.php');

session_start();

// Function to get user ID from session or authentication mechanism
if (isset($_SESSION['email']) && $_SESSION['email'] != "") {
    // Get the user email from the session
    $userEmail = $_SESSION['email'];

    // Perform a database query to retrieve the user information based on the email
    $userInfoSql = "SELECT * FROM users WHERE email = '$userEmail'";
    $userInfoResult = $conn->query($userInfoSql);

    if ($userInfoResult->num_rows > 0) {
        // Fetch the user information
        $userInfo = $userInfoResult->fetch_assoc();
        $userId = $userInfo['user_id'];

        // Now, $userId contains the user ID associated with the email in the session
    }

}

else {
    header("Location: login.php");
    exit();
}

// Handle the order placement
// Fetch the products in the shopping cart for the specific user
$cartSql = "SELECT p.name, p.price, sc.quantity
            FROM shopping_cart sc
            JOIN products p ON sc.product_id = p.product_id
            WHERE sc.user_id = $userId";
$cartResult = $conn->query($cartSql);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {

    // Display the receipt
    if ($cartResult->num_rows > 0) {
        echo "<h2>Potvrdenie Objednávky</h2>";
        echo "<p>Vaša objednávka bola úspešne odoslaná. Ďakujeme!</p><br/>";
        echo "<p><strong>Objednané produkty:</strong></p>";
        while ($cartRow = $cartResult->fetch_assoc()) {
            echo "<p>" . $cartRow['quantity'] . ' x ' . $cartRow['name'] . ' - ' . $cartRow['price'] . "</p>";
        }

        // Calculate and display total price
        $totalPrice = 0;
        $cartResult->data_seek(0); // Reset the result set pointer
        while ($cartRow = $cartResult->fetch_assoc()) {
            $totalPrice += $cartRow['price'] * $cartRow['quantity'];
        }
        echo "<p><strong>Celková cena:</strong> $totalPrice</p>";

        // Delete shopping cart rows associated with the user
        $deleteCartSql = "DELETE FROM shopping_cart WHERE user_id = $userId";
        $conn->query($deleteCartSql);

    } else {
        echo "<p>Váš nákupný košík je prázdny.</p>";
    }

    // Redirect back to the index page or display a success message
    echo "<p><a href='index.php'>Prejsť na Index</a></p>";
    exit();
}

// ... (rest of your HTML/PHP code)

$conn->close();
?>

<!DOCTYPE html>
<html lang="sk"> <!-- Set the language to Slovak -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potvrdenie Objednávky</title>
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
    <h2>Potvrdenie Objednávky</h2>
    <?php
    if ($cartResult->num_rows > 0) {

        // Display user information
        echo "<p><strong>Dodacie udaje:</strong></p>";
        echo "<p><strong>Email:</strong> " . $userInfo['email'] . "</p>";
        echo "<p><strong>Meno:</strong> " . $userInfo['first_name'] . " " . $userInfo['last_name'] . "</p>";
        echo "<p><strong>Telefónne číslo:</strong> " . $userInfo['phone_number'] . "</p>";
        echo "<p><strong>Adresa:</strong><br>";
        echo $userInfo['address_line1'] . "<br>";
        if (!empty($userInfo['address_line2'])) {
            echo $userInfo['address_line2'] . "<br>";
        }
        echo $userInfo['city'] . ", " . $userInfo['state'] . " " . $userInfo['zip_code'] . "</p>";

        // Display ordered products
        echo "<p><strong>Objednané produkty:</strong></p>";
        while ($cartRow = $cartResult->fetch_assoc()) {
            echo "<p>" . $cartRow['quantity'] . ' x ' . $cartRow['name'] . ' - ' . $cartRow['price'] . "</p>";
        }

        // Calculate and display total price
        $totalPrice = 0;
        $cartResult->data_seek(0); // Reset the result set pointer
        while ($cartRow = $cartResult->fetch_assoc()) {
            $totalPrice += $cartRow['price'] * $cartRow['quantity'];
        }
        echo "<p><strong>Celková cena:</strong> $totalPrice</p>";
    }
    ?>
    <form method="post" action="">
        <input type="submit" name="place_order" value="Odoslať Objednávku">
    </form>

    <p><a href="index.php">Prejsť na Index</a></p>
</body>
</html>
