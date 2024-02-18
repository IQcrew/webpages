<?php
session_start();
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            if($email == "admin@it.com") {
                header("location: admin/produkty.php");
            }
            else{
                header("location: produkty.php");
            }
            exit;
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" 
     type="image/png" 
     href="src/logo.png">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            background: linear-gradient(-45deg, #009dff, #2c8897, #23a6d5, #01fffa);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
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
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            background-color: #ffffff3d;
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
        input[type="password"],
        input[type="submit"] {
            
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 0px solid #ccc;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    <h2 style="text-align:center;margin-top: 200px;">Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="password">Heslo:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Login">
        <br/>
        <div class="index-link">
            <a href="registration.php">Registrovať sa</a>
        </div>
        <br />
        <div class="index-link">
            <a href="produkty.php">Späť</a>
        </div>
    </form>
</body>
</html>
