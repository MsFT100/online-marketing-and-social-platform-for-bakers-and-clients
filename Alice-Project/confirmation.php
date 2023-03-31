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
                        <?php
                            // check if user is logged in
                            if(isset($_SESSION['username'])) {
                                echo '<button class="dropbtn" onclick="loginPage(\'myOrders.php\')"><ion-icon name="bag-check"></ion-icon>myOrders</button>';
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
        <div class="end-page">

        <div class="wrapper">
            <div class="title">
                <?php
                include 'includes/dbhlogin.inc.php';
                include 'includes/functions.inc.php';
                sendEmail($conn);
                ?>
                    <h2>Payment recieved</h2>
                    <div class="checkmark">
                    <ion-icon name="checkmark-outline"></ion-icon>
                    </div>
                    <p>Thank you for shopping. click the button below to continue shopping.</p>
            </div>
            
        
            <button onclick="loginPage('index.php')">Continue shopping</button>
                
        </div>
            
            
        </div>
        <?php
            include 'footer.php';
        ?>  
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>