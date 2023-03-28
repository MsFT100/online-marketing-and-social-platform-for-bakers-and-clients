<?php
include 'header.php';
?>
<body>
    <header class="background">
        <nav class="navbar">
            <ul class="navparent">
                <li><img class="logo" src="images/icons/logoIcon.png"></li>
                
                <li class="dropdown">
                    <button class="dropbtn">Account</button>

                    <div class="dropdown-content">
                        <?php
                            // check if user is logged in
                            if(isset($_SESSION['username'])) {
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
                        <?php
                            // check if user is logged in
                            if(isset($_SESSION['username'])) {
                                echo '<button class="dropbtn" onclick="loginPage(\'chat.php\')">Chat</button>';
                            }
                        ?>

                    </li>
                <li class="dropdown">
                    <?php
                    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
                    $cartCount = count($cart);

                    // check if user is logged in
                    if(isset($_SESSION['username'])) {
                        echo '<button class="dropbtn" onclick="loginPage(\'cart.php\')">cart</button>';
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
                    <button class="dropbtn">Shop</button>
                    <div class="dropdown-content">
                        <a href="index.php">Shop</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropbtn">Help</button>
                    <div class="dropdown-content">
                        <a href="#">Contacts</a>
                        <a href="#">support</a>
                    </div>
                </li>
                
            </ul>          
        </nav>
    </header>
    <div class="container">
        <div class="product-page">
            <?php
            include 'includes/dbhlogin.inc.php';
            include 'includes/functions.inc.php';

            // Retrieve the id parameter from the URL query string
            if (isset($_GET['id'])) {
            $id = $_GET['id'];
            } else {
            // Handle error if id parameter is not set
            }

            // Get the item details using the getItem() function
            $item = getItem($conn, $id);
            //var_dump($item);
            $filename = basename($item[0]['item_image']);
            // Display the item details
            echo "<img class='products-image'src='images/uploadedImages/$filename' alt='src='images/uploadedImages/$filename'>";
            
            echo '<div class="product-card">';
            echo "<h1 class='product-name'>" . $item[0]['item_name'] . "</h1>";
            echo "<p class='product-description'>" . $item[0]['item_description'] . "</p>";
            echo "<p class='price'>Price: ksh" . $item[0]['item_price'] . "</p>";
            echo '<div class="card-btn">';
            echo "<button class='add-to-cart-btn' data-item-id='{$item[0]['item_id']}' data-item-name='{$item[0]['item_name']}' data-item-price='{$item[0]['item_price']}' data-item-price='{$item[0]['item_image']}'
                    onclick='buyNow({$item[0]['item_id']}, \"{$item[0]['item_name']}\", {$item[0]['item_price']},  \"$filename\")'>Buy now</button>";
                    
            echo "<button class='add-to-cart-btn' data-item-id='{$item[0]['item_id']}' data-item-name='{$item[0]['item_name']}' data-item-price='{$item[0]['item_price']}' data-item-price='{$item[0]['item_image']}'
                    onclick='addToCart({$item[0]['item_id']}, \"{$item[0]['item_name']}\", {$item[0]['item_price']},  \"$filename\")'>Add to cart</button>";
            echo '</div>';
            echo '</div>';
            echo "<div class='title'><h2>Similar Items</h2></div>";
            echo "<div class='products'>";
            $randomResults = include 'includes/getSimilarProducts.inc.php';
            
            // Display the search results
            if (count($randomResults) > 0) {
                echo "<div class='cards-container'>";
                foreach ($randomResults as $result) {
                    echo "<div class='card'>";
                    $filename = basename($result['item_image']);
                    echo "<img class='card-img' src='images/uploadedImages/$filename' onclick='sendToProductPage(\"productPage.php\", \"{$result['item_id']}\")' alt='defaultImage'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>{$result['item_name']}</h5>";
                    echo "<p class='card-price'>Ksh:{$result['item_price']}</p>";
                    //when we press the add to cart button
                    echo "<button class='add-to-cart-btn' data-item-id='{$result['item_id']}' data-item-name='{$result['item_name']}' data-item-price='{$result['item_price']}'
                    onclick='addToCart({$result['item_id']}, \"{$result['item_name']}\", {$result['item_price']})'>Add to cart</button>";
                    echo "</div>"; // card-body
                    echo "</div>"; // card
                }
                echo "</div>"; // cards-container
            } else {
                echo "<p class='no-results'>No results found.</p>";
            }
            echo '</div>';
            // Close the database connection
            $conn->close();
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