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
        <title>Grave Investments</title>
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
                <li><a href='#'><span>Shop</span></a>
                    <ul>
                        <li class='has-sub'><a href='#'><span>Caskets</span></a></li>
                        <li class='has-sub'><a href='#'><span>Urns</span></a></li>
                        <li class='has-sub'><a href='#'><span>Flowers</span></a></li>
                    </ul>
                </li>
                <li><a href='#'><span>Schedule</span></a></li>
                <li class='last'><a href="#"><span>Sign In</span></a></li>
            </ul>
        </div>
        <!-- END OF NAVIGATION BAR -->

        <!-- This is where all the content that will change from page to page is added -->
        <div id="content">
            <form method="post" name="logIn">
                <input type="text" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <button type="submit" name="logIn" value="1">Sign In</button>
            </form>
            <a href="sign_up.php">sign up</a>

            <?php
            $email = 'example@gmail.com';
            $stmt = $dbh->prepare("SELECT password FROM users WHERE email = '".$_POST["email"]."'");
            $stmt->execute();
            $pass = $stmt->fetchAll();
            echo $pass;
            ?>
        </div>
        <!-- End of content-->

        <div id="footer">
            <p>Taylor Spiller</p>
        </div>

    </body>
</html>
