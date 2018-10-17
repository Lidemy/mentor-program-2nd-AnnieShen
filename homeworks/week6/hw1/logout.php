
<?php

  require_once('conn.php');
  require_once('function.php');
  

  setcookie("user_id", "" , time()+3600*24);
  header('Location: index.php');
  
?>
