<?php

require 'src/User.php';
require 'src/Validate.php';
require 'src/Message.php';
session_start();
if(!isset($_SESSION['logged'])){
  header ('Location: index.php');
}elseif ($_GET['idO']==$_SESSION['id']) {
  header ('Location: lookYourself.php');
}
else{
  $conn = Validate::databaseConn();
  $loggedUser = User::loadUserById($conn, $_SESSION['id']);
  if(is_numeric($_GET['idO'])){
    $idO = $_GET['idO'];
  }else{
    exit("bez kombinacji prosze");
  }
  if($_SERVER['REQUEST_METHOD']==='POST'){
    $newMessage = new Message();
    $newMessage->setIdN($loggedUser->getId());
    $newMessage->setIdO($idO);
    $newMessage->setText($_POST['text']);
    $newMessage->setReaded();
    $newMessage->setSendDate();

    if(!isset($_SESSION['e_text'])){
      $add = $newMessage->saveToDB($conn);
      if($add){
        $_SESSION['send']="Wysłano wiadomość pomyślnie";
      }else{
        $_SESSION['send']="Kłopoty techniczne, nie wysłano wiadomości";
      }
    }
  }
 }

 if(isset($_SESSION['send'])){
   echo '<span class="error">'.$_SESSION['send'].'</span>';
   unset($_SESSION['send']);
 }
?>


<!DOCTYPE html>
<html lang=pl>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>
  <body>

      <form method="POST">
        <textarea name="text" cols=70 rows=6 maxlength=900 placeholder="Tu wpisz treść wiadomości"></textarea>
        <br />
        <?php
          if(isset($_SESSION['e_text'])){
            echo '<span class="error">'.$_SESSION['e_text'].'</span>';
            unset($_SESSION['e_text']);
          }
        ?>
        <br />
        <input type="submit" value="Wyślij wiadomość" />
      </form>
      <br />
      <a href="index.php">Powrót do strony głównej</a>

  </body>
</html>
