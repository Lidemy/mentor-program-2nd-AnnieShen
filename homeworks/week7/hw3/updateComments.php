<?php
  require_once('conn.php');
      

  // 編輯主留言
  if(isset($_POST['comment_id']) && isset($_POST['content'])){
      $comment_id = $_POST['comment_id'];
      
      $sql = "SELECT * FROM annieshen_comments WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $comment_id);
      $stmt->execute();
      $stmt->store_result();
      $row = $stmt->num_rows;
      if($row > 0){
          $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'utf-8');
          $updateSql = "UPDATE annieshen_comments SET content = ? WHERE id = ?";
          $stmt_updateSql = $conn->prepare($updateSql);
          $stmt_updateSql->bind_param("si", $content,$comment_id);
          $stmt_updateSql->execute();
          $arr = array('result' => 'success');
          echo json_encode($arr);
        }else{
          //echo '失敗';
          echo json_encode('{"success": fail}');
        }
      
  }

  $stmt->close();

?>