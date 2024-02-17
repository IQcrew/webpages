<?php
include 'header.php';
include 'admin_auth.php';
include '../db_connection.php';

function getProductById($conn, $productId) {
    $sql = "SELECT * FROM Products WHERE ProductID = $productId";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

if(isset($_GET['id'])) {
    $productId = $_GET['id'];
    $product = getProductById($conn, $productId);

    if($product) {
        $name = $product['Name'];
        $description = $product['Description'];
        $price = $product['Price'];
        $oldImage = $product['Image'];
    } else {
        echo "Product not found.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['productId'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../src/imagesUpload/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        $newImageName = uniqid() . '.' . $imageFileType;
        $newImageFilePath = $targetDir . $newImageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $newImageFilePath)) {
            if(!empty($oldImage)) {
                unlink($targetDir . $oldImage);
            }
            $sql = "UPDATE Products SET Name='$name', Description='$description', Price='$price', Image='$newImageName' WHERE ProductID=$productId";
            if ($conn->query($sql) === TRUE) {
                header("Location: produkty.php");
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        $sql = "UPDATE Products SET Name='$name', Description='$description', Price='$price' WHERE ProductID=$productId";
        if ($conn->query($sql) === TRUE) {
            header("Location: produkty.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upraviť produkt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            margin-top: 80px;
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

        .form-container .old-image {
            max-width: 100px;
            max-height: 100px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <h2>Upraviť produkt</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="productId" value="<?php echo $productId; ?>">

            <label for="name">Názov:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

            <label for="description">Popis:</label>
            <textarea id="description" name="description" rows="4" cols="50"><?php echo $description; ?></textarea>

            <label for="price">Cena:</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo $price; ?>" required>

            <label for="image">Obrázok:</label>
            <?php if(!empty($oldImage)): ?>
                <img src="../src/imagesUpload/<?php echo $oldImage; ?>" alt="Starý obrázok" class="old-image">
            <?php endif; ?>
            <input type="file" id="image" name="image">

            <input type="submit" value="Uložiť zmeny">
        </form>
    </div>
    <?php include "../footer.html"; ?> 
</body>
</html>

<?php
$conn->close();
?>
