<?php
  require_once('conn.php');
  require_once('function.php');
      
  $user_id = $_COOKIE[$cookie_name] ;


      //$nickname = $_POST['nickname'];
      $writeContent = $_POST['writeContent'];


      //新增留言到comments資料庫 
      $sql2 = "INSERT INTO annieshen_comments (content,user_id) VALUES ('$writeContent','$user_id')";

   
   
        if ($conn->query($sql2)) {
            echo "留言已送出!";
            header("Location:index.php");

            //echo 
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo "留言填寫失敗";
 
        }
      
?>
