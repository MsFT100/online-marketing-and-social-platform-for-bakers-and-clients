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
        $target_dir = 'images/uploadedImages/';
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
                header('Location: ../sellpage.php?error=uploaded');
                //echo $user_id;
            } else {
                // Error inserting data
                error_reporting();
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
    $user_id = $_SESSION['userid']; // Replace with your session variable name
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
    $query = "SELECT item_name, item_price, item_image FROM items WHERE item_name LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $query);

    // Create an array to hold the search results
    $searchResults = array();

    // Loop through the search results and add them to the array
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults[] = array(
                'item_image' => $row['item_image'],
                'item_name' => $row['item_name'],
                'item_price' => $row['item_price']
            );
        }
    }

    // Return the search results array
    return $searchResults;
}

