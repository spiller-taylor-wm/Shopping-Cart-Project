<?php
    require_once('connect.php');
    $message = "";
    /**
     * We'll always want to pull the users to show them in the table
     */
    $stmt = $dbh->prepare('SELECT * FROM products');
    $result = $stmt->execute();

    if(!$result){
        $message .= '<p>There was an error processing your request.</p>';
    }else {
        $products = $stmt->fetchAll();
    }

$_SESSION['users_id'] = null;

    if(@$_POST['add_cart']) {
        /** Must be logged in to add items to cart.  */
        if(!is_null($_SESSION['users_id'])) {
            /** Will not add to cart if the quantity is 0 */
            if (@$_POST['quantity'] > 0) {
                $stmt = $dbh->prepare('INSERT INTO cart (users_id, products_id, quantity) VALUES (:users_id, :products_id, :quantity)');
                $result = $stmt->execute(
                    array(
                        /** Temporary Placeholder user */
                        'users_id' => $_SESSION['users_id'],
                        'products_id' => $_POST['id_product'],
                        'quantity' => $_POST['quantity']
                    )
                );
            }
        } else {
            /** They are not logged in */
            echo "You are not logged in!!";
        }
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Products</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>

        <!-- Files for menu bar -->
        <script src="js/navbar.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="css/navbar.css"/>

        <style>
            td{
                padding-right: 30px;
                text-align: center;
                width: 33%;
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
            <h1>Products</h1>
            <table align="center">
                <?php
                    $count = 0;
                    foreach ($products as $product) {
                        $shop_id = $product['id'];
                        $path = "pics/" . $product['picture'];
                        if ($count%3 == 0){
                            echo "<tr>";
                        }
                        ?>
                        <td>
                            <?php echo "<img src='$path'/><br/>" ?>
                            <?php echo $product['artist'] .": " .$product['name']?>
                            <br/>
                            <?php echo "$" .$product['price']?>
                            <br/>
                            <?php echo "<form method='post'><input type='hidden' name='id_product' value='$shop_id' />Quantity: <input name='quantity' style='width: 3em;' value='0' type='number' min='0'/><br/><input type='submit' name='add_cart' value='Add to Cart'/></form>" ?>
                        </td>
                        <?php
                        if ($count%3 == 2){
                            echo "</tr>";
                        }
                        $count += 1;
                    }
                ?>
            </table>
        </div>
        <!-- End of content-->

        <div id="footer">
            <p>Taylor Spiller</p>
        </div>

    </body>
</html>