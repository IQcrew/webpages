<?php
include 'header.php';
include 'admin_auth.php';
include '../db_connection.php';

function getAllProducts($conn) {
    $sql = "SELECT * FROM Products";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function deleteProduct($conn, $productId) {
    $sql = "DELETE FROM Products WHERE ProductID = $productId";
    return $conn->query($sql);
}

$products = getAllProducts($conn);

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $sql = "SELECT * FROM Products WHERE Name LIKE '%$searchTerm%' OR Description LIKE '%$searchTerm%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $products = [];
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    deleteProduct($conn, $productId);
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Správa produktov</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            padding-top: 60px;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin-top: 0;
            padding-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .product-image {
            max-width: 100px;
            max-height: 100px;
            border-radius: 8px;
        }

        .action-buttons a {
            display: inline-block;
            margin: 5px;
            margin-right: 10px;
            padding: 8px 16px;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
            background-color: #007bff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .action-buttons a:hover {
            background-color: #0056b3;
        }

        .add-product-button {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
            background-color: #007bff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .add-product-button:hover {
            background-color: #0056b3;
        }

        .search-form {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-form input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-right: 10px;
        }

        .search-form input[type="submit"] {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Správa produktov</h1>



    <a href="add_produkt.php" class="add-product-button">Pridať nový produkt</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Názov</th>
            <th>Popis</th>
            <th>Cena</th>
            <th>Obrázok</th>
            <th>Akcie</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['ProductID']; ?></td>
            <td><?php echo $product['Name']; ?></td>
            <td>
                <?php
                $description = $product['Description'];
                $words = explode(" ", $description);
                if (count($words) > 30) {
                    $description = implode(" ", array_slice($words, 0, 30)) . "...";
                }
                echo $description;
                ?>
            </td>
            <td><?php echo $product['Price']; ?></td>
            <td><img src="../src/imagesUpload/<?php echo $product['Image']; ?>" alt="<?php echo $product['Name']; ?>" class="product-image"></td>
            <td class="action-buttons">
                <a href="edit_produkt.php?id=<?php echo $product['ProductID']; ?>">Upraviť</a>
                <a href="delete_produkt.php?action=delete&id=<?php echo $product['ProductID']; ?>" style="background-color:red;">Odstrániť</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php include "../footer.html"; ?> 
</body>
</html>

<?php
$conn->close();
?>
