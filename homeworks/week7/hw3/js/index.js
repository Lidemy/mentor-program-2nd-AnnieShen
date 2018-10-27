
//新增主留言改 ajax
$(document).ready(function () {
  $('.writeComments').submit(function(e){
    e.preventDefault();
    //console.log($(e.target).find('textarea[name=writeContent]'));
    const content = $(e.target).find('textarea[name=writeContent]').val();
    const user_id = $(e.target).find('.id').data("id");
    const nickname = $(e.target).find('.name').data("id");
    console.log(content,user_id,nickname);

    //現在時間
    const TimeNow= new Date();
    const yyyy = TimeNow.toLocaleDateString().slice(0,4)
    const MM = (TimeNow.getMonth()+1<10 ? '0' : '')+(TimeNow.getMonth()+1);
    const dd = (TimeNow.getDate()<10 ? '0' : '')+TimeNow.getDate();
    const h = (TimeNow.getHours()<10 ? '0' : '')+TimeNow.getHours();
    const m = (TimeNow.getMinutes()<10 ? '0' : '')+TimeNow.getMinutes();
    const s = (TimeNow.getSeconds()<10 ? '0' : '')+TimeNow.getSeconds(); 
    const now = yyyy +"-"+ MM +"-"+ dd +" "+ h +":"+ m +":"+ s;


    $.ajax({
      type: 'POST',
      url: 'writeComments.php',
      data: {
        writeContent : content,
        
      },
      success: function(resp) {
        console.log('response:', resp);
        var res = JSON.parse(resp);
        if(res.result === 'success'){
          $('.reply').prepend(
            `
          <div class="reply_wrap row"><!--.reply_wrap-->
            <div class="main_reply list">
          
          <div class="userInfo"> 
            
            <div class="id">${user_id}</div>
            <div class="name">${nickname}</div>
            <div class="date">${now}</div>
            <div class="show_content">
              <div class="show_content_text">${content}</div>
            
              
                  <form action="updateComments.php" class="updateComments" method="POST" onsubmit="return submit_check();">
                    <input type="button" value="編輯" class="edit_btn edit${res.id}">
                    
                    <div class="edit_box edit_box${res.id}">
                      <textarea cols="50" rows="5" name="content" class="text text_edit">${content}</textarea>
                      <input type="hidden" name="comment_id" class="comment_id" value="${res.id}">
                      <input type="submit" value="修改留言" class="btn-edit">
                    </div>
                  </form>

                  <form id="deleteComments" class="deleteComments" method="POST" onsubmit="return delete_check();">
                    <input type="hidden" name="comment_id" class="comment_id" value="${res.id}">
                    <input type="submit" value="刪除" class="delete_btn">
                  </form>
                

                </div><!--.show_content-->  
            </div><!--.user_info-->    
  
          
        </div><!--under_reply-->
    
      <form action="underComments.php" class="underComments" method="POST">      
        <div class="">
          <div class="">
            <textarea cols="50" rows="5" name="writeContentChild" class="text"></textarea>
            <div class="btn-wrap"><input type="submit" id="add" class="btn btn-info" value="回覆"></div>
            <input type="hidden" name="commentsId" value="${res.id}">
          </div>
        </div>
      </form>
    </div><!--.reply_wrap-->
                

            `

          )
          

          //append後刪除
          $('.deleteComments').submit(function(e){
            e.preventDefault();
            console.log($(e.target).find('.comment_id').val());
            const delete_comment_id = $(e.target).find('.comment_id').val();
            //alert(delete_comment_id);

            $.ajax({
              type: 'POST',
              url: 'deleteComments.php',
              data: {
                comment_id : delete_comment_id,
                
              },
              success: function(resp) {
                console.log('response:', resp);
                var res = JSON.parse(resp);
                
                if(res.result === 'success'){
                  $(e.target).parent().parent().parent().parent().remove();
                }
              }
            });
          });

          //append後修改
          $('.updateComments').submit(function(e){
            e.preventDefault();
            console.log($(e.target).find('.comment_id').val());
            const edit_comment_id = $(e.target).find('.comment_id').val();
            const edit_content = $(e.target).find('textarea[name=content]').val();
            $.ajax({
              type: 'POST',
              url: 'updateComments.php',
              data: {
                comment_id : edit_comment_id,
                content : edit_content,  
              },
              success: function(resp) {
                console.log('response:', resp);
                var res = JSON.parse(resp);
                
                if(res.result === 'success'){
                  $(e.target).parent().children('.show_content_text').text(
                    `
                    ${edit_content}
                    `
                    );
                  //$('.show_content_text').text("更改成功");
                  
                }
              }
            });

          });


          $(e.target).find('textarea[name=writeContent]').val("");
        }
      }
    });
    
  });
});


//刪除主留言
$(document).ready(function () {
  $('.deleteComments').submit(function(e){
    e.preventDefault();
    console.log($(e.target).find('.comment_id').val());
    const delete_comment_id = $(e.target).find('.comment_id').val();

    $.ajax({
      type: 'POST',
      url: 'deleteComments.php',
      data: {
        comment_id : delete_comment_id,
        
      },
      success: function(resp) {
        console.log('response:', resp);
        var res = JSON.parse(resp);
        
        if(res.result === 'success'){
          $(e.target).parent().parent().parent().parent().remove();
        }
      }
    });


  });
});

//修改主留言
$(document).ready(function () {
  $('.updateComments').submit(function(e){
    e.preventDefault();
    console.log($(e.target).find('.comment_id').val());
    const edit_comment_id = $(e.target).find('.comment_id').val();
    const edit_content = $(e.target).find('textarea[name=content]').val();
    $.ajax({
      type: 'POST',
      url: 'updateComments.php',
      data: {
        comment_id : edit_comment_id,
        content : edit_content,  
      },
      success: function(resp) {
        console.log('response:', resp);
        var res = JSON.parse(resp);
        
        if(res.result === 'success'){
          $(e.target).parent().children('.show_content_text').text(
            `
            ${edit_content}
            `
            );
          //$('.show_content_text').text("更改成功");
          
        }
      }
    });

  });
});




function submit_check(){
  let message = confirm("確定要修改留言嗎?");
  // if (message == true){
  //   alert("留言修改成功");
  // }else{
  //   return false;
  // }
}

/*刪除留言提示*/
function delete_check(){
  let message = confirm("確定要刪除留言嗎?");
  // if (message == true){
  //   alert("留言刪除成功");
  // }else{
  //   return false;
  // }
}

