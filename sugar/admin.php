<?php
include('db_connection.php');

// Check if the user is an admin or redirect if not
// (You may need to implement your own authentication and authorization mechanism)
session_start();

if (isset($_SESSION['email']) && $_SESSION['email'] == "admin@spsknm.com") {
    // admin logged
}
else{
    header("Location: login.php");
}
// Fetch all orders with user information
$ordersSql = "SELECT o.order_id, o.user_id, o.order_date, o.total_amount, o.status,
                      u.email, u.first_name, u.last_name, u.phone_number, 
                      o.shipping_address_line1, o.shipping_address_line2,
                      o.shipping_city, o.shipping_state, o.shipping_zip_code
               FROM orders o
               JOIN users u ON o.user_id = u.user_id ORDER BY order_date DESC";
$ordersResult = $conn->query($ordersSql);

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f8f8f8;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        .details {
            display: none;
        }

        a {
            text-decoration: none;
            color: #007bff;
            cursor: pointer;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Admin Panel - Orders</h2>
    
    <?php
    if ($ordersResult->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>ID objednávky</th>
                <th>Email používateľa</th>
                <th>Meno používateľa</th>
                <th>Telefónne číslo</th>
                <th>Dátum objednávky</th>
                <th>Celková suma</th>
                <th>Stav</th>
                <th>Podrobnosti</th>
             </tr>";

        while ($orderRow = $ordersResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$orderRow['order_id']}</td>";
            echo "<td>{$orderRow['email']}</td>";
            echo "<td>{$orderRow['first_name']} {$orderRow['last_name']}</td>";
            echo "<td>{$orderRow['phone_number']}</td>";
            echo "<td>{$orderRow['order_date']}</td>";
            echo "<td>{$orderRow['total_amount']}€</td>";
            $selectedStatus = $orderRow["status"];
            echo '<td><select id="'.$orderRow['order_id'].'" onchange="handleSelectionChange('.$orderRow['order_id'].')">
                <option value="Objednane" ' . ($selectedStatus == "Objednane" ? 'selected' : '') . '>Objednané</option>
                <option value="Odoslane" ' . ($selectedStatus == "Odoslane" ? 'selected' : '') . '>Odoslané</option>
                <option value="Dorucene" ' . ($selectedStatus == "Dorucene" ? 'selected' : '') . '>Doručené</option>
                </select></td>';
            echo "<td><a onclick=\"toggleDetails('details_{$orderRow['order_id']}')\">View Details</a></td>";
            echo "</tr>";

            // Display details in an expandable row
            echo "<tr class='details' id='details_{$orderRow['order_id']}' style='background-color: #f9f9f9;'><td colspan='8'>";
            echo "<strong>Order Details:</strong>";

            echo "<p><strong>Dodacie udaje:</strong></p>";
            echo "<p><strong>Email:</strong> {$orderRow['email']}</p>";
            echo "<p><strong>Meno:</strong> {$orderRow['first_name']} {$orderRow['last_name']}</p>";
            echo "<p><strong>Telefónne číslo:</strong> {$orderRow['phone_number']}</p>";
            echo "<p><strong>Adresa:</strong><br>";
            echo "{$orderRow['shipping_address_line1']}<br>";
            if (!empty($orderRow['shipping_address_line2'])) {
                echo "{$orderRow['shipping_address_line2']}<br>";
            }
            echo "{$orderRow['shipping_city']}, {$orderRow['shipping_state']} {$orderRow['shipping_zip_code']}</p>";

            // Fetch and display order items
            $orderItemsSql = "SELECT oi.product_id, p.name, oi.quantity, oi.price 
                              FROM order_items oi 
                              JOIN products p ON oi.product_id = p.product_id 
                              WHERE oi.order_id = {$orderRow['order_id']}";
            $orderItemsResult = $conn->query($orderItemsSql);

            if ($orderItemsResult->num_rows > 0) {
                echo "<p><strong>Produkty:</strong><br>";
                echo "<ul>";
                while ($itemRow = $orderItemsResult->fetch_assoc()) {
                    echo "<li>{$itemRow['quantity']} x {$itemRow['name']} - {$itemRow['price']}€</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No items in this order.</p>";
            }

            echo "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No orders available.</p>";
    }

    // JavaScript to toggle display of details
    echo "<script>
            function toggleDetails(detailsId) {
                var details = document.getElementById(detailsId);
                details.style.display = (details.style.display === 'none') ? 'table-row' : 'none';
            }
          </script>";
    ?>

</body>
<script>
  function handleSelectionChange(orderId) {
    var selectedValue = event.target.value;

    // Make an AJAX request to update the status
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    // Set the parameters to send in the request
    var params = "order_id=" + orderId + "&new_status=" + selectedValue;

    // Set up the callback function
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Request was successful, you can perform additional actions if needed
                console.log("Status updated successfully");
            } else {
                // Request failed, handle the error
                console.error("Failed to update status");
            }
        }
    };

    // Send the request
    xhr.send(params);
  }
</script>
</html>
