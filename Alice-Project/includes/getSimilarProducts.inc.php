<?php
include 'includes/dbhlogin.inc.php';


$randomProducts = getSimilarProducts($conn);

// Return the array of random products
return $randomProducts;