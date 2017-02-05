<?php


session_start();
if(!isset($_SESSION['logged'])){
  header ('Location: index.php');
}else{
  if($_SERVER['REQUEST_METHOD']==='POST'){
    require 'src/User.php';
    require 'src/Validate.php';
    require 'src/Tweet.php';
    require 'src/Comment.php';
    $conn = Validate::databaseConn();
    $loggedUser = User::loadUserById($conn, $_SESSION['id']);
    $newComment = new Comment;
    $newComment->setUserId($loggedUser->getId());
    $newComment->setTweetId($_POST['tweetId']);
    $newComment->setCreationDate();
    $newComment->setText($_POST['comment']);
    $add = $newComment->saveToDB($conn);
    if($add){
      header ('Location: loggedIndex.php');
    }
  }
}


?>
