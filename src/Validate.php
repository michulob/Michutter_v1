<?php

class Validate{

  public static function databaseConn (){
    require 'config.php';
    return new PDO("mysql:host=".DB_HOST.";dbname=".DB_DB.";charset=UTF8", DB_USER, DB_PASS);
  }

  // public static function checkEmailUni (PDO $conn, $email){
  //   $result = $conn->query('SELECT id FROM users WHERE email="'.$email.'"');
  //   if ($result->rowCount() > 0){
  //     $_SESSION['e_email']="Istnieje już taki email";
  //     return FALSE;
  //   }else{
  //     return TRUE;
  //   }
  // }
  //
  // public static function checkUserName($username){
  //   if ($username == '' || empty($username)){
  //     $_SESSION['e_username']= "Podaj imie/pseudo";
  //   }
  // }
  //
  // public static function validEmail ($email){
  //   var_dump($email);
  //   $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
  //   var_dump($emailB);
  //   if (empty($email)){
  //     $_SESSION['e_email']="Podaj maila";
  //   }
  //   elseif(!filter_var($emailB, FILTER_VALIDATE_EMAIL) || $emailB!=$email){
  //     $_SESSION['e_email'] = "Podany e-mail jest nieprawidłowy";
  //   }
  //   else{
  //     return $emailB;
  //   }
  // }
  //
  // public static function arrTrim (&$array){
  //   foreach ($array as $key => $value){
  //     $array[$key] = trim($value);
  //   }
  // }
  //
  // public static function validPass ($pass1, $pass2){
  //   if (empty($pass1) || empty($pass2)){
  //     $_SESSION['e_pass']="Podaj hasło i je powtórz";
  //   }
  //   elseif ((strlen($pass1)<8) || (strlen($pass1)>20)){
  //     $_SESSION['e_pass']="Hasło musi posiadać od 8 do 20 znaków";
  //   }
  //   elseif ($pass1!=$pass2){
  //     $_SESSION['e_pass']="Podane hasła nie są takie same";
  //   }
  //   elseif (!ctype_alnum($pass1)){
  //     $_SESSION['e_pass'] = "Hasło może zawierać tylko litery alfabetu angielskiego oraz cyfry";
  //   }
  //   else{
  //     return TRUE;
  //   }
  // }

}

?>
