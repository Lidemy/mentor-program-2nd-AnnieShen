<?php
  require_once('conn.php');
  require_once('function.php');

  $user_id = $_COOKIE[$cookie_name] ;
    //$nicknameChild = $_POST['nicknameChild'];
    $writeContentChild = $_POST['writeContentChild'];
    $contentId = $_POST['commentsId'];
    
    //新增子留言到comments資料庫
    $sql3 = "INSERT INTO annieshen_commentschild (content,parent_id,user_id) VALUES ('$writeContentChild','$contentId','$user_id')";



    if ($conn->query($sql3)) {
        echo "子留言已送出!";
        header("Location:index.php");

        //echo 
    } else {
        echo "Error: " . $sql3 . "<br>" . $conn->error;
        echo "留言填寫失敗";

    }
?>