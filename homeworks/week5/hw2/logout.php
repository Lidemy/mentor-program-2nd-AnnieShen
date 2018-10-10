
<?php

  require_once('conn.php');
  require_once('function.php');
  

    setcookie($cookie_name, "" , time()+3600*24);
    echo $_COOKIE [$cookie_name] . "<br />";
    echo "You have successfully logged out.";
    header('Location: index.php');




  
?>
