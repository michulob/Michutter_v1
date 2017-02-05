<?php

require 'src/User.php';
require 'src/Validate.php';
require 'src/Message.php';
session_start();
if(!isset($_SESSION['logged'])){
  header ('Location: index.php');
}else{
  $conn = Validate::databaseConn();
  $loggedUser = User::loadUserById($conn, $_SESSION['id']);
  $allUserMessages = Message::loadAllMessagesByIdO($conn, $loggedUser->getId());
  if($allUserMessages==NULL){
    exit("Brak wiadomości w skrzynce<br /><a href=\"loggedIndex.php\">Powrót do strony głównej</a>");
  }
  $unreaded = 0;
  foreach ($allUserMessages as $message){
    $from = User::loadUserById($conn, $message->getIdO());
    if($message->getReaded()==0){
      $unreaded++;
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
    <?php
    echo "Twoje wiadomości : <br />
            Nieprzeczytane: $unreaded";
    foreach ($allUserMessages as $message){
      if($message->getReaded()==0){
        $class = "message";
        $unreaded++;
      }else{
        $class = "messageReaded";
      }
      echo '<div class="from">Od: '.$from->getUsername().'</div><div class="'.$class.'" ><a href="oneMessage.php?id='.$message->getId().'">';
      if(strlen($message->getText())>30){
        echo substr($message->getText(), 0, 29)."...";
      }else{
        echo $message->getText();
      }
      echo '</a></div>';
    }
    ?>
    <a href="loggedIndex.php">Powrót do strony głównej</a>
  </body>
</html>
