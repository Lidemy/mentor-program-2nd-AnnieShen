<div class="header">
    <div class="home"><a href="index.php"><b>I WANT TO SAY.</b></a></div> 
    <div class="login">
        
        <?php 

            //判斷是否登入過
            if(!isset($_COOKIE[$cookie_name])){
                
            } else{
                //echo "member id: " . $_COOKIE[$cookie_name];
                echo "Hello " . $_COOKIE[$cookie_name] ." !";
                
                
            }
        ?>    

        

        <?php 

            //判斷是否登入過
            if(!isset($_COOKIE[$cookie_name])){  ?> 
                <a href="register.php">註冊</a> <a href="login.php">會員登入</a>
                <?php  } else{ ?> 

                
                <a href="logout.php">登出</a>
                
                
            <?php } ?> 
    

        
    
    </div>
</div>