<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations</title>
    <link rel="stylesheet" href="style.css">
    <style>

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
        include '..\db_connection.php';
        include 'admin_auth.php';
        $sql = "SELECT * FROM Reservations";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ReservationID"] . "</td>";
                echo "<td>" . $row["Time"] . "</td>";
                echo "<td>" . $row["Hour"] . "</td>";
                echo "<td>" . $row["Sluzba"] . "</td>";
                echo "<td>" . $row["FirstName"] . "</td>";
                echo "<td>" . $row["LastName"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "<td>" . $row["PhoneNumber"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No reservations found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
