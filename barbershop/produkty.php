<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="icon" type="image/png" href="src/logo.png">
    <link rel="stylesheet" href="src/button.css">
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
            background-color: #ffffff3d;
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


        .product-image {
            width: 100%;
            border-radius: 8px;
            max-height: 400px;
            max-width: 200px;
        }

        .product-name {
            font-weight: bold;
            margin-top: 10px;
        }

        .product-description {
            margin-top: 10px;
            height: 50px;
        }

        .product-price {
            margin-top: 15px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .view-details-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .view-details-button:hover {
            background-color: #0056b3;
        }
        body {
            margin: 0;
            background-color: #f4f4f4;
            padding: 0px;
            background: linear-gradient(-45deg, #009dff, #2c8897, #23a6d5, #00ffee);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;

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


<form action="" method="GET">
    <input type="submit" value="Vyhľadať">
    <input type="text" id="search" name="search" value="">
</form>
<div style="min-height:85vh; margin-top: 75px;">
<div class="grid-container">
    <?php
    session_start();
    if(isset($_SESSION['email']) && $_SESSION['email'] == "admin@it.com"){
        header('Location: admin/produkty.php');
        exit();
    }
    include 'db_connection.php';
    include 'header.php';
    $search_query = "";

    if(isset($_GET['search'])) {
        $search_query = $_GET['search'];
    }

    $sql = "SELECT * FROM Products";
    if(!empty($search_query)) {
        $sql .= " WHERE Name LIKE '%$search_query%' OR Description LIKE '%$search_query%'";
    }

    $sql .= " LIMIT 50";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            <div class="product-card">
                <div style="height:210px;">
                    <img src="src/imagesUpload/<?php echo $row["Image"]; ?>" alt="<?php echo $row["Name"]; ?>" class="product-image">
                </div>
                <div class="product-name"><?php echo $row["Name"]; ?></div>
                <div class="product-description">
                <?php
                $description = $row["Description"];
                $words = explode(" ", $description);
                if (count($words) > 14) {
                    $description = implode(" ", array_slice($words, 0, 12)) . "...";
                }
                echo $description;
                ?>
                </div>
                <div class="product-price" ><?php echo $row["Price"]; ?>€</div>
                <div class="customButton" >
                 <a href="produkt_detaily.php?id=<?php echo $row["ProductID"]; ?>" class="button type--A">
                <div class="button__line"></div>
                <div class="button__line"></div>
                <span class="button__text">Detaily</span>
                <div class="button__drow1"></div>
                <div class="button__drow2"></div>
            </a>
        </div>
            </div>
            <?php
        }
    } else {
        echo "No products found.";
    }
    $conn->close();
    ?>
</div>
</div>
<?php include "footer.html"; ?>
</body>
</html>
