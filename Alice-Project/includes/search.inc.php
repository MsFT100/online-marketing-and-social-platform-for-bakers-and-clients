<?php
require_once 'dbhlogin.inc.php';
require_once 'functions.inc.php';

if (isset($_GET['query'])) {
    $searchTerm = $_GET['query'];

    // Call the searchProducts function and capture the search results
    $searchResults = searchProducts($conn, $searchTerm);

    // Pass the search results to searchitem.php using a query string parameter
    header("Location: ../searchitem.php?results=" . urlencode(json_encode($searchResults)));
    exit();
}

