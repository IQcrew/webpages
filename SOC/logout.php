<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the index page
    header("Location: index.php");
    exit();
} else {
    // If the user is not logged in, redirect to the index page
    header("Location: index.php");
    exit();
}
?>
