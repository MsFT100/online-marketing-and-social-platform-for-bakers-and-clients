<?php
include 'dbhlogin.inc.php';
include 'functions.inc.php';

$name = $_POST["name"];
$sender_email = $_POST["sender"];
$recipient_email = $_POST["recipient"];
$message = $_POST["message"];

// Send email and check for errors
sendTo($name, $sender_email, $recipient_email, $message);

?>