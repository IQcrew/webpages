<?php
session_start();
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users (Email, FirstName, LastName, PhoneNumber, Password) VALUES ('$email', '$firstName', '$lastName', '$phoneNumber', '$password')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header("location: sluzby.php");
        exit;
    } else {
        echo "Chyba: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrácia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="email"],
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .index-link {
            text-align: center;
            margin-top: 20px;
        }
        .index-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .index-link a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Registrácia</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="firstName">Meno:</label>
        <input type="text" name="firstName" required>
        <label for="lastName">Priezvisko:</label>
        <input type="text" name="lastName" required>
        <label for="phoneNumber">Telefónne číslo:</label>
        <input type="text" name="phoneNumber" required>
        <label for="password">Heslo:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Registrovať sa">
    </form>
    <div class="index-link">
        <a href="index.php">Späť</a>
    </div>
</body>
</html>
