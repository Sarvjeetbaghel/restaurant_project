<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    http_response_code(401);
    exit("Unauthorized");
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "radhe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current user's email
$email = $_SESSION['email'];

// Fetch orders associated with the current user
$sql = "SELECT item, quantity FROM orders WHERE user_email = ?";
$stmt = $conn->prepare($sql);

// Check for prepare error
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("s", $email);

// Execute statement
$stmt->execute();

// Get result
$result = $stmt->get_result();

// Check if any orders were found
if ($result->num_rows > 0) {
    // Fetch and output orders as JSON
    $orders = array();
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    echo '<script type="text/javascript">alert("Orders found!");</script>';
    echo json_encode($orders);
} else {
    // No orders found
    echo '<script type="text/javascript">alert("No orders found!");</script>';
    echo json_encode(array());
}

// Close statement
$stmt->close();

// Close database connection
$conn->close();
?>
