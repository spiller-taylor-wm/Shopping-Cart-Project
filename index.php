<!DOCTYPE html>
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
                <li><a href='shop.php'><span>Shop</span></a>
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

        </div>
        <!-- End of content-->

        <div id="footer">
            <p>Taylor Spiller</p>
        </div>

    </body>
</html>