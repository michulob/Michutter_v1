<?php

require 'src/User.php';
require 'src/Validate.php';
require 'src/Tweet.php';
session_start();
if(!isset($_SESSION['logged'])){
  header ('Location: index.php');
}else{
  $_SESSION['idLook'] = $_GET['id'];
  $conn = Validate::databaseConn();
  $loggedUser = User::loadUserById($conn, $_SESSION['id']);
  $lookedUser = User::loadUserById($conn, $_SESSION['idLook']);
  $tweets = Tweet::loadAllTweetsByUserId($conn, $lookedUser->getId());
  echo '<ul><strong>Dane użytkownika:</strong>
          <li>ID : '.$lookedUser->getId().'</li>
          <li>Email : '.$lookedUser->getEmail().'</li>
          <li>Nickname : '.$lookedUser->getUsername().'</li>
          <li>Ilość wpisów : '.count($tweets).'</li>
        </ul><br />
        <a href="allUserTweets.php">Zobacz wszystkie wpisy danego użytkownika</a><br />
        <a href="sendMessageTo.php?idO='.$lookedUser->getId().'">Wyślij wiadomość do '.$lookedUser->getUsername().'</a><br />
        <a href="loggedIndex.php">Powrot do strony głównej</a><br />';
}


?>
