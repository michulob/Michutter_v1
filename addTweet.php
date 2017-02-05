<?php

require 'src/User.php';
require 'src/Tweet.php';
require 'src/Validate.php';
session_start();
if(!isset($_SESSION['logged'])){
  header ('Location: index.php');
}else{
  $conn = Validate::databaseConn();
  $loggedUser = User::loadUserById($conn, $_SESSION['id']);
}

if($_SERVER['REQUEST_METHOD']==='POST'){
  $tweet = new Tweet();
  $tweet->setUserId($loggedUser->getId());
  $tweet->setText($_POST['tweet']);
  $tweet->setCreationDate();
  if (!isset($_SESSION['e_tweet'])){
    $add = $tweet->saveToDB($conn);
    if ($add){
      header ('Location: index.php');
    }
  }
}

?>

<!DOCTYPE html>
<html lang=pl>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>
  <body>

    <form method='POST'>
      Dodaj tweeta: <br />
      <label><textarea maxlength=170  name="tweet" cols=100 rows=3 placeholder="Tu wpisz treść tweeta..."/></textarea></label><br />
      <input type="submit" value="Tweetuj!" />
    </form>
    <br /><br />
    <a href="index.php">Powrót do strony głównej</a>

  </body>
</html>
