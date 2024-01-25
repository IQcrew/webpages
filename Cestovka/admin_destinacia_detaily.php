<?php
// Include the database connection file
include('db_connection.php');
include('auth.php');
if ($_SESSION['email'] != 'admin@admin.com') {
    header("Location: index.php");
    exit();
}
if(isset($_POST['redirect_button'])){
    // Redirect to another page
    header("Location: admin.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_destination'])) {
    $destination_id = $_POST['destination_id'];
    $new_destination_name = $_POST['new_destination_name'];
    $new_description = $_POST['new_description'];
    $new_price = $_POST['new_price'];

    // Get the current image path
    $current_image_path = $_POST['current_image'];
    $uploadDir = 'images/uploads/';

    // Update destination details in the database
    $update_query = "UPDATE trips 
                     SET destination_name = ?, description = ?, price = ? 
                     WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param('ssdi', $new_destination_name, $new_description, $new_price, $destination_id);

    if ($update_stmt->execute()) {
        // Handle image upload if a new image is provided
        if (!empty($_FILES['new_image']['name'])) {
            // Remove the old image from the folder
            
            if (file_exists($current_image_path)) {
                unlink($current_image_path);
            }

            // Upload the new image
            $uploadedFile = $uploadDir . basename($_FILES['new_image']['name']);
            move_uploaded_file($_FILES['new_image']['tmp_name'], $uploadedFile);

            // Update the image path in the database
            $update_image_query = "UPDATE trips SET image_path = ? WHERE id = ?";
            $update_image_stmt = $conn->prepare($update_image_query);
            $update_image_stmt->bind_param('si', $uploadedFile, $destination_id);
            $update_image_stmt->execute();
            $update_image_stmt->close();
        }

        echo "Destination updated successfully.";
    } else {
        echo "Error updating destination: " . $update_stmt->error;
    }

    $update_stmt->close();
    
    // Redirect to admin.php after updating
    header('Location: admin.php');
    exit();
}
// Check if the form is submitted for updating destination
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['destination_id'])) {
    $destination_id = $_GET['destination_id'];

    // Retrieve destination details for the given ID
    $query = "SELECT * FROM trips WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $destination_id);
    $stmt->execute();
    $result = $stmt->get_result();
    // Check if any results are found
if ($result->num_rows < 1) {
    header("Location: admin.php");
    exit();
}
    $destination = $result->fetch_assoc();
    $stmt->close();

    // Process the form submission for updating destination
    

    // Process the form submission for deleting destination
    if (isset($_GET['delete_destination'])) {
        // Get the current image path
        $current_image_path = $destination['image_path'];

        // Delete the destination from the database
        $delete_query = "DELETE FROM trips WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param('i', $destination_id);

        if ($delete_stmt->execute()) {
            // Remove the old image from the folder
            if (file_exists($current_image_path)) {
                unlink($current_image_path);
            }

            echo "Destination deleted successfully.";
            // Redirect to destinations.php or any other page after deletion
            header('Location: admin.php');
            exit();
        } else {
            echo "Error deleting destination: " . $delete_stmt->error;
        }

        $delete_stmt->close();
    }
} else {
    // Redirect to destinations.php if accessed without proper parameters
    header('Location: admin.php');
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destination</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            text-align: center;
            padding-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        input[type="submit"], input[type="button"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Upraviť Destináciu</h2>

<!-- Form pre úpravu detailov destinácie -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="destination_id" value="<?php echo $destination_id; ?>">

    <label for="new_destination_name">Nový Názov Destinácie:</label>
    <input type="text" name="new_destination_name" value="<?php echo htmlspecialchars($destination['destination_name']); ?>" required>

    <label for="new_description">Nový Popis:</label>
    <textarea name="new_description" required><?php echo htmlspecialchars($destination['description']); ?></textarea>

    <label for="new_price">Nová Cena:</label>
    <input type="number" name="new_price" value="<?php echo $destination['price']; ?>" required>

    <!-- Zobraziť aktuálny obrázok -->
    <p>Aktuálny Obrázok:</p>
    <img src="<?php echo htmlspecialchars($destination['image_path']); ?>" alt="Aktuálny Obrázok Destinácie" width="200">
    <input type="hidden" name="current_image" value="<?php echo $destination['image_path']; ?>">
    <label for="new_image">Nový Obrázok:</label>
    <input type="file" name="new_image" accept="image/*">

    <input type="submit" name="update_destination" value="Aktualizovať Destináciu">
</form>

<!-- Form pre odstránenie destinácie -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
    <input type="hidden" name="destination_id" value="<?php echo $destination_id; ?>">
    <input type="submit" name="delete_destination" value="Odstrániť Destináciu" onclick="return confirm('Ste si istý, že chcete odstrániť túto destináciu?');">
</form>
<form method="post">
    <input type="submit" name="redirect_button" value="Späť">
</form>

</body>
</html>
