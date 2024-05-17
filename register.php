<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Database credentials
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "radhe";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO registration (email, password) VALUES (?, ?)");
    if ($stmt === false) {
        die("MySQL prepare error: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>


