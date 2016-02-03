<!DOCTYPE html>
<?php
    require_once('connect.php');
    $error = false;
    $success = false;


    if(@$_POST['addUser']){
        /**
         * New user was submitted. Make sure name and email are present!
         */
        if(!$_POST['email'] || !$_POST['username'] || !$_POST['name'] || !$_POST['password']){
            $error .= '<p>Please enter all fields.</p>';
        }

        if($_POST['password'] != $_POST['password_confirm']){
        $error .= '<p>Your passwords do not match.</p>';
        }

        /**
        * If we're here...all is well. Process the insert
        */
        if($_POST['name'] && $_POST['email'] && $_POST['password'] && $_POST['username'] && $_POST['password'] == $_POST['password_confirm']) {

        $stmt = $dbh->prepare('INSERT INTO users (name, email, password, username) VALUES (:name, :email, :password, :username)');
        $result = $stmt->execute(
        array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'username' => $_POST['username']
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
        <title>Home</title>
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
    </body>
</html>