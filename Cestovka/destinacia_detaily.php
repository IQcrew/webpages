<?php
// Include the database connection file
include('db_connection.php');
session_start();
// Retrieve destination ID from the GET method
$destinationId = isset($_GET['destination_id']) ? $_GET['destination_id'] : null;

// Validate destination ID
if ($destinationId === null || !is_numeric($destinationId)) {
    echo "Invalid destination ID";
    exit();
}
if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_trip'])) {
        // Process the form submission and insert a row into the user_trips table
        $query = "INSERT INTO user_trips (user_id, trip_id, date, duration, final_price, number_of_people, birth_number, address, psc, phone_number)
                  VALUES ((SELECT id FROM users WHERE email = ?), ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Set parameters for the prepared statement
        $userEmail = $_SESSION['email'];
        $date = isset($_POST['trip_date']) ? $_POST['trip_date'] : date('Y-m-d'); // Use the provided date or the current date
        $duration = isset($_POST['trip_duration']) ? $_POST['trip_duration'] : 7; // Use the provided duration or a default value    
        $finalPrice = $_POST['final_price']; // Example price (you can customize this)
        $numberOfPeople = isset($_POST['number_of_people']) ? $_POST['number_of_people'] : 1; // Example input field
        $birthNumber = isset($_POST['birth_number']) ? $_POST['birth_number'] : ''; // Example input field
        $address = isset($_POST['address']) ? $_POST['address'] : ''; // Example input field
        $psc = isset($_POST['psc']) ? $_POST['psc'] : ''; // Example input field
        $phoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : ''; // Example input field

        // Bind parameters to the prepared statement
        $stmt->bind_param('sisisissss', $userEmail, $destinationId, $date, $duration, $finalPrice, $numberOfPeople, $birthNumber, $address, $psc, $phoneNumber);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Trip purchased successfully!";
        } else {
            echo "Error purchasing trip: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Query to retrieve destination details and related reviews
$query = "SELECT trips.*, GROUP_CONCAT(reviews.content ORDER BY reviews.created_at DESC) as review_content,
                 IFNULL(ROUND(AVG(reviews.rating), 1), '-') as avg_rating
          FROM trips
          LEFT JOIN reviews ON trips.id = reviews.trip_id
          WHERE trips.id = ?
          GROUP BY trips.id";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $destinationId);
$stmt->execute();
$result = $stmt->get_result();

// Fetch destination details
$destinationDetails = $result->fetch_assoc();

$query = "SELECT content, rating
          FROM reviews
          WHERE trip_id = ".$destinationId;

$stmt = $conn->prepare($query);
$stmt->execute();
$resultReviews = $stmt->get_result();


// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destination Details</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        div.destination-details {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
            margin: 20px auto;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        div.destination-details img {
            display: block;
            margin: 10px auto;
            max-width: 100%;
            height: auto;
        }

        div.review {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
        }

        form {
            margin-top: 20px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-top: 10px;
        }

        form input, form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .star-rating {
            display: inline-block;
            font-size: 1.5em;
            color: #ffcc00; /* Star color */
        }

        .star-rating::before {
            content: "\2605"; /* Unicode character for a filled star */
        }

        .no-rating::before {
            content: "\2606"; /* Unicode character for an empty star */
        }
    </style>
</head>
<body>
    <h2>Destination Details</h2>

    <?php if ($destinationDetails): ?>
        <div class="destination-details">
            <h3><?php echo htmlspecialchars($destinationDetails['destination_name']); ?></h3>
            <p><?php echo htmlspecialchars($destinationDetails['description']); ?></p>
            <p>Price: <?php echo number_format($destinationDetails['price'], 2); ?>€</p>
            <p>Average Rating: <?php echo ($destinationDetails['avg_rating'] !== '-') ? $destinationDetails['avg_rating'] : 'N/A'; ?></p>
            <img src="<?php echo htmlspecialchars($destinationDetails['image_path']); ?>" alt="Destination Image" width="400">

            <?php if (!empty($destinationDetails['review_content'])): ?>
                <h4>Reviews:</h4>
                <?php foreach ($resultReviews as $review): ?>
                    <div class="review">
                        <?php 
                        for ($x = 0; $x < $review['rating']; $x++) {
                            echo '<div class="star-rating" title="User Rating: "></div>';
                          }
                        ?>
                        <br />
                        <?php echo htmlspecialchars($review['content']); ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No reviews available for this destination.</p>
            <?php endif; ?>
        </div>
        <?php if (isset($_SESSION['email'])): ?>
                <!-- Form to buy the trip -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?destination_id=<?php echo $destinationId; ?>" method="post" style="margin-top: 20px;">
                    <label for="number_of_people">Number of People:</label>
                    <input type="number" name="number_of_people" id="number_of_people" min="1" value="1" onchange="updateFinalPrice()" required>

                    <label for="trip_date">Trip Date:</label>
                    <input type="date" name="trip_date" id="trip_date" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">

                    <label for="trip_duration">Trip Duration (in days):</label>
                    <input type="number" name="trip_duration" id="trip_duration" min="7" value="7" onchange="updateFinalPrice()" required>
                    
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" id="phone_number" required>

                    <label for="birth_number">Birth Number:</label>
                    <input type="text" name="birth_number" id="birth_number" required>

                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" required>

                    <label for="psc">PSC:</label>
                    <input type="text" name="psc" id="psc" required>

                    <label for="final_price">Final Price:</label>
                    <input type="text" name="final_price" id="final_price" readonly>

                    <input type="submit" name="buy_trip" value="Buy Trip">
                </form>
            <?php else: ?>
                <p>Login to purchase this trip.</p>
            <?php endif; ?>
    <?php else: ?>
        <p>Destination not found.</p>
    <?php endif; ?>
    
    <script>
        function updateFinalPrice() {
            var price = <?php echo $destinationDetails['price']; ?>; // Get the price from PHP
            var duration = parseInt(document.getElementById('trip_duration').value);
            var numberOfPeople = parseInt(document.getElementById('number_of_people').value);
            var finalPrice = price * duration * numberOfPeople;
            
            document.getElementById('final_price').value = finalPrice.toFixed(2) + '€';
        }
        
        // Initialize final price on page load
        updateFinalPrice();
    </script>
</body>
</html>
