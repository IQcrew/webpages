<?php
include 'auth.php';
include 'db_connection.php';

function getCartProducts($conn, $userId) {
    $sql = "SELECT c.CartID, p.Name, p.Description, p.Price, p.Image, c.Quantity FROM Cart c JOIN Products p ON c.ProductID = p.ProductID WHERE c.UserID = '$userId'";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getUserId($conn, $userEmail) {
    $sql = "SELECT UserId FROM Users WHERE Email = '$userEmail'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['UserId'];
}

$userId = getUserId($conn, $_SESSION['email']);
$cartProducts = getCartProducts($conn, $userId);
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Nákupný Košík</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>


        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            margin-top: 80px;
            background: linear-gradient(-45deg, #009dff, #2c8897, #23a6d5, #00ffee);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        .container {
            max-width: 80%;
            margin: 50px auto;
            background-color: #ffffff3d;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ffffff0d;
        }

        th {
            background-color: #ffffff3d;
            color: #666;
            text-transform: uppercase;
        }

        td {
            color: #444;
        }

        .product-image {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .checkout-button {
            display: block;
            width: 200px;
            margin: 0 auto;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .checkout-button:hover {
            background-color: #0056b3;
        }

        .empty-cart-message {
            text-align: center;
            color: #666;
        }
        .remove-button {
            display: inline-block;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            background-color: #ff4444;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .remove-button:hover {
            background-color: #cc0000;
        }
    </style>

</head>
<body>
    <?php include 'header.php'; ?>
    <div style="min-height: 87vh;">
        <div class="container">
            <h2>Nákupný Košík</h2>
            <?php if(empty($cartProducts)): ?>
                <p class="empty-cart-message">Váš košík je prázdny.</p>
            <?php else: ?>
                <table>
                    <tr>
                        <th>Produkt</th>
                        <th>Popis</th>
                        <th>Cena</th>
                        <th>Množstvo</th>
                        <th>Obrázok</th>
                        <th></th>
                    </tr>
                    <?php foreach ($cartProducts as $product): ?>
                    <tr>
                        <td><?php echo $product['Name']; ?></td>
                        <td>
                            <?php
                            $description = $product['Description'];
                            $words = explode(' ', $description);
                            if (count($words) > 19) {
                                $description = implode(' ', array_slice($words, 0, 19)) . '...';
                            }
                            echo $description;
                            ?>
                        </td>
                        <td><?php echo $product['Price']; ?>€</td>
                        <td><?php echo $product['Quantity']; ?></td>
                        <td><img src="src/imagesUpload/<?php echo $product['Image']; ?>" alt="<?php echo $product['Name']; ?>" class="product-image"></td>
                        <td>
                            <form action="remove_from_cart.php" method="post">
                                <input type="hidden" name="cart_id" value="<?php echo $product['CartID']; ?>">
                                <button type="submit" class="remove-button">Odstrániť</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <a href="objednat.php" class="checkout-button">Pokračovať k Pokladni</a>
            <?php endif; ?>
        </div>
    </div>
    <?php include 'footer.html'; ?>
</body>
</html>
