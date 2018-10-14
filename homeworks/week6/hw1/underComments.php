<?php
  require_once('conn.php');
  require_once('function.php');

    $session_id = $_COOKIE["session_id"];
    $sql_s = "SELECT * FROM annieshen_users where session_id=?";
    $stmt_s = $conn->prepare($sql_s);
    $stmt_s->bind_param("s", $session_id);
    $stmt_s->execute();
    $result_s = $stmt_s->get_result();
    $row_s = $result_s->fetch_assoc();

    $writeContentChild = $_POST['writeContentChild'];
    $contentId = $_POST['commentsId'];
    $user_id = $row_s['user_id'] ;
    
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