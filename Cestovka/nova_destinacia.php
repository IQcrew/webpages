<?php
// Include the database connection file
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user inputs
    $destination_name = $_POST['destination_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Image upload handling
    $uploadDir = 'images/uploads/';
    $uploadedFile = $uploadDir . basename($_FILES['image']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));

    // Check if the file already exists
    if (file_exists($uploadedFile)) {
        echo "Sorry, the file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['image']['size'] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload the file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
            // Insert the destination details into the database
            $query = "INSERT INTO trips (destination_name, image_path, description, price) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssd', $destination_name, $uploadedFile, $description, $price);

            if ($stmt->execute()) {
                echo "Destination created successfully.";
            } else {
                echo "Error creating destination: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Destination</title>
</head>
<body>

<h2>Create New Destination</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <label for="destination_name">Destination Name:</label>
    <input type="text" name="destination_name" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br>

    <label for="price">Price:</label>
    <input type="number" name="price" required><br>

    <label for="image">Select Image:</label>
    <input type="file" name="image" accept="image/*" required><br>

    <input type="submit" value="Create Destination">
</form>

</body>
</html>
