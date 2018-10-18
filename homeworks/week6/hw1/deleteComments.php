<?php
  require_once('conn.php');
  require_once('function.php');
      

  // 刪除主留言
  if(isset($_POST['comment_id'])){
      $comment_id = $_POST['comment_id'];
      
      $sql = "SELECT * FROM annieshen_comments WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $comment_id);
      $stmt->execute();
      $stmt->store_result();
      $row = $stmt->num_rows;
      if($row > 0){
        $deleteSql = "DELETE FROM annieshen_comments WHERE id = ?";
        $stmt_deleteSql = $conn->prepare($deleteSql);
        $stmt_deleteSql->bind_param("i", $comment_id);
        $stmt_deleteSql->execute();
        //echo 'success';
        header('Location: index.php');
      }else{
        echo '失敗';
      }
      
  }

  $stmt->close();

?>