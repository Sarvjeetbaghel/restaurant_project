<?php


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        // Redirect to login page if not logged in
        header("Location: login.html");
        exit();
    }
?>