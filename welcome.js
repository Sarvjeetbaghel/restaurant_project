function showAboutUs() {
    hideAllSections();
    document.getElementById("aboutUs").style.display = "block";
}

function showOurServices() {
    hideAllSections();
    document.getElementById("ourServices").style.display = "block";
}

function showContactUs() {
    hideAllSections();
    document.getElementById("contactUs").style.display = "block";
}

function showMenu() {
    hideAllSections();
    document.getElementById("menu").style.display = "block";
}


function showOrderForm() {
    hideAllSections();
    document.getElementById("orderForm").style.display = "block";
}


function showReservationForm() {
    hideAllSections();
    document.getElementById("reservationForm").style.display = "block";
}

function hideAllSections() {
    document.getElementById("orderForm").style.display = "none";
    document.getElementById("reservationForm").style.display = "none";
}

function showMyOrders() {
    // Clear any existing form
    document.getElementById('orderFormContent').innerHTML = '';

    // Create a new form for displaying orders
    const orderFormContent = document.createElement('div');
    orderFormContent.id = 'orderFormContent';

    // Fetch the user's orders from the server     
    fetch('get_my_orders.php')
        .then(response => response.text())
        .then(data => {
            // Display the orders in a table
            const table = document.createElement('table');
            table.innerHTML = data;
            orderFormContent.appendChild(table);

            // Show the order form
            document.getElementById('orderForm').style.display = 'block';
        });

    // Add the new form to the page
    document.getElementById('orderForm').appendChild(orderFormContent);
}


// Function to handle reservation submission
document.getElementById("reservationForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
    
    var reservationName = document.getElementById("reservationName").value;
    var reservationDate = document.getElementById("reservationDate").value;
    var reservationTime = document.getElementById("reservationTime").value;
    var reservationPartySize = parseInt(document.getElementById("reservationPartySize").value);

    // Perform validation
    if (reservationName.trim() === "" || reservationDate === "" || reservationTime === "" || isNaN(reservationPartySize) || reservationPartySize <= 0) {
        alert("Please enter valid reservation details.");
        return;
    }

    // Process reservation (you can replace this with your own logic)
    console.log("Reservation details:", reservationName, reservationDate, reservationTime, reservationPartySize);
    alert("Reservation successful!");

    // Optionally, you can clear the form fields after making a reservation
    document.getElementById("reservationName").value = "";
    document.getElementById("reservationDate").value = "";
    document.getElementById("reservationTime").value = "";
    document.getElementById("reservationPartySize").value = "";
}
);