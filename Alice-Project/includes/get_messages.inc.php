<?php
include 'dbhlogin.inc.php';

// Get the recipient's name from the POST request
$recipient = $_POST['recipient'];

// Query the database for new messages
$sql = "SELECT * FROM chat_messages WHERE recipient = '$recipient' ORDER BY timestamp DESC";
$result = mysqli_query($conn, $sql);

// Loop through the messages and return them as HTML
//while