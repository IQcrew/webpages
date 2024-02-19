<?php
include '../db_connection.php';
include 'header.php';

$sql = "SELECT * FROM Orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Orders</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
        }
    </style>
</head>
<body>
    <div style="min-height:820px; margin-top: 80px;">
        <h2 style="text-align: center;">All Orders</h2>
        <table id="ordersTable">
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Shipping Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Country</th>
                <th>Order Date</th>
            </tr>
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr class="orderRow" data-orderid="<?php echo $row['OrderID']; ?>">
                        <td><?php echo $row['OrderID']; ?></td>
                        <td><?php echo $row['UserID']; ?></td>
                        <td><?php echo $row['ShippingAddress']; ?></td>
                        <td><?php echo $row['City']; ?></td>
                        <td><?php echo $row['PostalCode']; ?></td>
                        <td><?php echo $row['Country']; ?></td>
                        <td><?php echo $row['OrderDate']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">No orders found.</td>
                </tr>
            <?php endif; ?>
        </table>
        
        <!-- Container to display ordered items -->
        <div id="orderedItemsContainer" class="hidden">
            <h3>Ordered Items</h3>
            <ul id="orderedItemsList"></ul>
        </div>
    </div>

    <script>
        // Get all rows with class "orderRow"
        const orderRows = document.querySelectorAll('.orderRow');

        // Add click event listener to each row
        orderRows.forEach(row => {
            row.addEventListener('click', function() {
                // Get the order ID from the data-orderid attribute
                const orderId = this.getAttribute('data-orderid');

                // Call a function to fetch and display ordered items
                fetchOrderedItems(orderId);
            });
        });

        // Function to fetch and display ordered items
        function fetchOrderedItems(orderId) {
            fetch(`fetch_ordered_items.php?id=${orderId}`)
                .then(response => response.json())
                .then(data => {
                    // Display ordered items in the container
                    const orderedItemsList = document.getElementById('orderedItemsList');
                    orderedItemsList.innerHTML = '';
                    data.forEach(item => {
                        const listItem = document.createElement('li');
                        listItem.textContent = `${item.ProductName} - Quantity: ${item.Quantity}`;
                        orderedItemsList.appendChild(listItem);
                    });

                    // Show the container
                    const orderedItemsContainer = document.getElementById('orderedItemsContainer');
                    orderedItemsContainer.classList.remove('hidden');
                })
                .catch(error => console.error('Error fetching ordered items:', error));
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
