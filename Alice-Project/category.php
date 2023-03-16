<?php
include 'header.php';
session_start();
?>
<body>

<header class="background">

    <nav class="navbar">
        <ul class="navparent">
            
            <li><img class="logo" src="images/icons/logoIcon.png" alt='defaultImage'></li>
            
            <li class="dropdown">

                <button class="dropbtn" onclick="loginPage('index.php')">Home</button>

            </li>

            <li class="dropdown">
                <button class="dropbtn">Account</button>
                <div class="dropdown-content">
                    
                <?php

                    
                    // check if user is logged in
                    if(isset($_SESSION['username'])) {
                        echo '<button class="signin-btn" onclick="loginPage(\'profile.php\')">Profile</button>';
                        echo '<button class="signin-btn" onclick="loginPage(\'#\')">My Orders</button>';
                        echo '<button class="signin-btn" onclick="loginPage(\'includes/logout.inc.php\')">Log out</button>';
                        
                    } else {
                        
                        echo '<button class="signin-btn" onclick="loginPage(\'login.php\')">sign in</button>';
                        echo '<button class="signin-btn" onclick="loginPage(\'signup.php\')">Register</button>';
                    }
                ?>

                
                </div>
            </li>
            
            <li><span class="vertical-line"></span><li>
            <li class="dropdown">
                <?php
                    // check if user is logged in
                    if(isset($_SESSION['username'])) {
                        echo '<button class="dropbtn" onclick="loginPage(\'sellpage.php\')">Sell</button>';
                    }
                ?>

            </li>
            
            <li class="dropdown">
                <button class="dropbtn">Help</button>
                <div class="dropdown-content">
                    <a href="#">Contacts</a>
                    <a href="#">support</a>
                </div>
            </li>
        </ul>

        <div>
            <form class="search-form" method="get" action="includes/search.inc.php">
                <div>
                    <br><br>
                    <h1>Connecting the bakery industry</h1>
                </div>
                <br><br>
                <div class="srch">
                    <input class="search-input" type="text" name="query" placeholder="Search for products, bakers...">
                    <button class="search-button" type="submit">
                        <img src="images/icons/search-icon-2.png" class="search-img" alt='defaultImage'>
                    </button>
                </div>
                </form>
        </div>
    </nav> 
</header>
<div class="container">
    
    <div class="title">
        <h2>shopping list</h2>
    </div>
    <div class="search-area">
        <?php
            require_once 'includes/dbhlogin.inc.php';

            // Retrieve only cake items from the database
            $category = $_GET['category'];
            // Query the database for items in the specified category
            $sql = "SELECT * FROM items WHERE item_name LIKE '%$category%'";
            $result = mysqli_query($conn, $sql);

            // Display the cake items on the page
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='card'>";
                    $filename = basename($row['item_image']);
                    echo "<button><img class='card-img' src='images/uploadedImages/$filename' alt='defaultImage'></button>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>{$row['item_name']}</h5>";
                    echo "<p class='card-price'>Ksh:{$row['item_price']}</p>";

                    // When we press the add to cart button
                    echo "<button class='add-to-cart-btn' data-item-id='{$row['id']}' data-item-name='{$row['item_name']}' data-item-price='{$row['item_price']}'
                    onclick='addToCart({$row['id']}, \"{$row['item_name']}\", {$row['item_price']})'>Add to cart</button>";
                    echo "</div>"; // card-body
                    echo "</div>"; // card
                }
            } else {
                echo 'No items found in category ' . $category;
            }
            ?>

        
    </div>
    
    <
    <?php
        include 'footer.php';
    ?>
</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
