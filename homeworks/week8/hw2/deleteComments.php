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
      
      $sql = "DELETE FROM annieshen_comments WHERE id = ? AND user_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("is", $comment_id, $user_id);
      $stmt->execute();
      $arr = array('result' => 'success');
      echo json_encode($arr);
      if($stmt->execute() == false){
        echo json_encode('{"success": fail}');
      }
      
  }

  $stmt->close();

?>
