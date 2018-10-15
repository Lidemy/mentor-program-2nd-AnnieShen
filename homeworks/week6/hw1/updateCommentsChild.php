<?php
  require_once('conn.php');
  require_once('function.php');
      

  // 編輯
  if(isset($_POST['comment_id']) && isset($_POST['content'])){
      $comment_id = $_POST['comment_id'];
      
      $sql = "SELECT * FROM annieshen_commentschild WHERE id = ?";
      echo $comment_id;
      //$result = $conn->query($sql);
      $stmt = $conn->prepare($sql);
      
      //$uc_id = $_COOKIE['uc_id'];
      //$status = 1;
      $stmt->bind_param("i", $comment_id);
      $stmt->execute();
      $stmt->store_result();
      $stmt->store_result();
      $row = $stmt->num_rows;
      if($row > 0){
          
        $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'utf-8');
        //$update_time = date("Y-m-d H:i");
        $updateSql = $conn->query("UPDATE annieshen_commentschild SET content = '$content' WHERE id = $comment_id;");
        echo 'success';
        header('Location: index.php');
      }else{
        echo '失敗';
      }
      
  }


?>