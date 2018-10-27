<?php
  require_once('conn.php');


  $session_id = $_COOKIE["user_id"];
  $stmt = $conn->prepare("SELECT * FROM annieshen_users_certificate where id = ?");
  $stmt->bind_param("s", $session_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $user_id = $row['user_id'];

    $writeContent = $_POST['writeContent'];


    //新增留言到comments資料庫 
    $sql_insert = "INSERT INTO annieshen_comments (content,user_id) VALUES (?,?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ss", $writeContent, $user_id);
    $stmt_insert->execute();

    $conn->prepare($sql_insert);
    $last_id =  $conn->insert_id;
    $arr = array('result' => 'success', 'id' => $last_id);
    echo json_encode($arr);
      
?>
