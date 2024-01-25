<?php
include('db_connection.php');
session_start();
$userEmail = $_SESSION['email'];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $tripId = isset($_POST['trip_id']) ? $_POST['trip_id'] : null;
    $rating = isset($_POST['rating']) ? $_POST['rating'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;

    if ($tripId && $rating && $content) {
        // Check if a review already exists for the user and trip
        $checkReviewQuery = "SELECT * FROM reviews WHERE user_id = (SELECT id FROM users WHERE email = ?) AND trip_id = ?";
        $checkReviewStmt = $conn->prepare($checkReviewQuery);
        $checkReviewStmt->bind_param('si', $userEmail, $tripId);
        $checkReviewStmt->execute();
        $existingReview = $checkReviewStmt->get_result()->fetch_assoc();
        $checkReviewStmt->close();

        if (!$existingReview) {
            // Insert the review into the database
            $insertReviewQuery = "INSERT INTO reviews (user_id, trip_id, content, rating, created_at)
                                  VALUES ((SELECT id FROM users WHERE email = ?), ?, ?, ?, NOW())";
            $insertReviewStmt = $conn->prepare($insertReviewQuery);
            $insertReviewStmt->bind_param('siss', $userEmail, $tripId, $content,$rating);

            if ($insertReviewStmt->execute()) {
                // Success
                echo "Review submitted successfully!";
            } else {
                // Error
                echo "Error submitting review: " . $insertReviewStmt->error;
            }

            $insertReviewStmt->close();
        }
    }
}
header("Location: profil.php"); // Redirect to the login page if not logged in
exit();
?>