<!DOCTYPE html>
<html lang="sk">
<?php include 'header.php';
    include '..\db_connection.php';
    include 'admin_auth.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objednávky</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .orders-list {
            margin-top: 20px;
        }

        .order-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .filter-form {
            margin-bottom: 20px;
        }

        .filter-form label {
            font-weight: bold;
        }

        .filter-form input[type="date"] {
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 8px;
        }

        .filter-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .filter-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    <div style="margin-top:80px;min-height:87vh;">

    <div class="container">
        <h1>Všetky objednávky</h1>
        
        <form class="filter-form" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="start-date">Dátum začiatku:</label>
            <input type="date" id="start-date" name="start-date">
            
            <label for="end-date">Dátum konca:</label>
            <input type="date" id="end-date" name="end-date">
            
            <input type="submit" value="Filtrovať">
        </form>
        
        <div class="orders-list">
            <?php

            $sql = "SELECT * FROM Orders";

            if (isset($_GET['start-date']) && !empty($_GET['start-date']) && isset($_GET['end-date']) && !empty($_GET['end-date'])) {
                $startDate = $_GET['start-date'];
                $endDate = $_GET['end-date'];
                $sql = "SELECT * FROM Orders WHERE OrderDate BETWEEN '$startDate' AND '$endDate'";
            } elseif (isset($_GET['start-date']) && !empty($_GET['start-date'])) {
                $startDate = $_GET['start-date'];
                $sql = "SELECT * FROM Orders WHERE OrderDate > '$startDate'";
            } elseif (isset($_GET['end-date']) && !empty($_GET['end-date'])) {
                $endDate = $_GET['end-date'];
                $sql = "SELECT * FROM Orders WHERE OrderDate < '$endDate'";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='order-item'>";
                    echo "<p><strong>ID objednávky:</strong> " . $row["OrderID"] . "</p>";
                    echo "<p><strong>Dátum objednávky:</strong> " . $row["OrderDate"] . "</p>";
                    echo "<p><strong>Dodacia adresa:</strong> " . $row["ShippingAddress"] . ", " . $row["City"] . ", " . $row["PostalCode"] . ", " . $row["Country"] . "</p>";

                    $orderId = $row["OrderID"];
                    $items_sql = "SELECT * FROM orderitems WHERE OrderID = '$orderId'";
                    $items_result = $conn->query($items_sql);

                    if ($items_result->num_rows > 0) {
                        echo "<h3>Objednané položky:</h3>";
                        echo "<ul>";
                        while ($item_row = $items_result->fetch_assoc()) {
                            echo "<li>" . $item_row["ProductName"] . " - Množstvo: " . $item_row["Quantity"] . " - Cena: " . $item_row["ProductPrice"] . "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "Pre túto objednávku neboli nájdené žiadne položky.";
                    }

                    echo "</div>";
                }
            } else {
                echo "Žiadne objednávky neboli nájdené.";
            }
            $conn->close();
            ?>
        </div>
    </div>
    </div>
<?php include "../footer.html"; ?> 
</body>
</html>
