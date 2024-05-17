<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "radhe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Fetch items from the inventory table
$sql = "SELECT item_name FROM inventory";
$result = $conn->query($sql);

// Create an array to store the items
$items = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

// Close connection
$conn->close();

// Output the items in JSON format
echo json_encode($items);
?>