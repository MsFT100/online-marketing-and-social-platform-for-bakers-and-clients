<?php
session_start();
require_once 'functions.inc.php';

if (isset($_GET['itemId'])) {
    $itemId = $_GET['itemId'];
    removeItem($itemId);
} else {
    echo 'Error: Item ID not provided';
}
?>

