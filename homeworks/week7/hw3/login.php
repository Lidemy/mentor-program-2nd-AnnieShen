
<?php
  require_once('conn.php');
  //require_once('function.php');

  if (isset($_POST['user_id']) && isset($_POST['password'])) {
    if (!empty($_POST['user_id']) && !empty($_POST['password'])) {
      $user_id = $_POST['user_id'];
      $password = $_POST['password'];

      $stmt = $conn->prepare("SELECT * FROM annieshen_users where user_id = ? ");
      $stmt->bind_param("s", $user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

      $passwordCheck = password_verify($password, $row['password']);

      if($result->num_rows > 0 && $passwordCheck === true){
        $stmt_certificate = $conn->prepare("SELECT * FROM annieshen_users_certificate WHERE user_id = ?");
        $stmt_certificate->bind_param("s",$user_id);
        $stmt_certificate->execute();
        $result_certificate = $stmt_certificate->get_result();
        
        if($result_certificate->num_rows > 0){ //已登入過，更新session_id
            $session_id = uniqid();
            $stmt_session = $conn->prepare("UPDATE annieshen_users_certificate SET id = ? WHERE user_id = ?");
            $stmt_session->bind_param('ss',$session_id,$user_id);
            $stmt_session->execute();
            setcookie('user_id',$session_id,time()+3600*24);
            header('Location:index.php');                    
        }
        else{  //第一次登入，新增session_id
            $session_id = uniqid();
            $stmt_session = $conn->prepare("INSERT INTO annieshen_users_certificate(id,user_id) VALUES(?,?)");
            $stmt_session->bind_param('ss',$session_id,$user_id);
            $stmt_session->execute();
            setcookie('user_id',$session_id,time()+3600*24);
            header('Location:index.php');                    
        }
      } else{
          echo "<script> alert('密碼錯誤，請重新登入'); location.href = 'login.php'</script>";
      }
      $conn->close();
    } else{
      echo "<script> alert('請填寫正確的帳號密碼'); location.href = 'login.php'</script>";
    }
  } 
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>week7 留言板</title> 
<meta name="viewport" content="width=device-width, initial-scale=1">
   

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/primary.css" type="text/css">

</head>
<body>
<?php require('incl-header.php');?>
<div class="container">


  <div class="content">

    <h1>會員登入</h1>

    <form action='login.php' method='POST' class='register_form'>
    <div>帳號: <input name='user_id' /></div>
    <div>密碼: <input name='password' type='password'/></div>
    <div><input type='submit' class='btn btn-lg'/></div>
    </form>

  </div>
</div>


</body>
</html>