<?php
function getRandomString($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $keyString = getRandomString(19);
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    $product = $_POST['product'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];


    $sql = "INSERT INTO Reservations (Time, Hour, Sluzba, FirstName, LastName, Email, PhoneNumber, DeleteKey)
            VALUES ('$date', '$hour', '$product', '$firstName', '$lastName', '$email', '$phoneNumber', '$keyString')";

    if ($conn->query($sql) === TRUE) {

        $mail = new PHPMailer();


        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'barbershopsoc@gmail.com';
        $mail->Password = 'ozjrofbpxvcxldqx'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('barbershopsoc@gmail.com', "Barber shop");
        $mail->addAddress($email, '$firstName');

        $mail->Subject = 'Confirmation email';
        
        $mail->isHTML(true);
        $message = "
            <!DOCTYPE html>
            <html lang='sk'>
            <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Potvrdenie Rezervácie</title>
            <style>
                body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                }
                .container {
                max-width: 600px;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h1 {
                color: #333;
                }
                p {
                margin-bottom: 10px;
                line-height: 1.5;
                }
                .btn {
                display: inline-block;
                background-color: #00ff25;
                color: #fff;
                text-decoration: none;
                padding: 10px 20px;
                border-radius: 5px;
                margin-top: 15px;
                }
                .btn:hover {
                background-color: #0056b3;
                }
            </style>
            </head>
            <body>
            <div class='container'>
                <h1>Potvrdenie Rezervácie</h1>
                <p>Vážený/á $firstName $lastName,</p>
                <p>Ďakujeme Vám za rezerváciu u nás. Vaša rezervácia bola potvrdená s nasledujúcimi údajmi:</p>
                <p><strong>Dátum:</strong> $date</p>
                <p><strong>Hodina:</strong> ".$hour."</p>
                <p><strong>Produkt:</strong> $product</p>
                <p>Tešíme sa na Vašu návštevu. Ak máte nejaké otázky alebo potrebujete zmeniť Vašu rezerváciu, neváhajte nás kontaktovať.</p>
                <a href='http://localhost/barbershop/zrusenie_rezervacie.php?key=$keyString' class='btn'>Zrušiť Rezerváciu</a>
                <p>S pozdravom,<br>Barber Shop</p>
            </div>
            </body>
            </html>
            ";

        $mail->Body = $message;
        

        $conn->close();
        if ($mail->send()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Failed to send email. Error: " . $mail->ErrorInfo;
        }


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Form not submitted";
}

?>
