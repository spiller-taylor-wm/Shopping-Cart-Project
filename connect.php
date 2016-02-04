<?php
/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'root';

try
{
    $dbh = new PDO("mysql:host=$hostname;dbname=shopping-cart", $username, $password);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

