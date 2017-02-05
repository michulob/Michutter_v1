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
  $allUsers = User::loadAllUsers($conn);
  if($_SERVER['REQUEST_METHOD']==='POST' && $_POST['idO']!=$loggedUser->getId()){
    $newMessage = new Message();
    $newMessage->setIdN($loggedUser->getId());
    $newMessage->setIdO($_POST['idO']);
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
  }elseif(isset($_POST['idO']) && $_POST['idO']==$loggedUser->getId()){
    $_SESSION['sendMyself'] = "Nie można wysyłać wiadomości do samego siebie";
    echo '<span class="error">'.$_SESSION['sendMyself'].'</span>';
    unset($_SESSION['sendMyself']);
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
        <select name="idO">
          <?php
            foreach ($allUsers as $user){
              echo '<option value='.$user->getId().'>'.$user->getUsername().'</option>';
            }
          ?>
        </select>
        <input type="submit" value="Wyślij wiadomość" />
      </form>
      <br />
      <a href="index.php">Powrót do strony głównej</a>

  </body>
</html>
