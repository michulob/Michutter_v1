<?php

require 'src/User.php';
require 'src/Validate.php';
require 'src/Tweet.php';
require 'src/Comment.php';
session_start();
if(!isset($_SESSION['logged'])){
  header ('Location: index.php');
}elseif($_SERVER['REQUEST_METHOD']==='POST'){
  $tweetId = $_POST['tweetIdLook'];
  $conn = Validate::databaseConn();
  $loggedUser = User::loadUserById($conn, $_SESSION['id']);
  $tweet = Tweet::loadTweetById($conn, $tweetId);
  $comments = Comment::loadAllCommentsByTweetId($conn, $tweetId);
}
?>
<!DOCTYPE html>
<html lang=pl>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>
  <body>
    <a href="loggedIndex.php">Powrót do strony głównej</a>
    <br />
    <div id="tweet">
<?php
  if($tweet){
      $id = $tweet->getUserId();
      $sql = "SELECT id, email, username FROM users WHERE id=$id";
      $result = $conn->query($sql);
      $row = $result->fetch(PDO::FETCH_ASSOC);
      echo '<div class="tweet">
                <div class="dataTweet">Imie: '.$row['username'].' || </div>
                <div class="dataTweet">Email: '.$row['email'].' || </div>
                <div class="dataTweet">Data utworzenia: '.$tweet->getCreationDate().'</div>
                <div class="text">'.$tweet->getText().'</div>
                <form action="addComment.php" method="POST">
                  <input type="text" maxlength=60 size=60 name="comment" />
                  <input type="hidden" name="tweetId" value="'.$tweet->getId().'" />
                  <input type="submit" value="Dodaj komentarz" />
                </form>';
      $allComments = Comment::loadAllCommentsByTweetId($conn, $tweet->getId());
      if(is_array($allComments)){
        $allComments = array_reverse($allComments);
      }
      for($i=0; $i<count($allComments); $i++){
        $userId = $allComments[$i]->getUserId();
        $sql2 = "SELECT id, email, username FROM users WHERE id=$userId";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch(PDO::FETCH_ASSOC);
        echo '<div class="comment">'.$row2['username'].'||'.$allComments[$i]->getCreationDate().'</div>
              <div class="textC">'.$allComments[$i]->getText().'</div>';
      }
      echo '</div>';
    }

?>
    </div>
  </body>
</html>
