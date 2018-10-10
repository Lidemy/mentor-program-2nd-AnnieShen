
<?php
  require_once('conn.php');
  require_once('function.php');
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
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
        <form action='login-php.php' method='POST' class='register_form'>
        <div>帳號: <input name='user_id' /></div>
        <div>密碼: <input name='password' type='password'/></div>
        <div><input type='submit' class='btn'/></div>
        </form>

</div>
</div>


</body>
</html>