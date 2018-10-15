<?php
  require_once('conn.php');
  require_once('function.php');
      

  // 編輯
  if(isset($_POST['comment_id'])){
      $comment_id = $_POST['comment_id'];
      
      $sql = "SELECT * FROM annieshen_comments WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $comment_id);
      $stmt->execute();
      $stmt->store_result();
      $stmt->store_result();
      $row = $stmt->num_rows;
      if($row > 0){
  
          $updateSql = $conn->query("DELETE FROM annieshen_comments WHERE id = $comment_id;");
          echo 'success';
          header('Location: index.php');
      }else{
        echo '失敗';
      }
      
  }

  $stmt->close();

?>