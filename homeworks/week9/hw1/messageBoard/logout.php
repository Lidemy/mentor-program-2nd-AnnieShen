
<?php
  session_start();
  require_once('conn.php'); 
  unset($_SESSION['member_id']);
  session_destroy();
  //setcookie("user_id", "" , time()+3600*24);
  header('Location: index.php');
  
?>
