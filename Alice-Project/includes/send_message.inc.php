<?php
include 'dbhlogin.inc.php';
// Get the message data from the POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sender = $_POST['sender'];
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];
    
    // Insert the message into the database
    $sql = "INSERT INTO chat_messages (sender, recipient, message) VALUES ('$sender', '$recipient', '$message')";
    $result = mysqli_query($conn, $sql);
}


?>
