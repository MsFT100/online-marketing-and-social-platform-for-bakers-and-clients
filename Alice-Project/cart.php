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
            <div class="search-area">
                <div class="checkout-table">

                    <?php
                        // Retrieve the cart items from the session storage
                        $cartItems = isset($_SESSION['cart_items']) ? $_SESSION['cart_items'] : array();

                        // Initialize total price
                        $totalPrice = 0;

                        // Loop through the cart items and display them in a table
                        if (!empty($cartItems)) {
                        echo "<table>";
                        echo "<tr><th>Item Name</th><th>Price</th></tr>";
                        foreach ($cartItems as $item) {
                            $itemId = $item['id'];
                            $itemName = $item['name'];
                            $itemPrice = $item['price'];
                            $totalPrice += $itemPrice;
                            //echo $itemId;
                            echo "<tr>";
                            echo "<tr id='item-{$itemId}'>";
                            echo "<td>{$itemName}</td>";
                            echo "<td>{$itemPrice}</td>";
                            echo "<td><button onclick=\"removeItem('{$itemId}')\">Remove</button></td>";

                            //echo "<td><button onclick=\"removeItem('{$item['id']}')\">Remove</button></td>";
                            echo "</tr>";
                        }
                        echo "<tr><td><strong>Total</strong></td><td>{$totalPrice}</td></tr>";
                        echo "</table>";
                        } else {
                        echo "<p>Your cart is empty.</p>";
                        }
                    ?>

                     <button onclick="loginPage('checkout.php')">Checkout</button>
                     <button onclick="removeAllItems()">Remove All</button>



                </div>
            
            </div>

            <?php
            include 'footer.php';
            ?>
    </div>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>