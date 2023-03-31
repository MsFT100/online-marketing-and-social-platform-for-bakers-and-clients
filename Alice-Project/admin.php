<?php
include 'header.php';
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
                
               
            
            </ul>

           
        </nav>

        
    </header>
    <div class="container">
        <div class="title">
            <h2>All Products</h2>
        </div>
        <div class="products">
            <div class="cards-container">
                <?php
                    include 'includes/dbhlogin.inc.php';
                    include 'includes/functions.inc.php';
                        // Retrieve all products from the database
                        $sql = "SELECT * FROM items";
                        $result = mysqli_query($conn, $sql);

                    // Loop through all the products and display them in cards
                    while ($row = mysqli_fetch_assoc($result)) {
                    
                ?>
                
                    <div class="card">
                        <?php $filename = basename($row['item_image']);
                            echo "<img class='card-img' src='images/uploadedImages/$filename' alt='defaultImage'>";
                        ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['item_name']; ?></h5>
                            <p class="card-text"><?php echo $row['item_description']; ?></p>
                            <h6 class="card-subtitle mb-2 text-muted">Price: <?php echo $row['item_price']; ?></h6>
                            
                        </div>
                    </div>
                
                <?php } ?>
                </div>

            </div>
    </div>
</body>
</html>