
<?php
  require_once('conn.php');
  require_once('function.php');
  
  $error_message ="";

  
  if (!empty($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    //$password = $_POST['password'];

    $sql = "SELECT * FROM annieshen_users where user_id=? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    //echo mysqli_error($conn); //可以印出錯誤

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $password = $row['password'];
    $passwordCheck = password_verify($_POST['password'], $password);

    if($result->num_rows>0 && $passwordCheck===true){
      
      //setcookie("user_id", $user_id, time()+3600*24); // 設定一個 24 小時之後會過期的 Cookie
      setcookie("session_id", $row['session_id'], time()+3600*24); 
      header('Location: index.php');
    } else{
        $error_message = '帳號密碼錯誤';
    }
    $conn->close();
  }
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>week5 留言板</title> 
<meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
<meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1"> 
   
<link rel="stylesheet" href="css/primary.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>

<div class="container">

  <?php require('incl-header.php');?>
  <div class="content">

    <h1>登入</h1>

    <?php 
      if($error_message !== ''){
        echo $error_message;
      }
    ?>
    <form action='login.php' method='POST' class='register_form'>
    <div>帳號: <input name='user_id' /></div>
    <div>密碼: <input name='password' type='password'/></div>
    <div><input type='submit' class='btn'/></div>
    </form>

  </div>
</div>


</body>
</html>