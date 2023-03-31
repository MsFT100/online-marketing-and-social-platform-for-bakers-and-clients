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
                                <h1>You are one step closer from accesing our products<br> sign up below</h1>
                                
                            </div>
                            
                            </form>
                    </div>
        </nav>


    </header>

    <div class="container">

        <div class="login-form">

            <!--signup form-->       
            <form method="post" action="includes/signup.inc.php">

                <div class="loginForm">
                    <h2>Sign up</h2>
                    
                    <input type="text" name="name" placeholder="Enter Full name here" required>

                    <input type="text" name="email" placeholder="Enter your Email here" required>

                    <input type="text" name="uid" placeholder="Enter username here" required>

                    <input type="password" name="pwd" placeholder="Enter password here" required>
                    <span>

                        <ion-icon name="eye-off" id="eye" style="font-size: 23px;" onclick="showPassword()"></ion-icon>
                    </span>
                    <input type="password" name="pwdrepeat" placeholder="Repeat password" required>

                    <button class="btn" type="submit" name="submit">Sign Up</button>
                    <a href="login.php">Log in</a>
                    

                    <?php
                        if(isset($_GET["error"]))
                        {
                            if($_GET["error"] == "emptyinput"){
                                echo "<p>Fill in all fields!<p>";
                            }else if($_GET["error"] == "invaliduid"){
                                echo "<p>username already exists!<p>";
                            }
                            else if($_GET["error"] == "invalidemail"){
                                echo "<p>choose proper email!<p>";
                            }
                            else if($_GET["error"] == "passwordsdontmatch"){
                                echo "<p>passwords doesn't match!<p>";
                            }
                            else if($_GET["error"] == "stmtfailed"){
                                echo "<p>something went wrong, try again!<p>";
                            }
                            else if($_GET["error"] == "usernametaken"){
                                echo "<p>username already taken!<p>";
                            }
                            else if($_GET["error"] == "none"){
                                echo "<p>You have signed up!<p>";
                            }
                        }
                    ?>
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