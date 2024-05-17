<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $item = $_POST['item'];
    $quantity = intval($_POST['quantity']);
    $tableNumber = intval($_POST['tableNumber']);

    // Validate input
    if (empty($item) || empty($quantity) || empty($tableNumber)) {
        echo '<script type="text/javascript">alert("Please fill out all fields."); window.location.href = "welcome.php";</script>';
        exit();
    }

    if ($quantity < 1 || $quantity > 5) {
        echo '<script type="text/javascript">alert("The quantity must be between 1 and 5."); window.location.href = "welcome.php";</script>';
        exit();
    }

    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        echo '<script type="text/javascript">alert("User not logged in."); window.location.href = "login.php";</script>';
        exit();
    }

    // Retrieve user's email from the session
    $user_email = $_SESSION['email'];

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

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Prepare and execute SQL statement to check inventory
        $stmt = $conn->prepare("SELECT quantity FROM inventory WHERE item_name = ?");
        $stmt->bind_param("s", $item);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Check if the item exists in the inventory
        if ($row === null) {
            throw new Exception("Item not available.");
        }

        $inventoryQuantity = $row['quantity'];

        // Check if the item is available in the inventory
        if ($inventoryQuantity < $quantity) {
            throw new Exception("Item not available. The maximum limit of the item is 5.");
        }

        // Insert order into the 'orders' table
        $stmt = $conn->prepare("INSERT INTO orders (item, quantity, table_number, user_email) VALUES (?,?,?,?)");
        $stmt->bind_param("siis", $item, $quantity, $tableNumber, $user_email);
        $stmt->execute();

        // Update the inventory
        $stmt = $conn->prepare("UPDATE inventory SET quantity = quantity - ? WHERE item_name = ?");
        $stmt->bind_param("is", $quantity, $item);
        $stmt->execute();

        // Commit transaction
        $conn->commit();

        // Display pop-up message that the order has been placed successfully
        echo '<script type="text/javascript">alert("Order placed successfully."); window.location.href = "welcome.php";</script>';

    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo '<script type="text/javascript">alert("' . $e->getMessage() . '"); window.location.href = "welcome.php";</script>';
    }

    // Close connection
    $conn->close();
    // Exit the script
    exit();
}
?>
