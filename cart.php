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
        $stmt = $dbh->prepare("DELETE FROM cart WHERE id = '".$_POST['id_cart']."' AND users_id = '".$_SESSION['users_id']."'");
        $result = $stmt->execute();
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cart</title>
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

        <script>
            function updateCart(){
                location.reload();
            }
        </script>
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
            <h1 align="center">Cart</h1>
            <p>** As of right now, you have to refresh the page to see the updated cart **</p>
            <table align="center">
                <tr>
                    <td></td>
                    <td>Item Name</td>
                    <td>Quantity</td>
                    <td>Price per Unit</td>
                    <td>Order Price</td>
                </tr>
                <?php
                /** This php displays all of the items in the cart. It also keeps track of the running subtotal. */
                $subtotal = 0;
                foreach($cart_stuff as $cart){
                    $path = "pics/". $cart['picture'];
                    $cart_id_entry = $cart['id'];
                    $subtotal += $cart['price'] * $cart['quantity'];
                    ?>
                    <tr>
                        <td><?php echo "<img src='$path'/>"?></td>
                        <td><?php echo $cart['name']?></td>
                        <td><?php echo $cart['quantity']?></td>
                        <td><?php echo "@ $" .$cart['price']?></td>
                        <td><?php echo "Price = $" .$cart['price'] * $cart['quantity']?></td>
                        <td><?php echo "<form method='post'><input type='hidden' name='id_cart' value='$cart_id_entry' /><input type='submit' name='remove_cart' value='Remove from Cart' onClick='updateCart()'/></form>"?></td>
                    </tr>
                    <?php
                }
                $tax = number_format($subtotal * 0.1, 2);
                ?>
            </table>

            <!--- This will display the order total -->
            <div align="center">
                <p>Subtotal = $<?php echo $subtotal ?></p>
                <p>Tax = $<?php echo $tax ?></p>
                <p>Total = $<?php echo $tax + $subtotal?></p>
                <a href="checkout.php">Check Out</a>
            </div>
        </div>
        <!-- End of content-->

        <div id="footer">
            <p>Taylor Spiller</p>
        </div>

    </body>
</html>