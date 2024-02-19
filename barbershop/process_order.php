<?php
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include 'auth.php';
include 'db_connection.php';
function getUserId($conn, $userEmail) {
    $sql = "SELECT UserID FROM Users WHERE Email = '$userEmail'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['UserID'];
}
function getUserInfo($conn, $userId) {
    $sql = "SELECT FirstName, LastName, Email FROM Users WHERE UserID = '$userId'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
}
function getCartProducts($conn, $userId) {
    $sql = "SELECT c.CartID, c.ProductID, p.Name, p.Description, p.Price, p.Image, c.Quantity FROM Cart c JOIN Products p ON c.ProductID = p.ProductID WHERE c.UserID = '$userId'";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
$userId = getUserId($conn, $_SESSION['email']);
$cartProducts = getCartProducts($conn, $userId);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $shippingAddress = $_POST['shippingAddress'];
        $city = $_POST['city'];
        $postalCode = $_POST['postalCode'];
        $country = $_POST['country'];
        $userInfo = getUserInfo($conn, $userId);
        $firstName = $userInfo['FirstName'];
        $lastName = $userInfo['LastName'];
        $email = $userInfo['Email'];
    
        $sql = "INSERT INTO Orders (UserID, ShippingAddress, City, PostalCode, Country) VALUES ('$userId', '$shippingAddress', '$city', '$postalCode', '$country')";
        if ($conn->query($sql) === TRUE) {
    
            $orderId = $conn->insert_id;
            $totalPrice = 0;
            foreach ($cartProducts as $product) {
                $pPrice = $product['Price'];
                $pName = $product['Name'];
                $totalPrice += $pPrice * $quantity;
                $productId = $product['ProductID'];
                $quantity = $product['Quantity'];
                $sql = "INSERT INTO OrderItems (OrderID, ProductName,ProductPrice, Quantity) VALUES ('$orderId', '$pName',' $pPrice', '$quantity')";
                $conn->query($sql);
            }
    
            $sql = "DELETE FROM Cart WHERE UserID = '$userId'";
            $conn->query($sql);
    
            $mail = new PHPMailer();


            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'barbershopsoc@gmail.com';
            $mail->Password = 'ozjrofbpxvcxldqx'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('barbershopsoc@gmail.com', "Barber shop");
            $mail->addAddress($email, $firstName);

            $mail->Subject = 'Confirmation email';
            
            $mail->isHTML(true);
            $message = "
                <!DOCTYPE html>
                <html lang='sk'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Potvrdenie objednávky</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f8f9fa;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            padding: 20px;
                            background-color: #ffffff;
                            border-radius: 10px;
                            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
                        }
                        h2 {
                            color: #333333;
                        }
                        .order-details {
                            margin-bottom: 20px;
                        }
                        .order-item {
                            padding: 10px;
                            background-color: #f2f2f2;
                            border-radius: 5px;
                            margin-bottom: 10px;
                        }
                        .product-name {
                            font-weight: bold;
                        }
                        .product-price {
                            color: #007bff;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h2>Potvrdenie objednávky</h2>
                        <div class='order-details'>
                            <p><strong>Dodacia adresa:</strong> $shippingAddress, $city, $postalCode, $country</p>
                            <p><strong>Meno:</strong> $firstName $lastName</p>
                            <p><strong>Email:</strong> $email</p>
                        </div>
                        <div class='ordered-items'>
                            <h3>Objednané položky:</h3>";
                            
                            foreach ($cartProducts as $product) {
                                $productName = $product['Name'];
                                $productPrice = $product['Price'];
                                $quantity = $product['Quantity'];
                                
                                $message .= "
                                <div class='order-item'>
                                    <p class='product-name'>$productName</p>
                                    <p>Počet: $quantity</p>
                                    <p class='product-price'>Cena: ".$productPrice."€</p>
                                </div>";
                            }

                $message .= "
                        </div>
                        <p><strong>Celková cena:</strong> $totalPrice €</p>
                    </div>
                </body>
                </html>";

            $mail->Body = $message;
            

            $conn->close();
            
            if ($mail->send()) {
                header("Location: profil.php");
                exit();
            } else {
                echo "Failed to send email. Error: " . $mail->ErrorInfo;
            }
            exit();
        } else {
            echo "Chyba: " . $sql . "<br>" . $conn->error;
        }
    }


?>