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
  $oneMessage = Message::loadMessageById($conn, $_GET['id']);
  $from = User::loadUserById($conn, $oneMessage->getIdO());
  if($oneMessage){
    $oneMessage->setReaded();
    $oneMessage->saveToDB($conn);
    echo 'Wiadomość od : '.$from->getUsername().'<br />';
    echo 'Data wysłania : '.$oneMessage->getSendDate().'<br />';
    echo 'Treść wiadomości : '.$oneMessage->getText().'<br /><br />';
  }else{
    echo "nie wpisuj z palca mi tu getów cwaniaczku, bynajmniej póki nie dopracuje tego ptakierrra";
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
    <a href="mailBox.php">Powrót do skrzynki odbiorczej</a><br />
    <a href="loggedIndex.php">Powrót do strony głównej</a>
  </body>
</html>
