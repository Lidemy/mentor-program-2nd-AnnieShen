
<?php

  require_once('conn.php');
  

  setcookie("user_id", "" , time()+3600*24);
  header('Location: index.php');
  
?>
