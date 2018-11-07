<?php
  session_start();
  require_once('conn.php');

  $stmt = $conn->prepare("SELECT * FROM annieshen_users WHERE user_id=?");
  $stmt->bind_param("s", $_SESSION["member_id"]);
  $stmt->execute();
  $result = $stmt->get_result();
  
  $row = $result->fetch_assoc();
  $nickname=$row['nickname'];

  $writeContent = $_POST['writeContent'];
  $user_id = $row['user_id'];
  

  //新增留言到comments資料庫 
  $sql_insert = "INSERT INTO annieshen_comments (content,user_id) VALUES (?,?)";
  $stmt_insert = $conn->prepare($sql_insert);
  $stmt_insert->bind_param("ss", $writeContent, $user_id);
  $stmt_insert->execute();

  $conn->prepare($sql_insert);
  $last_id =  $conn->insert_id;

  $stmt_time = $conn->prepare("SELECT * FROM annieshen_comments WHERE content=? AND user_id=? ");
  $stmt_time->bind_param("ss", $writeContent, $user_id);
  $stmt_time->execute();
  $result_time = $stmt_time->get_result();
  $row_time = $result_time->fetch_assoc();
  $last_time = $row_time['created_at'];

  $arr = array('result' => 'success', 'id' => $last_id, 'time' => $last_time);
  echo json_encode($arr);
     
?>
