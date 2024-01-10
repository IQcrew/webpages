<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    
    <?php
    // Function to validate phone number format
    function isValidPhoneNumber($phoneNumber) {
        return preg_match('/^\+?\d{1,4}[-.\s]?\(?(\d{1,})\)?[-.\s]?(\d{1,})[-.\s]?(\d{1,})$/', $phoneNumber);
    }
    include('db_connection.php');
    // Handle registration form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $phoneNumber = $_POST['phone_number'];
        $addressLine1 = $_POST['address_line1'];
        $addressLine2 = $_POST['address_line2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipCode = $_POST['zip_code'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p>Invalid email format.</p>";
        } else if (!isValidPhoneNumber($phoneNumber)) {
            echo "<p>Invalid phone number format.</p>";
        } else {
            // Insert user data into the database (you should use prepared statements and hash the password)
            // Note: Replace 'your_database_connection' with your actual database connection logic
            $sql = "INSERT INTO users (email, password, first_name, last_name, phone_number, address_line1, address_line2, city, state, zip_code) 
                    VALUES ('$email', '$password', '$firstName', '$lastName', '$phoneNumber', '$addressLine1', '$addressLine2', '$city', '$state', '$zipCode')";
            $conn->query($sql);

            echo "<p>Registration successful!</p>";

            // Redirect to index page after successful registration
            header("Location: index.php");
            exit();
        }
    }
    ?>

    <form method="post" action="register.php">
        Email: <input type="text" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"><br>
        Password: <input type="password" name="password" required><br>
        First Name: <input type="text" name="first_name" required pattern="\p{L}{1,50}"><br>
        Last Name: <input type="text" name="last_name" required pattern="\p{L}{1,50}"><br>
        Phone Number: <input type="text" name="phone_number" pattern="^\+?\d{1,4}[-.\s]?\(?(\d{1,})\)?[-.\s]?(\d{1,})[-.\s]?(\d{1,})$"><br>
        Address Line 1: <input type="text" name="address_line1" pattern=".{1,255}"><br>
        Address Line 2: <input type="text" name="address_line2" pattern=".{1,255}"><br>
        City: <input type="text" name="city" pattern="\p{L}{1,50}"><br>
        State: <input type="text" name="state" pattern="\p{L}{1,50}"><br>
        Zip Code: <input type="text" name="zip_code" pattern="[0-9]{1,20}"><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
