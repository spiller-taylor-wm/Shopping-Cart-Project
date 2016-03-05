<?php
    /*** mysql hostname ***/
    $hostname = 'localhost';

    /*** mysql username ***/
    $username = 'root';

    /*** mysql password ***/
    /** if using at west-mec */
    $password = 'root';

    /**If using at home
    $password = '';
     * */

    try {
        $dbh = new PDO("mysql:host=$hostname;dbname=shopping-cart-2", $username, $password);
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }

    session_set_cookie_params(0);
    session_start();


