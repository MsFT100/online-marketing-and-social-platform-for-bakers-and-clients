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
        <div class="sell-item">

            <form action="includes/process_sell_item.inc.php" method="POST" enctype="multipart/form-data">
                <label for="item_image">Item image:</label>
                <input type="file" name="item_image" id="item_image" accept="image/*" required>
                
                

                <label for="item_type">Type:</label>
                <select name="item_type" id="item_type" required>
                    <option value="">-- Select type of cake --</option>
                    <option value="Cake">cake</option>
                    <option value="Bread">Bread</option>
                    <option value="cookies">Cookies</option>
                    <!-- Add more options as needed -->
                </select>
                
                <label for="item_name">Name:</label>
                <input type="text" name="item_name" id="item_name" required>

                <label for="item_price">Price:</label>
                <input type="number" name="item_price" id="item_price" min="10" step="0.1" required>
                
                <button type="submit">Sell item</button>
            </form>

        </div>
        
        <?php

            if(isset($_GET["error"]))
            {           
                if($_GET["error"] == "none"){
                    echo "<script>alert('successful upload')</script>";

                }else if($_GET["error"] == "notuploaded"){
                    echo "<p>incorrect info!<p>";
                }
                            
            }
        ?>
       
        <?php
        include 'footer.php';
        ?>
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>