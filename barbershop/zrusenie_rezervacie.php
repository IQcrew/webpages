<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Reservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .success-msg {
            color: green;
            margin-bottom: 10px;
        }
        .error-msg {
            color: red;
            margin-bottom: 10px;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Include the database connection file
    include 'db_connection.php';

    // Check if the reservation ID is provided in the GET request
    if (isset($_GET['key'])) {
        // Sanitize the input to prevent SQL injection
        $reservationKey = $_GET['key'];

        // Delete the reservation from the database
        $sql = "DELETE FROM Reservations WHERE DeleteKey = '$reservationKey';";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="success-msg">Reservation deleted successfully</div>';
        } else {
            echo '<div class="error-msg">Error deleting reservation: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="error-msg">No reservation ID provided</div>';
    }

    // Close the database connection
    $conn->close();
    ?>

    <div class="button-container">
        <!-- Button for redirection to index page -->
        <button onclick="window.location.href = 'index.php';">Go to Index</button>
    </div>
</div>

</body>
</html>
