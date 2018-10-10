
<?php

  require_once('conn.php');
  require_once('function.php');

  $user_id = $_POST['user_id'];
  $password = $_POST['password'];
  $nickname = $_POST['nickname'];





if (empty($user_id) || empty($password) || empty($nickname)) {
    echo "註冊失敗，請確實填寫資料!";
    header("Refresh:1; register.php");
} else if(!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i",$password)){
    echo "密碼必須由數字+英文字母組成";
    header("Refresh:1; register.php");
} else if(!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i",$user_id)){
    echo "帳號必須由數字+英文字母組成";
    header("Refresh:1; register.php");
} else {
    $sql = "SELECT * FROM annieshen_users where user_id='" . $user_id . "' and nickname='" . $nickname . "' and password='" . $password . "'";
    $result = $conn->query($sql);
  
    $sql = "INSERT INTO annieshen_users (user_id,nickname,password) VALUES ('$user_id','$nickname','$password')";
    if ($conn->query($sql)) {
        echo "註冊成功，請重新登入!";
        header("Refresh:1; login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "註冊失敗";
    }

}   
?>