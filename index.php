<?php

session_start();
if(isset($_SESSION['logged'])){
  header('Location: loggedIndex.php');
}
require 'src/User.php';
require 'src/Validate.php';
require 'src/Tweet.php';

$conn = Validate::databaseConn();
$tweets = Tweet::loadAllTweets($conn);
?>

<!DOCTYPE html>
<html lang=pl>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>
  <body>
    <div id="tweet">
      <?php
        if($tweets){
          $revTweets = array_reverse($tweets);
          foreach ($revTweets as $value){
            $id = $value->getUserId();
            $sql = "SELECT email, username FROM users WHERE id=$id";
            $result = $conn->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo '<div class="tweet">
                      <div class="dataTweet">Imie: '.$row['username'].' ||</div>
                      <div class="dataTweet">Email: '.$row['email'].' ||</div>
                      <div class="dataTweet">Data utworzenia: '.$value->getCreationDate().'</div>
                      <br />
                      <div class="text">'.$value->getText().'</div>
                      <br />
                  </div>';
           }
        }

      ?>
    </div>
    <div id="kontener">
      <div id="log">
        <form method='POST' action='log.php'>
          <label>Podaj email: <input type="text" name="email" /></label><br />
          <?php if(isset($_SESSION['e_emailLog'])){
            echo '<span class="error">'.$_SESSION['e_emailLog'].'</span><br />';
            unset($_SESSION['e_emailLog']);
          }
          ?>
          <label>Podaj hasło: <input type="password" name="password" /></label><br />
          <?php if(isset($_SESSION['e_passLog'])){
            echo '<span class="error">'.$_SESSION['e_passLog'].'</span><br />';
            unset($_SESSION['e_passLog']);
          }
          ?>
          <input type="submit" name="registry" value="Zaloguj się" />
        </form>
        <br />
        <a href="registry.php">Zarejestruj się</a>
      </div>
    </div>
    <div style="clear: both;"><div>
  </body>
</html>
