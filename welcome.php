<?php
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
} // Ensure this closing PHP tag is here if you are transitioning to straight HTML below

// PHP code block ends here before HTML starts
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Restaurant Management System</title>
    <link rel="stylesheet" href="welcome.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="about.html">About us</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact us</a></li>
                <li><a href="menu.html">Menu</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>        
    </header>   
    <div class="container">
        <h2>Welcome <?php echo htmlentities($_SESSION['email']);?>!</h2>
        <p>You are now logged in. Use the options below to manage the system.</p>
        <div class="options">
            <button onclick="showOrderForm()">Place Order</button>
            <button onclick="showReservationForm()">Make Reservation</button>
            <div id="orders-container">
                <button onclick="showMyOrders()"><a href="fetch_my_orders.php">My Orders</button></a>
            </div>
            <div id="myorders"></div>
        </div>
    </div>
    
    <div id="orderForm" style="display: none;">
        <div class="container">
            <h1>Place Order</h1>
            <form action="login_order.php" method="post">
                <label for="item">Items Available:-</label>
                <select name="item" id="itemSelect">
                    <!-- Items will be populated dynamically using JavaScript -->
                </select>
                <input type="text" id="item" name="item" required><br><br>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required><br><br>
                <label for="tableNumber">Table Number:</label>
                <input type="number" id="tableNumber" name="tableNumber" required><br><br>
                <button type="submit">Place Order</button>
            </form>
        </div>
    </div>
    
    <div id="reservationForm" style="display: none;">
        <h1>Make Reservation</h1>
        <form id="reservation" method="post" action="login_reservation.php">
            <label for="reservationName">Name:</label>
            <input type="text" id="reservationName" name="reservationName" required><br><br>
            <label for="reservationDate">Date:</label>
            <input type="date" id="reservationDate" name="reservationDate" required><br><br>
            <label for="reservationTime">Time:</label>
            <input type="time" id="reservationTime" name="reservationTime" required><br><br>
            <label for="reservationPartySize">Party Size:</label>
            <input type="number" id="reservationPartySize" name="reservationPartySize" required><br><br>
            <button type="submit">Make Reservation</button>
        </form>
    </div>
    
    <script src="welcome.js"></script>
    <script>
        // Function to populate items in the dropdown box
        function populateItems() {
            fetch('fetch_items.php', {
                method: 'GET',
                // Add necessary headers if required
            })
           .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
           .then(data => {
                const itemSelect = document.getElementById('itemSelect');
                itemSelect.innerHTML = ''; // Clear previous items
                // Iterate through fetched items and append them to the dropdown box
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.item_name;
                    option.text = item.item_name;
                    itemSelect.appendChild(option);     
                });
            })
           .catch(error => {
                console.error('Error fetching items:', error);
            });
        }
        
        // Call the function to populate items when the page loads
        window.onload = populateItems;
        
        function showMyOrders() {
            // Assuming you have a backend endpoint to fetch orders
            fetch('fetch_my_orders.php', {
                method: 'GET',
                // Add necessary headers if required
            })
           .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
               }
                return response.json();
            })
          .then(data => {
                const ordersContainer = document.getElementById('myorders');
                ordersContainer.innerHTML = ''; // Clear previous orders
                // Iterate through fetched orders and append them to the container
                if (data.length > 0) {
                    data.forEach(order => {
                        const orderElement = document.createElement('div');
                        orderElement.textContent = `Order ID: ${order.id}, Item: ${order.item}, Quantity: ${order.quantity}, Table Number: ${order.tableNumber}`;
                        ordersContainer.appendChild(orderElement);
                    });
                } else {
                    ordersContainer.textContent = 'No orders found.';
                }
            })
          .catch(error => {
                console.error('Error fetching orders:', error);
            });
        }
    </script>
</body>
</html>