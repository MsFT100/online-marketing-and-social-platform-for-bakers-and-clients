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
            <h2>My Orders</h2>
        </div>
        <div class="products">
            <div class="orders">
                <?php
                    include 'includes/dbhlogin.inc.php';
                    include 'includes/functions.inc.php';
                        // Retrieve all products from the database
                        $user_id = $_SESSION['username'];
                        $sql = "SELECT * FROM myorders WHERE username = '$user_id'";

                        $result = mysqli_query($conn, $sql);

                    // Loop through all the products and display them in cards
                    while ($row = mysqli_fetch_assoc($result)) {
                    
                
                
                        echo '<div class="card">';
                        $filename = basename($row["image"]);
                        echo "<img class='card-img' src='images/uploadedImages/$filename' alt='defaultImage'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $row['item'] . "</h5>";
                        echo "<p class='card-text'>" . $row['description'] . "</p>";
                        echo "<p class='card-text'>Quantity: " . $row['quantity'] . "</p>";
                        echo "<h6 class='card-subtitle mb-2 text-muted'>Price: ksh" . $row['price'] . "</h6>";
                        echo "<p class='card-text'>bought</p>";
                        echo "</div>";
                        echo "</div>";
                        
                    }
                ?>
                    
                        
                   
                
                
                 
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