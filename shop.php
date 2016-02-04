<!DOCTYPE html>
<?php
    require_once('connect.php');
    $error = false;
    $success = false;

    if(@$_POST['add-to-cart']){
        /**
         * If we're here...all is well. Process the insert
         */
        $stmt = $dbh->prepare('INSERT INTO cart () VALUES (:date)');
        $result = $stmt->execute(
            array(
                'date'=>$_POST['date']
            )
        );

        if($result) {
            $success = "User " . $_POST['firstName'] . " was successfully saved.";
        }else {
            $success = "There was an error saving " . $_POST['firstName'];
        }
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Shop</title>
        <style>
            img{
                width: 200px;
                height: 200px;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td><img src="pic/iron_animals.png"/></td>
                <td><img src="pic/iron_deathstar.jpg"/></td>
                <td><img src="pic/iron_fish.jpg"/></td>
            </tr>
            <tr>
                <td><img src="pic/iron_gator.jpg"/></td>
                <td><img src="pic/iron_heartflower.jpg/"></td>
                <td><img src="pic/iron_heartpop.jpg"/></td>
            </tr>
            <tr>
                <td><img src="pic/iron_keyboard.jpg"/></td>
                <td><img src="pic/iron_pixel.jpg"/></td>
                <td><img src="pic/iron_gator1.jpg"/></td>
            </tr>
        </table>


        <?php

        $sql="SELECT * FROM products ORDER BY name ASC";
        $query=mysql_query($sql);

        while ($row=mysql_fetch_array($query)) {

            ?>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo $row['price'] ?>$</td>
                <td><a href="index.php?page=products&action=add&id=<?php echo $row['id_product'] ?>">Add to cart</a></td>
            </tr>
            <?php

        }

        ?>
    </body>
</html>