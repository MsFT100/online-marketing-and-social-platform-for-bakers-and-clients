<?php
require_once 'dbhlogin.inc.php';
require_once 'functions.inc.php';

// Call the getRandomProducts function to get the array of random products
$randomProducts = getRandomProducts($conn);

// Return the array of random products
return $randomProducts;