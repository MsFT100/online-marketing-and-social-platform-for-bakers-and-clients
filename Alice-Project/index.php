<?php
include_once 'header.php';

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
                    <button class="dropbtn">Help</button>
                    <div class="dropdown-content">
                        <a href="#">Contacts</a>
                        <a href="#">support</a>
                    </div>
                </li>
            </ul>

            <div>
                <form class="search-form" action="POST" method="get">
                    <div>
                        <br><br>
                        <h1>Connecting the bakery industry</h1>
                    </div>
                    <br><br>
                    <div class="srch">
                        <input class="search-input" type="text" name="search" placeholder="Search for products, bakers...">
                        <button class="search-button" type="submit">
                            <img src="images/icons/search-icon-2.png" class="search-img">
                        </button>
                    </div>
                    </form>
            </div>
        </nav>

        
    </header>
    <div class="container">

        <div class="title">
            <h2>Top Bakers</h2>
        </div>

    
        <div class="profiles">
    
            <div class="cardProfile">
                <button>
                <ion-icon name="person-circle-outline"></ion-icon>
                    
                </button>
            </div>
            <div class="cardProfile">
                <button>

                <ion-icon name="person-circle-outline"></ion-icon>
                </button>
            </div>
            <div class="cardProfile">
                <button>
                    <ion-icon name="person-circle-outline"></ion-icon>
                </button>
            </div>
        </div>
        <div class="title">
            <h2>Our products</h2>
        </div>
        <div class="products">
            <ul>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>

                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>
                <li class="item">
                    <button>
                        <img src="images/icons/logoIcon.png" alt="cake">
                    </button>
                </li>

            </ul>
        </div>

        <?php
    
        include 'footer.php';
        ?>
    </div>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>