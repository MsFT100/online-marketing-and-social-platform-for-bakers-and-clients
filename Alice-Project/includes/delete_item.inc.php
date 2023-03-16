<?php
session_start();
require_once 'dbhlogin.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = mysqli_real_escape_string($conn, $_POST['itemId']);

    // Check if the item belongs to the current user
    $user_id = $_SESSION['username']; // Replace with your session variable name
    $sql = "SELECT * FROM items WHERE id = '$itemId' AND user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // Delete the item from the database
        $sql = "DELETE FROM items WHERE id = '$itemId'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Send a success response
            http_response_code(200);
            echo 'Item deleted successfully';
        } else {
            // Send an error response
            http_response_code(500);
            echo 'Failed to delete item';
        }
    } else {
        // Send an error response
        http_response_code(403);
        echo 'Access denied';
    }
} else {
    // Send an error response
    http_response_code(400);
    echo 'Invalid request';
}


