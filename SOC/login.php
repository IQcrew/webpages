<?php
session_start(); // Start the session

// Function to validate phone number format
function isValidPhoneNumber($phoneNumber) {
    return preg_match('/^\+?\d{1,4}[-.\s]?\(?(\d{1,})\)?[-.\s]?(\d{1,})[-.\s]?(\d{1,})$/', $phoneNumber);
}

include('db_connection.php');

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists in the database (you should use prepared statements and hashed passwords)
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, start a session
        $_SESSION['email'] = $email;

        // Redirect to the index page
        header("Location: index.php");
        exit(); // Make sure to exit after sending the header
    } else {
        echo "<p>Login failed. Please check your credentials.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>
    <h2>User Login</h2>

    <form method="post" action="login.php">
        Email: <input type="text" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
