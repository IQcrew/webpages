<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newFirstName = $_POST['new_first_name'];
    $newLastName = $_POST['new_last_name'];
    $newPhoneNumber = $_POST['new_phone_number'];
    $newAddressLine1 = $_POST['new_address_line1'];
    $newAddressLine2 = $_POST['new_address_line2'];
    $newCity = $_POST['new_city'];
    $newState = $_POST['new_state'];
    $newZipCode = $_POST['new_zip_code'];

    $email = $_SESSION['email'];
    $sql = "UPDATE users SET 
            first_name = '$newFirstName', 
            last_name = '$newLastName', 
            phone_number = '$newPhoneNumber', 
            address_line1 = '$newAddressLine1', 
            address_line2 = '$newAddressLine2', 
            city = '$newCity', 
            state = '$newState', 
            zip_code = '$newZipCode' 
            WHERE email = '$email'";
    $conn->query($sql);

    echo "<p>Profil úspešne aktualizovaný!</p>";

    $newPassword = $_POST['new_password'];
    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";
        $conn->query($sql);
        echo "<p>Heslo úspešne zmenené!</p>";
    }
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentFirstName = $row['first_name'];
    $currentLastName = $row['last_name'];
    $currentPhoneNumber = $row['phone_number'];
    $currentAddressLine1 = $row['address_line1'];
    $currentAddressLine2 = $row['address_line2'];
    $currentCity = $row['city'];
    $currentState = $row['state'];
    $currentZipCode = $row['zip_code'];
} else {
    echo "<p>Chyba: Informácie o používateľovi nenájdené.</p>";
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil používateľa</title>
    <link rel="stylesheet" type="text/css" href="profil.css">  
</head>
<body>
    <h2>Profil používateľa</h2>

    <p>Vitajte, <?php echo $currentFirstName . ' ' . $currentLastName; ?>!</p>

    <form method="post" action="profil.php">
        Nové meno: <input type="text" name="new_first_name" value="<?php echo $currentFirstName; ?>"><br>
        Nové priezvisko: <input type="text" name="new_last_name" value="<?php echo $currentLastName; ?>"><br>
        Nové telefónne číslo: <input type="text" name="new_phone_number" value="<?php echo $currentPhoneNumber; ?>"><br>
        Nová adresa : <input type="text" name="new_address_line1" value="<?php echo $currentAddressLine1; ?>"><br>
        Číslo D.: <input type="text" name="new_address_line2" value="<?php echo $currentAddressLine2; ?>"><br>
        Nové mesto: <input type="text" name="new_city" value="<?php echo $currentCity; ?>"><br>
        Nový štát: <input type="text" name="new_state" value="<?php echo $currentState; ?>"><br>
        Nový PSČ: <input type="text" name="new_zip_code" value="<?php echo $currentZipCode; ?>"><br>

        Nové heslo: <input type="password" name="new_password"><br>

        <input type="submit" value="Aktualizovať profil">
    </form>

    <p><a href="logout.php">Odhlásiť sa</a></p>
    <p><a href="index.php">Prejsť na Index</a></p>
</body>
</html>
