<?php
session_start();

// Dummy admin credentials (replace with your actual authentication mechanism)
$valid_username = "sarvjeet";
$valid_password = "sarvjeet@123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $valid_username && $password === $valid_password) {
        // Authentication successful, redirect to admin panel or dashboard
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin_panel.php");
        exit();
    } else {
        // Authentication failed, redirect back to login page with error message
        $_SESSION["login_error"] = "Invalid username or password";
        header("Location: login.php");
        exit();
    }
}
?>
