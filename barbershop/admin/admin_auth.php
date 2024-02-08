<?php
session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['email'] != "admin@it.com") {
        header("location: ..\login.php");
        exit();
    }
?>