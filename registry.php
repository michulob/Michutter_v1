<?php

session_start();
if(isset($_SESSION['logged'])){
  header('Location: loggedIndex.php');
}
require 'src/User.php';
require 'src/Validate.php';

if ($_SERVER['REQUEST_METHOD']==='POST'){
  foreach ($_POST as $key => $value){
    $_POST[$key] = trim($value);
  }

  $flag = TRUE;
  $conn = Validate::databaseConn();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $newUser = new User();
  $newUser->setPassword($_POST['password'],$_POST['passwordV']);
  $newUser->setEmail($conn, $_POST['email']);
  $newUser->setUsername($_POST['username']);

  if (isset($_SESSION['e_pass']) || isset($_SESSION['e_username']) || isset($_SESSION['e_email'])){
    $flag = FALSE;
  }
  if($flag){
    $add = $newUser->saveToDB($conn);
    if ($add){
      session_unset();
      header ('Location: welcome.php');
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

    <form  method='POST'>
      Rejestracja nowego użytkownika: <br />
      <label>Podaj nickname: <input type="text" name="username" /></label><br />
      <?php
        if(isset($_SESSION['e_username'])){
          echo '<span class="error">'.$_SESSION['e_username'].'</span><br />';
          unset($_SESSION['e_username']);
        }
      ?>
      <label>Podaj email: <input type="text" name="email" /></label><br />
      <?php
        if(isset($_SESSION['e_email'])){
          echo '<span class="error">'.$_SESSION['e_email'].'</span><br />';
          unset($_SESSION['e_email']);
        }
      ?>
      <label>Podaj hasło: <input type="password" name="password" /></label><br />
      <label>Powtórz hasło: <input type="password" name="passwordV" /></label><br />
      <?php
        if(isset($_SESSION['e_pass'])){
          echo '<span class="error">'.$_SESSION['e_pass'].'</span><br />';
          unset($_SESSION['e_pass']);
        }
      ?>
      <input type="submit" name="registry" value="Zarejestruj" />
    </form>

    <br /><br />

    <a href="index.php">Powrót do strony głównej</a>

  </body>
</html>
