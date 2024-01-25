<?php
// Include the database connection file
include('db_connection.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

// Get the logged-in user's email
$userEmail = $_SESSION['email'];

// Query to retrieve user trips with details
$query = "SELECT user_trips.*, trips.destination_name
          FROM user_trips
          INNER JOIN trips ON user_trips.trip_id = trips.id
          WHERE user_trips.user_id = (SELECT id FROM users WHERE email = ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $userEmail);
$stmt->execute();
$result = $stmt->get_result();

// Fetch user trips
$userTrips = $result->fetch_all(MYSQLI_ASSOC);

// Close the database connection

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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

        .trip {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #fff;
        }

        .review {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #fff;
        }

        .star-rating {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            width: 10%;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            cursor: pointer;
            font-size: 24px;
            color: #ddd;
        }


        
    </style>
</head>
<body>
    <h2>User Profile</h2>

    <?php if (!empty($userTrips)): ?>
        <?php foreach ($userTrips as $trip): ?>
            <div class="trip">
                <h3><?php echo htmlspecialchars($trip['destination_name']); ?></h3>
                <p>Date: <?php echo htmlspecialchars($trip['date']); ?></p>
                <p>Duration: <?php echo htmlspecialchars($trip['duration']); ?> days</p>
                <p>Final Price: <?php echo number_format($trip['final_price'], 2); ?>€</p>

                <?php
                // Check if the user has already written a review for this trip
                $reviewQuery = "SELECT * FROM reviews WHERE user_id = (SELECT id FROM users WHERE email = ?) AND trip_id = ?";
                $reviewStmt = $conn->prepare($reviewQuery);
                $reviewStmt->bind_param('si', $userEmail, $trip['trip_id']);
                $reviewStmt->execute();
                $reviewResult = $reviewStmt->get_result();
                $stmt->close();
                $conn->close();
                if ($reviewResult->num_rows === 0) { // User hasn't written a review
                ?>
                    <div class="review">
                        <h4>Write a Review</h4>
                        <form action="review_confirmation.php" method="post">
                            <input type="hidden" name="trip_id" value="<?php echo $trip['trip_id']; ?>">

                            <label for="rating">Rating:</label>
                            <div class="star-rating">
                            <input type="radio" id="star1" name="rating" value="1"><label id="1" for="star1">&#9733;</label>
                            <input type="radio" id="star2" name="rating" value="2"><label id="2" for="star2">&#9733;</label>
                            <input type="radio" id="star3" name="rating" value="3"><label id="3" for="star3">&#9733;</label>
                            <input type="radio" id="star4" name="rating" value="4"><label id="4" for="star4">&#9733;</label>
                            <input type="radio" id="star5" name="rating" value="5"><label id="5" for="star5">&#9733;</label>
                            </div>


                            <label for="content">Review:</label>
                            <textarea name="content" rows="4" required></textarea>
                            <br />
                            <input type="submit" name = "submit_review" value="Submit Review">
                        </form>
                    </div>
                <?php } else { // User has already written a review ?>
                    <div class="review">
                        <h4>Your Review</h4>
                        <?php $userReview = $reviewResult->fetch_assoc(); ?>
                        <p>Rating: <?php echo htmlspecialchars($userReview['rating']); ?>/5</p>
                        <p>Review: <?php echo htmlspecialchars($userReview['content']); ?></p>
                    </div>
                <?php } ?>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No trips found for this user.</p>
    <?php endif; ?>
    <script>
  function changeColor() {
    // Get the selected radio button value
    var selectedValue = document.querySelector('input[name="rating"]:checked').value;

    // Loop through all labels and change their color based on the selected value
    for (var i = 1; i <= 5; i++) {
      var label = document.getElementById(i.toString());
      if (i <= selectedValue) {
        // Change color for labels with id smaller than or equal to the selected value
        label.style.color = 'gold'; // You can change 'gold' to any color you prefer
      } else {
        // Reset color for labels with id greater than the selected value
        label.style.color = '#ddd'; // You can change 'black' to any default color
      }
    }
  }

  // Attach the function to the "change" event of radio buttons
  var radioButtons = document.querySelectorAll('input[name="rating"]');
  radioButtons.forEach(function(radioButton) {
    radioButton.addEventListener('change', changeColor);
  });
</script>
</body>
</html>
