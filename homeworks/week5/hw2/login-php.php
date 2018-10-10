
<?php


  require_once('conn.php');
  require_once('function.php');

  $user_id = $_POST['user_id'];
  $password = $_POST['password'];

  if(!isset($_POST['user_id'])){
    echo "沒有user id";
} else{
    echo "user id: " . $_POST['user_id'];
    
}

  $sql = "SELECT * FROM annieshen_users where user_id='" . $user_id . "' and password='" . $password . "'";
  $result = $conn->query($sql);



  if ($result->num_rows > 0) {
    if (empty($user_id) || empty($password)) {
        echo "登入失敗，請確實填寫資料!";
        header("Refresh:1; login.php");
    }else{
        echo '登入成功';
        header('Location: index.php');
    }
  } else {
      echo '請輸入正確帳號密碼 (請回上一頁，或等待頁面2秒後回到登入頁)';

      header("Refresh:1; login.php");
  }


  $cookie_value = $user_id;
  
    // 設定一個 24 小時之後會過期的 Cookie
    setcookie($cookie_name, $cookie_value , time()+3600*24);
  
    //判斷是否登入過
    /*if(!isset($_COOKIE[$cookie_name])){
        echo "not login";
    } else{
        echo "member id: " . $_COOKIE[$cookie_name];
        
    }
   */
?>
