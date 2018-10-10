
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
<body id="demo">



<div class="container">

<?php require('incl-header.php');?>
  <div class="content">
   
   <h1>I WANT TO SAY</h1>
      
      <form action="writeComments.php" method="POST">      
        <div class="row">
          
           <?php  
           
           
            //判斷是否登入過
            if(isset($_COOKIE[$cookie_name])){
                
                //echo "member id: " . $_COOKIE[$cookie_name];
        

                $sql_nickname = "SELECT nickname,user_id FROM annieshen_users WHERE user_id= '$_COOKIE[$cookie_name]'";
                
                $result_nickname  = $conn->query($sql_nickname); //conn連結資料庫  result是物件
  

                if($result_nickname  -> num_rows>0){
                  while($row_nickname = $result_nickname -> fetch_assoc()){ //fetch_assoc 會逐一搜尋 找不到結束while
                    
                    //if($row_nickname ["user_id"] === $_COOKIE[$cookie_name]){ 
                    ?>
                      <div class = 'userInfo'>
                        <div class='id'><?php  echo substr($row_nickname ["user_id"],0,1); ?></div>
                        <div class='name'><?php  echo $row_nickname ["nickname"];?></div>
                      </div> 
              
                    <?php
                    //}
                  }
                  
                }else{
                  //echo "0 results";
                }   
                
            }
           
           ?>
            <!--<div class="nickname">我叫<input id="nickname" type="text" name="nickname" />，我想說 . . .</div>-->
            <textarea cols="50" rows="5" name="writeContent" class="text"></textarea>
            <?php
            //判斷是否登入過
            if(isset($_COOKIE[$cookie_name])){ 
            ?>
              <div class="btn-wrap"><input type="submit" id="add" class="replySubmit btn-login" value="送出" /></div>
            <?php
              
            } else{?>
              <div><a href="login.php" class="btn-login">留言請先登入</a></div>
                
            <?php   
            }
            ?>
            
          
        </div>
      </form>


<?php

$sql_comment = "SELECT annieshen_comments.id, annieshen_comments.user_id, annieshen_comments.content, annieshen_users.nickname, annieshen_comments.created_at FROM annieshen_comments LEFT JOIN annieshen_users ON annieshen_comments.user_id = annieshen_users.user_id ORDER BY annieshen_comments.created_at DESC";
$result  = $conn->query($sql_comment); //conn連結資料庫  result是物件


$data_nums = $result -> num_rows; //把 result 的筆數存進 data_nums
$per = 10; //每頁10筆
$pages = ceil($data_nums/$per); //可以分幾頁
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
  $page=1; //則在此設定起始頁數
} else {
  $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*$per; //每一頁開始的資料序號
$result = $conn->query($sql_comment.' LIMIT '.$start.', '.$per) or die("Error");


if($result -> num_rows>0){
  while($row = $result -> fetch_assoc()){ //fetch_assoc 會逐一搜尋 找不到結束while
?>
  <div class="reply_wrap"><!--.reply_wrap-->
  <div class="main_reply">
    <div class="userInfo"> 
      
      <div class='id'><?php echo substr($row ["user_id"],0,1); ?></div>
      <div class='name'><?php echo $row ["nickname"]; ?></div>
      <div class='date'><?php echo $row ["created_at"]; ?></div>
      <div class='show_content'><?php echo $row ["content"]; ?></div>
    </div>


      
    
        
  
<?php
  //拿子留言
  $sql_commentChild = "SELECT annieshen_commentschild.content, annieshen_commentschild.parent_id, annieshen_commentschild.user_id, annieshen_commentschild.created_at FROM annieshen_commentschild LEFT JOIN annieshen_comments ON annieshen_commentschild.parent_id = annieshen_comments.id";
  
  $result2  = $conn->query($sql_commentChild); //conn連結資料庫  result是物件

  
  
  if($result2 -> num_rows>0 ){
    while($row2 = $result2 -> fetch_assoc() ){ //fetch_assoc 會逐一搜尋 找不到結束while
      
      if($row2 ["parent_id"] === $row ["id"]){ 
      ?>
        <div class="under_reply">   
          <dl class='userInfo'>
            
            

            <dt class='id'><?php echo substr($row2 ["user_id"],0,1);?></dt>

            <?php  
           
           
          
               
           //echo "member id: " . $_COOKIE[$cookie_name];
   

           $sql_commentChildname = "SELECT annieshen_commentschild.content, annieshen_users.nickname, annieshen_users.user_id FROM annieshen_commentschild LEFT JOIN annieshen_users ON annieshen_commentschild.user_id = annieshen_users.user_id";
           
           $result_childname  = $conn->query($sql_commentChildname); //conn連結資料庫  result是物件

            
             while($row_childname = $result_childname -> fetch_array()){ //fetch_assoc 會逐一搜尋 找不到結束while
               
               if($row2 ["user_id"] === $row_childname ["user_id"] ){
               
              ?>   
                  <dd class='name'><?php echo $row_childname ["nickname"];?></dd>
                 
              <?php
              break;
              }
              //break;
             }
 
      
      ?>

            <dd class='date'><?php echo $row2 ["created_at"]; ?></dd>
          </dl>
          <div class=''><?php echo $row2 ["content"]; ?></div>
          
        </div>

 

      <?php
      }
    }
    
  }else{
    //echo "0 results";
  }

  ?>
    </div><!--under_reply-->
    <?php
    //判斷是否登入過
    if(isset($_COOKIE[$cookie_name])){
      
  ?>

    <form action="underComments.php" method="POST">      
      <div class="">
        <div class="">
          <textarea cols="50" rows="5" name="writeContentChild" class="text"></textarea>
          <div class='btn-wrap'><input type="submit" id="add" class="btn-login" value="回覆" /></div>
          <input type="hidden" name="commentsId" value="<?php echo $row ["id"]?>" />
        </div>
      </div>
    </form>

  <?php 
      }else{
  ?>
<div class='login_bar'><a href="login.php" class="btn">登入回應留言</a></div>
<?php 
} 

  ?>

  </div><!--.reply_wrap-->
  <?php

  }
}else{
  //echo "0 results";
}
?>

<div class='pages'>

    <?php
      //分頁頁碼
      //echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
      echo "<br /><a href=?page=1>&lt;&lt;</a> ";
      //echo "第 ";
      for( $i=1 ; $i<=$pages ; $i++ ) {
          if ( $page-3 < $i && $i < $page+3 ) {
              echo "<a href=?page=".$i.">".$i."</a> ";
          }
      } 
      echo "<a href=?page=".$pages.">&gt;&gt;</a>";
    ?>

</div>
 
             

  
  </div>




</div><!--.container-->







</body>


</html>
