<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    $result = false;
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function invalidUid($username){
    $result = false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function invalidEmail($email){
    $result = false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function pwdMatch($pwd,$pwdRepeat){
    $result = false;
    if($pwd != $pwdRepeat){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function uidExists($conn,$username, $email){
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function createUser($conn, $name,$email, $username, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail,usersUid, usersPwd) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email,$username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=none");

    exit();
}
function emptyInputLogin($username, $pwd){
    $result = false;
    if(empty($username) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
//here we login the user
function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);

    if($uidExists === false){
        header("location: ../login.php?error=wrong login");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false){
        header("location: ../signup.php?error=wronglogin");
    }else if ($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["username"] = $uidExists["usersUid"]; // Use 'username' instead of 'userid'
        header("location: ../index.php?error=none");
        exit();

    }
}

//updating the profiles
//retrive users name and email
function getEssentials($conn) {
    
    $userid = $_SESSION['username'];
    $stmt = mysqli_prepare($conn, "SELECT usersName, usersEmail, about, adress, user_image  FROM users WHERE usersUid = ?");
    mysqli_stmt_bind_param($stmt, "i", $userid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        return null;
    }
}
function changeProfile($conn, $profilePic, $email, $address, $about){
    session_start();
    $userid = $_SESSION['username'];

    // handle file upload
    if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == UPLOAD_ERR_OK) {
        $file_name = $_FILES["profile_pic"]["name"];
        $file_tmp = $_FILES["profile_pic"]["tmp_name"];
        $file_type = $_FILES["profile_pic"]["type"];
        $file_size = $_FILES["profile_pic"]["size"];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $allowed_exts = array("jpg", "jpeg", "png");
        $upload_dir = '../images/profilepics/';
        //$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/images/profilepics/';

        $upload_path = $upload_dir . $userid . "." . $file_ext;
        

        if (!in_array(strtolower($file_ext), $allowed_exts) || $file_size > 500000) {
            // handle error
            header("Location: ../profile.php?error=invalidfile");
            exit();
        }

        if (!is_dir($upload_dir)) {
            // directory does not exist, create it
            mkdir($upload_dir, 0777, true);
        }

        if (!file_exists($upload_dir)) {
            // handle error
            header("Location: ../profile.php?error=directorynotfound");
            exit();
        }

        if (!is_writable($upload_dir)) {
            // handle error
            header("Location: ../profile.php?error=directorynotwritable");
            exit();
        }

        if (!move_uploaded_file($file_tmp, $upload_path)) {
            // handle error
            header("Location: ../profile.php?error=uploadfailed");
            exit();
        }
        
        $profilePic = $upload_path;
         
    }

    $update_query = "UPDATE users SET usersEmail=?, about=?, adress=?, user_image=? WHERE usersUid=?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, "ssssi", $email, $about, $address, $profilePic, $userid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) >= 0) {
        header("Location: ../profile.php?success=updated");
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}




//search bar implementation
function searchItems($conn, $search_query){
    if (isset($_GET['search'])) {
        $search_query = $_GET['search'];
        // Example database query using PDO
        $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE :search_query OR description LIKE :search_query");
        $stmt->execute(['search_query' => '%'.$search_query.'%']);
        $results = $stmt->fetchAll();
        // Display search results
        foreach ($results as $result) {
            // Display each search result
        }
    }

}
//sell items
//place items on database
function submitItems($conn){

    session_start();
    // Retrieve user ID from session or cookies
    $user_id = $_SESSION['username']; // assuming user ID is stored in a session variable
    

    // Handle file upload
    if ($_FILES['item_image']['error'] === UPLOAD_ERR_OK) {
        $temp_file = $_FILES['item_image']['tmp_name'];
        $target_dir = '../images/uploadedImages/';
        $target_file = $target_dir . basename($_FILES['item_image']['name']);

        if (move_uploaded_file($temp_file, $target_file)) {
            // File was uploaded successfully
            // Insert data into database
            $item_image = $conn->real_escape_string($target_file);
            $item_type = $conn->real_escape_string($_POST['item_type']);
            $item_price = $conn->real_escape_string($_POST['item_price']);
            $item_name = $conn->real_escape_string($_POST['item_name']);

            $sql = "INSERT INTO items (user_id, item_image, item_type, item_price, item_name) VALUES ('$user_id', '$item_image', '$item_type', '$item_price', '$item_name')";

            if ($conn->query($sql) === TRUE) {
                // Data was inserted successfully
                header('Location: ../sellpage.php?error=none');
                //echo $user_id;
            } else {
                // Error inserting data
                error_reporting();
                header('Location: ../sellpage.php?error=notuploaded');
            }
        } else {
            error_reporting();
        }
    } else {
        error_reporting();
    }
}

//get products
function getProducts($conn){

    session_start();
    // Retrieve products for current user from database
    $user_id = $_SESSION['username']; // Replace with your session variable name
    $sql = "SELECT * FROM items WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    // Convert result set to array
    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
    }

    // Return products as JSON
    header('Content-Type: application/json');
    echo json_encode($products);
}

function searchProducts($conn, $searchTerm){

    // Perform the search query here
    $query = "SELECT id, item_name, item_price, item_image FROM items WHERE item_name LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $query);

    // Create an array to hold the search results
    $searchResults = array();

    // Loop through the search results and add them to the array
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults[] = array(
                'item_id' => $row['id'],
                'item_image' => $row['item_image'],
                'item_name' => $row['item_name'],
                'item_price' => $row['item_price']
            );
        }
    }

    // Return the search results array
    return $searchResults;
}

function getRandomProducts($conn){
    // Perform the search query here
    $sql = "SELECT * FROM items ORDER BY RAND() LIMIT 8";
    $result = $conn->query($sql);

    // Create an array to hold the search results
    $randomResults = array();

    // Loop through the search results and add them to the array
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $randomResults[] = array(
                'item_id' => $row['id'],
                'item_image' => $row['item_image'],
                'item_name' => $row['item_name'],
                'item_price' => $row['item_price']
            );
        }
    }

    // Return the search results array
    return $randomResults;
}

function getRandomBakers($conn){
    // Perform the search query here
    $sql = "SELECT * FROM users ORDER BY RAND() LIMIT 5";
    $result = $conn->query($sql);

    // Create an array to hold the search results
    $randomProfiles = array();

    // Loop through the search results and add them to the array
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $randomProfiles[] = array(
                'user_id' => $row['userId'],
                'user_image' => $row['user_image'],
                'user_name' => $row['usersName'],
            );
        }
    }

    // Return the search results array
    return $randomProfiles;
    var_dump($randomProfiles);
}

function removeItem(){
    if (isset($_GET['itemId'])) {
        $itemId = $_GET['itemId'];
        
        if (isset($_SESSION['cart_items'])) {
            foreach ($_SESSION['cart_items'] as $key => $item) {
                if ($item['id'] == $itemId) {
                    unset($_SESSION['cart_items'][$key]);
                    break;
                }
            }
        }
        var_dump($_SESSION['cart_items']);

        // Redirect back to the cart page
        header('Location: ../cart.php');
        exit();
    } else {
        // Return an error message
        echo 'Error: Item ID not provided';
    }
}
function removeAllItems(){
    unset($_SESSION['cart_items']);
    var_dump($_SESSION['cart_items']);
    header('Location: ../cart.php'); 
    exit();  
}

function processItems($conn){
    
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the form data
        $name = $_POST['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $notes = $_POST['notes'];
        $specifics = $_POST['specifics'];
        $user_id = $_SESSION['username']; // Replace with your session variable name
        // Do something with the data (e.g. insert into database)
        // ...
         // Insert the order details into the database
        $sql = "INSERT INTO orders (item_name, user_id, delivery_address, city, county, zip, phone, email, product_specs, delivery_instructions)
        VALUES ('$name','$user_id', '$address', '$city', '$state', '$zip', '$phone', '$email', '$specifics','$notes')";

        if ($conn->query($sql) === TRUE) {
        echo "Order added successfully";
        } else {
        echo "Error adding order: " . $conn->error;
        }
        $order_id = mysqli_insert_id($conn);
        $_SESSION['order_id'] = $order_id;
        // Close the database connection
        $conn->close();
        header('Location: ../payment.php'); 
    }
}

function addPaymentDetails($conn){
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the form data
        $card_number = $_POST['card_number'];
        $card_expiry = $_POST['card_expiry'];
        $card_cvc = $_POST['card_cvc'];
        $user_id = $_SESSION['username']; // Replace with your session variable name

        // Check if the user already has an order in the database
        $result = $conn->query("SELECT * FROM orders WHERE user_id='$user_id'");
        if ($result->num_rows > 0) {
            // User has an existing order, update the row with the payment details
            $sql = "UPDATE orders SET card_number='$card_number', card_expiry='$card_expiry', card_cvc='$card_cvc' WHERE user_id='$user_id'";
            if ($conn->query($sql) === TRUE) {
                echo "Order updated successfully";
            } else {
                echo "Error updating order: " . $conn->error;
            }
        } else {
            // User does not have an existing order, insert a new row with the payment details
            $sql = "INSERT INTO orders (user_id, card_number, card_expiry, card_cvc) VALUES ('$user_id', '$card_number', '$card_expiry', '$card_cvc')";
            if ($conn->query($sql) === TRUE) {
                echo "Order added successfully";
            } else {
                echo "Error adding order: " . $conn->error;
            }
        }

        // Send the email notification
        sendEmail($conn);

        // Close the database connection
        $conn->close();

        // Redirect to the payment confirmation page
        header('Location: ../confirmation.php'); 
    }
}

function sendEmail($conn){
    $order_id = $_SESSION['order_id'];
    //var_dump($order_id);
// Retrieve the buyer's email from the database
    $sql = "SELECT email FROM orders WHERE id = $order_id";
    $result = $conn->query($sql);
    //$row = $result->fetch_assoc();
        //var_dump($row['email']);
    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $buyer_email = $row['email'];
        // Use $buyer_email in your email function to send an email to the buyer
         // Set the email subject
          // Construct the email message body
        $message = "Dear customer,\n\nYour order has been processed and is on the way.\n\nThank you for choosing us.\n\nBest regards,\nThe Cake Shop Team";

        $subject = "Your Cake Order";

        // Set the email headers
        $headers = "From: lennoxmathewwork@gmail.com\r\n";
        $headers .= "Reply-To: lennoxmathewwork@gmail.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Send the email to the buyer
        mail($buyer_email, $subject, $message, $headers);
    }
    
   
   
    
}

function sendTo($name, $sender_email, $recipient_email, $message) {
    $subject = "New message from $name";
    $headers = "From: $name <$sender_email>\r\n";
    $headers .= "Reply-To: $sender_email\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

    $mail_result = mail($recipient_email, $subject, $message, $headers);

    if ($mail_result) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }
    header("location: ../chat.php?id=5");
}

function getItem($conn, $id){
    // Perform the search query here
    $sql = "SELECT * FROM items WHERE id = $id";
    $result = $conn->query($sql);

    // Create an array to hold the search results
    $items = array();

    // Loop through the search results and add them to the array
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = array(
                'item_id' => $row['id'],
                'item_image' => $row['item_image'],
                'item_description' => $row['item_description'],
                'item_price' => $row['item_price'],
                'item_name' => $row['item_name'],
            );
        }
    }
    // Return the search results array
    return $items;
    
}
