<?php
session_start();

// Check if the admin is logged in, if not, redirect to the login page
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
              <li><a href="about.html">About us</a></li>
              <li><a href="services.html">Services</a></li>
              <li><a href="contact.html">Contact us</a></li>
              <li><a href="menu.html">Menu</a></li>
              <li><a href="logout_admin.php">logout</a></li> 
            </ul>
         </nav>        
    </header>
    <div class="container">
        <h1>Welcome to our Restaurant Management System</h1>
        <div class="options">
            <button onclick="toggleSection('inventory')">Manage Inventory</button>
            <button onclick="toggleSection('staffForm')">Manage Staff</button>
        </div>
        <div id="inventory" style="display: none;">
    <h2>Inventory Management</h2>
    <form action="inventory.php" method="post">
        <div>
            <label for="itemName">Item Name:</label>
            <input type="text" id="itemName" name="itemName" required>
        </div><br>
        <div>
            <label for="inventoryQuantity">Quantity:</label>
            <input type="number" id="inventoryQuantity" name="inventoryQuantity" required>
        </div><br>
        <div>
            <button type="submit" name="addinventory">Add Item</button>
            <button type="submit" name="removeinventory">Remove Item</button>
        </div>
    </form>
</div>
<div id="staffForm" style="display: none;">
    <h2>Staff Management</h2>
    <form action="staff.php" method="post">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
        </div>
        <div>
            <label for="role">Role:</label>
            <input type="text" id="role" name="role" required><br><br>
        </div>
        <div>
            <button type="submit" name="add_staff">Add Staff</button>
        </div>
    </form>

    <form action="staff.php" method="post"> <!-- New form for removing staff -->
        <div>
            <label for="staff_id">Staff ID:</label>
            <input type="text" id="staff_id" name="staff_id" required><br><br> <!-- Assuming staff_id is a text input -->
        </div>
        <div>
            <button type="submit" name="remove_staff">Remove Staff</button>
        </div>
    </form>
</div>


    <script>
        function toggleSection(sectionId) {
        const inventorySection = document.getElementById("inventory");
        const staffFormSection = document.getElementById("staffForm");

        if (sectionId === "inventory") {
            inventorySection.style.display = "block";
            staffFormSection.style.display = "none";
        } else {
            staffFormSection.style.display = "block";
            inventorySection.style.display = "none";
        }
    }
    </script>
    <script src="admin.js"></script>
</body>
</html>