<?php
require_once 'dbhlogin.inc.php';
require_once 'functions.inc.php';

$user = getEssentials($conn);
if ($user) {
    $username = $user['usersName'];
    $email = $user['usersEmail'];
    $about = $user['about'];
    $address = $user['adress'];
    $profilePic = $user['user_image'];
}
