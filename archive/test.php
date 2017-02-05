<?php
session_start();
require './src/User.php';
require './src/Validate.php';

$conn = Validate::databaseConn();
$new = User::loadUserById($conn, 3);
$new->delete($conn);
// var_dump($new);
//
// $new->setUsername('Januszetti');
// $new->setEmail($conn, 'januszetti@wp.pl');
// $new->setSalt();
// $new->setPassword('janusz11', 'janusz11');
// $new->saveToDB($conn);
// var_dump($new->saveToDB($conn));
// var_dump($new);
// var_dump($_SESSION);
// session_unset();
// var_dump($_SESSION);




 ?>
