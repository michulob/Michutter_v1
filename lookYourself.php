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
  echo '<ul><strong>Dane użytkownika:</strong>
          <li>ID : '.$loggedUser->getId().'</li>
          <li>Email : '.$loggedUser->getEmail().'</li>
          <li>Nickname : '.$loggedUser->getUsername().'</li>
          <li>Ilość wpisów : '.count($tweets).'</li>
        </ul><br />
        <a href="allYourTweets.php">Zobacz wszystkie wpisy danego użytkownika</a><br />
        <a href="loggedIndex.php">Powrot do strony głównej</a><br />';
}


?>
