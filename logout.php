<?php

session_start();
if(!isset($_SESSION['logged'])){
  header ('Location: index.php');
}else{
  session_unset();
  header ('Location: index.php');
}

?>
