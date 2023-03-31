
//profile buttons
var glbStaffCurrentDisplayID;
var glbAdminCurrentDisplayID;
window.onload = function() {
    //console.log("sttartOfDEBUG");
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
            document.getElementById("Location").style.display = "flex";
            activeDisplayId = "Location";
            glbStaffCurrentDisplayID = activeDisplayId;
            localStorage.setItem(glbStaffCurrentDisplayID, activeDisplayId);
        }else{
            localStorage.setItem(glbStaffCurrentDisplayID, activeDisplayId);
            activeDisplay = glbStaffCurrentDisplayID;
            document.getElementById(activeDisplay).style.display = "flex";
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
            document.getElementById("dashboard").style.display = "flex";
            activeDisplayId = "dashboard";
            console.log("Was null now set at: " + activeDisplayId);
            glbAdminCurrentDisplayID = activeDisplayId;
            console.log("globlAdminCurrentDisplayId Staff is set as: " + glbAdminCurrentDisplayID);
            localStorage.setItem(glbAdminCurrentDisplayID, activeDisplayId);
        }else{
            localStorage.setItem(glbAdminCurrentDisplayID, activeDisplayId);
            activeDisplay = glbAdminCurrentDisplayID;
            document.getElementById(activeDisplay).style.display = "flex";
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
    selectedContent.style.display = "flex";

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
function addToCart(item_id, item_name, item_price, item_image) {
    // Retrieve the data attributes from the "Add to cart" button
    const itemId = item_id;
    const itemName = item_name;
    const itemPrice = item_price;
    const itemImage = item_image;
    // Retrieve the quantity value from the input field
    //const quantity = document.querySelector('input[name="quantity"]').value;
    const quantityInput = document.querySelector('input[name="quantity"]');
    console.log('quantityInput',quantityInput);
    if(quantityInput == null){
      quantity = 1;
    }
    //const quantity = quantityInput.value !== '' ? parseInt(quantityInput.value) : 1;
    console.log(quantity);
    // Send an AJAX request to add the item to the cart
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/cart.inc.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      // Handle the response from the server
      console.log(xhr.responseText);
    };
    xhr.send(`itemId=${itemId}&itemName=${itemName}&itemPrice=${itemPrice}&itemImage=${itemImage}&itemQuantity=${quantity}`);
    alert("Added to cart");
    
    
  }
//add to cart and go to checkout
function buyNow(item_id, item_name, item_price, item_image){
  // Retrieve the data attributes from the "Add to cart" button
  const itemId = item_id;
  const itemName = item_name;
  const itemPrice = item_price;
  const itemImage = item_image;
  // Send an AJAX request to add the item to the cart
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'includes/cart.inc.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    // Handle the response from the server
    console.log(xhr.responseText);
  };
  xhr.send(`itemId=${itemId}&itemName=${itemName}&itemPrice=${itemPrice}&itemImage=${itemImage}`);
    
  alert("Added to cart");
  window.location.href = "../Alice-Project/checkout.php";
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

function showPassword() {
  var passwordField = document.getElementById("password");
  var eyeIcon = document.getElementById("eye");
  if (passwordField.type === "password") {
      passwordField.type = "text";
      eyeIcon.setAttribute("name", "eye");
      eyeIcon.setAttribute("name", "eye-off");
  } else {
      passwordField.type = "password";
      eyeIcon.setAttribute("name", "eye-off");
      eyeIcon.setAttribute("name", "eye");
  }
}





  
  


  
