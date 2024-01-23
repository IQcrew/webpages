<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST["email"];
    $password = $_POST["password"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];

    // Check if the email is in a valid format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format. Please enter a valid email address.";
    } else {
        // Check if the email already exists
        $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            echo "Email already exists. Please choose a different email address.";
        } else {
            // Insert user into the database without hashing the password
            $insertUserQuery = "INSERT INTO users (email, password, first_name, last_name) 
                                VALUES ('$email', '$password', '$firstName', '$lastName')";
            
            if ($conn->query($insertUserQuery) === TRUE) {
                header("Location: login.php");
            } else {
                echo "Error: " . $insertUserQuery . "<br>" . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="">
        Email: <input type="text" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"><br>
        Password: <input type="password" name="password" required><br>
        First Name: <input type="text" name="first_name" required><br>
        Last Name: <input type="text" name="last_name" required><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
