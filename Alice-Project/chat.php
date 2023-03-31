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
        
        <form id="chat-form" action="includes/sendmail.inc.php" method="POST" class="email-form">
            <label>Your name</label>
            <input type="text"  name="name" placeholder="Your name" required>
            <label>Your Email</label>
            <input type="email" name="sender" placeholder="Your Email" required>
            <label>Recipient Email</label>
            <?php
            include 'includes/dbhlogin.inc.php';
            // Retrieve the id parameter from the URL query string
            if (isset($_GET['id'])) {
                $recipient_id = $_GET['id'];
                } else {
                // Handle error if id parameter is not set
                
            }
            $sql = "SELECT usersEmail FROM users WHERE userId = $recipient_id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $recipient_email = $row['usersEmail'];
            echo "<input type='email' name='recipient' placeholder='Recipient's name' value='$recipient_email' required>";    
            
            ?>
            <label>message</label>
            <textarea name="message" placeholder="Type your message here" required></textarea>
            <button type="submit">Send</button>
        </form>


        
        <?php
            include 'footer.php';
        ?>
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>