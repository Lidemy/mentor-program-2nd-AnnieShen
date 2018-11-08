
<?php
  session_start();
  require_once('conn.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>week9 留言板</title> 
<meta name="viewport" content="width=device-width, initial-scale=1">
   
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/main.prefixed.css" type="text/css">

</head>
<body>
<?php require('incl-header.php');?>

  <div class="container">


    <div class="content">
   
      <h1>I WANT TO SAY</h1>
      
      <form action="writeComments.php" class="writeComments" method="POST">      
        <div class="row">
          
        <?php 

          //判斷是否登入過
          if(isset($_SESSION["member_id"])) {
            $login=true;
            $stmt = $conn->prepare("SELECT * FROM annieshen_users WHERE user_id=?");
            $stmt->bind_param("s", $_SESSION["member_id"]);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $row = $result->fetch_assoc();
            $user_id=$row['user_id'];
            $nickname = htmlspecialchars($row ["nickname"], ENT_QUOTES, 'utf-8');;
              ?>
              <div class = 'userInfo'>
                <div class='id' data-id="<?php echo substr($user_id,0,1); ?>"><?php  echo substr($user_id,0,1); ?></div>
                <div class='name' data-id="<?php echo $nickname; ?>"><?php  echo $nickname;?></div>
              </div> 
      
            <?php
            
          } else{
            $login=false;
          }
          
        ?>

          <textarea cols="50" rows="5" name="writeContent" class="text"></textarea>
          <?php 
          //判斷是否登入過
          if($login){
          ?>          
            <div class="btn-wrap"><input type="submit" id="add" class="replySubmit btn btn-info" value="送出" /></div>
          <?php
            
          } else{?>
            <div><a href="login.php" class="btn btn-info btn-block">留言請先登入</a></div>
              
          <?php   
          }
          ?>
            
          
        </div>
      </form>
    <div class="reply"><!--.reply-->

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
     
        <div class="reply_wrap row"><!--.reply_wrap-->
        <div class="main_reply list">
          
          <div class="userInfo"> 
            
            <div class='id'><?php echo substr($row ["user_id"],0,1); ?></div>
            <div class='name'><?php echo htmlspecialchars($row ["nickname"], ENT_QUOTES, 'utf-8'); ?></div>
            <div class='date'><?php echo $row ["created_at"]; ?></div>
            <div class='show_content'>
              <div class="show_content_text"><?php echo htmlspecialchars($row ["content"], ENT_QUOTES, 'utf-8'); ?></div>

            
              <?php
              //主留言修改刪除
              if($login) {
                if($row ["user_id"] === $user_id) { //如果comments 的user_id = cookie裡的user_id

              ?>

                  <form action="updateComments.php" class="updateComments" method="POST" onsubmit="return submit_check();">
                    <input type="button" value="編輯" name="edit_btn" class="edit_btn edit<?php echo $row ["id"]; ?>" data-id="<?php echo $row ["id"]; ?>"/>
                    
                    <div class="edit_box edit_box<?php echo $row ["id"]; ?>">
                      <textarea cols="50" rows="5" name="content" class="text text_edit"><?php echo htmlspecialchars($row ["content"], ENT_QUOTES, 'utf-8'); ?></textarea>
                      <input type="hidden" name="comment_id" class="comment_id" value="<?php echo $row ["id"] ?>" />
                      <input type="submit" value="修改留言" class="btn-edit"/>
                    </div>
                  </form>

                  <form id="deleteComments" class="deleteComments" action="deleteComments.php" method="POST" onsubmit="return delete_check();">
                    <input type="hidden" name="comment_id" class="comment_id" value="<?php echo $row ["id"] ?>" />
                    <input type="submit" value="刪除" class="delete_btn"/>
                  </form>
                

                <script>
                $('.edit_box<?php echo $row ["id"]; ?>').hide();
                $('.show_content').on('click', '.edit<?php echo $row ["id"]; ?>', function(event) {
                  
                    var $target = $(event.target);
                    if( $target.is(".edit<?php echo $row ["id"]; ?>") ) {
                      
                      $('.edit_box<?php echo $row ["id"]; ?>').toggle();
                      console.log($(event.target).html());
                  }
                });
                </script>

                <?php

              }  

            }
            ?>
            </div><!--.show_content-->  
          </div><!--.user_info-->    
  
          <?php
            $comment_id = $row ["id"];
            //拿子留言
            $sql_commentChild = "SELECT annieshen_commentschild.id, annieshen_commentschild.content, annieshen_commentschild.parent_id, annieshen_users.nickname, annieshen_commentschild.user_id, annieshen_commentschild.created_at FROM annieshen_commentschild LEFT JOIN annieshen_users ON annieshen_commentschild.user_id = annieshen_users.user_id WHERE annieshen_commentschild.parent_id = $comment_id ORDER BY annieshen_commentschild.created_at ASC";
            $result2  = $conn->query($sql_commentChild); //conn連結資料庫  result是物件

            if($result2 -> num_rows>0 ){
              while($row2 = $result2 -> fetch_assoc() ){ //fetch_assoc 會逐一搜尋 找不到結束while

                  if($row2 ["user_id"] === $row ["user_id"]){
                    ?>
                    <div class="under_reply member_reply"> 
                    <?php
                  }else{
                    ?>
                    <div class="under_reply"> 
                    <?php
                  }

                ?>
        
                    <dl class='userInfo'>
                      <dt class='id'><?php echo substr($row2 ["user_id"],0,1);?></dt>
                      <dd class='name'><?php echo htmlspecialchars($row2 ["nickname"], ENT_QUOTES, 'utf-8'); ?></dd>
                      <dd class='date'><?php echo $row2 ["created_at"]; ?></dd>
                    </dl>
                    <div class='show_content_child'>
                      <div class="show_content_text"><?php echo htmlspecialchars($row2 ["content"], ENT_QUOTES, 'utf-8'); ?></div>
                    
                    
                    <?php
                    //子留言修改刪除
                    if($login){
                      if($row2 ["user_id"] === $user_id) { //如果comments 的user_id = cookie裡的user_id
                      //if($row2 ["user_id"] === $row_nickname ["user_id"])    {
                        ?>
                        <form action="updateCommentsChild.php" method="POST" onsubmit="return submit_check();">

                          <input type="button" name="edit" value="編輯" class="edit_btn edit_child<?php echo $row2 ["id"]; ?>"/>
                          <div class="edit_box_child<?php echo $row2 ["id"]; ?>">

                            <textarea cols="50" rows="5" name="content" class="text text_edit"><?php echo htmlspecialchars($row2 ["content"], ENT_QUOTES, 'utf-8'); ?></textarea>
                            <input type="hidden" name="comment_id" value="<?php echo $row2 ["id"] ?>" />
                            <input type="submit" value="修改留言" class="btn-edit"/>
                          </div>
                        </form>
                        <form action="deleteCommentsChild.php" method="POST" onsubmit="return delete_check();">
                          <input type="hidden" name="comment_id" value="<?php echo $row2 ["id"] ?>" />
                          <input type="submit" value="刪除" class="delete_btn" />
                        </form>

                       <script>
                          $('.edit_box_child<?php echo $row2 ["id"]; ?>').hide();
                          $('.show_content_child').on('click', '.edit_child<?php echo $row2 ["id"]; ?>', function(event) {    
                            var $target_child = $(event.target);
                            if( $target_child.is(".edit_child<?php echo $row2 ["id"]; ?>") ) { 
                              $('.edit_box_child<?php echo $row2 ["id"]; ?>').toggle();
                            }
                          });
                        </script>

                        <?php
                      }  
                      ?>
                      
                      <?php
                      

                    }
                    ?>
                    
                    </div><!--.show_content_child-->
                  </div>

          
                <?php
                
              }
              
            }else{
              //echo "0 results";
            }

            ?>
         </div><!--under_reply-->
    <?php

      //判斷是否登入過
      if($login){

  ?>

      <form action="underComments.php" class="underComments" method="POST">      
        <div class="">
          <div class="">
            <textarea cols="50" rows="5" name="writeContentChild" class="text"></textarea>
            <div class='btn-wrap'><input type="submit" id="add" class="btn btn-info" value="回覆" /></div>
            <input type="hidden" name="commentsId" class="commentsId" data-id="<?php echo substr($user_id,0,1); ?>" data-name="<?php echo $nickname; ?>" value="<?php echo $row ["id"]?>" />
          </div>
        </div>
      </form>

  <?php
        
      }else{
  ?>
        <div class='login_bar'><a href="login.php" class="btn btn-default btn-block">登入回應留言</a></div>
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
</div><!--.reply-->
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
<script src="js/index.js"></script>
</html>
