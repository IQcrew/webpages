<?php
include 'auth.php';
include 'header.php';
include 'db_connection.php';


$userEmail = $_SESSION['email'];

$sqlUserInfo = "SELECT * FROM Users WHERE Email = '$userEmail'";
$resultUserInfo = $conn->query($sqlUserInfo);
$rowUserInfo = $resultUserInfo->fetch_assoc();

$sqlUserOrders = "SELECT * FROM Orders WHERE UserID = (SELECT UserID FROM Users WHERE Email = '$userEmail')";
$resultUserOrders = $conn->query($sqlUserOrders);

$sqlUserAppointments = "SELECT * FROM Reservations WHERE Email = '$userEmail'";
$resultUserAppointments = $conn->query($sqlUserAppointments);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    if(isset($_POST['password']) && strlen($_POST['password'] >4)){
        $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sqlUpdateUser = "UPDATE Users SET FirstName = '$firstName', LastName = '$lastName', Password = '$newPassword' , PhoneNumber = '$phoneNumber' WHERE Email = '$userEmail'";

    }
else{
    $sqlUpdateUser = "UPDATE Users SET FirstName = '$firstName', LastName = '$lastName', PhoneNumber = '$phoneNumber' WHERE Email = '$userEmail'";
}

    if ($conn->query($sqlUpdateUser) === TRUE) {
        header("Location: profil.php");
        exit();
    } else {
        echo "Chyba pri aktualizácii informácií o používateľovi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Užívateľský profil</title>
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
            padding: 20px;
            background-color: #ffffff3d;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        h3{
            text-align: center;
        }
        .user-info {
            margin-bottom: 20px;
            border-bottom: 0px solid #ccc;
            padding-bottom: 20px;
            padding-right: 30%;
        }

        .user-info label {
            font-weight: bold;
        }

        .user-info p {
            margin: 5px 0;
        }

        .order-history {
            margin-top: 20px;
        }

        .order-history h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .order-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .order-item p {
            margin: 5px 0;
        }
        .form-label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-input {

            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 0px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .submit-btn {
            
            padding: 20px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
        .flex-box {
            display: flex;
            flex-direction: row;
        }
        .flex-box div{
            flex: 1; 
            box-sizing: border-box;
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
            text-transform: uppercase;
        }

        td {
        }
    </style>
</head>
<body>
<div style="min-height: 87vh;">
<div class="container">
    <div class="flex-box">

        <div class="user-info">
            <h2>Užívateľský profil</h2>
            <h3>Informácie o používateľovi</h3>
            <form action="profil.php" method="post">
                <p><label>E-mail:</label> <?php echo $rowUserInfo['Email']; ?></p>
                <p><label for="password">Heslo:</label>
                <input type="text" id="password" name="password" class="form-input" minlength="5"></p>
                <p><label for="firstName">Meno:</label>
                <input type="text" id="firstName" name="firstName" class="form-input" value="<?php echo $rowUserInfo['FirstName']; ?>"></p>
                <p><label for="lastName">Priezvisko:</label>
                <input type="text" id="lastName" name="lastName" class="form-input" value="<?php echo $rowUserInfo['LastName']; ?>"></p>
                <p><label for="phoneNumber">Telefónne číslo:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" class="form-input" value="<?php echo $rowUserInfo['PhoneNumber']; ?>"></p>
                <input type="submit" value="Uložiť zmeny" class="form-input submit-btn">
            </form>
        </div>
        <div>
        <h3>Termíny rezervácií</h3>
        <?php if ($resultUserAppointments->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>Dátum</th>
                    <th>Hodina</th>
                    <th>Služba</th>
                </tr>
                <?php while ($rowAppointment = $resultUserAppointments->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $rowAppointment['Time']; ?></td>
                        <td><?php echo $rowAppointment['Hour']; ?>:00</td>
                        <td><?php echo $rowAppointment['Sluzba']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>Neboli nájdené žiadne termíny rezervácií.</p>
        <?php endif; ?>
        </div>
    </div>
    <div class="order-history">
    <h3>História objednávok</h3>
    <?php if ($resultUserOrders->num_rows > 0) : ?>
        <?php while ($rowOrder = $resultUserOrders->fetch_assoc()) : ?>
            <div class="order-item">
                <p><label>ID objednávky:</label> <?php echo $rowOrder['OrderID']; ?></p>
                <?php
                $orderId = $rowOrder['OrderID'];
                $sqlOrderItems = "SELECT oi.Quantity, oi.ProductName, oi.ProductPrice FROM orderitems oi WHERE oi.OrderID = '$orderId'";
                $resultOrderItems = $conn->query($sqlOrderItems);
                $totalPrice = 0;
                ?>
                <div class="flex-box">

                    <div>
                        <p><label>Adresa doručenia:</label> <?php echo $rowOrder['ShippingAddress']; ?></p>
                        <p><label>Mesto:</label> <?php echo $rowOrder['City']; ?></p>
                        <p><label>PSČ:</label> <?php echo $rowOrder['PostalCode']; ?></p>
                        <p><label>Krajina:</label> <?php echo $rowOrder['Country']; ?></p>
                        <p><label>Dátum objednávky:</label> <?php echo $rowOrder['OrderDate']; ?></p>
                    </div>
                    <div>
                        <p><label>Objednané produkty:</label></p>
                        <ul>
                            <?php while ($rowOrderItem = $resultOrderItems->fetch_assoc()) : ?>
                            <li><?php echo $rowOrderItem['ProductName']; ?> - <?php echo $rowOrderItem['ProductPrice']; ?>€ (Množstvo: <?php echo $rowOrderItem['Quantity']; ?>)</li>
                            <?php
                        $totalPrice += $rowOrderItem['ProductPrice'] * $rowOrderItem['Quantity'];
                        ?>
                    <?php endwhile; ?>
                </ul>
                <p><label>Celková cena:</label> <?php echo $totalPrice; ?>€</p>
            </div>
        </div>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>Neboli nájdené žiadne objednávky.</p>
    <?php endif; ?>
</div>


</div>
</div>
<?php include 'footer.html'; ?>
</body>
</html>
