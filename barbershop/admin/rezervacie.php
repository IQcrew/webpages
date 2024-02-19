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
        .deleteBtn{
            display: inline-block;
            margin: 5px;
            margin-right: 10px;
            padding: 8px 16px;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
            background-color: #ff5f5f;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }
        .deleteBtn:hover{
            background-color: #ff0000;
        }
    </style>
</head>
<?php 
include 'admin_auth.php';
include 'header.php'; ?>
<body>
<div class="container">
    <h2>Rezervácie</h2>
    <table>
        <tr>
        <th></th>
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
        
        $sql = "SELECT * FROM Reservations ORDER BY Time, Hour";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='remove_rezervacia.php?id=" . $row["ReservationID"] . "' class='deleteBtn'>Delete</a></td>";
                echo "<td>" . $row["Time"] . "</td>";
                echo "<td>" . $row["Hour"] . ":00</td>";
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
<?php include "../footer.html"; ?> 
</body>
</html>
