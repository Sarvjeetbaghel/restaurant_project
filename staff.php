<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "radhe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add_staff'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "INSERT INTO staff (name, role) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sd", $name, $role);

    if ($stmt->execute()) {
        // Success message
        echo "<script>alert('New staff member added successfully.'); window.location.href = 'admin_panel.php';</script>";
    } else {
        // Error message
        echo "<script>alert('Error adding staff member.');</script>";
    }

    $stmt->close();
}

if (isset($_POST['remove_staff'])) {
    $staff_id = $_POST['staff_id'];

    $sql = "DELETE FROM staff WHERE staff_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $staff_id);

    if ($stmt->execute()) {
        // Success message
        echo "<script>alert('Staff member removed successfully.'); window.location.href = 'admin_panel.php';</script>";
    } else {
        // Error message
        echo "<script>alert('Error removing staff member.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
