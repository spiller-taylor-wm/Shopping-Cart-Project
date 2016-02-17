<?php
    require_once('connect.php');
    $error = false;
    $success = false;

    if(@$_POST['logIn']){
        /**
         * New user was submitted. Make sure name and email are present!
         */
        if(!$_POST['email'] || !$_POST['password']){
            $error .= '<p>Please enter all fields.</p>';
        }

        /**
         * If we're here...all is well. Process the insert
         */



        if($_POST['password'] && $_POST['email']) {

            $email = $_POST['email'];
            /** I know this isn't secure, but it will work for now */
            $stmt = $dbh->prepare("SELECT password FROM users WHERE email = '".$_POST["email"]."'");
            $stmt->execute();
            $pass = $stmt->fetchAll();
            if($_POST['password'] == $pass){
                $result = true;
            } else {
                $result = false;
            }


            if ($result) {
                $success = "User " . $_POST['email'] . " was successfully logged in.";

            } else {
                $success = "There was an error signing in " . $_POST['email'];
            }
        }
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>

        <!-- Files for menu bar -->
        <script src="js/navbar.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

        <style>
            td{
                padding-right: 30px;
                text-align: center;
            }
            p, h1{
                padding-left: 20px;
                padding-right: 20px;
            }
            img{
                width: 200px;
                height: 200px;
            }

        </style>
    </head>
    <body>
        <!-- Top Logo -->
        <header>

        </header>

        <!-- NEW NAVIGATION BAR
        http://cssmenumaker.com/menu/animated-responsive-drop-down-menu
        -->
        <div style="z-index: 10" id='cssmenu'>
            <ul>
                <li class='active'><a href='index.php'><span>Home</span></a></li>
                <li><a href='shop.php'><span>Shop</span></a></li>
                <li><a href='about.html'><span>About</span></a></li>
                <li><a href="account.php">Profile</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li class='last'><a href="log_in.php"><span>Sign In</span></a></li>
            </ul>
        </div>
        <!-- END OF NAVIGATION BAR -->

        <!-- This is where all the content that will change from page to page is added -->
        <div id="content">
            <h1>Log In</h1>
            <p>** So far this website does not actually log someone in, but it will show an error if the user does not enter both fields. **</p>
            <form method="post" name="logIn">
                <input type="text" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <button type="submit" name="logIn" value="1">Sign In</button>
            </form>
            <a href="sign_up.php">sign up</a>

            <?php
            /**
            $email = 'example@gmail.com';
            $stmt = $dbh->prepare("SELECT password FROM users WHERE email = '".$_POST["email"]."'");
            $stmt->execute();
            $pass = $stmt->fetchAll();
            echo $pass;
             */
            ?>
        </div>
        <!-- End of content-->

        <div id="footer">
            <p>Taylor Spiller</p>
        </div>

    </body>
</html>
