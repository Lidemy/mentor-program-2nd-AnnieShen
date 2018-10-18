
<?php

require_once('conn.php');

if (isset($_POST['user_id']) && isset($_POST['password']) && isset($_POST['nickname'])) {
  if (!empty($_POST['user_id']) && !empty($_POST['password']) && !empty($_POST['nickname'])) {

        $user_id = $_POST['user_id'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $nickname = $_POST['nickname'];

        $stmt = $conn->prepare("INSERT INTO annieshen_users (user_id,nickname,password) VALUES (?,?,?)");
        $stmt->bind_param("sss", $user_id,$nickname,$password);


        $stmt_name = $conn->prepare("SELECT * FROM annieshen_users WHERE user_id = ?");
        $stmt_name->bind_param("s",$user_id);
        $stmt_name->execute();
        $result_name = $stmt_name->get_result();
        $row_name = $result_name->fetch_assoc();

        if($row_name['user_id'] === $user_id){
          echo "<script> alert('註冊失敗，帳號已被使用過'); </script>";
        }else if($stmt->execute()){ //註冊成功，新增session_id
              $session_id = uniqid();
              $stmt_session = $conn->prepare("INSERT INTO annieshen_users_certificate(id,user_id) VALUES(?,?)");
              $stmt_session->bind_param('ss',$session_id,$user_id);
              $stmt_session->execute();
              setcookie('user_id',$session_id,time()+3600*24);
              header('Location:index.php'); 
          
        }
        $stmt->close(); 

  } else{
    echo "<script> alert('請確實填寫您的資料'); </script>";
  }

}


$conn->close(); 

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>week6 留言板</title> 
<meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
<meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1"> 
   
<link rel="stylesheet" href="css/primary.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
<div class="container">

<?php require('incl-header.php');?>
        <div class="content">

        <h1>會員註冊</h1>
        <form action='register.php' method='POST' class='register_form'>
        <div class='inputBox1'>帳號: <input name='user_id' /></div>
        <div class='inputBox2'>暱稱: <input name='nickname'/></div>
        <div class='inputBox3'>密碼: <input name='password' type='password'/></div>
        <div><input type='submit' class='btn'/></div>

        </form>

        </div>
</div>

</body>
</html>