<?php
if(isset($_POST["submit"])){
    $profilePic = $_FILES["profile_pic"]["name"];
    $tempName = $_FILES["profile_pic"]["tmp_name"];
    $email = $_POST["email"];
    $about = $_POST["about"];
    $address = $_POST["adress"];

    require_once 'dbhlogin.inc.php';
    require_once 'functions.inc.php';

    changeProfile($conn, $profilePic, $email, $address, $about);
}
else{
    header("location: ../profile.php?error=not_updated");
    exit;
}
