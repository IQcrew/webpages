<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <link rel="icon" type="image/png" href="src/logo.png">
    <style>

        .product-card:hover {
            transform: translateY(-5px); 
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        .product-details {
            display: flex;
            justify-content: space-around;
            flex-direction: row;
        }
        body {
            margin: 0;
            background-color: #f4f4f4;
            padding: 0px;
            background: linear-gradient(-45deg, #009dff, #2c8897, #23a6d5, #0141ff);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;

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
        .nadpis{
            background-color: #ffffff3d;
            max-width: 300px;
            border-radius: 16px; 
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); 
        }
        .popis{
            margin-top: 30px;
            background-color: #ffffff3d;
            border-radius: 16px; 
            padding: 30px;
            margin-right: 20px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); 
        }
        .add-to-cart {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        .add-to-cart-btn {
            background-color: #ffffff3d;
            color: black;
            border: none;
            padding: 8px 16px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .add-to-cart-btn:hover {
            background-color: #ffffff5d;
        }

        .quantity {
            width: 60px;
            padding: 6px 10px;
            border: 0px solid #ccc;
            border-radius: 7px;
            font-size: 16px;
            background-color:#ffffff3d ;
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
        <div style="min-height:820px; margin-top: 80px;">
        <div class="product-details">
            <img src="src/imagesUpload/<?php echo $row["Image"]; ?>" alt="<?php echo $row["Name"]; ?>" class="product-image" style="padding: 20px; max-width: 100vh;">
            <div style="width:50%;">
                <div class="nadpis">
                    <h2><?php echo $row["Name"]; ?></h2>
                    <p>Cena: <?php echo $row["Price"]; ?>€</p>
                </div>             
                <div class="popis">
                    <p><?php echo str_replace("\n","</br>",$row["Description"]); ?></p>
                    <div class="add-to-cart">
                        <form method="post" >
                        <button class="add-to-cart-btn">Pridať do košíka</button>
                        <input type="number" class="quantity" value="1" min="1">
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
