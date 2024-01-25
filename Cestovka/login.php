<?php
include('db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the user exists in the database
    $checkUserQuery = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows == 1) {
        // Login successful, set session variable
        $_SESSION["email"] = $email;
        header("Location: index.php"); // Redirect to a welcome page
    } else {
        echo "Login failed. Check your email and password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</body>
</html>
