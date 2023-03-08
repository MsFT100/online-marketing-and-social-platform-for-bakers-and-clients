
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

  //linking pages
function loginPage(url){
    console.log("working..");
    window.location.href = "../Alice-Project/" + url;
    
}