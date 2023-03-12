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
        <div class="profile-form">
        <?php
            // include the function here
            include 'includes/profile.inc.php';
            
        ?>
    
        <div class="section-prof">

            <img src="<?php echo $profilePic ? $profilePic : 'images/icons/no-user.jpg'; ?>" class="dashboard-pic" alt="defaultImage">



            <div class="profile-card">
                <!--Retrieve username and email-->
                <br>
                
    
                <br><h1><?php echo $username; ?></h1> 
                <br><hr><br><h2>Email: <?php echo $email; ?></h2> 
                <br><hr><br><h2>About: <?php echo $about; ?></h2> 
                <br><hr><br><h2>Address:<Address><?php echo $address; ?></Address></h2>
            </div>
            


            <!--About-->
            <button class="prof-item-btn" onclick="changeContent('Profile-form')">
                <ion-icon name="pencil-outline"></ion-icon>
                Change Profile
            </button>
            <button class="prof-item-btn" onclick="changeContent('Products')">
                My products

            </button>
            <button class="prof-item-btn" onclick="changeContent('About')">
                Orders

            </button>
        </div>

            <div class="main-section-prof">
                <div class="prof-item" id="Profile-form">
                    <div class="prof-item-about">
                        <form id="update-profile_form" method="post" action="includes/updateProfile.inc.php" enctype="multipart/form-data">
                            <label for="profile_pic">Upload Profile Picture:</label>
                            <input type="file" name="profile_pic" id="profile_pic">
                            <label for="Update Your Profile">update Profile</label>
                            <input type="email" name="email" placeholder="enter your email" value="<?php echo $email;?>"><br>
                            <input type="text" name="adress" placeholder="enter your address" value="<?php echo $address;?>"><br>
                            <input type="text" name="about" class="about-box" placeholder="write something about yourself" value="<?php echo $about;?>"><br>
                            <button type="submit" name="submit"> Save</button>
                        </form>
                        
                    </div>
                    
                </div>
                <div class="prof-item" id="About">
                    
                    
                </div>
                
                <div class="prof-item" id="Products">

                    <script>
                    // Call get_products.php script using AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'includes/getProducts.inc.php');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                        // Parse response as JSON and generate product cards
                        var products = JSON.parse(xhr.responseText);
                        var container = document.getElementById('Products');
                        products.forEach(function(product) {
                            var card = document.createElement('div');
                            card.className = 'prof-item-about';
                            card.innerHTML = `
                            <img src="${product.item_image}" alt="Product Image">
                            <h3>${product.item_type}</h3>
                            <p class="price">$${product.item_price}</p>
                            <button>remove</button>
                            `;
                            container.appendChild(card);
                        });
                        }
                    };
                    xhr.send();
                    </script>

                </div>

            
            </div>
            
        </div>

        <?php
            include 'footer.php';
        ?>
            
    </div>
    <script src="javascript/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>