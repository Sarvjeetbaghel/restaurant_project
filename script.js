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
});