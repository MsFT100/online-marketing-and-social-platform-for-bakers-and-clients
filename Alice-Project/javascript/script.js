
//profile buttons
var glbStaffCurrentDisplayID;
var glbAdminCurrentDisplayID;
window.onload = function() {
    console.log("sttartOfDEBUG");
    //Gettig the path on our browser
    var currentDocument = window.location.pathname.split('/').pop();
     
    try {
        glbAdminCurrentDisplayID = localStorage.getItem("glbAdminCurrentDisplayID");
        glbStaffCurrentDisplayID = localStorage.getItem("glbStaffCurrentDisplayID");
      } catch (e) {
        // Handle any errors with local storage access
        console.error("Error accessing local storage:", e);
    }

    var activeDisplay = document.getElementsByClassName("prof-item");
     
    // Disabling all the displays
    if (currentDocument == "profile.php") {
        // Disable relevant displays
        for (var i = 0; i < activeDisplay.length; i++) {
            activeDisplay[i].style.display = "none";
        }
        // Enable current display if it was hidden on page load
        // Get the ID of the active display
        var activeDisplayId = glbStaffCurrentDisplayID;
        if(activeDisplayId == null){
            document.getElementById("Location").style.display = "block";
            activeDisplayId = "Location";
            glbStaffCurrentDisplayID = activeDisplayId;
            localStorage.setItem(glbStaffCurrentDisplayID, activeDisplayId);
        }else{
            localStorage.setItem(glbStaffCurrentDisplayID, activeDisplayId);
            activeDisplay = glbStaffCurrentDisplayID;
            document.getElementById(activeDisplay).style.display = "block";
        }

    } else if (currentDocument == "adminDashboard.php") {
        // Disable relevant displays on the admin dashboard 
        console.log("Disabling displays for adminDashboard");
        for (var i = 0; i < activeDisplay.length; i++) {
            activeDisplay[i].style.display = "none";
        }
        // Enable current display if it was hidden on page load
        // Get the ID of the active display
        var activeDisplayId = glbAdminCurrentDisplayID;
        console.log("log: " + activeDisplayId);
        if(activeDisplayId == null){
            document.getElementById("dashboard").style.display = "block";
            activeDisplayId = "dashboard";
            console.log("Was null now set at: " + activeDisplayId);
            glbAdminCurrentDisplayID = activeDisplayId;
            console.log("globlAdminCurrentDisplayId Staff is set as: " + glbAdminCurrentDisplayID);
            localStorage.setItem(glbAdminCurrentDisplayID, activeDisplayId);
        }else{
            localStorage.setItem(glbAdminCurrentDisplayID, activeDisplayId);
            activeDisplay = glbAdminCurrentDisplayID;
            document.getElementById(activeDisplay).style.display = "block";
            console.log("Reloading and seting id as: " + activeDisplay);
        }
    }
    

};
  

function changeContent(contentID) {
    // Hide all content elements
    var contentElements = document.getElementsByClassName("prof-item");
    for (var i = 0; i < contentElements.length; i++) {
      contentElements[i].style.display = "none";
    }
  
    // Show the selected content element
    var selectedContent = document.getElementById(contentID);
    selectedContent.style.display = "block";

    var currentDocument = window.location.pathname.split('/').pop();

    if(currentDocument == "profile.php"){
        localStorage.setItem("glbStaffCurrentDisplayID", contentID);
        console.log("globlStaffCurrentDisplayId Staffis set as: " + glbStaffCurrentDisplayID);
    }
    else if(currentDocument == "adminDashboard.php"){
        localStorage.setItem("glbAdminCurrentDisplayID", contentID);
        console.log("globlAdminCurrentDisplayId Admin is set as: " + glbAdminCurrentDisplayID);
    }
    
    
    
  }
function changePayment(contentID){
  console.log("working");
  // Hide all content elements
  var contentElements = document.getElementsByClassName("payment-card");
  for (var i = 0; i < contentElements.length; i++) {
    contentElements[i].style.display = "none";
  }

  // Show the selected content element
  var selectedContent = document.getElementById(contentID);
  selectedContent.style.display = "block";

}
  //linking pages
function loginPage(url){
    console.log("working..");
    window.location.href = "../Alice-Project/" + url;
    
}
function sendToProductPage(url, id){
  window.location.href = "../Alice-Project/" + url + "?id=" + id;
  
}
function goToCategory(category){
  console.log("working..");
  window.location.href = "../Alice-Project/category.php?category=" + category;
}


// SECTION: adding items to the cart
function addToCart(item_id, item_name, item_price) {
    
    // Retrieve the data attributes from the "Add to cart" button
    const itemId = item_id;
    const itemName = item_name;
    const itemPrice = item_price;
    // Send an AJAX request to add the item to the cart
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/cart.inc.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      // Handle the response from the server
      console.log(xhr.responseText);
    };
    xhr.send(`itemId=${itemId}&itemName=${itemName}&itemPrice=${itemPrice}`);
    alert("Added to cart");
    
    
  }

// Remove item from cart
function removeItem(itemId) {
  var confirmRemove = confirm('Are you sure you want to remove this item from your cart?');
  if (confirmRemove) {
      window.location.href = 'includes/remove_item.inc.php?itemId=' + itemId;
  }
}

function removeAllItems() {
  if (confirm("Are you sure you want to remove all items from the cart?")) {
    window.location.href = "includes/remove_all_items.inc.php";
  }
}

  
// Deleting item
function confirmDelete(itemId) {
  if (window.confirm('Are you sure you want to delete this item?')) {
    // Send AJAX request to delete the item from the database
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/delete_item.inc.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
          // Refresh the page
          location.reload();
      } else {
          alert('Failed to delete item');
      }
    };
    xhr.send('itemId=' + encodeURIComponent(itemId));
  }
}

/*chatting
$('#chat-form').submit(function(event) {
  event.preventDefault(); // Prevent the form from submitting normally

  // Get the form data
  var sender = $('#sender').val();
  var recipient = $('#recipient').val();
  var message = $('#message').val();

  // Send the message data to the PHP script via AJAX
  $.ajax({
    url: 'includes/send_message.inc.php',
    type: 'POST',
    data: { sender: sender, recipient: recipient, message: message },
    success: function(response) {
      // Clear the message input field
      $('#message').val('');
    }
  });
  alert("sending");
});
setInterval(function() {
  // Get the recipient's name
  var recipient = $('#recipient').val();

  // Send an AJAX request to the PHP script to get new messages
  $.ajax({
    url: 'includes/get_messages.inc.php',
    type: 'POST',
    data: { recipient: recipient },
    success: function(response) {
      // Display the new messages
      $('#chatbox').append(response);
    }
  });
}, 1000); // Check for new messages every 1 second
*/



  
  


  
