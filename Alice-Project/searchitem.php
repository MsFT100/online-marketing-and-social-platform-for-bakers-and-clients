<?php
include 'header.php';
?>
<body>

    <header class="background">

        <nav class="navbar">
            <ul class="navparent">
                
                <li><img class="logo" src="images/icons/logoIcon.png" alt='defaultImage'></li>
                
                <li class="dropdown">

                    <button class="dropbtn" onclick="loginPage('index.php')"><ion-icon name="home"></ion-icon>Home</button>

                </li>

                <li class="dropdown">
                    <button class="dropbtn"><ion-icon name="person"></ion-icon>Account</button>
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
                            echo '<button class="dropbtn" onclick="loginPage(\'sellpage.php\')"><ion-icon name="bag-handle"></ion-icon>Sell</button>';
                        }
                    ?>

                </li>
                <li class="dropdown">
                        <?php
                            // check if user is logged in
                            if(isset($_SESSION['username'])) {
                                echo '<button class="dropbtn" onclick="loginPage(\'myOrders.php\')"><ion-icon name="bag-check"></ion-icon>myOrders</button>';
                            }
                        ?>

                    </li>
                <li class="dropdown">
                    <?php
                    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
                    $cartCount = count($cart);

                    // check if user is logged in
                    if(isset($_SESSION['username'])) {
                        echo '<button class="dropbtn" onclick="loginPage(\'cart.php\')"><ion-icon name="cart"></ion-icon>cart</button>';
                        echo '<div class="dropdown-content">';
                        echo '<a href="cart.php">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="cart-count"><?php echo $cartCount; ?></span>
                        </a>';
                        echo '</div>';
                    }
                    
                    ?>
                    
                  
                </li>
                
                <li class="dropdown">
                    <button class="dropbtn"><ion-icon name="help-circle"></ion-icon>Help</button>
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
        <div class="search-area">
            <?php
            

            // Check if there are search results to display
           if (isset($_GET['results'])) {

            // Decode the search results from the query string parameter
            $searchResults = json_decode($_GET['results'], true);

            // Display the search results
            if (count($searchResults) > 0) {
                echo "<div class='cards-container'>";
                foreach ($searchResults as $result) {
                    echo "<div class='card'>";
                    $filename = basename($result['item_image']);
                    echo "<button><img class='card-img' src='images/uploadedImages/$filename' onclick='sendToProductPage(\"productPage.php\", \"{$result['item_id']}\")' alt='defaultImage'></button>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>{$result['item_name']}</h5>";
                    echo "<p class='card-price'>Ksh:{$result['item_price']}</p>";
            
                    //when we press the add to cart button
                    echo "<button class='add-to-cart-btn' 
                        data-item-id='{$result['item_id']}' data-item-name='{$result['item_name']}'
                         data-item-price='{$result['item_price']}' data-item-image='{$filename}'
                        onclick='addToCart({$result['item_id']}, \"{$result['item_name']}\", {$result['item_price']}, \"$filename\" )'>Add to cart</button>";
                    echo "</div>"; // card-body
                    echo "</div>"; // card
                }
                echo "</div>"; // cards-container
            } else {
                echo "<p class='no-results'>No results found.</p>";
            }
        }

            
            ?>

        </div>

        <?php
        include 'footer.php';
        ?>
    </div>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>