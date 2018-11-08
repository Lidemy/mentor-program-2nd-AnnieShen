<?php
  session_start();
  require_once('conn.php');
 
  //判斷是否登入過
  if(isset($_SESSION["member_id"])) {
    $user_id=$_SESSION["member_id"];
  } 

  // 刪除子留言
  if(isset($_POST['comment_id'])){
      $comment_id = $_POST['comment_id'];
  
      $deleteSql = "DELETE FROM annieshen_commentschild WHERE id = ? AND user_id = ?";
      $stmt_deleteSql = $conn->prepare($deleteSql);
      $stmt_deleteSql->bind_param("is", $comment_id, $user_id);
      $result = $stmt_deleteSql->execute();
      if($result){
          header('Location: index.php');
      }else{
        echo '失敗';
      }
      
  }

  $stmt_deleteSql->close();

?>