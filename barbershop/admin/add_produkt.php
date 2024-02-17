<?php
include 'header.php';
include 'admin_auth.php';
include '../db_connection.php';

function addProduct($conn, $name, $description, $price, $image) {
    $sql = "INSERT INTO Products (Name, Description, Price, Image) VALUES ('$name', '$description', '$price', '$image')";
    return $conn->query($sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $targetDir = "../src/imagesUpload/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit();
    }

    if ($_FILES["image"]["size"] > 15000000) {
        echo "Sorry, your file is too large.";
        exit();
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG & PNG files are allowed.";
        exit();
    }

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        if (addProduct($conn, $name, $description, $price, basename($_FILES["image"]["name"]))) {
            header("Location: produkty.php");
            exit();
        } else {
            echo "Error: Unable to add product.";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pridať nový produkt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            margin-top: 80px;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }


        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            min-height: 80vh;
        }

        .form-container h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container textarea,
        .form-container input[type="file"],
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-container textarea {
            height: 100px;
        }

        .form-container input[type="file"] {
            cursor: pointer;
        }

        .form-container input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="form-container">
        <h2>Pridať nový produkt</h2>
        <form action="add_produkt.php" method="POST" enctype="multipart/form-data">
            <label for="name">Názov:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Popis:</label>
            <textarea id="description" name="description" rows="4" cols="50"></textarea>

            <label for="price">Cena:</label>
            <input type="number" id="price" name="price" min="1"required>

            <label for="image">Obrázok:</label>
            <input type="file" id="image" name="image" required>

            <input type="submit" value="Pridať produkt">
        </form>
    </div>
    <?php include "../footer.html"; ?> 
</body>
</html>
