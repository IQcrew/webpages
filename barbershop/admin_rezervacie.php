<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto; /* Allow horizontal scroll if table is wider than container */
        }
        h2 {
            color: #333;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px; /* Increase padding for better readability */
            text-align: left;
            word-wrap: break-word; /* Wrap long text within cells */
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold; /* Make table header text bold */
        }
        tr:nth-child(even) {
            background-color: #f9f9f9; /* Alternate row background color */
        }
        tr:hover {
            background-color: #f2f2f2; /* Highlight row on hover */
        }
        .button-container {
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
    <h2>Rezervácie</h2>
    <div class="button-container">
        <button onclick="window.location.href = 'admin_panel.php';">Speť</button>
    </div>
    <table>
        <tr>
        <th>ID</th>
        <th>Dátum</th>
        <th>Hodina</th>
        <th>Produkt</th>
        <th>Meno</th>
        <th>Priezvisko</th>
        <th>Email</th>
        <th>Telefónne číslo</th>
        </tr>

        <?php
        // Include the database connection file
        include 'db_connection.php';

        // Select all reservations from the database
        $sql = "SELECT * FROM Reservations";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ReservationID"] . "</td>";
                echo "<td>" . $row["Time"] . "</td>";
                echo "<td>" . $row["Hour"] . "</td>";
                echo "<td>" . $row["Product"] . "</td>";
                echo "<td>" . $row["FirstName"] . "</td>";
                echo "<td>" . $row["LastName"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "<td>" . $row["PhoneNumber"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No reservations found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
