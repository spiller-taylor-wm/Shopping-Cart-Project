<?php
    require_once('connect.php');
    /** Pulls everything from cart */
    $stmt = $dbh->prepare('SELECT c.quantity, p.name, c.id, p.price, p.picture, p.artist, c.products_id FROM products p INNER JOIN cart c ON c.products_id=p.id');
    $result = $stmt->execute();
    $message = "";

    if(!$result){
        $message .= '<p>There was an error processing your request.</p>';
    }else {
        $cart_stuff = $stmt->fetchAll();
    }

    if(@$_POST['check_out']){   // Adds user id to orders table
        /** Create Order */
        $stmt = $dbh->prepare('INSERT INTO orders (users_id) VALUES (:users_id)');
        $result = $stmt->execute(
            array(
                /** Temporary Placeholder user */
                'users_id' => $_SESSION['users_id']
            )
        );
        $orders_id = $dbh->lastInsertId();    // Grabs the last id that was entered, which will be used as the orders id

        $query = "INSERT INTO orders_products (products_id, orders_id, quantity) VALUES (:products_id, :orders_id, :quantity)";
        $stmt = $dbh->prepare($query);

        foreach ($cart_stuff as $order) {   // Adds all items in the cart to the orders_products table
            $products_id = $order['products_id'];
            $quantity = $order['products_id'];
            $stmt->execute(
                array(
                    'products_id'   => $products_id,
                    'orders_id'     => $orders_id,
                    'quantity'      => $quantity
                )
            );
        }

        // Empties the Cart
        $query = "TRUNCATE TABLE cart";
        $stmt = $dbh->prepare($query);
        $stmt->execute();

        // Adds success message
        $message .= "Order successfully placed!";
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Check Out</title>
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
        <h1 align="center">Checkout</h1>
        <p>I am working on getting this page to put everything that is in the cart into the orders and orders_products tables when they press the button.</p>
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
            <form method = "post">
                <input type="submit" name="check_out" value="Check Out">
            </form>
            <?php echo $msg; ?>
        </div>
    </div>
    <!-- End of content-->

    <div id="footer">
        <p>Taylor Spiller</p>
    </div>

    </body>
</html>