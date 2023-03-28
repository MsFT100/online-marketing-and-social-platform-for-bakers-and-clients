<?php
include_once 'header.php';
?>
<body>
    <header class="background">
        <nav class="navbar">
            <ul class="navparent">
                
                <li><img class="logo" src="images/icons/logoIcon.png" alt='defaultImage'></li>
                <li class="dropdown">
                    <button class="dropbtn"><ion-icon name="person"></ion-icon>Account</button>
                    <div class="dropdown-content">
                        
                    <?php

                       
                        // check if user is logged in
                        if(isset($_SESSION['username'])) {
                            echo '<button class="signin-btn" onclick="loginPage(\'profile.php\')"><ion-icon name="person"></ion-icon>Profile</button>';
                            
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
                                //echo '<button class="dropbtn" onclick="loginPage(\'chat.php\')"><ion-icon name="chatbox-ellipses"></ion-icon>Chat</button>';
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
                        /*echo '<a href="cart.php">
                        
                        <span class="cart-count"><?php echo $cartCount; ?></span>
                        </a>';*/
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
        
        <div class="title">
            <h2>Our products</h2>
        </div>
        <div class="products">
            <ul>
                <li class="item">
                    <button onclick="goToCategory('cake')">
                        <img src="images/icons/Fresh cakes.jpg" alt="cake">
                    </button>
                    <h3>Cake</h3>
                </li>
                
                <li class="item">
                    <button onclick="goToCategory('Financiers')">
                        <img src="images/icons/Financiers.jpg" alt="cake">
                    </button>
                    <h3>Financiers</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Scones')">
                        <img src="images/icons/scones.jpg" alt="cake">
                    </button>
                    <h3>Scones</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Cookies')">
                        <img src="images/icons/cookies.jpg" alt="cake">
                    </button>
                    <h3>Cookies</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Muffins')">
                        <img src="images/icons/muffins.jpg" alt="cake">
                    </button>
                    <h3>Muffins</h3>
                </li>

                <li class="item">
                    <button onclick="goToCategory('Bread Rolls')">
                        <img src="images/icons/bread-rolls.jpg" alt="cake">
                    </button>
                    <h3>Bread Rolls</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Pizza')">
                        <img src="images/icons/pizza.jpg" alt="cake">
                    </button>
                    <h3>Pizza</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Maandazi')">
                        <img src="images/icons/mandazi.jpg" alt="cake">
                    </button>
                    <h3>Maandazi</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Bread Rolls')">
                        <img src="images/icons/bread-rolls.jpg" alt="cake">
                    </button>
                    <h3>Bread Rolls</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Burger Buns')">
                        <img src="images/icons/BurgerBuns.jpg" alt="cake">
                    </button>
                    <h3>Pizza</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Special cakes')">
                        <img src="images/icons/Special cakes.jpg" alt="cake">
                    </button>
                    <h3>Special cakes</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Tarts')">
                        <img src="images/icons/Tarts.jpg" alt="cake">
                    </button>
                    <h3>Tarts</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Macaron')">
                        <img src="images/icons/Macaron.jpg" alt="cake">
                    </button>
                    <h3>Macaron</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Baquette')">
                        <img src="images/icons/mandazi.jpg" alt="cake">
                    </button>
                    <h3>Baquette</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Muffins')">
                        <img src="images/icons/muffins.jpg" alt="cake">
                    </button>
                    <h3>Muffins</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Vienna')">
                        <img src="images/icons/Vienna.jpg" alt="cake">
                    </button>
                    <h3>Vienna</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Ciabatta')">
                        <img src="images/icons/Ciabatta.jpg" alt="cake">
                    </button>
                    <h3>Ciabatta</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Scones')">
                        <img src="images/icons/mandazi.jpg" alt="cake">
                    </button>
                    <h3>Maandazi</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Submarine')">
                        <img src="images/icons/submarine.jpg" alt="cake">
                    </button>
                    <h3>Submarine</h3>
                </li>
                <li class="item">
                    <button onclick="goToCategory('Viennosiere')">
                        <img src="images/icons/viennoiserie.jpg" alt="cake">
                    </button>
                    <h3>Viennosiere</h3>
                </li>

            </ul>
        </div>
        <div class="title">
            <h2>Shop</h2>
        </div>
        <div class="products"> 
            <?php
                
                $randomResults = include 'includes/randomproducts.inc.php';
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
            
                
            ?>

            
        </div>

        <div class="title">
            <h2>profiles</h2>
        </div>
        <div class="profiles">
            <?php
            include 'includes/dbhlogin.inc.php';
            
            $profiles = getRandomBakers($conn);
            //var_dump($profiles);
                // Display the search results
                if (count($profiles) > 0) {
                    echo "<div class='cards-container'>";
                    foreach ($profiles as $result) {
                        echo "<div class='card-prof'>";
                        $filename = basename($result['user_image']);
                        echo "<img class='prof-img' src='images/profilepics/$filename' onclick='sendToProductPage(\"chat.php\", \"{$result['user_id']}\")' alt='defaultImage'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>{$result['user_name']}</h5>";
                        echo "<button onclick='sendToProductPage(\"chat.php\", \"{$result['user_id']}\")' >Write to</button>";
                        
                        echo "</div>"; // card-body
                        echo "</div>"; // card
                    }
                    echo "</div>"; // cards-container
                } else {
                    echo "<p class='no-results'>No results found.</p>";
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