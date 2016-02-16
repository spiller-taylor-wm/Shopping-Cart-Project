<?php
    require_once('connect.php');
    $stmt = $dbh->prepare('SELECT c.quantity, p.name, c.id, p.price, p.picture, p.artist, c.products_id FROM products p INNER JOIN cart c ON c.products_id=p.id');
    $result = $stmt->execute();
    $message = "";

    if(!$result){
        $error .= '<p>There was an error processing your request.</p>';
    }else {
        $cart_stuff = $stmt->fetchAll();
    }

    if(@$_POST['remove_cart']){
        $stmt = $dbh->prepare("DELETE FROM cart WHERE id = '".$_POST['id_cart']."' AND users_id = '1'");
        $result = $stmt->execute();
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
                width: 100px;
                height: 100px;
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
            <h1>Products</h1>
            <table align="center">
                <?php
                foreach($cart_stuff as $cart){
                    $path = "pics/". $cart['picture'];
                    $cart_id_entry = $cart['id'];
                    ?>
                    <tr>
                        <td><?php echo $cart['name']?></td>
                        <td><?php echo $cart['price']?></td>
                        <td><?php echo $cart['quantity']?></td>
                        <td><?php echo "<img src='$path'/>"?></td>
                        <td><?php echo "<form method='post'><input type='hidden' name='id_cart' value='$cart_id_entry' /><input type='submit' name='remove_cart' value='Remove from Cart'/></form>"?></td>
                    </tr>
                    <?php
                }
                echo $message;
                ?>

            </table>
        </div>
        <!-- End of content-->

        <div id="footer">
            <p>Taylor Spiller</p>
        </div>

    </body>
</html>