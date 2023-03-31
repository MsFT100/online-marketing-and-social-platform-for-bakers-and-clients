<?php
include_once 'header.php';
?>

<body>
    <header class="background">
        <nav class="navbar">
                <ul class="navparent">
                    <li><img class="logo" src="images/icons/logoIcon.png"></li>
                    
                    <li class="dropdown">
                        <button class="dropbtn"><ion-icon name="help-circle"></ion-icon>Help</button>
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
                            <h1>login to see personalised products, orderd products</h1>
                        </div>
                        
                        </form>
                </div>
        </nav>

        
        
    </header>

    <div class="container">
        <div class="login-form">
            <form method="post" action="includes/login.inc.php" class="enter-form">
            
                <div class="loginForm" >
                    <h2>Login</h2>

                    <input type="text" name="uid" placeholder="username...." id="username" required>

                    <input type="password" name="pwd" placeholder="password..." id="password" required>
                    <span>

                        <ion-icon name="eye-off" id="eye" style="font-size: 23px;" onclick="showPassword()"></ion-icon>
                    </span>
                    <!--<input type="checkbox" id="show-password" onchange="showPassword()">-->
                    
                    <button class="btn" type="submit" name="submit">Log in</button>
                    
                    <a href="signup.php">Sign Up</a><br><br>
                   
                </div>
            </form>

        </div>

        <?php
            include 'footer.php';
        ?>
            
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>