<?php
/**
 * Created by PhpStorm.
 * User: matthieuparis
 * Date: 09/11/2018
 * Time: 21:49
 */

$user= "tpPHP";
$pass= "tpPHP";

try {
    $dbh = new PDO('mysql:host=mariadb;dbname=tpPHP', $user, $pass);
} catch (PDOException $e) {
    print "Error !: " . $e->getMessage() . "<br/>";
    die();
}
