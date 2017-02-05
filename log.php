<?php

session_start();
require 'src/User.php';
require 'src/Validate.php';

if ($_SERVER['REQUEST_METHOD']==='POST'){
  $sql = 'SELECT id,salt,hashed_password FROM users WHERE email="'.$_POST['email'].'"';
  $conn = Validate::databaseConn();
  $result = $conn->query($sql);
  if($result->rowCount() == 1){
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if($row['hashed_password'] == hash('sha256', $_POST['password'].$row['salt'])){
      $_SESSION['logged']=TRUE;
      $loggedUser = User::loadUserById($conn, $row['id']);
      $_SESSION['id']=$loggedUser->getId();
      header ('Location: loggedIndex.php');
    }else{
      $_SESSION['e_passLog'] = 'Błędne hasło !';
      header ('Location: index.php');
    }
  }elseif($result->rowCount() == 0){
    $_SESSION['e_emailLog'] = 'Użytkownik z takim e-mailem nie istnieje !';
    header ('Location: index.php');
  }else{
    $_SESSION['e_emailLog'] = 'Problemy techniczne, prosze sprobój ponownie za jakiś czas !';
    header ('Location: index.php');
  }
}



?>
