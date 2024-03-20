<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" 
     type="image/png" 
     href="src/logo.png">
    <style>


    </style>
</head>
<?php 
include 'admin_auth.php';
include '..\db_connection.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['password']) && strlen($_POST['password'] >4)) {
        $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sqlUpdateUser = "UPDATE Users SET Password = '$newPassword' WHERE Email = 'admin@it.com'";
        $conn->query($sqlUpdateUser);
}



?>
<body>
<div class="container">
<form  method="post">
            <p><label for="password">Heslo:</label>
            <input type="text" id="password" name="password" class="" minlength="5"></p>
            <input type="submit" value="Uložiť zmeny" class="">
</form>
</div>
<?php include "../footer.html"; ?> 
</body>
</html>
