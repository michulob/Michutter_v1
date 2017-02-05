<?php

require 'src/User.php';
require 'src/Validate.php';

if ($_SERVER['REQUEST_METHOD']==='POST'){
  foreach ($_POST as $key => $value){
    $_POST[$key] = trim($value);
  }

  $flag = TRUE;
  $newUser = new User();
  $newUser->setSalt();
  $newUser->setPassword($_POST['password'],$_POST['passwordV']);
  $newUser->setEmail($_POST['email']);
  $newUser->setUsername($_POST['username']);
  $conn = Validate::databaseConn();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if (isset($_SESSION['e_pass']) || isset($_SESSION['e_username']) || isset($_SESSION['e_email'])){
    $flag = FALSE;
  }
  var_dump($_SESSION);
  if(Validate::checkEmailUni($conn, $newUser->getEmail()) && $flag == TRUE){
    $add = $newUser->saveToDB($conn);
    if ($add){
      session_unset();
      header ('Location: welcome.php');
    }
  }else{
    echo "<a href=\"registry.php\">Powrót do strony rejestracji</a>";
  }

}


?>
