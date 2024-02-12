<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <link rel="icon" type="image/png" href="src/logo.png">
    <style>
        .grid-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            grid-gap: 20px;
            padding: 20px;
        }

        .product-card {
            flex-basis: calc(20% - 20px); 
            background-color: #ffffff;
            max-width: 300px;
            border-radius: 16px; 
            padding: 30px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        }

        .product-card:hover {
            transform: translateY(-5px); 
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 0px;
            background: linear-gradient(-45deg, #112633, #163349, #23a6d5, #407885);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;

        }
        .customButton{
            display : flex ;
            justify-content : space-around ;
        }
        .customButton{
            display : flex ;
            justify-content : space-around ;
        }
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

    </style>
</head>
<body>
<?php
session_start();
include 'db_connection.php';
include 'header.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $sql = "SELECT * FROM Products WHERE ProductID = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <div class="product-details">
            <h2><?php echo $row["Name"]; ?></h2>
            <img src="src/imagesUpload/<?php echo $row["Image"]; ?>" alt="<?php echo $row["Name"]; ?>" class="product-image">
            <p>Description: <?php echo $row["Description"]; ?></p>
            <p>Price: <?php echo $row["Price"]; ?>€</p>
        </div>
        <?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}

$conn->close();
?>
<?php include "footer.html"; ?> 
</body>
</html>
