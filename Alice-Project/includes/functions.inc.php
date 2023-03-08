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
    $stmt = mysqli_prepare($conn, "SELECT usersName, usersEmail, about, adress  FROM users WHERE usersUid = ?");
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
function changeProfile($conn, $email, $address, $about){
    session_start();
    // get the user ID from the session or a GET/POST variable
    $userid = $_SESSION['username']; // replace with your own code

    

    // update the user's details in the database
    // replace this with your own code to update the database
    $update_query = "UPDATE users SET usersEmail=?, about=?, adress=? WHERE usersUid=?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, "sssi", $email, $about, $address, $userid);
    mysqli_stmt_execute($stmt);

    if (!mysqli_stmt_prepare($stmt, $update_query)) {
        // redirect the user to their profile page or display a success message
        header("Location: ../profile.php?error=updated");
    } else {
        // display an error message
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

