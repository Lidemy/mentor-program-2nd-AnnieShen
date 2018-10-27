<?php
  require_once('conn.php');

  $session_id = $_COOKIE["user_id"];
  $stmt = $conn->prepare("SELECT * FROM annieshen_users_certificate where id = ?");
  $stmt->bind_param("s", $session_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $user_id = $row['user_id'];

  $writeContentChild = $_POST['writeContentChild'];
  $contentId = $_POST['commentsId'];

  
  //新增子留言到comments資料庫
  $sql_insert = "INSERT INTO annieshen_commentschild (content,parent_id,user_id) VALUES (?,?,?)";
  $stmt_insert = $conn->prepare($sql_insert);
  $stmt_insert->bind_param("sss", $writeContentChild, $contentId, $user_id);
  $stmt_insert->execute();

  if ($conn->prepare($sql_insert)) {
    echo "子留言已送出!";
    header("Location:index.php"); 
  } else {
      echo "Error: " . $sql3 . "<br>" . $conn->error;
      echo "留言填寫失敗";

  }
?>