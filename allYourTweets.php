<?php

require 'src/User.php';
require 'src/Validate.php';
require 'src/Tweet.php';
session_start();
if(!isset($_SESSION['logged'])){
  header ('Location: index.php');
}else{
  $conn = Validate::databaseConn();
  $loggedUser = User::loadUserById($conn, $_SESSION['id']);
  $tweets = Tweet::loadAllTweetsByUserId($conn, $loggedUser->getId());
}

?>

<!DOCTYPE html>
<html lang=pl>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>
  <body>
    <a href="loggedIndex.php">Powrót do strony użytkownika</a><br />
    <div id="tweet">
      <?php
      if($tweets){
        $revTweets = array_reverse($tweets);
        echo "Wszystkich tweetów : ".count($tweets);
        foreach ($revTweets as $value){
          $id = $value->getUserId();
          $sql = "SELECT email, username FROM users WHERE id=$id";
          $result = $conn->query($sql);
          $row = $result->fetch(PDO::FETCH_ASSOC);
          echo '<div class="tweet">
                    <div class="dataTweet">Imie: '.$row['username'].' ||</div>
                    <div class="dataTweet">Email: '.$row['email'].' ||</div>
                    <div class="dataTweet">Data utworzenia: '.$value->getCreationDate().'</div>
                    <form action="onePost.php" method="POST">
                      <input type="hidden" name="tweetIdLook" value="'.$value->getId().'" />
                      <input type="submit" value="Zobacz wpis" />
                    </form>
                    <div class="text">'.$value->getText().'</div>
                    <br />
                </div>';
         }
      }
      ?>
    </div>
  </body>
</html>
