<?php

require 'src/User.php';
require 'src/Validate.php';
require 'src/Tweet.php';
require 'src/Comment.php';
session_start();
if(!isset($_SESSION['logged'])){
  header ('Location: index.php');
}else{
  $conn = Validate::databaseConn();
  $loggedUser = User::loadUserById($conn, $_SESSION['id']);
  $tweets = Tweet::loadAllTweets($conn);
}


?>

<!DOCTYPE html>
<html lang=pl>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>
  <body>
    <form action="addTweet.php" method='POST'>
      Dodaj tweeta: <br />
      <label><textarea maxlength=170  name="tweet" cols=100 rows=3 placeholder="Tu wpisz treść tweeta..."/></textarea></label><br />
      <input type="submit" value="Tweetuj!" />
    </form>
    <br />
    <div id="tweet">
      <?php
        if($tweets){
          $revTweets = array_reverse($tweets);
          foreach ($revTweets as $value){
            $id = $value->getUserId();
            $sql = "SELECT id, email, username FROM users WHERE id=$id";
            $result = $conn->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo '<div class="tweet">
                      <div class="dataTweet">Imie: <a href="lookUser.php?id='.$row['id'].'">'.$row['username'].' </a>|| </div>
                      <div class="dataTweet">Email: '.$row['email'].' || </div>
                      <div class="dataTweet">Data utworzenia: '.$value->getCreationDate().'</div>
                      <form action="onePost.php" method="POST">
                        <input type="hidden" name="tweetIdLook" value="'.$value->getId().'" />
                        <input type="submit" value="Zobacz wpis" />
                      </form>
                      <div class="text">'.$value->getText().'</div>
                      <form action="addComment.php" method="POST">
                        <input type="text" maxlength=60 size=60 name="comment" />
                        <input type="hidden" name="tweetId" value="'.$value->getId().'" />
                        <input type="submit" value="Dodaj komentarz" />
                      </form>';
            $allComments = Comment::loadAllCommentsByTweetId($conn, $value->getId());
            if(is_array($allComments)){
              $allComments = array_reverse($allComments);
            }
            for($i=0; $i<count($allComments); $i++){
              $userId = $allComments[$i]->getUserId();
              $sql2 = "SELECT id, email, username FROM users WHERE id=$userId";
              $result2 = $conn->query($sql2);
              $row2 = $result2->fetch(PDO::FETCH_ASSOC);
              echo '<div class="comment"><a href="lookUser.php?id='.$row2['id'].'">'.$row2['username'].'</a>||'.$allComments[$i]->getCreationDate().'</div>
                    <div class="textC">'.$allComments[$i]->getText().'</div>';
            }
            echo '</div>';
          }
        }
      ?>
    </div>
    <div id="kontener">
      <div id="log">
        Zalogowany jako : <?php echo $loggedUser->getUsername().'<br />';?>
        <a href="editUser.php">Edycja użytkownika</a><br />
        <a href="lookYourself.php">Pokaż użytkownika</a><br />
        <a href="mailBox.php">Skrzynka wiadomości</a><br />
        <a href="sendMessage.php">Wyślij wiadomość</a><br />
        <a href="addTweet.php">Dodaj nowego tweeta</a><br />
        <a href="allYourTweets.php">Zobacz wszystkie tweety usera</a><br />
        <a href="logout.php">Wyloguj</a><br />
      </div>
    </div>
  </body>
</html>
