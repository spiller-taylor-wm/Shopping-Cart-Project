<?php
    require_once('connect.php');
    $error = false;
    $success = false;

    if(@$_POST['addUser']){
        /**
         * New user was submitted. Make sure name and email are present!
         */
        if(!$_POST['email'] || !$_POST['name_first'] || !$_POST['password']){
            $error .= '<p>Please enter all fields.</p>';
        }

        if($_POST['password'] != $_POST['password_confirm']){
            $error .= '<p>Your passwords do not match.</p>';
        }

        /**
         * If we're here...all is well. Process the insert
         */
        if($_POST['name_first'] && $_POST['email'] && $_POST['password'] && $_POST['password'] == $_POST['password_confirm']) {

            $stmt = $dbh->prepare('INSERT INTO users (email, name_first, password) VALUES (:email, :name_first, :password)');
            $result = $stmt->execute(
                array(
                    'email' => $_POST['email'],
                    'name_first' => $_POST['name_first'],
                    'password' => $_POST['password']
                )
            );


            if ($result) {
                $success = "User " . $_POST['email'] . " was successfully saved.";
            } else {
                $success = "There was an error saving " . $_POST['email'];
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
            <form name="addUser" method="post">
                <input type="text" name="email" placeholder="email">
                <input type="text" name="name_first" placeholder="name_first">
                <input type="password" name="password" placeholder="password">
                <input type="password" name="password_confirm" placeholder="confirm password">
                <button type="submit" name="addUser" value="1">Submit</button>
            </form>
            <a href="log_in.php">log in</a>

            <?php
            echo $error;
            echo $success;
            ?>
        </div>
        <!-- End of content-->

        <div id="footer">
            <p>Taylor Spiller</p>
        </div>

    </body>
</html>
