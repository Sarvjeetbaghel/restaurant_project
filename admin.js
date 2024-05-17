// Show/hide inventory form
function showInventory() {
  document.getElementById("inventory").style.display = "block";
  document.getElementById("staffForm").style.display = "none"; // Hide staff form
}

// Show/hide staff management form
function showStaffForm() {
  document.getElementById("staffForm").style.display = "block";
  document.getElementById("inventory").style.display = "none";
}

// Add event listeners to buttons
document.addEventListener("DOMContentLoaded", function() {
  const inventoryForm = document.getElementById("inventoryForm");
  const staffForm = document.getElementById("staffForm");

  // Inventory form submit handler
  inventoryForm.addEventListener("submit", function(event) {
      event.preventDefault();
      const itemName = document.getElementById("itemName").value;
      const inventoryQuantity = document.getElementById("inventoryQuantity").value;
      const action = event.submitter.name;

      // Send AJAX request to inventory.php
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "inventory.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send(`itemName=${itemName}&inventoryQuantity=${inventoryQuantity}&action=${action}`);

      // Reset form fields
      document.getElementById("itemName").value = "";
      document.getElementById("inventoryQuantity").value = "";
  });

  // Staff form submit handler
  staffForm.addEventListener("submit", function(event) {
      event.preventDefault();
      const staffName = document.getElementById("name").value;
      const staffRole = document.getElementById("role").value;
      const action = event.submitter.name;

      // Send AJAX request to manage_staff.php
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "staff.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send(`name=${staffName}&role=${staffRole}&action=${action}`);

      // Reset form fields
      document.getElementById("name").value = "";
      document.getElementById("role").value = "";
  });
});
