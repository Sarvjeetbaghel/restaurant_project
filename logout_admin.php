<?php
session_start();

// Unset the admin session variable and destroy the session
unset($_SESSION["admin_logged_in"]);
session_destroy();

// Redirect to the login page after logout
header("Location: index.html");
exit();
?>
