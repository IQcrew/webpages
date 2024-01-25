<?php
// Include the database connection file
include('db_connection.php');
include('auth.php');
if ($_SESSION['email'] != 'admin@admin.com') {
    header("Location: index.php");
    exit();
}
// Query to retrieve user trips with user details and destination name
$query = "SELECT user_trips.*, users.email, users.first_name, users.last_name, trips.destination_name
          FROM user_trips
          INNER JOIN users ON user_trips.user_id = users.id
          INNER JOIN trips ON user_trips.trip_id = trips.id";
$result = $conn->query($query);

// Fetch user trips
$userTrips = $result->fetch_all(MYSQLI_ASSOC);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Trips</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h2>User Trips</h2>

    <?php if (!empty($userTrips)): ?>
        <table>
            <thead>
                <tr>
                    <th>User Email</th>
                    <th>User Name</th>
                    <th>Destination Name</th>
                    <th>Date</th>
                    <th>Duration</th>
                    <th>Final Price</th>
                    <th>Number of People</th>
                    <th>Birth Number</th>
                    <th>Address</th>
                    <th>PSC</th>
                    <th>Phone Number</th>
                    <!-- Add other columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userTrips as $trip): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($trip['email']); ?></td>
                        <td><?php echo htmlspecialchars($trip['first_name'] . ' ' . $trip['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($trip['destination_name']); ?></td>
                        <td><?php echo htmlspecialchars($trip['date']); ?></td>
                        <td><?php echo htmlspecialchars($trip['duration']); ?> days</td>
                        <td><?php echo number_format($trip['final_price'], 2); ?>€</td>
                        <td><?php echo htmlspecialchars($trip['number_of_people']); ?></td>
                        <td><?php echo htmlspecialchars($trip['birth_number']); ?></td>
                        <td><?php echo htmlspecialchars($trip['address']); ?></td>
                        <td><?php echo htmlspecialchars($trip['psc']); ?></td>
                        <td><?php echo htmlspecialchars($trip['phone_number']); ?></td>
                        <!-- Add other columns as needed -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No user trips found.</p>
    <?php endif; ?>
</body>
</html>
