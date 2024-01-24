<?php

// Include the database connection file
include('db_connection.php');
include('auth.php');
if ($_SESSION['email'] != 'admin@admin.com') {
    header("Location: index.php");
    exit();
}

// Define default values for filters
$searchTerm = '';
$minPrice = 0;
$maxPrice = 10000;
$searchString = '';

// Handle form submissions for filtering
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    $searchString = $searchTerm;
    $minPrice = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
    $maxPrice = isset($_GET['max_price']) ? $_GET['max_price'] : 10000;
}

// Query to retrieve destinations based on filters
$query = "SELECT * FROM trips 
          WHERE (destination_name LIKE ? 
          OR description LIKE ?)
          AND price BETWEEN ? AND ?";
$stmt = $conn->prepare($query);
$searchTerm = '%' . $searchTerm . '%';
$stmt->bind_param('ssdd', $searchTerm, $searchTerm, $minPrice, $maxPrice);
$stmt->execute();
$result = $stmt->get_result();

// Fetch destinations
$destinations = $result->fetch_all(MYSQLI_ASSOC);

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations</title>
    <script>
        // JavaScript to ensure min and max values are valid
        function updateMinMax() {
            var minPrice = document.getElementById('min_price');
            var maxPrice = document.getElementById('max_price');

            if (parseFloat(minPrice.value) > parseFloat(maxPrice.value)) {
                minPrice.value = maxPrice.value;
            }

            if (parseFloat(maxPrice.value) < parseFloat(minPrice.value)) {
                maxPrice.value = minPrice.value;
            }
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        form label {
            margin-right: 10px;
        }

        form input {
            margin-bottom: 10px;
        }

        div.destination {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #fff;
        }

        div.destination img {
            display: block;
            margin: 10px auto;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<h2>Destinations</h2>

<!-- Search Bar and Filters Form -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" oninput="updateMinMax()">
    <label for="search">Search:</label>
    <input type="text" name="search" value="<?php echo $searchString; ?>">

    <label for="min_price">Min Price:</label>
    <input type="number" name="min_price" id="min_price" min="0" value="<?php echo $minPrice; ?>">

    <label for="max_price">Max Price:</label>
    <input type="number" name="max_price" id="max_price" min="0" value="<?php echo $maxPrice; ?>">

    <input type="submit" value="Apply Filters">
</form>

<!-- Display Destinations -->
<?php foreach ($destinations as $destination): ?>
    <div class="destination">
        <h3><?php echo htmlspecialchars($destination['destination_name']); ?></h3>
        <p><?php echo htmlspecialchars($destination['description']); ?></p>
        <p>Price: $<?php echo number_format($destination['price'], 2); ?></p>
        <img src="<?php echo htmlspecialchars($destination['image_path']); ?>" alt="Destination Image" width="200">
        <form action="destinacia_detaily.php" method="get" style="margin-top: 10px;">
            <input type="hidden" name="destination_id" value="<?php echo $destination['id']; ?>">
            <input type="submit" value="Edit">
        </form>
    </div>
<?php endforeach; ?>

</body>
</html>
