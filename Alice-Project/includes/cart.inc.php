<?php
session_start();
require_once 'dbhlogin.inc.php';
require_once 'functions.inc.php';

// Check if the item ID, name, and price were sent in the POST request
if (isset($_POST['itemId']) && isset($_POST['itemName']) && isset($_POST['itemPrice']) && isset($_POST['itemImage'])&& isset($_POST['itemQuantity'])) {
  $itemId = $_POST['itemId'];
  $itemName = $_POST['itemName'];
  $itemPrice = $_POST['itemPrice'];
  $itemImage = $_POST['itemImage'];
  $itemQuantity =$_POST['itemQuantity'];

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }
  
  $_SESSION['cart'][] = array(
    'id' => $itemId,
    'name' => $itemName,
    'price' => $itemPrice,
    'image' => $itemImage,
    'quantity' => $itemQuantity
  );
  
  // Store the cart items in session storage
  $_SESSION['cart_items'] = $_SESSION['cart'];
  
  echo "<script>alert('Item added to cart');</script>";
} else {
  // Return an error message
  echo 'Error: Item information not provided';
}


 
  