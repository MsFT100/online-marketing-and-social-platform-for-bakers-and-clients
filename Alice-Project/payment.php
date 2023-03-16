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
            <h2>Payment</h2>
        </div>
        <div class="payment-card">
            
            <form action="includes/process_payment.inc.php" method="post">
                <h3>Payment Details</h3><br><br>
                <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" required>
                </div>
                <div class="form-group">
                <label for="card_expiry">Card Expiry</label>
                <input type="date" id="card_expiry" name="card_expiry" required>
                </div>
                <div class="form-group">
                <label for="card_cvc">Card CVC</label>
                <input type="text" id="card_cvc" name="card_cvc" required>
                </div>
                <button type="submit">Submit Payment</button>
            </form>
        </div>
        
        <?php
            include 'footer.php';
        ?>
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>