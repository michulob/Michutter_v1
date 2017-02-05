<?php

require 'src/User.php';
require 'src/Validate.php';
session_start();
if(!isset($_SESSION['logged'])){
  header ('Location: index.php');
}elseif($_SERVER['REQUEST_METHOD']==='POST'){
  $conn = Validate::databaseConn();
  $loggedUser = User::loadUserById($conn, $_SESSION['id']);
  $nowPass = hash('sha256', $_POST['oldPassword'].$loggedUser->getSalt());
  if($loggedUser->getPassword() == $nowPass){
    $flag = TRUE;
    $loggedUser->setEmail($conn, $_POST['newEmail']);
    $loggedUser->setUsername($_POST['newUsername']);
    $loggedUser->setPassword($_POST['newPassword'], $_POST['newPasswordV']);
    if (isset($_SESSION['e_pass']) || isset($_SESSION['e_username']) || isset($_SESSION['e_email'])){
      $flag = FALSE;
    }
    if ($flag==TRUE){
      $add = $loggedUser->saveToDB($conn);
      if ($add){
        $_SESSION['changeAdd'] = "Zapisano zmiany !!!";
      }
    }
  }else{
    $_SESSION['badPass'] = "Błędne hasło!!!";
  }
}

if (isset($_SESSION['changeAdd'])){
  echo '<span class="error">'.$_SESSION['changeAdd'].'</span><br />';
  unset($_SESSION['changeAdd']);
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
      <b>Zmiana danych :</b> <br />
      Podaj nowy e-mail : <input type="text" name="newEmail" /><br />
      <?php
      if(isset($_SESSION['e_email'])){
        echo '<span class="error">'.$_SESSION['e_email'].'</span><br />';
        unset($_SESSION['e_email']);
      }
      ?>
      Podaj nowy nickname : <input type="text" name="newUsername" /><br />
      <?php
      if(isset($_SESSION['e_username'])){
        echo '<span class="error">'.$_SESSION['e_username'].'</span><br />';
        unset($_SESSION['e_username']);
      }
      ?>
      Podaj nowe hasło : <input type="password" name="newPassword" /><br />
      Powtórz nowe hasło : <input type="password" name="newPasswordV" /><br />
      <?php
      if(isset($_SESSION['e_pass'])){
        echo '<span class="error">'.$_SESSION['e_pass'].'</span><br />';
        unset($_SESSION['e_pass']);
      }
      ?>
      <br />
      Aby dokonać zmian musisz podać stare hasło : <input type="password" name="oldPassword" /><br />
      <?php
      if(isset($_SESSION['badPass'])){
        echo '<span class="error">'.$_SESSION['badPass'].'</span><br />';
        unset($_SESSION['badPass']);
      }
      ?>
      <input type="submit" value="Edytuj" />
    </form>
    <a href="loggedIndex.php">Powrot do strony głównej</a>
  </body>
</html>
