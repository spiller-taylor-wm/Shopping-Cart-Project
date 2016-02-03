<?php
/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'root';

try
{
    $dbh = new PDO("mysql:host=$hostname;dbname=shopping_cat", $username, $password);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

