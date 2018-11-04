<?php
  session_start();
  require_once('conn.php');
      
  //判斷是否登入過
  if(isset($_SESSION["member_id"])) {
    $stmt = $conn->prepare("SELECT * FROM annieshen_users WHERE user_id=?");
    $stmt->bind_param("s", $_SESSION["member_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user_id=$row['user_id'];
  }    

  // 編輯子留言
  if(isset($_POST['comment_id']) && isset($_POST['content'])){
      $comment_id = $_POST['comment_id'];

      $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'utf-8');
      $updateSql = "UPDATE annieshen_commentschild SET content = ? WHERE id = ? AND user_id = ?";
      $stmt_updateSql = $conn->prepare($updateSql);
      $stmt_updateSql->bind_param("sis", $content,$comment_id, $user_id);
      $result_updateSql = $stmt_updateSql->execute();
      if($result_updateSql){
        //echo 'success';
        header('Location: index.php');
      }else{
        echo '失敗';
      }
      
  }

  $stmt->close();
?>