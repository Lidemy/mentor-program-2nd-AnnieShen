
<?php

  require_once('conn.php');
  require_once('function.php');
  
    //setcookie("id", "" , time()+3600*24);
    //setcookie("user_id", "" , time()+3600*24);
    setcookie("session_id", "" , time()+3600*24);
    header('Location: index.php');




  
?>
