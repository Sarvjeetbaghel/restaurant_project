<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the action is to add or remove an item
    if (isset($_POST["addinventory"])) {
        // Add item to inventory
        addInventoryItem();
    } elseif (isset($_POST["removeinventory"])) {
        // Remove item from inventory
        removeInventoryItem();
    }
}

// Function to add item to inventory
function addInventoryItem() {
    // Retrieve form data
    $itemName = $_POST["itemName"];
    $inventoryQuantity = $_POST["inventoryQuantity"];
    
    // Validate input (you may add more validation)
    if (empty($itemName) || empty($inventoryQuantity)) {
        // Handle empty fields
        echo "<script>alert('Please fill out all fields.'); window.location.href = 'admin_panel.php';</script>";
    } else {
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

        // Prepare and execute SQL statement to insert data into inventory table
        $sql = "INSERT INTO inventory (item_name, quantity) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        // Check if the SQL statement preparation was successful
        if (!$stmt) {
            echo "<script>alert('Error preparing statement: " . $conn->error . "'); window.location.href = 'admin_panel.php';</script>";
        } else {
            // Bind parameters and execute the statement
            $stmt->bind_param("si", $itemName, $inventoryQuantity);

            if ($stmt->execute()) {
                echo "<script>alert('Item added to inventory successfully.'); window.location.href = 'admin_panel.php';</script>";
            } else {
                echo "<script>alert('Error executing statement: " . $stmt->error . "'); window.location.href = 'admin_panel.php';</script>";
            }
            
            // Close statement
            $stmt->close();
        }

        $conn->close();
    }
}

// Function to remove item from inventory
function removeInventoryItem() {
    // Retrieve form data
    $itemName = $_POST["itemName"];
    
    // Validate input (you may add more validation)
    if (empty($itemName)) {
        // Handle empty field
        echo "<script>alert('Please provide the name of the item to remove.'); window.location.href = 'admin_panel.php';</script>";
    } else {
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

        // Prepare and execute SQL statement to remove item from inventory table
        $sql = "DELETE FROM inventory WHERE item_name = ?";
        $stmt = $conn->prepare($sql);

        // Check if the SQL statement preparation was successful
        if (!$stmt) {
            echo "<script>alert('Error preparing statement: " . $conn->error . "'); window.location.href = 'admin_panel.php';</script>";
        } else {
            // Bind parameter and execute the statement
            $stmt->bind_param("s", $itemName);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Item removed from inventory successfully.'); window.location.href = 'admin_panel.php';</script>";
            } else {
                echo "<script>alert('No item found with the given name.'); window.location.href = 'admin_panel.php';</script>";
            }

            // Close statement
            $stmt->close();
        }

        $conn->close();
    }
}
?>
