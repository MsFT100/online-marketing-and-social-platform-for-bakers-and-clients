<?php

if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $about = $_POST["about"];
    $address = $_POST["adress"];

    require_once 'dbhlogin.inc.php';
    require_once 'functions.inc.php';

    $user = changeProfile($conn, $email, $address, $about);
}
else{
    header("location: ../profile.php?error=not updated");
    exit;
}
