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

    if(@$_POST['add_cart']){
        /** Will not add to cart if the quantity is 0 */
        if(@$_POST['quantity'] > 0) {
            $stmt = $dbh->prepare('INSERT INTO cart (users_id, products_id, quantity) VALUES (:users_id, :products_id, :quantity)');
            $result = $stmt->execute(
                array(
                    /** Temporary Placeholder user */
                    'users_id' => '1',
                    'products_id' => $_POST['id_product'],
                    'quantity' => $_POST['quantity']
                )
            );
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
            <h1>Products</h1>
            <table align="center">
                <?php
                foreach($products as $product){
                    $shop_id = $product['id'];
                    $path = "pics/". $product['picture'];
                    ?>
                    <tr>
                        <td><?php echo $product['name']?></td>
                        <td><?php echo "<img src='$path'/>" ?></td>
                        <td><?php echo "$" .$product['price']?></td>
                        <td><?php echo "<form method='post'><input type='hidden' name='id_product' value='$shop_id' /><input name='quantity' value='0' type='number' min='0'/><input type='submit' name='add_cart'/></form>" ?></td>
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