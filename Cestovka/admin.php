<?php
// Include the database connection file
include('db_connection.php');
include('auth.php');
if ($_SESSION['email'] != 'admin@admin.com') {
    header("Location: index.php");
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
    $destination = $result->fetch_assoc();
    $stmt->close();

    // Process the form submission for updating destination
    if (isset($_GET['update_destination'])) {
        $new_destination_name = $_GET['new_destination_name'];
        $new_description = $_GET['new_description'];
        $new_price = $_GET['new_price'];

        // Update destination details in the database
        $update_query = "UPDATE trips 
                         SET destination_name = ?, description = ?, price = ? 
                         WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param('ssdi', $new_destination_name, $new_description, $new_price, $destination_id);

        if ($update_stmt->execute()) {
            // Handle image upload if a new image is provided
            if (!empty($_FILES['new_image']['name'])) {
                $uploadDir = 'images/uploads/';
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
    }

    // Process the form submission for deleting destination
    if (isset($_GET['delete_destination'])) {
        // Delete the destination from the database
        $delete_query = "DELETE FROM trips WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param('i', $destination_id);

        if ($delete_stmt->execute()) {
            echo "Destination deleted successfully.";
            // Redirect to destinations.php or any other page after deletion
            header('Location: destinations.php');
            exit();
        } else {
            echo "Error deleting destination: " . $delete_stmt->error;
        }

        $delete_stmt->close();
    }
} else {
    // Redirect to destinations.php if accessed without proper parameters
    header('Location: destinations.php');
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
        /* Your existing CSS styles here */
    </style>
</head>
<body>

<h2>Edit Destination</h2>

<!-- Form for editing destination details -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" enctype="multipart/form-data">
    <input type="hidden" name="destination_id" value="<?php echo $destination_id; ?>">

    <label for="new_destination_name">New Destination Name:</label>
    <input type="text" name="new_destination_name" value="<?php echo htmlspecialchars($destination['destination_name']); ?>" required>

    <label for="new_description">New Description:</label>
    <textarea name="new_description" required><?php echo htmlspecialchars($destination['description']); ?></textarea>

    <label for="new_price">New Price:</label>
    <input type="text" name="new_price" value="<?php echo $destination['price']; ?>" required>

    <label for="new_image">New Image:</label>
    <input type="file" name="new_image" accept="image/*">

    <input type="submit" name="update_destination" value="Update Destination">
</form>

<!-- Form for deleting destination -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
    <input type="hidden" name="destination_id" value="<?php echo $destination_id; ?>">
    <input type="submit" name="delete_destination" value="Delete Destination" onclick="return confirm('Are you sure you want to delete this destination?');">
</form>

</body>
</html>
