<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = trim(strtolower($_POST['email']));  // Normalize the email to lowercase
    $password = trim($_POST['password']);

    // Database connection parameters
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
    $stmt = $conn->prepare("SELECT password FROM registration WHERE email = ?");
    if (!$stmt) {
        die("MySQL prepare error: " . $conn->error);
    }

    $stmt->bind_param("s", $email);

    // Execute the statement and check results
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['email'] = $email;  // Set session
                header("Location: welcome.php");  // Redirect to welcome page
                exit;
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that email address.";
        }
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

?>











