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

  // 刪除主留言
  if(isset($_POST['comment_id'])){
    $comment_id = $_POST['comment_id'];
    
    $deleteSql = "DELETE FROM annieshen_comments WHERE id = ? AND user_id = ?";
    $stmt_deleteSql = $conn->prepare($deleteSql);
    $stmt_deleteSql->bind_param("is", $comment_id, $user_id);
    $result = $stmt_deleteSql->execute();
    if($result){
      $arr = array('result' => 'success');
      echo json_encode($arr);
    }else{
      echo json_encode('{"success": fail}');
    }
    
}


  $stmt->close();

?>
